<?php
//$username = $_POST['username'];
//Echo '<br> Welcome '.$username;









session_start();

//?>

    <html>
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

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="Stylesheet.css">
        <meta charset="UTF-8">
        <title></title></head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="#">A Membership and Ticketing System</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="FarmIndex.php">Home </a>


<?php
if(isset($_SESSION["UserID"]) and ($_SESSION["UserType"]==0)) {

    echo' <a class="nav-item nav-link" href="FarmIndex.php?page=employeeTable">View Farm</a>
                    <a class="nav-item nav-link" href="FarmIndex.php?page=ticketTable">Tickets</a>
                    <button class="btn btn-success" onclick="logout()" style="position: absolute; right: 15;"> Log Out</button>
                </div>
            </div>
        </nav>
        </nav>';

    if (isset($_GET['page'])) {


        $page = $_GET['page'];
        $pageload = $page . '.php';
        //echo "Our page is $page \n FarmID is " . $_SESSION["UserID"];

    } else {
        $pageload = 'home.php';
    }
    include($pageload);
}
elseif(isset($_SESSION["UserID"]) and ($_SESSION["UserType"]==1)){
    echo' <a class="nav-item nav-link" href="FarmIndex.php?page=farms">Farms</a>
                    <a class="nav-item nav-link" href="FarmIndex.php?page=ticketTable">Tickets</a>
                    <button class="btn btn-success" onclick="logout()" style="position: absolute; right: 15;"> Log Out</button>
                </div>
            </div>
        </nav>
        </nav>';
    if (isset($_GET['page'])) {
         $page = $_GET['page'];
         $pageload = $page . '.php';
         //echo "Our page is $page \n FarmID is " . $_SESSION["UserID"];

    }else {
        $pageload = 'adminHome.php';
    }
    include($pageload);
}
else
{
    header("Location: login.php");
    exit();
}
?>
    </body>
    </html>

<script>
    function logout() {
        window.location.replace("login.php");

    }

</script>
