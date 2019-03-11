<!DOCTYPE html>


<html lang="en">

<head>
    <title>Locate-a-Quake: Data 3</title>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script> <!-- js chart -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
    <!-- js chart data label plugin -->
    <script src="hammer\hammer.js"></script><!-- hammer js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/0.6.6/chartjs-plugin-zoom.js"></script>
    <!-- js chart zoom -->
    <style>
        canvas {
            background-color: rgba(0, 0, 0, 1);
        }

        .chart-container {
            width: 100%;
            height: 800px;
        }
    </style>
</head>

<body onload="getJSON()">
    <?php include 'includes/navigation.php' ?>

    <!-- content -->
    <div class="container-fluid body-content">

        <!-- breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Locate-a-Quake</a></li>
                    <li class="breadcrumb-item active">Air Traffic Visualisation</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-sm-8">
                <h1>Air Traffic Visualisation</h1>
                <div class="chart-container">
                    <canvas id="myChart" width="400" height="400"></canvas>

                </div>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-sm-4">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam tempora vitae magnam dolor
                    dolore
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
        // Extend Number object with methods to convert between degrees & radians
        Number.prototype.toRadians = function () {
            return this * Math.PI / 180;
        };
        Number.prototype.toDegrees = function () {
            return this * 180 / Math.PI;
        };
        var glasgow_airport_lat = 55.8691; //lat1
        var glasgow_airport_long = -4.4351; //long1 

        var distances_from_GLA = [];
        var json_flights = []; //global var banter 
        var json_airports = []; //global var banter 
        var airport_names = []; //global var banter 

        var ctx = document.getElementById("myChart").getContext('2d');

        function run() {
            getDistancesFromGla();
            create_titles_points();
            getAirportLatLong();
            drawChart();
        }

        function drawChart() {
            var scatterChart = new Chart(ctx, {
                type: 'scatter',
                data: data,
                options: {
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var index = tooltipItem.index;
                                return dataset.labels[index] + ': ' + dataset.data[index];
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            precision: 1,
                            ticks: {
                                min: 49,
                                max: 64,
                                stepSize: 1
                            },
                            gridLines: {
                                color: "rgba(0, 181, 204, 1)", //blue
                            }
                        }],
                        xAxes: [{
                            precision: 1,
                            ticks: {
                                min: -12,
                                max: 3,
                                stepSize: 1
                            },
                            gridLines: {
                                color: "rgba(0, 181, 204, 1)", //blue
                                zeroLineColor: "rgba(0, 181, 204, 1)" //blue
                            },
                        }]
                    },
                    plugins: {
                        anchor: 'start',
                        display: 'auto'

                    },
                    // Container for pan options
                    pan: {
                        // Boolean to enable panning
                        enabled: true,

                        // Panning directions. Remove the appropriate direction to disable 
                        // Eg. 'y' would only allow panning in the y direction
                        mode: 'xy'
                    },

                    // Container for zoom options
                    zoom: {
                        // Boolean to enable zooming
                        enabled: true,

                        // Zooming directions. Remove the appropriate direction to disable 
                        // Eg. 'y' would only allow zooming in the y direction
                        mode: 'xy',
                    }
                },
            });
        }

        function getDistancesFromGla() {
            for (i = 0; i < json_flights.length; i++) {
                distances_from_GLA.push(getDistance(json_flights[i]["geography"]["latitude"], json_flights[i][
                    "geography"
                ][
                    "longitude"
                ], glasgow_airport_lat, glasgow_airport_long));
            }
        }


        function getDistance(lat1, lon1, lat2, lon2) {
            // from https://www.movable-type.co.uk/scripts/latlong.html
            //return distance in kilo meters 
            var R = 6371e3; // metres
            var φ1 = lat1.toRadians();
            var φ2 = lat2.toRadians();
            var Δφ = (lat2 - lat1).toRadians();
            var Δλ = (lon2 - lon1).toRadians();

            var a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                Math.cos(φ1) * Math.cos(φ2) *
                Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            var d = R * c;

            return ((d / 1000).toFixed(0));
        }


        function create_titles_points() {
            for (i = 0; i < json_flights.length; i++) {
                names.push("\n\n" + json_flights[i]["aircraft"]["regNumber"] + " " + json_flights[i]["aircraft"][
                    "icaoCode"
                ] +
                    " " + json_flights[i]["geography"]["altitude"].toFixed(0) + "ft " + json_flights[i]["speed"]
                    [
                        "horizontal"
                    ]
                        .toFixed(0) + "kts " + distances_from_GLA[i] + "km")
                points.push({
                    x: json_flights[i]["geography"]["longitude"],
                    y: json_flights[i]["geography"]["latitude"]
                });
            }

        }

        function getAirportLatLong() {

            for (i = 0; i < json_airports.length; i++) {
                if (json_airports[i].nameAirport.includes("Bus") === false && json_airports[i].nameAirport.includes(
                    "train") === false && json_airports[i].nameAirport.includes("Railway") === false) {
                    airport_latlongs.push({
                        x: json_airports[i].longitudeAirport,
                        y: json_airports[i].latitudeAirport
                    }); // lat is y axis
                    airport_names.push(json_airports[i].nameAirport);
                }
            }
        }

        var airport_latlongs = [];
        var names = [];
        var points = [];

        var data = {

            datasets: [{
                label: 'Glasgow Airport Inbound Flights',
                labels: names,
                backgroundColor: 'rgba(60, 179, 113, 1)',
                data: points,
                datalabels: {
                    color: '#36A2EB', //color of flight text
                    formatter: function (value, context) {
                        return names[context.dataIndex];
                    }
                }
            },
            {
                labels: airport_names,
                label: 'Airports',
                backgroundColor: 'rgba(255, 179, 113, 1)', //orange
                data: airport_latlongs,
                datalabels: {
                    color: '#36A2EB', //color of flight text
                    formatter: function (value, context) {
                        return airport_names[context.dataIndex];
                    }
                }
            }
            ]
        };




        function getJSON() {
            var flights_url = "data/flights.txt";
            var airports_url = "data/airports.txt";
            $.when($.getJSON(flights_url), $.getJSON(airports_url)).then(function (flights, airports) {
                json_flights = flights[0];
                json_airports = airports[0];
                console.log(json_flights);
                console.log(json_airports);
                run();
            });
        }
    </script>
</body>

</html>