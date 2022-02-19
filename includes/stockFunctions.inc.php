<?php
require_once 'profFunctions.inc.php';
require_once 'bankFunctions.inc.php';

function testEcho($conn, $userName, $sSym, $buyOrSell, $numShares, $cPrice, $amt)
{
    echo 'Username: ' . $userName;
    echo "<br>";
    echo 'Symbol: ' . $sSym;
    echo "<br>";
    echo 'Selected ' . $buyOrSell;
    echo "<br>";
    echo '# Of Shares: ' . $numShares;
    echo "<br>";
    echo 'Current Price: ' . $cPrice;
    echo "<br>";
    echo 'Amount: ' . $amt;
    echo "<br>";
    echo 'Current Amount Of Shares: ' . currShares($conn, $userName, $sSym);
    echo "<br>";
    echo 'Current Investment: ' . currInv($conn, $userName, $sSym);
    echo "<br>";

    return 0;
}

function getApiData($sSym)
{
    $token = '&token=c1hpg4v48v6sod8lijpg';
    $link = 'https://finnhub.io/api/v1/quote?symbol=' . $sSym . $token;
    $json_data = file_get_contents($link);
    $response_data = json_decode($json_data, true);

    //Retrurns Array
    return $response_data;
}

function openPrice($sSym)
{
    $data = getApiData($sSym);
    $ret = $data["o"];

    $_SESSION["openPrice"] = $ret;
    return $ret;
}

function highPrice($sSym)
{
    $data = getApiData($sSym);
    $ret = $data["h"];

    $_SESSION["highPrice"] = $ret;
    return $ret;
}

function lowPrice($sSym)
{
    $data = getApiData($sSym);
    $ret = $data["l"];

    $_SESSION["lowPrice"] = $ret;
    return $ret;
}
function currentPrice($sSym)
{
    $data = getApiData($sSym);
    $ret = $data["c"];

    $_SESSION["currentPrice"] = $ret;
    return $ret;

}
function closePrice($sSym)
{
    $data = getApiData($sSym);
    $ret = $data["pc"];

    $_SESSION["prevClose"] = $ret;
    return $ret;
}

function percentChange($sSym)
{
    $currPrice = (float) currentPrice($sSym);
    $openPrice = (float) openPrice($sSym);
    $perChange = (($currPrice - $openPrice) / $openPrice) * 100;
    $_SESSION["perChange"] = $perChange;

}
function calcSale($numShares, $cPrice)
{
    return $numShares * $cPrice;
}

function doesStockExist($conn, $username, $sSym)
{
    $sql = "SELECT * FROM stocks WHERE stocksUsername = ? AND stocksSymbol = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../trade.php?error=stmtFail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $sSym);
    mysqli_stmt_execute($stmt);

    $exists = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($row = mysqli_fetch_assoc($exists)) {
        return true;
    } else {
        return false;
    }

}

function buyStock($conn, $userName, $sSym, $numShares, $amt)
{
    $cShares = currShares($conn, $userName, $sSym);
    $cInv = currInv($conn, $userName, $sSym);
    $nShares = $cShares + $numShares;
    $nInv = $cInv + $amt;
    $canAfford = canAfford($conn, $userName, $amt);
    
    
    if (doesStockExist($conn, $userName, $sSym) !== true && $canAfford !== false) {
        $sql = "INSERT INTO stocks (stocksUsername, stocksSymbol,
        stocksShares, stocksInv) VALUES (?,?,?,?);";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("locaton: ../trade.php?error=stmtFail");

        }

        mysqli_stmt_bind_param($stmt, "ssss", $userName, $sSym, $numShares, $amt);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "Stock added" . "<br>";

        
        
        exit();

    } else {

        $sql = "UPDATE stocks SET stocksShares = ?, stocksInv = ?
        WHERE stocksUsername = ? AND stocksSymbol = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("locaton: ../trade.php?error=stmtFail");

        }

        mysqli_stmt_bind_param($stmt, "ssss", $nShares, $nInv, $userName, $sSym);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo "Update Successfull" . "<br>";
       
        exit();
    }

   

}

function sellStock($conn, $userName, $sSym, $numShares, $amt)
{
    $cShares = currShares($conn, $userName, $sSym);
    $cInv = currInv($conn, $userName, $sSym);
    $nShares = $cShares - $numShares;
    $nInv = $cInv - $amt;

    if (doesStockExist($conn, $userName, $sSym) !== true) {
        header("location: ../trade.php?error=DontOwnTheStock");
        exit();
    } else if ($nShares < 0) {
        header("location: ../trade.php?error=NotEnoughStock");
        exit();
    } else if ($nShares == 0) {
        deleterow($conn, $userName, $sSym);
        exit();
    } else {
        $sql = "UPDATE stocks SET stocksShares = ?, stocksInv = ?
        WHERE stocksUsername = ? AND stocksSymbol = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("locaton: ../trade.php?error=stmtFail");
            exit();

        }
        mysqli_stmt_bind_param($stmt, "ssss", $nShares, $nInv, $userName, $sSym);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "Update Successfull" . "<br>";
    }


}

function deleteRow($conn, $userName, $sSym)
{
    $sql = "DELETE FROM stocks WHERE stocksUserName = ?
    AND stocksSymbol = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("locaton: ../trade.php?error=stmtFail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $userName, $sSym);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    exit();
}

function currShares($conn, $userName, $sSym)
{
    $sql = "SELECT stocksShares FROM stocks WHERE stocksUsername =? AND
    stocksSymbol = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("locaton: ../trade.php?error=stmtFail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $userName, $sSym);
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($results);
    mysqli_stmt_close($stmt);

    return $row["stocksShares"];

   
}

function currInv($conn, $userName, $sSym)
{
    $sql = "SELECT stocksInv FROM stocks WHERE stocksUsername =? AND
    stocksSymbol = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("locaton: ../trade.php?error=stmtFail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $userName, $sSym);
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_assoc($results);

    return $row["stocksInv"];
}

function canAfford($conn, $userName, $amt){
    $funds = getAmtAvail($conn, $userName);
    if($amt <= $funds){
        $ret = true;
    }else{
        $ret = false;
    }

    return $ret;

}


function doesOwnStock($conn, $userName){
    $sql = "SELECT * FROM stocks WHERE stocksUsername = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../trade.php?error=stmtFail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);

    $exists = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($row = mysqli_fetch_assoc($exists)) {
        return true;
    } else {
        return false;
    }

}

