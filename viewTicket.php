<?php
error_reporting(0);
session_start();
error_reporting(E_ALL);

//echo $_GET['memID'];
//

include('includes/dbFunctions.php');

$ticID = $_GET['ticID'];
$status = $_GET['status'];

//$ticID = 1;
$table = viewTic($ticID);

if(checkStatus($ticID)){

    $ticketDetails = getTicketDetails($ticID);
}
else {
    $ticketDetails = getReTicketDetails($ticID);
}
?>


    <html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <script
                src="http://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="Stylesheet.css">
        <title></title>
    </head>
    <body>
    <div class ="text-center">
    <h1>Ticket Details:</h1>

    <h3>Ticket Type:  </h3>
    <h5> <?php echo $ticketDetails[0]; ?> </h5>

    <h3>Ticket description:  </h3>
    <h5> <?php echo $ticketDetails[1] ?> </h5>



    <br>
    <br>
    <h2>Comments</h2>
    <br>
    <table class="table table-striped table-bordered">

        <thead class="thead-dark">
        <tr>
            <th>Time Submitted</th>
            <th>Comment</th>
        </tr>
        </thead>
        <tbody>

<?php

while ($row = $table->fetch_array(MYSQLI_BOTH)) {
    echo '<tr>'

        . '<td>' . $row['submitedTime'] . '</td>'
        . '<td>' . $row['comment'] . '</td>'



        . '<tr>';
}

?></tbody>
    </table>

<!--    <input type="textarea" id="comment-input">-->
    <label for="comment-input">
        Comment:

    </label>
    <br>
    <textarea id="comment-input">

    </textarea>
        <br>

        <br>

        <button class ="btn btn-success"  type="submit" id = "submitcomment">
        Submit comment
    </button>




    <?php
    if($_SESSION['UserType']==1) {
        if($status==0){
            echo '<button class ="btn btn-success"  type="submit" id = "assignTicket" onclick="assignTicket()">
           Assign Ticket
           </button>
           ';
        }
        elseif($status==1){

       echo '<button  class ="btn btn-success" type="submit" id = "resolveTicket" onclick="resolveTicket()">
        Resolve Ticket
    </button>';

       }
//       if($ticketDetails[3]==0 and $status==0) {
    }
    if ($status!=2 and $status!=3){
        echo'<button class ="btn btn-success" type="submit" id ="removeTicket" onclick="removeTicket()">
        remove/close
    </button>';


    if($ticketDetails[0]=='addMember')
    {echo'<button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitAddMemberTicketModal">
        Edit Ticket
    <span class="glyphicon glyphicon-edit"></span> 
</button>


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
                    <input id = "firstNameInput"  type = "text" name ="fnames" >
                    <br><label>
    Surname/s
                    </label>
                    <br>
                    <input id = "surNameInput"  type = "text" name ="snames" >
                    <br><label>
    Email
                    </label>
                    <input id = "emailInput"  type = "text" name ="email" >
                    <br><label>
    Phone Number
    </label>
                    <br>
                    <input id = "phoneNumInput"  type = "text" name ="phoneNum" >
                    <br><label>
    Date of Birth
    </label>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input onclick="updateAddQuery()"  type="submit" class="btn btn-success">
                </form>


            </div>

        </div>
    </div>
</div>';


    }
    elseif($ticketDetails[0]=='editMember')
    {echo ' <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitEditTicketModal">
 Edit Ticket
                        <span class="glyphicon glyphicon-edit"></span> 
                    </button>
                    
                    <div class="modal fade" id="submitEditTicketModal" tabindex="-1" role="dialog" aria-labelledby="submitEditTicketModalLabel"
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
                                        <label>Edit</label>
                                        <br>
                                        <label>Phone Number</label>
                    <br>
                                        <input type="text" name = "PhoneNumber" id="pn">
                                        <br>
                                    
                                        <label>Email</label>
                    <br>
                                        <input type="text" name = "Email" id = "em">
                                        <br>
                                    
                                        <label> PlanID</label>
                    <br>
                                        <select id = "plans" name = "planID" >
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
                                        <input id = "editinput"  type = "text" name ="comment" >
                                        <br>
                                    
                                        <input type = "submit" onclick = "updateEditQuery()" class="btn btn-success">
                                    </form>
                    
                    
                                </div>
                    
                            </div>
                        </div>';

    }
    elseif($ticketDetails[0]=='addDependent')
    {echo'<button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitAddDepTicketModal">
        Edit Ticket
    <span class="glyphicon glyphicon-edit"></span> 
</button>


        <div class="modal fade" id="submitAddDepTicketModal" tabindex="-1" role="dialog" aria-labelledby="submitAddDepTicketModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitAddDepTicketModalLabel">Add Dependent Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="submitAddDepTicket" method="post" >
                    <label>
    ID Number
    </label>
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


                    <br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input onclick="updateAddQuery()"  type="submit" class="btn btn-success">
                </form>


            </div>

        </div>
    </div>
</div>';

    }
    elseif($ticketDetails[0]=='editDependent')
    {echo ' <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitEditTicketModal">
 Edit Ticket
                        <span class="glyphicon glyphicon-edit"></span> 
                    </button>
                    
                    <div class="modal fade" id="submitEditTicketModal" tabindex="-1" role="dialog" aria-labelledby="submitEditTicketModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="submitEditTicketModalLabel">Edit Dependent Ticket</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="ticketEditSubmit" method="post" >
                                        <label>Edit</label>
                                        <br>
                                        <label>Phone Number</label>
                    <br>
                                        <input type="text" name = "PhoneNumber" id="pn">
                                        <br>
                                    
                                        <label>Email</label>
                    <br>
                                        <input type="text" name = "Email" id = "em">
                                        <br>
                                    
                                        <label> PlanID</label>
                    <br>
                                        <select id = "plans" name = "planID" >
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
                                        <input id = "editinput"  type = "text" name ="comment" >
                                        <br>
                                    
                                        <input type = "submit" onclick = "updateEditQuery()" class="btn btn-success">
                                    </form>
                    
                    
                                </div>
                    
                            </div>
                        </div>';

    }


}



    ?></div>

