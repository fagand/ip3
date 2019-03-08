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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/popper.min.js"></script>
    <!-- charting functions -->
    <script src="..\ip3\chartjs-chart-financial-master\docs\moment.js" type="text/javascript"></script>
    <script src="..\ip3\chartjs-chart-financial-master\docs\Chart.js" type="text/javascript"></script>
    <script src="..\ip3\chartjs-chart-financial-master\docs\Chart.Financial.js" type="text/javascript"></script>
    <script src="..\ip3\chartjs-chart-financial-master\docs\utils.js" type="text/javascript"></script>
    <!--builds html table from json (https://jquery.com/) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/json2html/1.2.0/json2html.min.js"></script>
    <!--builds html table from json (https://jquery.com/) -->

</head>

<body onload="getData()">
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
                <h1>Stocks...</h1>
                <div class="chart-container" style="max-width:8000px; max-height:400px">
                    <canvas id="myChart" width="800" height="400"></canvas>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas, excepturi. Consequuntur
                        molestias, minus dolorum obcaecati, quis, laboriosam voluptas rem reiciendis praesentium
                        delectus
                        corrupti deserunt rerum suscipit non error. Amet, facere.</p>
                </div>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-sm-4">
                <input type="text" id="stockname"><button onclick="getStocks()">Get Stock Data</button>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam tempora vitae magnam dolor dolore
                    minima consectetur nisi laudantium excepturi voluptates in amet possimus non nesciunt cumque
                    rerum,
                    atque sunt vero?</p>
            </div>
            <!-- end sidebar column content -->
        </div>

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->
    <script>
        var Gjson;
        var data_points_arr = [];
        var dates = [];

        function getStocks() {
            var x = document.getElementById("stockname");
            var apikey = "0F1ISWGUHZYUTIRI";
            var searchterm = x.value;
            var query_url = "https://www.alphavantage.co/query?function=SYMBOL_SEARCH&keywords=" + searchterm +
                "&apikey=" +
                apikey;

            $.getJSON(query_url, function (json) {
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