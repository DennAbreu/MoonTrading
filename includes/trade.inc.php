<?php
require_once 'dbHandler.inc.php';
require_once 'functions.inc.php';
require_once 'stockFunctions.inc.php';
require_once 'bankFunctions.inc.php';

session_start();

$userName = $_SESSION["userusname"];
$sSym = $_POST['sName'];
$buyOrSell = $_POST['selector'];
$numShares = $_POST['numShares'];
$cPrice = currentPrice($sSym);
$amt = calcSale($numShares, $cPrice);



if (!isset($_SESSION["userusname"])) {
    echo "Session Variable Is NOT Set";
    header("locaton: ../login.php");
    exit();

} else {
    echo "Session Variable Is Set";
    if ($buyOrSell == "buy") {
        buyStock($conn, $userName, $sSym, $numShares, $amt);
        updateBankAvail($conn, $userName);

        exit();
    } else if ($buyOrSell == "sell") {
        sellStock($conn, $userName, $sSym, $numShares, $amt);
        updateBankAvail($conn, $userName);
        exit();
    }

    

}

refresh();


