<?php

//checks if the username is valid
function invalidUsername($uname)
{
    
    //Built in preg match checks to see if $uname is valid
    //with string parameters listed

    if (!preg_match("/^[a-zA-Z0-9]*$/", $uname)) {
        $error = true;
    } else {
        $error = false;
    }

    return $error;

}

function invalidEmail($email)
{
    
    // use built in PHP function FILTER_VALIDATE_EMAIL to check
    // if the email is valid

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
    } else {

        $error = false;
    }

    return $error;

}

function passwordMatch($password, $passwordRep)
{
   
    // check to see if passwords match

    if ($password !== $passwordRep) {
        $error = true;

    } else {

        $error = false;
    }

    return $error;
}

function uniqueId($conn, $uname, $email)
{
    //checks to see if the username & email is already in the database

    //Create an SQL statement
    $sql = "SELECT * FROM users WHERE usersUsername = ? OR usersEmail = ?;";
    //Initialize new statement
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("locaton: ../signup.php?error=stmtFail");
        exit();
    }

    //Bind data from signup form to the statement in preparation to execute
    mysqli_stmt_bind_param($stmt, "ss", $uname, $email);
    mysqli_stmt_execute($stmt);

    $exists = mysqli_stmt_get_result($stmt);

    //if $exists actually exists then data exists in the data base
    if ($row = mysqli_fetch_assoc($exists)) {
        //TODO: Complete this section. If user exists we continue logging in...
        return $row; //returns all data if user does exist

    } else {
        $doesExist = false;
        return $doesExist;
    }

    mysqli_stmt_close($stmt);

}

function newUser($conn, $name, $uname, $email, $password)
{
    //Inserting data into database

    //Create an SQL statement
    $sql = "INSERT INTO users (usersUsername, usersName, usersEmail, usersPassword)
     VALUES (?,?,?,?);";
    //Initialize new statement
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("locaton: ../signup.php?error=newuserfailed");
        exit();
    }

    //Need to use PHP function to hash password
    $hashpwd = password_hash($password, PASSWORD_DEFAULT);

    //Bind data from signup form to the statement in preparation to execute
    mysqli_stmt_bind_param($stmt, "ssss", $uname, $name, $email, $hashpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=noerror");

    newBank($conn, $uname);
    loginUser($conn, $uname, $password);

}

function newBank($conn, $uname){
    
    $sql = "INSERT INTO bank (bankUsername, bankTotal, bankInv, bankAvail) 
    VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("locaton: ../signup.php?error=newuserfailed");
        exit();
    }

    $bT = 1000;
    $bInv = 0;
    $bAvail = $bT;

    mysqli_stmt_bind_param($stmt, "ssss", $uname, $bT, $bInv, $bAvail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

function loginUser($conn, $username, $password)
{
    $exists = uniqueId($conn, $username, $username);

    if ($exists === false) {
        header("location: ../login.php?error=incorrectlogin");
        exit();
    }

    //Retrieve hashed password from the database by using the assoc array
    $dbPwd = $exists["usersPassword"];
    //use password_verify to compare passwords. Returns true or false
    $pwdCheck = password_verify($password, $dbPwd);

    if ($pwdCheck === false) {
        header("location: ../login.php?error=incorrectpassword");
        exit();
    } else if ($pwdCheck === true) {
        //Start session
        session_start();
        //Set global session variable "userid" to the unique userID from DB
        $_SESSION["userid"] = $exists["usersId"];
        $_SESSION["userusname"] = $exists["usersUsername"];
        header("location: ../profile.php");
        exit();
    }

}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }



