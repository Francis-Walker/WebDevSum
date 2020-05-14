<?php
error_reporting(0);
session_start();
error_reporting(E_ALL);
include ('includes/dbFunctions.php');

$table = selectTic($_SESSION['UserID'],$_SESSION['UserType']);
?>


<html>
<head>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="Stylesheet.css">

    <title></title>
</head>
<body>

<table class="table table-striped table-bordered">

    <thead class="thead-dark">
    <tr>
        <th>TicketID</th>
        <th>Type</th>
        <th>Status</th>
        <th> Actions</th>
    </tr>
    </thead>
    <?php
    while($row =$table->fetch_array(MYSQLI_BOTH)  )
    {
        echo '<tr>'
            . '<td>' . $row['TicketID'] . '</td>'
            . '<td>' . $row['Type'] . '</td>'
            . '<td>';
        if ($row['Status']==0 )
        {
            echo 'Unassiged';
        }
        elseif ($row['Status']==1 )
        {
            echo 'Open';
        }elseif ($row['Status']==2 )
        {
            echo 'Resolved';
        }
        elseif ($row['Status']==3 )
        {
            echo 'Removed';
        }

        echo
        '</td>'

             .'<td> 
<div class="text-center">

                <button class="btn btn-success" onclick="isolatedTic('.$row['TicketID'].','.$row['Status'].')"> View</button></td></div>'
            . '<tr>';
    }
    ?>
</table>
</body>
</html>
<script>
    function isolatedTic(ticId,sID) {

        alert('working');


        window.location.replace('FarmIndex.php?page=viewTicket&ticID='+ticId+'&status='+sID);


    }
</script>