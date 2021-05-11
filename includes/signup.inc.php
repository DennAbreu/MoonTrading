<?php

if(isset($_POST["submit"])){
   
    //Grab global variables
    $name = $_POST["name"];
    $uname = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRep = $_POST["passwordRep"];

    require_once "dbHandler.inc.php";
    require_once "functions.inc.php";

    //Error Checks

    if(invalidUsername($uname) !== false){
        header("location: ../signup.php?error=invalidusername");
        exit();

    }

    if(invalidEmail($email) !== false){
        header("location: ../signup.php?error=invalidemail");
        exit();

    }

    if(passwordMatch($password, $passwordRep) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();

    }

    if(uniqueId($conn, $uname, $email)!==false){
        header("location: ../signup.php?error=usernameexists");
        exit();
    }


    //If no errors were detected then a new user will be created.

    newUser($conn, $name, $uname, $email, $password);


}else{

    //Site security. Can't directly access signup script 
    //without going through form

    header("location: ../signup.php");
    exit();
}