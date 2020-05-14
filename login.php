<?php
error_reporting(0);
session_destroy();

error_reporting(E_ALL);
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Stylesheet.css">

    <style>
        .container {
            padding: 100px;
            height: 300px;
        }
    </style>

</head>
<body>
<div class="container">
    <div class="row">
        <h2>
            User Login
        </h2>
    </div>
    <form method='post' action="includes/validateLogin.php">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" class="btn btn-success" >Submit</button>

    </form>
</div>
</body>
</html>
