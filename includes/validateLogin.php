<?php
include ('db_connect.php');
//echo "validateLogin";
$un = $_POST['username'];
$pw = md5($_POST['password']);
validateLogin($un,$pw);


    function validateLogin($username, $password){
        echo ' <html>
                <head>
               <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    
</script>
    
     <link rel="stylesheet" href="SubmissionDraft2/Stylesheet.css">
                </head>
                <body>';

       // echo '<br>'.$username.'<br>';
        //echo '<br>'.$password.'<br>';
        echo ' 
 <style>
        .container {
            padding: 300px;
            height: 300px;
        }
        
        body{
    background-color: rgba(68, 255, 122, 0.65);
}
    </style>';

        $mysqli = connectToDb();

        $query = "SELECT * FROM users WHERE Username = '".$username
        ."' and PasswordHash = '".$password."'";

        $result = $mysqli->query($query);
       // print_r($result);
        //echo'<br>';
        //echo 'random';
        //print_r($result->fetch_array());
        echo '<div class="container"><div class="col text-center">';
        if ($result->num_rows==1)
        {
            echo 'Successful, Please click Okay to go to Dashboard';
            $action_page ="../FarmIndex.php";
            session_start();
            $row = $result->fetch_array(MYSQLI_BOTH);

            $_SESSION["UserID"]=$row['UserID'];
            $_SESSION["UserType"]=$row['UserType'];


        }
        else
        {
            echo 'login Failed, Please click Okay to go to login';
            $action_page ="../login.php";

           // return false;
        }

        echo '<form name="user_redirect" id="user_redirect" method="POST"'
            . 'action="' . $action_page . '">'
            .'<input type="hidden" name="username" value='.$username.'>'
            .  '
    <div class="col text-center"><br><button class="btn btn-success"> Okay</button></div>'
            . '</form>';

   // <button class="float-left submit-button" >Home</button>
//</form>


        echo '</div></div> </body> </html>';
    }