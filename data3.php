<!DOCTYPE html>


<html lang="en">

<head>
    <title>Locate-a-Quake: Air Traffic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="css\bootstrap.min.css" rel="stylesheet">
    <!-- external js-->

    <!-- jquery,popper,bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js\bootstrap.min.js"></script>
    <!-- jquery,popper,bootstrap end -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script> <!-- js chart -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
    <!-- js chart data label plugin -->
    <script src="hammer\hammer.js"></script><!-- hammer js -->
    <style>
        /* Always set the map height explicitly to define the size of the div
                       * element that contains the map. */
        #map {
            height: 600px;
            width: 100%;
            position: inherit
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
                <li class="breadcrumb-item"><a href="index.php">Locate-a-Quake</a></li>
                <li class="breadcrumb-item active">Air Traffic Visualisation</li>
            </ol>
        </div>
    </div>
    <!-- breadcrumb end -->

    <div class="row">
        <!-- main column content -->
        <div class="col-sm-8">
            <h1>Air Traffic Visualisation</h1>
            <div id="map"></div>
            <div class="chart-container">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
        </div>
        <!-- end main column content-->

        <!-- sidebar column content-->
        <div class="col-sm-4">
            <h4>Chart showing Air Traffic data</h4>
            <p>This page shows data regarding flight information of selected flights flying in and around the UK Ilse.
                <br><br>There are two maps on this page, the top map shows all flights currently in air. <br>The bottom
                map shows the airports represented as *TBC* and the current flights represented as a small
                aeroplane.<br><br>The chart can be zoomed in using your mouse and the data within the chart is
                clickable; e.g. <br>[Chart 1] Clicking/highlighting the plottings on the map displays the infomration of
                the selection.<br>[Chart 2] Clicking the plottings on the map displays the infomration of the selection.<br>Clicking
                the flight icon displays information for that selected flight. </p>
        </div>
        <!-- end sidebar column content -->
    </div>

    <?php include 'includes/footer.php' ?>
</div>
<!-- end content-->
<!-- gmaps script-->
<!-- map scripts below -->

<!-- Need the following code for clustering Google maps markers-->
<script
        src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<!-- Need the following code for Google Maps. PLEASE INSERT YOUR OWN GOOGLE MAPS KEY BELOW -->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0rO-86zPMYGXlsruR9s6kxlFOnIrBORo&callback=initMap">
</script>
<!-- end gmaps-->
<script>
    var airport_latlongs = [];
    var names = [];
    var points = [];
    var mymap;
    var glasgow_airport_lat = 55.8691; //lat1
    var glasgow_airport_long = -4.4351; //long1

    var distances_from_GLA = [];
    var json_flights = []; //global var banter
    var json_airports = []; //global var banter
    var airport_names = []; //global var banter


    // Extend Number object with methods to convert between degrees & radians
    Number.prototype.toRadians = function () {
        return this * Math.PI / 180;
    };
    Number.prototype.toDegrees = function () {
        return this * 180 / Math.PI;
    };


    function run() {
        getDistancesFromGla();
        create_titles_points();
        getAirportLatLong();
        plotAirports();
        plotFlights();
    }

    //initMap() called when Google Maps API code is loaded - when web page is opened/refreshed
    function initMap() {
        mymap = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: new google.maps.LatLng(55.86515, -
                4.25763), // Center Map. Set this to any location that you like
            mapTypeId: 'terrain' // can be any valid type
        });
        google.maps.event.trigger(mymap, 'resize');
    }


    function plotAirports() {
        var infoWindow = new google.maps.InfoWindow(), marker, i;
        var image = "img/airport.png";
        for (i = 0; i < json_airports.length; i++) {
            if (json_airports[i].nameAirport.includes("Bus") === false && json_airports[i].nameAirport.includes(
                "train") === false && json_airports[i].nameAirport.includes("Railway") === false) {

                var position = new google.maps.LatLng(parseFloat(json_airports[i].latitudeAirport), parseFloat(json_airports[i].longitudeAirport));

                marker = new google.maps.Marker({
                    position: position,
                    map: mymap,
                    icon: image,
                    title: json_airports[i].nameAirport
                });

                // Add info window to marker
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infoWindow.setContent(json_airports[i].nameAirport);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    }


    function plotFlights() {
        let infoWindow = new google.maps.InfoWindow(), marker, i;
        const plane_icon = "img/plane.png";
        //plane image icon
        //https://www.shareicon.net/airline-plane-fly-airplane-882177
        for (i = 0; i < json_flights.length; i++) {
            let position = new google.maps.LatLng(parseFloat(json_flights[i]["geography"]["latitude"]), parseFloat(json_flights[i]["geography"]["longitude"]));

            marker = new google.maps.Marker({
                position: position,
                map: mymap,
                icon: plane_icon,
                title: ""
            });

            // Add info window to marker
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {

                    infoWindow.setContent(json_flights[i]["aircraft"]["regNumber"] + " " + json_flights[i]["aircraft"][
                            "icaoCode"
                            ] +
                        " " + json_flights[i]["geography"]["altitude"].toFixed(0) + "ft " + json_flights[i]["speed"]
                            [
                            "horizontal"
                            ]
                            .toFixed(0) + "kts " + distances_from_GLA[i] + "km");
                    infoWindow.open(map, marker);
                }
            })(marker, i));
        }
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
        const R = 6371e3; // metres
        let φ1 = lat1.toRadians();
        let φ2 = lat2.toRadians();
        let Δφ = (lat2 - lat1).toRadians();
        let Δλ = (lon2 - lon1).toRadians();

        let a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
        let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        let d = R * c;

        return ((d / 1000).toFixed(0));
    }

    function create_titles_points() {
        let string_builder;
        for (i = 0; i < json_flights.length; i++) {
            string_builder = [];
            string_builder = [
                "\n\n",
                json_flights[i]["aircraft"]["regNumber"],
                " ",
                json_flights[i]["aircraft"]["icaoCode"],
                " ",
                json_flights[i]["geography"]["altitude"].toFixed(0),
                "ft ",
                json_flights[i]["speed"]["horizontal"].toFixed(0),
                "kts ",
                distances_from_GLA[i],
                "km"
            ];

            names.push(string_builder.join(''));

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

    function getJSON() {
        var flights_url = "data/flights.txt";
        var airports_url = "data/airports.txt";
        $.when($.getJSON(flights_url), $.getJSON(airports_url)).then(function (flights, airports) {
            json_flights = flights[0];
            json_airports = airports[0];
            run();
        });
    }
</script>
</body>
</html>