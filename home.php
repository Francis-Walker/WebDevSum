<?php

echo"";


?>
<head>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="Stylesheet.css">

<title>Home</title>
</head>
<body>
<div class="text-center">
    <h1> EMPLOYER HOME </h1>
    <br>
    <button type="button" class="w-25 h-75 p-3 btn btn-success" onclick="farmsLoad()">
        View Farm
    </button>

    <button type="button" class="w-25 h-75 p-3 btn btn-success" onclick="ticketsLoad()">
        View Tickets
    </button>
</div>
<script>
    function farmsLoad(){
        window.location.replace("FarmIndex.php?page=employeeTable")

    }
    function ticketsLoad(){
        window.location.replace("FarmIndex.php?page=ticketTable")

    }
</script>