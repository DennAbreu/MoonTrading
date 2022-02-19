<?php
include_once 'headerProf.php';
?>

<link rel="stylesheet" href="css/profile.css" type="text/css">

<title>Profile</title>
<div class = 'bodyStyle'>
    <main>
            <center>
            <span class ="topBar">
            <span  class = "currBank" id ="currAmount"
            title = "This is the total value of your bank. This includes your available funds as well as the funds you have invested.">
            Bank Total: <?php
                echo  " $".$bankTotal;
            ?>
            </span>
            <span class = "currBank" id = "amtAvail"
            title = "This is the current amount of funds you have available to invest. Use this to purchase more stock or sell stocks to have more funds available.">
            Available Funds:<?php
                echo " $".$amtAvail;
            ?>
            </span>
            <span class = "currBank" id = "amtInv"
            title = "This is the total initial investments you have made into the stock market.">
            Initial Investments: <?php
                echo  " $".$amountInvested;
            ?>
            </span>
            <span class = "currBank" id = "newInv"
            title = "This is the current value of all your stocks. This can be lower or higher than the amount you initially invested depending on how the market is going.">
            Stocks Value: Test <?php
                echo  " $".$stockValue;
            ?>
            </span>
           
            <span class = "currBank" id = "growth"
            title = "This is the total growth percentage of your portfolio.">
            Growth: <?php
                echo $growth.'%';
            ?>
            </span>
            </span>

            
            <br><br>
            
            <div class = "bankUpdate"
                title = "You can add or subtract more funds to your total bank account using this form.">
                <div class='bankUpdateContents'>
                    <form action="includes/bank.inc.php" method = "post">
                        <label for="amount">Bank</label>
                        <input type="text" size = "50" name="bankAmt" id="amtToUpdate" required/>
                        <select name="addSub" id="addSubSelect">
                            <option value ="empty">Select</option>
                            <option value ="add">Add</option>
                            <option value ="subtract">Subtract</option>
                        </select>
                        <button class="bnkBtn" type ="submit" >Update</button>
                    </form>
                <!-- onclick="sendToBank()" -->
                
                <!-- <span id ="bankMssg"></span> -->
                </div>
            </div>

            <div class = "stockDisplay" id = "sDisplay">
            <?php
                  displayStocks($conn, $userName);
            ?>
           
           </div> </center>
           
    </main>
</div>
   

<script type = "text/Javascript" src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type = "text/Javascript" src = "js/profile.js"></script>
</body>
</html>