<?php
include ('includes/dbFunctions.php');

if(isset($_SESSION["UserID"]) and ($_SESSION["UserType"]==0)) {
    $farmID =$_SESSION["UserID"];
    //echo "farm ID" .$farmID;
}
else {
    $farmID = $_GET["farmID"];
    $_SESSION['farmID'] = $farmID;
    //echo $farmID;
}

$table = selectEmp($farmID);

?>
<head>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <title></title>
</head>
<body>
<br>


<div class="modal fade" id="submitAddMemberTicketModal" tabindex="-1" role="dialog" aria-labelledby="submitAddMemberTicketModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitAddMemberTicketModalLabel">Add Member Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="submitAddMemberTicket" method="post" >
                    <label>
                        ID Number
                    </label>
                    <br>
                    <input id = "IDnumInput"  type = "text" name ="IDnum" >
                    <br>
                    <label>
                        First Name/s
                    </label>
                    <br>
                    <input id = "firstNameInput"  type = "text" name ="fnames" >
                    <br><label>
                        Surname/s
                    </label>
                    <br>
                    <input id = "surNameInput"  type = "text" name ="snames" >
                    <br><label>
                        Email
                    </label>
                    <br>
                    <input id = "emailInput"  type = "text" name ="email" >
                    <br><label>
                        Phone Number
                    </label>
                    <br>
                    <input id = "phoneNumInput"  type = "text" name ="phoneNum" >
                    <br><label>
                        Date of Birth
                    </label>
                    <br>
                    <input id = "dobInput"  type = "date" name ="dob" >
                    <br>
                    <label> PlanID</label>
                    <br>
                    <select id = "addplans" name = "planID" >
                        <option value="">Please select plan</option>
                        <option value="1">Plan 1, Deduction Amount: 10, Payout Amount: 10 000</option>
                        <option value="2">Plan 2, Deduction Amount: 20, Payout Amount: 20 000</option>
                        <option value="3">Plan 3, Deduction Amount: 30, Payout Amount: 30 000</option>

                    </select>
                    <br><label>
                        comment
                    </label>
                    <br>
                    <input id = "addComment"  type = "text" name ="addcomment" >
                    <br>


                    <br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input onclick="submitAddMemTicket(<?php echo $farmID?>)"  type="submit" class="btn btn-success">
                </form>


            </div>

        </div>
    </div>
</div>




<div class="text-center">
<table class="table table-striped table-bordered">

    <thead class="thead-dark">
    <tr>

        <th>ID</th>
        <th>Member ID</th>
        <th>Firstname</th>
        <th>Surname</th>
        <th>Plan</th>
        <th>Amount</th>
        <th>Dependent Deductions</th>
        <th>
                Actions
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitAddMemberTicketModal">

                <span class="glyphicon glyphicon-plus"></span>
            </button>
            <button type="button" class="btn btn-success" onclick="loadFarmPDF()">

                <span class="glyphicon glyphicon-download"></span>
            </button>

        </th>
    </tr>
    </thead>

    <?php
            while($row =$table->fetch_array(MYSQLI_BOTH)  )
            {
                echo '<tr>'
                    . '<td>' . $row['IDnum'] . '</td>'
                    . '<td>' . $row['memID'] . '</td>'
                    . '<td>' .  $row['fnames']  . '</td>'
                    . '<td>' .  $row['sname']  . '</td>'
                    . '<td>' .  $row['planID']  . '</td>'
                    . '<td>' .  $row['deductionAmount']  . '</td>'
                    . '<td>' .  $row['deductable']  . '</td>'

                    .'<td> <button class="btn btn-success" onclick="isolatedEmp('.$row['memID'].','.$farmID.')"> View</button>'

            . ' 
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitRemoveTicketModal' . $row['memID'] . ' ">
                        <span class="glyphicon glyphicon-remove"></span> 
                    </button>
                    
                    <div class="modal fade" id="submitRemoveTicketModal' . $row['memID'] . '" tabindex="-1" role="dialog" aria-labelledby="submitRemoveTicketModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="submitRemoveTicketModalLabel">Remove Member Ticket</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="ticketSubmit" method="post" >
                                        <label>
                                           Remove ' . $row['fnames'] . ' ' .$row['sname'] . '
                                        </label>
                                        <br>
                                        <label>
                                        comment
                                        </label>
                                        <input id = "input' . $row['memID'] . '"  type = "text" name ="comment" >
                                        <br>
                                        
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input onclick="submitRemoveTicket('.$row['memID'].',' . $farmID . ')"  type="submit" class="btn btn-success">
                                    </form>
                    
                    
                                </div>
                    
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitEditTicketModal' . $row['memID'] . ' ">
                        <span class="glyphicon glyphicon-edit"></span> 
                    </button>
                    
                    <div class="modal fade" id="submitEditTicketModal' . $row['memID'] . '" tabindex="-1" role="dialog" aria-labelledby="submitEditTicketModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="submitEditTicketModalLabel">Edit Member Ticket</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="ticketEditSubmit" method="post" >
                                        <label>Edit '.  $row['fnames'].' '. $row['sname'].' </label>
                                        <br>
                                        <label>Phone Number</label>
                                        <br>
                                        <input type="text" name = "PhoneNumber" id="pn' . $row['memID'] . '">
                                        <br>
                                    
                                        <label>Email</label>
                                        <br>
                                        <input type="text" name = "Email" id = "em' . $row['memID'] . '">
                                        <br>
                                    
                                        <label> PlanID</label>
                                        <br>
                                        <select id = "plans' . $row['memID'] . '" name = "planID" >
                                            <option value="">Please select plan</option>
                                            <option value="1">Plan 1, Deduction Amount: 10, Payout Amount: 10 000</option>
                                            <option value="2">Plan 2, Deduction Amount: 20, Payout Amount: 20 000</option>
                                            <option value="3">Plan 3, Deduction Amount: 30, Payout Amount: 30 000</option>
                                    
                                        </select>
                                        <br>
                                        
                                        <label>
                                        comment
                                        </label>
                                        <br>
                                        <input id = "editinput' . $row['memID'] . '"  type = "text" name ="comment" >
                                        <br>
                                    
                                        <br>
                                        <input type = "submit" onclick = "submitEditTicket('.$row['memID'].',' . $farmID . ')" class="btn btn-success">
                                    </form>
                    
                    
                                </div>
                    
                            </div>
                        </div>
                    </div>
                    

            .</td>'

            . '<tr>';
    }

    ?>
