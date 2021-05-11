<?php
require_once 'dbHandler.inc.php';
require_once 'functions.inc.php';
require_once 'stockFunctions.inc.php';
require_once 'bankFunctions.inc.php';

session_start();
$userName = $_SESSION["userusname"];
$_SESSION["sessionSym"] = $_POST['sName'];
$_SESSION["conn"] = $conn;

