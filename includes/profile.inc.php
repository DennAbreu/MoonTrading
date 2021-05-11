<?php
require_once 'dbHandler.inc.php';
require_once 'stockFunctions.inc.php';
require_once 'profFunctions.inc.php';
require_once 'bankFunctions.inc.php';

$userName = $_SESSION["userusname"];

if(doesOwnStock($conn, $userName) == true){
$bankTotal = number_format(getBankTotal($conn, $userName),2);
$amountInvested = number_format(getAmountInv($conn, $userName),2);
$stockValue = number_format(calcStockVal($conn, $userName),2);
$amtAvail = number_format(getAmtAvail($conn, $userName),2);
$growth = number_format(totalGrowth($conn, $userName),2);
}else{
$bankTotal = number_format(getBankTotal($conn, $userName),2);
$amountInvested = 0;
$stockValue = number_format(calcStockVal($conn, $userName),2);
$amtAvail = number_format(getAmtAvail($conn, $userName),2);
$growth = number_format(totalGrowth($conn, $userName),2);
}

