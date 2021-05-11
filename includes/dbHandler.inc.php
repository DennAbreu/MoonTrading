<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "cisc4900";


// Opens up connection the database on XAMPP
$conn =  mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

//Error check
if(!$conn){
    die("Something went wrong!:".mysqli_connect_error());
}