</table>
</div>
</body>
</html>
<script>
    function loadFarmPDF(){
        window.open('downloadTest.php');
    }
    function isolatedEmp(memId, farmID) {

        alert('viewed '+memId);
        window.location.replace('FarmIndex.php?page=viewEmployee&memID='+memId + '&farmID='+farmID);



    }

    function submitAddMemTicket(farmID) {

        alert("addMem Ticket");

        let IDnum = document.getElementById('IDnumInput').value;
        let fn = document.getElementById('firstNameInput').value;
        let sn = document.getElementById('surNameInput').value;
        let email = document.getElementById('emailInput').value;
        let phoneNum = document.getElementById('phoneNumInput').value;
        let dob = document.getElementById('dobInput').value;
        let comment = document.getElementById('addComment').value;
        let plan = document.getElementById('addplans').value;

        let member_data = IDnum +',' + fn +',' + sn +',' + email +','+ phoneNum +','+ dob+','+plan ;
        alert(member_data);
        $.ajax({
            url: 'includes/dbFunctions.php',
            type: "post",
            data: {
                fun: 'submitTicket',
                type: 'addMember',
                iso: farmID,
                com: comment,
                chg: member_data,
                farmID: farmID
            },
            success: function () {
                alert("worked");
            }
        })


    }

    function submitRemoveTicket(memID, farmID) {

        alert(farmID);

        let comment = document.getElementById('input' + memID).value;


        $.ajax({
            url: 'includes/dbFunctions.php',
            type: "post",
            data: {
                fun: 'submitTicket',
                type: 'removeMember',
                iso: memID,
                com: comment,
                chg: "31",
                farmID: farmID
            },
            success: function () {
                alert("worked");
            }
        })


    }

    function submitEditTicket(memID, farmID) {
        let phonenumber = document.getElementById('pn'+ memID).value;
        let email = document.getElementById('em'+ memID).value;
        let plan = document.getElementById('plans'+ memID).value;
        let comment = document.getElementById('editinput' + memID).value;
        let edit_data = phonenumber + ","+ email +","+plan;

        alert(edit_data);
        alert(comment);

        $.ajax({
            url: 'includes/dbFunctions.php',
            type: "post",
            data: {
                fun: 'submitTicket',
                type: 'editMember',
                iso: memID,
                com: comment,
                chg: edit_data,
                farmID: farmID
            },
            success: function () {
                alert("worked");
            }
        })

    }


</script>
