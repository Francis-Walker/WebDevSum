<?php
error_reporting(0);
session_start();
error_reporting(E_ALL);
include ('db_connect.php');

function selectEmp($farmID)
    {

        $sqlConn = connectToDb();

        $query = "SELECT persons.IDnum,members.memID, persons.fnames, persons.sname,  members.planID, plans.deductionAmount, plans.paymentAmount,totalDep.deductable
FROM members
LEFT OUTER join persons on persons.IDnum = members.ID
LEFT OUTER join plans on plans.planID = members.planID
LEFT OUTER join (SELECT memID, sum(plans.deductionAmount)as deductable from dependents inner join plans on plans.planID = dependents.planID group by memID) as totalDep on members.memID =totalDep.memID
Where members.farmID =  '".$farmID."'";

        $result = $sqlConn ->query($query);

        return $result;

    }
function selectTic($farmID, $userType)
    {

        $sqlConn = connectToDb();



        if ($userType==0) {
            $query = "SELECT * FROM `tickets` WHERE farmID = '" . $farmID . "' order by Status asc";
        }
        elseif($userType==1){

            $query = "SELECT * FROM `tickets` WHERE (adminID = '" . $farmID . "'or adminID = '0') and userID <> '" . $farmID . "' order by Status asc";
        }

        $result = $sqlConn ->query($query);

        return $result;

    }
function viewTic($ticID)
{

    $sqlConn = connectToDb();

    $query = "SELECT * FROM `comments` WHERE ticketID = '".$ticID."'";

    $result = $sqlConn ->query($query);

    return $result;

}
function selectDep($memID)
{
    $sqlConn = connectToDb();

    $query = "SELECT persons.IDnum, dependents.depID,  persons.fnames, persons.sname, plans.planID, plans.deductionAmount, plans.paymentAmount 
FROM dependents
INNER join persons on persons.IDnum = dependents.ID
INNER join plans on plans.planID = dependents.planID
where dependents.memID = '".$memID."'";

    $result = $sqlConn ->query($query);

    return $result;
    //
}

function getMemName($memID)
{
    $sqlConn = connectToDb();
    $query = "SELECT persons.fnames, persons.sname, persons.IDnum
                FROM `persons`INNER join members on persons.IDnum = members.ID 
            Where members.memID = '".$memID."'";

            $result = $sqlConn ->query($query);

    return $result;

}
function getDepName($depID)
{
    $sqlConn = connectToDb();
    $query = "SELECT persons.fnames, persons.sname, persons.IDnum
                FROM `persons`INNER join dependents on persons.IDnum = dependents.ID 
            Where dependents.depID = '".$depID."'";

    $result = $sqlConn ->query($query);

    return $result;

}


function submitTicket($type , $isolated, $change,$farmID)
{
    $sqlConn = connectToDb();

    $query = "INSERT INTO `tickets` (`TicketID`, `Type`, `Isolated`, `Changes`,`farmID`,`UserID`)
    VALUES (NULL,'" .$type."','".$isolated."','".$change."','".$farmID."','".$_SESSION["UserID"]."')";

     $sqlConn ->query($query);
}

function submitComment($comment){
    $sqlConn = connectToDb();

    $query = "INSERT INTO `comments` 
                        (`commentID`, `ticketID`, `submitedTime`, `comment`)
                        VALUES (NULL, (SELECT max(ticketID) FROM `tickets`), current_timestamp(),'".$comment."')";
    $sqlConn ->query($query);
}

function submitNewComment($ticID,$comment){
    $sqlConn = connectToDb();

    $query = "INSERT INTO `comments` 
                        (`commentID`, `ticketID`, `submitedTime`, `comment`)
                        VALUES (NULL,".$ticID.",current_timestamp(),'".$comment."')";
    $sqlConn ->query($query);
}

function getDepPDF($memID)
{
    $sqlConn = connectToDb();
    $query =
        "SELECT dependents.depID, persons.fnames, persons.sname, persons.IDnum, persons.PhoneNum, persons.email, 
       plans.planID, plans.deductionAmount 
    FROM dependents 
    INNER join persons on persons.IDnum = dependents.ID 
    INNER join plans on plans.planID = dependents.planID where dependents.memID ='". $memID."'";
    $result = $sqlConn -> query($query);
    return $result;
}

function getMemPDF($farmID)
{
    $sqlConn = connectToDb();
    $query =
        "SELECT members.memID, persons.fnames, persons.sname, persons.IDnum, persons.PhoneNum, persons.email, members.planID, plans.deductionAmount, (plans.deductionAmount +totalDep.deductable) as totalDeduction
        FROM members
        LEFT OUTER join persons on persons.IDnum = members.ID
        LEFT OUTER join plans on plans.planID = members.planID
        LEFT OUTER join 
            (SELECT memID, sum(plans.deductionAmount)as deductable from dependents inner join plans on plans.planID = dependents.planID group by memID)
        as totalDep on members.memID =totalDep.memID
        Where members.farmID ='" . $farmID."'";

    $result =$sqlConn->query($query);
    return $result;
}

