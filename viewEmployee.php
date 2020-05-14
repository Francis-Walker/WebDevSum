<?php


//echo $_GET['memID'];
//

include('includes/dbFunctions.php');
$memID = $_GET['memID'];
$farmID = $_GET['farmID'];
//$memID = 1;
$table = selectDep($memID);
$head = getMemName($memID);
$header = $head ->fetch_array(MYSQLI_BOTH)
?>


<html>
<head>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="Stylesheet.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

        <title></title>

        <style>


        </style>




</head>
<body>

<h1>You are viewing <?php echo $header['fnames'] ." ".$header['sname'] ?></h1>
<br>
<br>



<div class=" modal fade" id="submitAddDependentTicketModal" tabindex="-1" role="dialog" aria-labelledby="submitAddDependentTicketModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitAddDependentTicketModalLabel">Add Dependent Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="submitAddDependentTicket" method="post" >
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
                    <br>


                    <label>
                        comment
                    </label>
                    <br>
                    <input id = "addComment"  type = "text" name ="addcomment" >
                    <br>


                    <br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input onclick="submitAddDepTicket(<?php echo $memID .','. $farmID?>)"  type="submit" class="btn btn-success">
                </form>


            </div>

        </div>
    </div>
</div>

<table class="table table-striped table-bordered">

    <thead class="thead-dark">
    <tr>
        <th>ID</th>
        <th>Dependant ID </th>
        <th>Dependant Firstname</th>
        <th>Dependant Surname</th>
        <th>Plan</th>
        <th>Deduction Amount</th>
        <th>Payment Amount</th>
        <th> Actions <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitAddDependentTicketModal">
                <span class="glyphicon glyphicon-plus"></span>
            </button></th>
    </tr>
    </thead>

    <?php

    while ($row = $table->fetch_array(MYSQLI_BOTH)) {
        echo '<tr>'
            . '<td>' . $row['IDnum'] . '</td>'
            . '<td>' . $row['depID'] . '</td>'
            . '<td>' .  $row['fnames']  . '</td>'
            . '<td>' .  $row['sname']  . '</td>'
            . '<td>' .  $row['planID']  . '</td>'
            . '<td>' .  $row['deductionAmount']  . '</td>'
            . '<td>' .  $row['paymentAmount']  . '</td>'

            . '
                <td> '

            . ' 
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitRemoveTicketModal' . $row['depID'] . ' ">
                        <span class="glyphicon glyphicon-remove"></span> 
                    </button>
                    
                    <div class="modal fade" id="submitRemoveTicketModal' . $row['depID'] . '" tabindex="-1" role="dialog" aria-labelledby="submitRemoveTicketModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="submitRemoveTicketModalLabel">Remove Dependent Ticket</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="ticketSubmit" method="post" >
                                        <label>
                                           Remove '.  $row['fnames']  . ' ' . $row['sname'] . '
                                        </label>
                                        <br>
                                        <label>
                                        comment
                                        </label>
                                        <input id = "input' . $row['depID'] . '"  type = "text" name ="comment" >
                                        <br>
                                        
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input onclick="submitRemoveTicket('.$row['depID'].',' . $farmID . ')"  type="submit" class="btn btn-success">
                                    </form>
                    
                    
                                </div>
                    
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitEditTicketModal' . $row['depID'] . ' ">
                        <span class="glyphicon glyphicon-edit"></span> 
                    </button>
                    
                    <div class="modal fade" id="submitEditTicketModal' . $row['depID'] . '" tabindex="-1" role="dialog" aria-labelledby="submitEditTicketModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="submitEditTicketModalLabel">Edit Dependent Ticket</h5>
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
                                        <input type="text" name = "PhoneNumber" id="pn" >
                                       <br>
                                    
                                        <label>Email</label>
                                        <br>
                                        <input type="text" name = "Email" id = "em">
                                        
                                    <br>
                                        <label> PlanID</label>
                                       <br>
                                        <select id = "plans'.$row['depID'].'" name = "planID" >
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
                                        <input id = "editinput' . $row['depID'] . '"  type = "text" name ="comment" >
                                        
                                    <br><br>
                                        <input type = "submit" onclick = "submitEditTicket('.$row['depID'].',' . $farmID . ')" class="btn btn-success">
                                    </form>
                    
                    
                                </div>
                    
                            </div>
                        </div>
                    </div>
                    
                    

            </td>'

            . '<tr>';
    }

    ?>
</table>
</body>
</html>
<script>
    function isolatedDep(depId) {

        alert('viewed ' + depId);
        window.location.replace('FarmIndex.php?page=employeeTable');


    }

    function submitRemoveTicket(depID, farmID) {

        alert(farmID);

        let comment = document.getElementById('input' + depID).value;


        $.ajax({
            url: 'includes/dbFunctions.php',
            type: "post",
            data: {
                fun: 'submitTicket',
                type: 'removeDependent',
                iso: depID,
                com: comment,
                chg: "31",
                farmID: farmID
            },
            success: function () {
                alert("worked");
            }
        })


    }

    function submitAddDepTicket(memID, farmID) {

        alert("addDep Ticket");

        let IDnum = document.getElementById('IDnumInput').value;
        let fn = document.getElementById('firstNameInput').value;
        let sn = document.getElementById('surNameInput').value;
         let email = document.getElementById('emailInput').value;
        let phoneNum = document.getElementById('phoneNumInput').value;
        let dob = document.getElementById('dobInput').value;
        let plan = document.getElementById('addplans').value;
        let comment = document.getElementById('addComment').value;

         let member_data = IDnum +',' + fn +',' + sn +',' + email +','+ phoneNum +','+ dob+','+plan ;
         alert(member_data);
        $.ajax({
            url: 'includes/dbFunctions.php',
            type: "post",
            data: {
                fun: 'submitTicket',
                type: 'addDependent',
                iso: memID,
                com: comment,
                chg: member_data,
                farmID: farmID
            },
            success: function () {
                alert("worked");
            }
        })


    }

    function submitEditTicket(depID, farmID) {
        let phonenumber = document.getElementById('pn').value;
        let email = document.getElementById('em').value;
        let plan = document.getElementById('plans'+depID).value;
        let comment = document.getElementById('editinput' + depID).value;
        let edit_data = phonenumber + ","+ email +","+plan;

        alert(edit_data);
        alert(comment);

        $.ajax({
            url: 'includes/dbFunctions.php',
            type: "post",
            data: {
                fun: 'submitTicket',
                type: 'editDependent',
                iso: depID,
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