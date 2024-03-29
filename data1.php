<!DOCTYPE html>
<html lang="en">

<head>
    <title>Locate-a-Quake: Stocks</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- jquery,popper,bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- jquery,popper,bootstrap end -->

    <!-- charting functions -->
    <script src="chartjs-chart-financial-master/docs/moment.js"></script>
    <script src="chartjs-chart-financial-master/docs/Chart.js"></script>
    <script src="chartjs-chart-financial-master/docs/Chart.Financial.js"></script>
    <script src="chartjs-chart-financial-master/docs/utils.js"></script>
</head>

<body>
    <?php include 'includes/navigation.php' ?>

    <!-- content -->
    <div class="container-fluid body-content">

        <!-- breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Locate-a-Quake</a></li>
                    <li class="breadcrumb-item active">Stocks</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-sm-12" id="main">
                <h1>Stocks</h1>
                <div id="search">
                    <h4>Search</h4>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" id="stockname" onkeypress="clickEnter(event)"
                            placeholder="Enter company name">
                        <button class="btn btn-info my-2 my-sm-0" type="button" onclick="getPossibleStocks()">Get Stock
                            Data</button>
                    </form>
                    <br>
                    <p>Enter your desired company in the input field above and click the "Get Stock Data" button to see
                        the
                        companies stocks represented in the chart.</p>
                </div>
                <div id="refine">
                    <h4>Refine</h4>
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>Symbol</th>
                                <th>Company Name</th>
                                <th>Type</th>
                                <th>Region</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div id="reset">
                    <button class="btn btn-info my-2 my-sm-0" type="button" onclick="start()">Reset</button>
                </div>
                <br>
                <div id="view">
                    <h4>View</h4>
                    <p>This chart is a OHLC (Open-High-Low-Close), this is a type of bar chart showing the open, high, low and closing prices for your specified company. This chart enables you to evaluate intraday volatility and see where prices opened and closed. <a href="https://www.investopedia.com/terms/o/ohlcchart.asp" target="_blank">Source</a></p>
                    <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end main column content-->



    <!-- end content-->
    <script>
        // executes getStocks function when user clicks enter key on input field
        function clickEnter(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                getPossibleStocks();
            }
        }
        var data_points_arr = [];
        var dates = [];
        var apikey = "0F1ISWGUHZYUTIRI";


        function getPossibleStocks() {
            $("#search").fadeOut();
            let searchTerm = document.getElementById("stockname").value;
            let query_url = "https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=" + searchTerm + "&apikey=" + apikey;
            $.getJSON(query_url, function (json) {
                $('#myTable tbody').empty(); //clear table but leave headers
                let symbol, company_name, type, region; //table headers              
                for (let i = 0; i < json.bestMatches.length; i++) {
                    symbol = json.bestMatches[i]["1. symbol"];
                    company_name = json.bestMatches[i]["2. name"];
                    type = json.bestMatches[i]["3. type"];
                    region = json.bestMatches[i]["4. region"];
                    $('#myTable > tbody:last-child').append('<tr><td><button class="btn btn-info my-2 my-sm-0" id="' + symbol + '"type="button" onclick="getData(this.id)">' + symbol + '</button ></td> <td>' + company_name + '</td><td>' + type + '</td><td>' + region + '</td></tr>'); //add new row to table
                    $("#refine").fadeIn();
                }
                console.log(json);
            });
        }

        function getData(clicked_symbol) {
            $("#refine").fadeOut();

            var query_url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&outputsize=compact&symbol=" + clicked_symbol + "&apikey=" + apikey + "&datatype=json";

            $.getJSON(query_url, function (json) {
                $("#view").fadeIn();
                console.log(Object.keys(json)[0]);
                if (Object.keys(json)[0] == "Meta Data") {
                    console.log("working");
                    let chartTitle = getLabel(json["Meta Data"]);
                    createDataPoints(json["Time Series (Daily)"]);
                    drawChart(chartTitle);
                    showResetButton();
                } else if (Object.keys(json)[0] == "Error Message") {
                    alert("error");
                } else if (Object.keys(json)[0] == "Note") {
                    alert("too many api calls")
                }

            });
        }

        function getLabel(meta_data) {
            let string = [];
            string.push(
                meta_data["1. Information"],
                " Stock:",
                meta_data["2. Symbol"],
                " Last Updated:",
                meta_data["3. Last Refreshed"],
                " Timezone:",
                meta_data["5. Time Zone"]
            );
            return string.join("");
        }

        function createDataPoints(timeseries) {
            data_points_arr = [];
            dates = [];
            //format is: o, h, l, c, timestamp
            var dateFormat = 'YYYY MM DD';
            Object.keys(timeseries).forEach(function (key, index) {
                var date = moment(key, dateFormat);
                var point = {
                    o: parseFloat(timeseries[key]["1. open"]),
                    h: parseFloat(timeseries[key]["2. high"]),
                    l: parseFloat(timeseries[key]["3. low"]),
                    c: parseFloat(timeseries[key]["4. close"]),
                    t: date.valueOf()
                }
                dates.push(key);
                data_points_arr.push(point)
            });
        }

        function drawChart(chartTitle) {
            // OHLC
            var ctx1 = document.getElementById("myChart").getContext("2d");
            // ctx1.canvas.width = 1000;
            // ctx1.canvas.height = 600;
            new Chart(ctx1, {
                type: 'ohlc',
                data: {
                    datasets: [{
                        label: chartTitle,
                        data: data_points_arr,
                        fractionalDigitsCount: 2,
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        position: 'nearest',
                        mode: 'index',
                    },
                },
            });
        }

        function showResetButton() {
            $("#reset").show();
        }

        var first_launch = false; //global flag
        function start() {
            if (first_launch == false) {
                first_launch = true;
                $("#view").hide();
            } else {
                $("#view").fadeOut();
            }
            //always
            $("#stockname").prop('value', ''); //remove previous text
            $("#search").show();
            $("#refine").hide();
            $("#reset").hide();
        }

        start();

    </script>
</body>

</html>