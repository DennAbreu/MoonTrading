<?php
require_once 'stockFunctions.inc.php';
require_once 'functions.inc.php';
require_once 'bankFunctions.inc.php';


function getAmountInv($conn, $userName){
    setAmountInv($conn, $userName);
    $sql = "SELECT bankInv FROM bank WHERE bankUsername = ?;";
    $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt, $sql)) {
    
            header("locaton: ../trade.php?error=stmtFail");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
    
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($results);
         mysqli_stmt_close($stmt);


        return $row["bankInv"];

    }

 
    function setAmountInv($conn, $userName){
        $amt = totalInv($conn, $userName);
        $sql = "UPDATE bank SET bankInv = ? WHERE bankUsername = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("locaton: ../profile.php?error=stmtFail");

        }

        mysqli_stmt_bind_param($stmt, "ss", $amt, $userName);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

     
    function totalInv($conn, $userName){
        $total = 0;
        $sql = "SELECT stocksInv FROM stocks WHERE stocksUsername =?;";        
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("locaton: ../profile.php?error=stmtFail");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        
        while($row = mysqli_fetch_assoc($results)){
            $retAmt = $row["stocksInv"];
            $total += $retAmt;
        }
            mysqli_stmt_close($stmt);

            $cString = "totalInv = ".$total;
            console_log($cString);

            return $total;
    }

   
    function getAmtAvail($conn, $userName){
        
        $a1 = getBankTotal($conn, $userName);
        $a2 = getBankInv($conn, $userName);
        $a3 = $a1 - $a2;
        console_log("Bank Total: ".$a1);
        console_log("Amount Invested: ".$a2);
        console_log("Amount Avail: ".$a3);
    
        return $a3;
     
    }



    function calcStockVal($conn, $userName){
        $retAmt = 0;
        $sql = "SELECT stocksSymbol FROM stocks WHERE stocksUsername =?;";        
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {

            header("locaton: ../profile.php?error=stmtFail");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        
        while($row = mysqli_fetch_assoc($results)){
            $symbol = $row["stocksSymbol"];
            $curPrice = currentPrice($symbol);
            $curShares = currShares($conn, $userName, $symbol);
            $calAmt = $curPrice * $curShares;
            $retAmt += $calAmt;
           
        }

        $cString = "calcStockVal = ".$retAmt;
        console_log($cString);
        
        return $retAmt;

    }


    function totalGrowth($conn, $userName){
        $currValue =  calcStockVal($conn, $userName);
        //$currValue = 500;
        $initInv = totalInv($conn, $userName);
        $diff = $currValue - $initInv;

        if($diff == 0){
            return null;
        }else{
        $growth = ($diff/$currValue)*100;
        }

        return $growth;
        

    }

    function soloStockGrowth($currAmt, $initAmt){
        $diff = $currAmt - $initAmt;
        $per = ($diff/$initAmt)*100;


        return $per;
    }

function getStockApi($sSym)
{
    $token = '&token=c1hpg4v48v6sod8lijpg';
    $link = 'https://finnhub.io/api/v1/stock/profile2?symbol=' . $sSym . $token;
    $json_data = file_get_contents($link);
    $response_data = json_decode($json_data, true);

    //Retrurns Array
    return $response_data;
}

function returnStockName($sSym){
    $data = getStockApi($sSym);
    $ret = $data["name"];

    return $ret;
}


function displayStocks($conn, $userName){
        $sql = "SELECT * FROM stocks WHERE stocksUsername = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../trade.php?error=stmtFail");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $userName);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);

        echo '<table>
        <tr>
            <td class ="tabHead">Name</td>
            <td class ="tabHead">Symbol</td>
            <td class ="tabHead">Shares</td>
            <td class ="tabHead">Current Price</td>
            <td class ="tabHead">Initial Investment</td>
            <td class ="tabHead">Stock Value </td>
            <td class ="tabHead">Percent Growth </td>
        </tr>';

        while($row = mysqli_fetch_assoc($results)){
            $sSymbol = $row['stocksSymbol'];
            $stockName = returnStockName($sSymbol);
            $cPrice = currentPrice($sSymbol);
            $sShares = $row['stocksShares'];
            $cValue = $cPrice*$sShares;
            $sInv = $row['stocksInv'];
            $growth = soloStockGrowth($cValue, $sInv);
          
            echo '
                <tr class = "highlightRow">
                  <td>'.$stockName.'</td>  
                  <td>'.$sSymbol.'</td> 
                  <td>'.$sShares.'</td> 
                  <td>$ '.number_format($cPrice,2).'</td> 
                  <td>$ '.number_format($sInv,2).'</td> 
                  <td>$ '.number_format($cValue,2).'</td> 
                  <td>'.number_format($growth,2).'%</td> 
                  
                </tr>';
                

        };

        echo '</table>';
        

        mysqli_stmt_close($stmt);
        
    }

  