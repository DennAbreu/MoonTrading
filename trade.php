<?php
include_once 'header.php';
?>

<link rel="stylesheet" href="css/trade.css" type="text/css">
<title>Trade</title>

    <main>
        <section>
            <div class = "leftSide">
                <div class="searchBar">
                        <input type="text" placeholder = "Enter Stock Symbol..." name="stockSymbol" id ="stockSym">
                        <button type="submit" name="submit" onclick="updateStock()">Search</button>
                        <input type="hidden" name = "hidden" value="">
                </div>

                <div class ="stockWidget">
                    <fieldset>
                        <legend id="stockDisplay"></legend>
                        <div class ="stockData">
                            <ul>
                                <li  class = "categories">Name:</li><span class ="catValues" id="cName"></span>
                                <li  class = "categories">Current:</li><span class ="catValues" id="cPrice"></span>
                                <li  class = "categories">Percent Change:</li><span class ="catValues" id="pChange"></span>
                                <li  class = "categories">Previous Close:</li><span class ="catValues" id="pClose"></span>
                                <li  class = "categories">Open: </li><span class ="catValues" id="pOpen"></span>
                                <li  class = "categories">High:</li><span class ="catValues" id="pHigh"></span>
                                <li  class = "categories">Low:</li><span class ="catValues" id="pLow"></span>
                            </ul>
                        </div>
                    </fieldset>
                </div>

                <div class ="tradeWidget">
                    <fieldset>
                        <legend>Trade</legend>
                        <div class ="tradeData">
                            <table>
                                <tr>
                                    <td><label>Available Funds</label></td>
                                    <td class ="tradeInputs">
                                        <?php
                                            require_once 'includes/bankFunctions.inc.php';
                                            require_once 'includes/dbHandler.inc.php';
                                            require_once 'includes/profFunctions.inc.php';
                                            
                                            if (isset($_SESSION["userusname"])) {
                                            updateBankAvail($conn, $_SESSION["userusname"]);
                                            
                                            $bankAvail = getBankAvail($conn, $_SESSION["userusname"]);                              
                                            echo '$'.number_format($bankAvail,2);

                                            }else {
                                                echo 'Please Sign In';
                                            }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><label>Number of Shares</label></td>
                                    <td class ="tradeInputs"><input type="text" name = "numShares" id ="numShares"></td>
                                </tr>

                                <tr>
                                    <td><label>Buy/Sell</label></td>
                                    <td class ="tradeInputs">
                                        <select onclick ="previewPrice()" name ="buySell" id ="selector" required >
                                            <option value ="empty">Select</option>
                                            <option value ="buy" >Buy</option>
                                            <option value ="sell">Sell</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Preview:</td>
                                    <td class ="tradeInputs">
                                        <span id ="prevPrice"></span>
                                    </td>
                                </tr>
                            </table>
                            <center>
                                <br><button type="submit" name ="tSubmit" onclick="sendToPhp()">Trade</button>
                            </center>

                            <span id ="tradeMssg"></span>

                     </div>
                    </fieldset>
                </div>

            </div>
            
            
                
            <div class = "rightSide">
                <div class = "rWidget">

                    <div class ="ls">                           
                        <div class ="candleChart" id = "candleChart"></div>
                    </div>
                    <div class = "rs">
                        <div class ="stockTbl" id = "stockTbl" ></div>
                    </div>

                </div>
                
            </div>

     </section>
</main>


<script type = "text/Javascript" src = "https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type = "text/Javascript" src = "js/stockSearch.js"></script>

</body>
</html>
