<?php
require 'database.php';

//if (!isset($_SESSION['loggedin']))
 //header("LOCATION: login.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pet Fish Inventory System : Home</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="bootstrap/css/body.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="FishLogo.png"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    <style>
    .btn-secondary {
        box-shadow:inset 0px 1px 0px 0px #276873;
        background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
        background-color:#599bb3;
        border-radius:6px;
        border:1px solid #29668f;
        display:inline-block;
        cursor:pointer;
        color:#ffffff;
        font-family:Arial;
        font-size:15px;
        font-weight:bold;
        padding:6px 24px;
        text-decoration:none;
        text-shadow:0px 1px 0px #3d768a;
    }
    .btn-secondary:hover {
        background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
        background-color:#408c99;
    }
    .btn-secondary:active {
        position:relative;
        top:1px;
    }
    </style>

</head>
<body>
    <?php include_once 'nav_bar.php'; ?>

    <div class="container center-wrapper text-center">
        <?php
        unset($_SESSION);
        session_destroy();
        header( "refresh:5;url=login.php");
        ?>
        <div style="padding: 3rem;background: rgba(0, 0, 0, 0.2);border-radius: 5px;">
            <h1>Logged Out</h1>
            <p>Thank you for using Pet Fish Ordering System.</p>
            <p class="text-muted" style="color: #FFF;">Click the button below if you've not been redirected in 5 second(s).</p>
            <a class="btn btn-secondary" href="login.php" role="button">Redirect</a>
        </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>