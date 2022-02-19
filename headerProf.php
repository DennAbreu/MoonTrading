<?php
session_start();
require_once 'includes/profile.inc.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/headerProf.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;700&display=swap" rel="stylesheet">


</head>

<body>
    <div class="header">
        <div class="logo">
            <img src="assets/MT2.png" height = "95%">
        </div>

        <nav>
            <ul>
                <!-- <li class="active"> -->
                <li>
                    <a href="index.php">About Us</a>
                </li>
                
                <li>
                    <a href="trade.php">Trade</a>
                </li>
                <?php
    if (isset($_SESSION["userusname"])) {
        echo " <li> <a href='profile.php'>".$_SESSION['userusname']."</a></li>";
        echo "<li class='highlight'><a href='includes/logout.inc.php'>Logout</a> </li>";
    } else {
        echo " <li> <a href='signup.php'>Sign Up</a></li>";
        echo " <li class='highlight'><a href='login.php'>Login</a></li>";
    }
    ?>
                <!-- <li>
                    <a href="signup.php">Sign Up</a>
                </li>
                <li class="highlight">
                    <a href="login.php">Login</a>
                </li> -->
            </ul>
        </nav>

    </div>
</body>







