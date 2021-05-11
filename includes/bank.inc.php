<?php
require_once 'dbHandler.inc.php';
require_once 'functions.inc.php';
require_once 'stockFunctions.inc.php';
require_once 'bankFunctions.inc.php';
require_once 'profFunctions.inc.php';

session_start();

$userName = $_SESSION["userusname"];
$bAmt = $_POST['bankAmt'];
$addOrSub = $_POST['addSub'];


if ($addOrSub == "add") {
    console_log("Amount Added: ".$bAmt);
    addToBank($conn, $userName,$bAmt);
    exit();
    

} else if ($addOrSub == "subtract") {
    console_log("Amount Subtracted: ".$bAmt);
    removeFromBank($conn, $userName, $bAmt);
    exit();
}else{
    header("location: ../profile.php");
}





