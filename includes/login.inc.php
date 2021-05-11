<?php

if (isset($_POST["submit"])) {
    $username = $_POST["uname"];
    $password = $_POST["password"];

    require_once "dbHandler.inc.php";
    require_once "functions.inc.php";

    loginUser($conn, $username, $password);

} else {
    header("location: ../login.php");
    exit();
}
