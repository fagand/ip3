<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Financial > Candlestick | Chart.js sample</title>
    <!--We will use JQuery library (https://jquery.com/) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="..\ip3\chartjs-chart-financial-master\docs\moment.js" type="text/javascript"></script>
    <script src="..\ip3\chartjs-chart-financial-master\docs\Chart.js" type="text/javascript"></script>
    <script src="..\ip3\chartjs-chart-financial-master\docs\Chart.Financial.js" type="text/javascript"></script>
    <script src="..\ip3\chartjs-chart-financial-master\docs\utils.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/json2html/1.2.0/json2html.min.js"></script>
    <!--builds html table from json (https://jquery.com/) -->


    <link rel="stylesheet" media="screen and (min-width: 600px)" href="css\main.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="css\mobile.css">
</head>

<body onload="getData()">
    <header>
        <img src="img\logo.jpg" width="50%" height="50%" />

    </header>
    <div class="navigation" id="topnav">
        <!-- BEGIN navigation.php INCLUDE -->
        <?php include "./navigation.php";?>
        <!-- EMD navigation.php INCLUDE -->
    </div>


    <section class="columns">
        <div class="column" id="left">
            <h2>Infomation</h2>
            <h3>OHLC</h3>

            "Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in r
            eprehenderit in voluptate velit esse cillum dolore eu fugiat nulla p
            riatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa q
            ui officia deserunt mollit anim id est laborum."
        </div>
        <div class="column" id="main">
            <div class="chart-container" style="max-width:8000px; max-height:400px">
                <canvas id="myChart" width="800" height="400"></canvas>
            </div>
        </div>
        <div class="column" id="right">
            <h2>Guide</h2>
            <input type="text" id="stockname"><button onclick="getStocks()">Get Stock Data</button>
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
            anim id est laborum."
        </div>
    </section>

    </div>

    <script>
    var Gjson;
    var data_points_arr = [];
    var dates = [];

    function getStocks() {
        var x = document.getElementById("stockname");
        var apikey = "0F1ISWGUHZYUTIRI";
        var searchterm = x.value;
        var query_url = "https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=" + searchterm + "&apikey=" +
            apikey;

        $.getJSON(query_url, function(json) {
            console.log(json);

            var transform = {
                "tag": "table",
                "children": [{
                    "tag": "tbody",
                    "children": [{
                        "tag": "tr",
                        "children": [{
                                "tag": "td",
                                "html": "${}"
                            },
                            {
                                "tag": "td",
                                "html": "${age}"
                            }
                        ]
                    }]
                }]
            };

            var data = [{
                    'name': 'Bob',
                    'age': 40
                },
                {
                    'name': 'Frank',
                    'age': 15
                },
                {
                    'name': 'Bill',
                    'age': 65
                },
                {
                    'name': 'Robert',
                    'age': 24
                }
            ];

            $('#right').html(json2html.transform(data, transform));
        });

    }

    function getData() {
        var query_url =
            "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&outputsize=compact&symbol=GOOG&apikey=0F1ISWGUHZYUTIRI&datatype=json";

        $.getJSON(query_url, function(json) {
            console.log(json);
            Gjson = json;
            createDataPoints();
            drawChart();
        });
    }

    function getLabel() {
        return Gjson["Meta Data"]["1. Information"] + " Stock:" + Gjson["Meta Data"]["2. Symbol"] + " Last Updated:" +
            Gjson["Meta Data"]["3. Last Refreshed"] + " Timezone:" + Gjson["Meta Data"]["5. Time Zone"];
    }

    function createDataPoints() {
        //o, h, l, c, timestamp
        var dateFormat = 'YYYY MM DD';
        Object.keys(Gjson["Time Series (Daily)"]).forEach(function(key, index) {
            var date = moment(key, dateFormat);
            var point = {
                o: parseFloat(Gjson["Time Series (Daily)"][key]["1. open"]),
                h: parseFloat(Gjson["Time Series (Daily)"][key]["2. high"]),
                l: parseFloat(Gjson["Time Series (Daily)"][key]["3. low"]),
                c: parseFloat(Gjson["Time Series (Daily)"][key]["4. close"]),
                t: date.valueOf()
            }





            dates.push(key);
            data_points_arr.push(point)

        });
        console.log(data_points_arr);

    }


    function drawChart() {
        var data = getRandomData('April 01 2017', 20);
        console.log(data);

        // OHLC
        var ctx1 = document.getElementById("myChart").getContext("2d");
        ctx1.canvas.width = 1000;
        ctx1.canvas.height = 250;
        new Chart(ctx1, {
            type: 'ohlc',
            data: {
                datasets: [{
                    label: getLabel(),
                    data: data_points_arr, //data,//,
                    fractionalDigitsCount: 2,
                }]
            },
            options: {
                tooltips: {
                    position: 'nearest',
                    mode: 'index',
                },
            },
        });
    }
    </script>
</body>

</html>