<?php
include ('includes/dbFunctions.php');
echo"";

$table = getOwners();

?>

<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="Stylesheet.css">

    <title>Home</title>
</head>
<body>

<div class="text-center">
    <h1>Farms</h1>
<?php
    while ($row = $table->fetch_array(MYSQLI_BOTH)) {
        echo
            '<button type="button" class="w-25 p-3 btn btn-success"  onclick="loadFarm(' . $row["UserID"] . ')" >
            ' . $row['FarmName'] . '
            </button>
    ';


}

?>
</div>

<script>
    function loadFarm(UserID) {

        window.location.replace('FarmIndex.php?page=employeeTable&farmID='+UserID);

    }
</script>