<script>

    document.getElementById("submitcomment").addEventListener("click",submitComment);

    function submitComment() {
        //alert("submit");

        let inputText = document.getElementById("comment-input").value;
        alert(inputText);

        $.ajax({
            url:'includes/dbFunctions.php',
            type:"post",
            data: {
                fun: 'submitNewComment',
                ticketID: <?php echo $ticID?>,
                comment: inputText

            },
            success: function(){alert("worked"); location.reload();}
        })
    }

    function resolveTicket()
    {
        let queries = <?php echo json_encode($ticketDetails[2]);?>;
        alert(queries);

        $.ajax({
            url:'includes/dbFunctions.php',
            type:"post",
            data: {
                fun: 'resolveTicket',
                query: queries,
                ticDetails: <?php echo json_encode($ticketDetails[1]);?>,
                ticID: <?php echo $ticID?>

            },
            success: function(){alert("worked");relocateTicketsTable();}
        })



    }

    function removeTicket(){
        $.ajax({
            url:'includes/dbFunctions.php',
            type:"post",
            data: {
                fun: 'removeTicket',
                ticDetails: <?php echo json_encode($ticketDetails[1]);?>,
                ticID: <?php echo $ticID?>

            },
            success: function(){
                alert("worked");
                relocateTicketsTable()
            }
        })
    }

    function assignTicket() {
        $.ajax({
            url: 'includes/dbFunctions.php',
            type: "post",
            data: {
                fun: 'assignTicket',
                ticID: <?php echo $ticID?>,
                adminID: <?php echo $_SESSION['UserID']?>

            },
            success: function () {
                alert("worked");
                relocateTicketsTable();
            }
        })
    }

    function relocateTicketsTable()
    {
        window.location.replace("FarmIndex.php?page=ticketTable")
    }

    function updateAddQuery()
    {
        alert("edit Ticket");

        let IDnum = document.getElementById('IDnumInput').value;
        let fn = document.getElementById('firstNameInput').value;
        let sn = document.getElementById('surNameInput').value;
        let email = document.getElementById('emailInput').value;
        let phoneNum = document.getElementById('phoneNumInput').value;
        let dob = document.getElementById('dobInput').value;
        let plan = document.getElementById('addplans').value;

        let member_data = IDnum +',' + fn +',' + sn +',' + email +','+ phoneNum +','+ dob+','+plan ;
        alert(member_data);
        $.ajax({
            url: 'includes/dbFunctions.php',
            type: "post",
            data: {
                fun: 'submitEditTicket',
                chg: member_data,
                ticID: <?php echo $ticID?>
            },
            success: function () {
                alert("worked");
                location.reload();
            }
        })
    }

    function updateEditQuery(){

        alert("edit Ticket");

        let phonenumber = document.getElementById('pn').value;
        let email = document.getElementById('em').value;
        let plan = document.getElementById('plans').value;

        let edit_data = phonenumber + ","+ email +","+plan;


        $.ajax({
            url: 'includes/dbFunctions.php',
            type: "post",
            data: {
                fun: 'submitEditTicket',
                chg: edit_data,
                ticID: <?php echo $ticID?>
            },
            success: function () {
                alert("worked");
                location.reload();
            }
        })

    }

    </script>

    </body>
    </html>
