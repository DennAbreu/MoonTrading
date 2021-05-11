function updateStock() {

    var sName = document.getElementById("stockSym").value;
   

    stockDisplay.innerHTML = sName;
    getStockPrices(sName);
    getStockName(sName);
    displayCandleChart(sName);
    getStockNewsApi(sName);
    
}
function displayCandleChart(e){
    var url_1 = 'https://widget.finnhub.io/widgets/stocks/chart?symbol=';
    var url_2 = '&watermarkColor=%231db954&backgroundColor=%23222222&textColor=white';
    var fullUrl = url_1+e+url_2;
    candleChart.innerHTML = 
    "<iframe width='60%' frameborder='0' height='600' src='"+fullUrl+"'</iframe>";
    
}

function getStockNewsApi(e){
  
    var apiData = {
        url: 'https://finnhub.io/api/v1/company-news?symbol=',
        symbol: e,
        key: '&from=2021-03-01&to=2021-03-09&token=c1hpg4v48v6sod8lijpg',
    }

    var { url, symbol, key } = apiData;
    var apiUrl = `${url}${symbol}${key}`;

    console.log(apiUrl);

    fetch(apiUrl)
        .then((data) => data.json())
        .then((news) => displayStockNews(news))

        
}

function displayStockNews(e){
    var i;
    var maxNews = 10;
    var returnString='';

    for (i = 0; i<=maxNews; i++){
    //    returnString += '<tr class ="highlightRow"><td>'+e[i].headline+'</tr></td>';
    returnString += `<tr class ="highlightRow"><td><a class ="newsLink" href ="
    `+e[i].url+`" target="_blank">
    `+ e[i].headline +
    `</a></td></tr>`;
    }

    

    // /style="width:300%"
    stockTbl.innerHTML =
    `
   <table class = "stoxTbl">
   <tr><th>News</th></tr>
    `+returnString+`
    </table>
    `;

}


async function getStockName(e){
    var apiData = {
        url: 'https://finnhub.io/api/v1/stock/profile2?symbol=',
        symbol: e,
        key: '&token=c1hpg4v48v6sod8lijpg',
    }

    var { url, symbol, key } = apiData;
    var apiUrl = `${url}${symbol}${key}`;

    console.log(apiUrl);

    fetch(apiUrl)
        .then((data) => data.json())
        .then((comp) => generateCompName(comp))

}

function generateCompName(e){
    
    var compName = e.name;
    cName.innerHTML = compName;
        
}




function getStockPrices(e) {

    var apiData = {
        url: 'https://finnhub.io/api/v1/quote?symbol=',
        symbol: e,
        key: '&token=c1hpg4v48v6sod8lijpg',
    }

    var { url, symbol, key } = apiData;
    var apiUrl = `${url}${symbol}${key}`;

    //Check to see if URL is correctly populated.
    console.log(apiUrl);

    //Use generated URL to fetch JSON data for sName
    fetch(apiUrl)
        .then((data) => data.json())
        .then((prices) => generatePrices(prices))

}

function generatePrices(e) {

    var openPrice = parseFloat(e.o);
    var currPrice = parseFloat(e.c);
    var perChange = ((currPrice - openPrice) / openPrice) * 100;

    cPrice.innerHTML = '$ ' + e.c;
    pOpen.innerHTML = '$ ' + e.o;
    pHigh.innerHTML = '$ ' + e.h;
    pLow.innerHTML = '$ ' + e.l;
    pClose.innerHTML = '$ ' + e.pc;
    pChange.innerHTML = perChange + ' %';

    if (localStorage.getItem("currPrice") != null) {
        localStorage.setItem("currPrice", currPrice);
    } else {
        localStorage.clear();
        localStorage.setItem("currPrice", currPrice);
    }


}

function previewPrice() {

    var numberOfShares = document.getElementById("numShares").value;
    var numSh = parseInt(numberOfShares);
    var currP = localStorage.getItem('currPrice');
    var ret = numSh * parseFloat(currP);
    prevPrice.innerHTML = "$ " + ret.toFixed(2);

}

function sendToPhp() {

    var sVal = document.getElementById("stockSym").value;
    var sSymbol = sVal.toUpperCase();

    var buyOrSell = document.getElementById("selector").value;
    var numOfShares = document.getElementById("numShares").value;

    if (buyOrSell == "empty") {
        tradeMssg.innerHTML = "Error! Please Select 'Buy' or 'Sell'";

    } else {
        $.ajax({
            method: "POST",
            url: "includes/trade.inc.php",
            data: { sName: sSymbol, selector: buyOrSell, numShares: numOfShares },
            success: function (data) {
                console.log("StockSearch.js AJAX POST Successful");
                tradeMssg.innerHTML = "Request completed.";

            },
            error: function (e) {
                console.log("Error");
            },
            done: function (e) {
                console.log("Done");
            }
        });
    }

    localStorage.clear();
    location.reload();
    
}






