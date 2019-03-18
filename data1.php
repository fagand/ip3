<!DOCTYPE html>
<html lang="en">

<head>
    <title>Locate-a-Quake: Stocks</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="css\bootstrap.min.css">

    <!-- jquery,popper,bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js\bootstrap.min.js"></script>
    <!-- jquery,popper,bootstrap end -->



    <!-- charting functions -->
    <script src="chartjs-chart-financial-master\docs\moment.js" type="text/javascript"></script>
    <script src="chartjs-chart-financial-master\docs\Chart.js" type="text/javascript"></script>
    <script src="chartjs-chart-financial-master\docs\Chart.Financial.js" type="text/javascript"></script>
    <script src="chartjs-chart-financial-master\docs\utils.js" type="text/javascript"></script>
    <!--builds html table from json (https://jquery.com/) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/json2html/1.2.0/json2html.min.js"></script>
    <!--builds html table from json (https://jquery.com/) -->

</head>

<body>
    <?php include 'includes/navigation.php' ?>

    <!-- content -->
    <div class="container-fluid body-content">

        <!-- breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Locate-a-Quake</a></li>
                    <li class="breadcrumb-item active">Stocks</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-sm-8">
                <h1>Stocks</h1>
                <div class="chart-container" style="max-width:8000px; max-height:600px">
                    <canvas id="myChart" width="800" height="600"></canvas>
                </div>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-sm-4">
                <h4>Stock Data</h4>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" id="stockname" onkeypress="clickEnter(event)"
                        placeholder="Enter company name">
                    <button class="btn btn-info my-2 my-sm-0" type="button" onclick="getPossibleStocks()">Get Stock
                        Data</button>
                </form>
                <br>
                <p>Enter your desired company in the input field above and click the "Get Stock Data" button to see the
                    companies stocks represented in the chart.</p>
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
            <!-- end sidebar column content -->
        </div>

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->
    <script>
        // executes getStocks function when user clicks enter key on input field
        function clickEnter(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                getStocks();
            }
        }

        var Gjson;
        var data_points_arr = [];
        var dates = [];
        var apikey = "0F1ISWGUHZYUTIRI";

        function getStocks() {
            let searchTerm = document.getElementById("stockname").value;
            let query_url = "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&outputsize=compact&symbol=" + searchTerm + "&apikey=" + apikey + "&datatype=json";

            $.getJSON(query_url, function (json) {
                console.log(json);
                Gjson = json;
                createDataPoints();
                drawChart();
            });

        }

        function getPossibleStocks() {
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
                    $('#myTable > tbody:last-child').append('<tr><td>' + symbol + '</td> <td>' + company_name + '</td><td>' + type + '</td><td>' + region + '</td></tr>'); //add new row to table
                }
            });
        }

        function getData() {
            var query_url =
                "https://www.alphavantage.co/query?function=TIME_SERIES_DAILY&outputsize=compact&symbol=GOOG&apikey=0F1ISWGUHZYUTIRI&datatype=json";

            $.getJSON(query_url, function (json) {
                console.log(json);
                Gjson = json;
                createDataPoints();
                drawChart();
            });
        }

        function getLabel() {
            return Gjson["Meta Data"]["1. Information"] + " Stock:" + Gjson["Meta Data"]["2. Symbol"] +
                " Last Updated:" +
                Gjson["Meta Data"]["3. Last Refreshed"] + " Timezone:" + Gjson["Meta Data"]["5. Time Zone"];
        }

        function createDataPoints() {
            //o, h, l, c, timestamp
            var dateFormat = 'YYYY MM DD';
            Object.keys(Gjson["Time Series (Daily)"]).forEach(function (key, index) {
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
            ctx1.canvas.height = 600;
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