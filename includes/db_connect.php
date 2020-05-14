<?php
include('constants.php');
function connectToDb()
{

    $mysqli = mysqli_connect(HOST_NAME, HOST_USERNAME, HOST_PASSWORD, DB_NAME);


    if (mysqli_connect_errno()) {
        echo "Unable to connect to database" . mysqli_error($mysqli);
    } else {
        return $mysqli;
    }
}

//function disconnectDb($mysqli)
//{
//    $mysqli->close();
//}
