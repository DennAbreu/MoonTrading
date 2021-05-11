<?php

require_once 'stockFunctions.inc.php';
require_once 'functions.inc.php';
require_once 'profFunctions.inc.php';



function getBankTotal($conn, $userName){
    $sql = "SELECT bankTotal FROM bank WHERE bankUsername = ?;";
    $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt, $sql)) {
    
            header("locaton: ../profile.php?error=stmtFail");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
    
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);
        mysqli_stmt_close($stmt);
    
        return $row["bankTotal"];
        
    }

function addToBank($conn, $userName, $amt){
    $currBankTotal = getBankTotal($conn, $userName);
    $newAmt = $amt + $currBankTotal;

    $sql = "UPDATE bank SET bankTotal = ?
        WHERE bankUsername = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("locaton: ../profile.php?error=stmtFail");
            exit();

        }
        mysqli_stmt_bind_param($stmt, "ss", $newAmt, $userName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        updateBankAvail($conn, $userName);

        header("location: ../profile.php");
}

function removeFromBank($conn, $userName, $amt){
    $currBankTotal = getBankTotal($conn, $userName);
    $currInv = getBankInv($conn, $userName);
    $currAvail = $currBankTotal-$currInv;
    $diff = $currAvail - $amt;
    
    if($amt > $currAvail){
        header("location: ../profile.php?error=CantGoUnderZero");
        exit();
    }else if ($amt <= $currAvail){
    $sql = "UPDATE bank SET bankTotal = ?
        WHERE bankUsername = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("locaton: ../profile.php?error=stmtFail");
            exit();

        }

        mysqli_stmt_bind_param($stmt, "ss", $diff, $userName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        
    }
    updateBankAvail($conn, $userName);

    header("location: ../profile.php");
}

function getBankInv($conn, $userName){
    $sql = "SELECT bankInv FROM bank WHERE bankUsername = ?;";
    $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt, $sql)) {
    
            header("locaton: ../profile.php?error=stmtFail");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
    
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);
        mysqli_stmt_close($stmt);

        updateBankAvail($conn, $userName);
    
        return $row["bankInv"];

}



function updateBankInv($conn, $userName){
       $currInv = totalInv($conn, $userName);
       
       $sql = "SELECT bankTotal FROM bank WHERE bankUsername=?;";
       $stmt = mysqli_stmt_init($conn);
       

       if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("locaton: ../profile.php?error=stmtFail");
        exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $currInv, $userName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        updateBankAvail($conn, $userName);

}


function getBankAvail($conn, $userName){

    $sql = "SELECT bankAvail FROM bank WHERE bankUsername =?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?error=stmtFail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
    
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);
        mysqli_stmt_close($stmt);

    
        return $row["bankAvail"];

}
    
function updateBankAvail($conn, $userName){
        $currBankTotal = getBankTotal($conn, $userName);
        $currInvTotal = totalInv($conn, $userName);
        $diff = $currBankTotal - $currInvTotal;

        $sql = "UPDATE bank SET bankAvail = ?
        WHERE bankUsername = ?;";
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt, $sql)) {
    
            header("locaton: ../profile.php?error=stmtFail");
            exit();
    
        }

        mysqli_stmt_bind_param($stmt, "ss", $diff, $userName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        

        
    
    }


    // function updateBankTotal($conn, $userName){
        
    //     $cAvail = getBankAvail($conn, $userName);
    //     $cInv = totalInv($conn, $userName);
    //     $newAmt = $cAvail + $cInv;


    //     $sql = "UPDATE bank SET bankTotal = ?
    //     WHERE bankUsername = ?;";
    //     $stmt = mysqli_stmt_init($conn);
    
    //     if (!mysqli_stmt_prepare($stmt, $sql)) {
    
    //         header("locaton: ../profile.php?error=stmtFail");
    //         exit();
    
    //     }

    //     mysqli_stmt_bind_param($stmt, "ss", $newAmt, $userName);
    //     mysqli_stmt_execute($stmt);
    //     mysqli_stmt_close($stmt);

    // }