function getOwners(){

    $sqlConn = connectToDb();
    $query = "SELECT UserID, FarmName from users where UserType = 0";
    $result = $sqlConn->query($query);
    return $result;

}

function getTicketDetails($ticID){

    $sqlConn = connectToDb();
    $query = "SELECT Type, Isolated, Changes,farmID,adminID FROM `tickets` WHERE TicketID ='" .$ticID."'";
    $result = $sqlConn->query($query);


    $ticket = $result->fetch_array(MYSQLI_BOTH);



    if($ticket['Type']=='removeMember'){
        $query = "SELECT FarmName from users where UserID = '".$ticket['farmID'] ."'";
        $result = $sqlConn->query($query);
        $name = getMemName($ticket['Isolated'])->fetch_array(MYSQLI_BOTH);
        $farmName = $result->fetch_array(MYSQLI_BOTH);
        $ticket_details = 'Member '.$name['fnames'].' '.$name['sname'].' will be removed from '. $farmName['FarmName'];
        $ticketQuery1 = "DELETE FROM `members` WHERE `members`.`memID` ='" .$ticket['Isolated']."'";
        $ticketQuery2 = "DELETE FROM `dependents` WHERE `dependents`.`memID` ='" .$ticket['Isolated']."'";
        $outputQuery = array($ticketQuery1,$ticketQuery2);
    }
    elseif($ticket['Type']=='removeDependent'){
        $query = "SELECT FarmName from users where UserID = '".$ticket['farmID'] ."'";
        $result = $sqlConn->query($query);
        $name = getDepName($ticket['Isolated'])->fetch_array(MYSQLI_BOTH);
        $farmName = $result->fetch_array(MYSQLI_BOTH);


        $ticket_details = 'Dependent '.$name['fnames'].' '.$name['sname'].' will be removed from '. $farmName['FarmName'];
        $ticketQuery1 = "DELETE FROM `dependents` WHERE `dependents`.`depID` ='" .$ticket['Isolated']."'";
        $outputQuery = array($ticketQuery1);
    }
    elseif($ticket['Type']=='editDependent'){
        $name = getDepName($ticket['Isolated'])->fetch_array(MYSQLI_BOTH);
        $edit_details = explode(',' ,$ticket['Changes']);
        $edits_string ='';
        $outputQuery =array();
        if($edit_details[0]){
            $edits_string .= "PhoneNumber: " .$edit_details[0]. "<br>";
            array_push($outputQuery,"UPDATE `persons` SET `PhoneNum` = '" .$edit_details[0]."'
             WHERE `persons`.`IDnum` ='".$name["IDnum"]."'");
        }
        if($edit_details[1]){
            $edits_string .= "Email: " .$edit_details[1]. "<br>";
            array_push($outputQuery,"UPDATE `persons` SET `email` = '" .$edit_details[1]."'
             WHERE `persons`.`IDnum` ='".$name["IDnum"]."'");
        }
        if($edit_details[2]){
            $edits_string .= "Plan: " .$edit_details[2]. "<br>";
            array_push($outputQuery,"UPDATE `dependents` SET `planID` = '".$edit_details[2]. "'
             WHERE `dependents`.`depID` ='".$ticket['Isolated']."'");
        }


        $ticket_details ='Dependent '.$name['fnames'].' '.$name['sname'].' will under go the following changes<br>'.$edits_string;


    }
    elseif($ticket['Type']=='editMember'){
        $name = getMemName($ticket['Isolated'])->fetch_array(MYSQLI_BOTH);
        $edit_details = explode(',' ,$ticket['Changes']);
        $edits_string ='';
        $outputQuery =array();
        if($edit_details[0]){
            $edits_string .= "PhoneNumber: " .$edit_details[0]. "<br>";
            array_push($outputQuery,"UPDATE `persons` SET `PhoneNum` = '" .$edit_details[0]."'
             WHERE `persons`.`IDnum` ='".$name["IDnum"]."'");
        }
        if($edit_details[1]){
            $edits_string .= "Email: " .$edit_details[1]. "<br>";
            array_push($outputQuery,"UPDATE `persons` SET `email` = '" .$edit_details[1]."'
             WHERE `persons`.`IDnum` ='".$name["IDnum"]."'");
        }
        if($edit_details[2]){
            $edits_string .= "Plan: " .$edit_details[2]. "<br>";
            array_push($outputQuery,"UPDATE `members` SET `planID` = '".$edit_details[2]. "'
             WHERE `members`.`memID` ='".$ticket['Isolated']."'");
        }


        $ticket_details ='Member '.$name['fnames'].' '.$name['sname'].' will under go the following changes<br>'.$edits_string;


    }
    elseif($ticket['Type']=='addMember'){

        //$name = getDepName($ticket['Isolated'])->fetch_array(MYSQLI_BOTH);
        $add_details = explode(',' ,$ticket['Changes']);
        $ticket_details='Add Member<br>Name: '.$add_details[1].' '.$add_details[2].'<br>ID number: 
                        '.$add_details[0].'<br>Email: '.$add_details[3].'<br>Phone: '.$add_details[4].
            '<br>Date of Birth: '.$add_details[5].'<br>Plan Number: '.$add_details[6];
        $outputQuery =array();

        array_push($outputQuery,
            "INSERT INTO `persons` (`IDnum`, `PhoneNum`, `DOB`, `email`, `fnames`, `sname`) 
                    VALUES ('".$add_details[0]."','".$add_details[4]."', '".$add_details[5]."', '".$add_details[3]."','".$add_details[1]."', '".$add_details[2]."') "
        );
        array_push($outputQuery,
            "INSERT INTO `members` (`ID`, `memID`, `coverageDate`, `planID`, `farmID`)
                    VALUES ('".$add_details[0]."', NULL, 'CURDATE()', '".$add_details[6]."', '".$ticket['farmID']."');"
        );


    }
    elseif($ticket['Type']=='addDependent'){

    $name = getDepName($ticket['Isolated'])->fetch_array(MYSQLI_BOTH);
    $add_details = explode(',' ,$ticket['Changes']);
    $ticket_details='Add Dependent<br>Name: '.$add_details[1].' '.$add_details[2].'<br>ID number: 
                        '.$add_details[0].'<br>Email: '.$add_details[3].'<br>Phone: '.$add_details[4].
        '<br>Date of Birth: '.$add_details[5].'<br>Plan Number: '.$add_details[6];
    $outputQuery =array();

    array_push($outputQuery,
        "INSERT INTO `persons` (`IDnum`, `PhoneNum`, `DOB`, `email`, `fnames`, `sname`) 
                    VALUES ('".$add_details[0]."','".$add_details[4]."', '".$add_details[5]."', '".$add_details[3]."','".$add_details[1]."', '".$add_details[2]."') "
    );
    array_push($outputQuery,
        "INSERT INTO `dependents` (`ID`, `depID`, `coverageDate`, `planID`, `memID`)
                    VALUES ('".$add_details[0]."', NULL, 'CURDATE()', '".$add_details[6]."', '".$ticket['Isolated']."');"
    );


}
    else{
        $ticket_details = 'Default';

        $outputQuery = 'default';
    }

    $output=array($ticket['Type'],$ticket_details,$outputQuery,$ticket['adminID']);
    return $output;
}

function getReTicketDetails($ticID){

    $sqlConn = connectToDb();
    $query = "SELECT Type, details,adminID FROM `tickets` WHERE TicketID ='" .$ticID."'";
    $result = $sqlConn->query($query);


    $ticket = $result->fetch_array(MYSQLI_BOTH);
    return array($ticket['Type'],$ticket['details'],null,$ticket['adminID']);
}

function checkStatus($ticID){
    $sqlConn = connectToDb();
    $query = "SELECT Status FROM `tickets` WHERE TicketID ='" .$ticID."'";
    $result = $sqlConn->query($query);
    $ticket = $result->fetch_array(MYSQLI_BOTH);

    if($ticket['Status']==3 or $ticket['Status']==2){
        return false;
    }
    else{
        return true;
    }
}

function resolveTicket($queries,$ticID,$text){
    $sqlConn = connectToDb();


    foreach ( $queries as $q){
        $sqlConn->query($q);
    }
    $sqlConn->query("UPDATE `tickets` SET Status = 2, `details` = '" .$text."' WHERE `tickets`.`TicketID` ='" .$ticID."'");
}

function assignTicket($ticID,$adminID)
{
    $sqlConn = connectToDb();
    $query = "UPDATE `tickets` SET `adminID` = '".$adminID."' , Status = 1 WHERE `tickets`.`TicketID` ='" .$ticID."'";
    $sqlConn->query($query);

}

function removeTicket($ticID, $text){
    $sqlConn = connectToDb();
    $sqlConn->query("UPDATE `tickets` SET Status = 3, `details` = '" .$text."' WHERE `tickets`.`TicketID` ='" .$ticID."'");
}
function editTicket($ticID, $changes){
    $sqlConn = connectToDb();
    $sqlConn->query("UPDATE `tickets` SET `Changes` ='".$changes."' WHERE `tickets`.`TicketID` ='" .$ticID."'");
}





if ((isset($_POST['fun'])) && !empty($_POST['fun']))
{
    echo "1";
    $fun = $_POST['fun'];

    switch ($fun){
        case 'submitTicket' :
            submitTicket($_POST['type'],$_POST['iso'],$_POST['chg'],$_POST['farmID']);
            submitComment($_POST['com']);
        break;
        case 'submitNewComment':
            submitNewComment($_POST['ticketID'],$_POST['comment']);
            break;

        case 'resolveTicket' :
            resolveTicket($_POST['query'], $_POST['ticID'], $_POST['ticDetails']);
            break;
        case 'assignTicket':
            assignTicket($_POST['ticID'],$_POST['adminID']);
            break;
        case 'removeTicket':
            removeTicket($_POST['ticID'], $_POST['ticDetails']);
            break;
        case 'submitEditTicket':
            editTicket($_POST['ticID'],$_POST['chg']);
            break;
    }
}

?>