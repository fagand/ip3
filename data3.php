<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>data3</title>
    <!--We will use JQuery library (https://jquery.com/) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script> <!-- js chart -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
    <!-- js chart data label plugin -->
    <script src="..\ip3\hammer\hammer.js"></script><!-- hammer js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/0.6.6/chartjs-plugin-zoom.js"></script>
    <!-- js chart zoom -->
        <link rel="stylesheet" media="screen and (min-width: 600px)" href="css\main.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href=css\mobile.css">
    <style>
    canvas {
        background-color: rgba(0, 0, 0, 1);
    }

    .chart-container {
        position: relative;
        margin: auto;
      
    }
    </style>
</head>

<body onload="getJSON()">
    <header>
  <img src="img\logo.jpg" width="50%" height="50%"/>

</header>
    <div class="navigation" id="topnav">
    <!-- BEGIN navigation.php INCLUDE -->
    <?php include "./navigation.php";?>
    <!-- EMD navigation.php INCLUDE -->
    </div>

    <section class="columns">
        <div class="column" id="left">
            <h2>Infomation</h2>
            <h3>Airpots</h3>
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
 nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in r
 eprehenderit in voluptate velit esse cillum dolore eu fugiat nulla p
 riatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa q
 ui officia deserunt mollit anim id est laborum."
        </div>
        <div class="column" id="main">
            <div class="chart-container"  style="max-width:8000px; max-height:400px">
                <canvas id="myChart" width="800" height="400"></canvas>
            </div>
        </div>
        <div class="column" id="right">
            <h2>Guide</h2>
                            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
 Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
 nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in r
 eprehenderit in voluptate velit esse cillum dolore eu fugiat nulla p
 riatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa q
 ui officia deserunt mollit anim id est laborum."
        </div>
    </section>
    <script>
    // Extend Number object with methods to convert between degrees & radians
    Number.prototype.toRadians = function() {
        return this * Math.PI / 180;
    };
    Number.prototype.toDegrees = function() {
        return this * 180 / Math.PI;
    };

    //variables are presevred in the json order
    var glasgow_airport_lat = 55.8691; //lat1
    var glasgow_airport_long = -4.4351; //long1
    var heathrow_airport_lat = 51.4700; //lat1
    var heathrow_airport_long = 0.4543; //long1
    var cdg = {
        x: 2.5479,
        y: 49.0097
    }

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
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var index = tooltipItem.index;
                            return dataset.labels[index] + ': ' + dataset.data[index];
                        }
                    }
                },
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 50,
                            max: 60,
                            stepSize: 1,
                            maxTicksLimit: 1
                        },
                        gridLines: {
                            color: "rgba(0, 181, 204, 1)", //blue
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            min: -12,
                            max: 2,
                            stepSize: 1,
                            maxTicksLimit: 100
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
            distances_from_GLA.push(getDistance(json_flights[i]["geography"]["latitude"], json_flights[i]["geography"][
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
                " " + json_flights[i]["geography"]["altitude"].toFixed(0) + "ft " + json_flights[i]["speed"][
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
                    formatter: function(value, context) {
                        return names[context.dataIndex];
                    }
                }
            },
            {
                labels: airport_names,
                label: 'Airports',
                backgroundColor: 'rgba(255, 179, 113, 1)',
                data: airport_latlongs,
                datalabels: {
                    color: '#36A2EB', //color of flight text
                    formatter: function(value, context) {
                        return airport_names[context.dataIndex];
                    }
                }
            }
        ]
    };




    function getJSON() {
        var flights_url = "..\\ip3\\data\\flights.txt";
        var airports_url = "..\\ip3\\data\\airports.txt";
        $.when($.getJSON(flights_url), $.getJSON(airports_url)).then(function(flights, airports) {
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