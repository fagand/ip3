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
        <div class="col-sm-9">
            <h1>Air Traffic Visualisation</h1>
            <div id="map"></div>
        </div>
        <!-- end main column content-->

        <!-- sidebar column content-->
        <div class="col-sm-3">
            <h4>Chart showing Air Traffic data</h4>
            <p>This page shows data regarding flight information of selected flights flying in and around the UK Ilse.
                <br><br>There are two maps on this page, the top map shows all flights currently in air. <br>The bottom
                map shows the airports and the current flights represented as a small
                aeroplane.<br><br>The chart can be zoomed in using your mouse and the data within the chart is
                clickable; e.g.<br>Clicking the plottings on the map displays the infomration of the selection.<br>Clicking
                the flight icon displays information for that selected flight. </p>
            <p> Legend</p>
            <img src="img/airport.png"; > Airports
        <br/>
            <img src="img/plane.png"; > Aircraft
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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJFdzFzjYX5JD0d-xcz5q7s68LZEH3X90&callback=initMap">
</script>
<!-- end gmaps-->
<script>
    const glasgow_airport_latitude = 55.8691;
    const glasgow_airport_longitude = -4.4351;
    const airport_icon = "img/airport.png";
    const plane_icon = "img/plane.png"; //plane image icon https://www.shareicon.net/airline-plane-fly-airplane-882177

    var airport_latlongs = [];
    var mymap; //the google maps object


    var distances_from_GLA = [];
    var json_flights = [];
    var json_airports = [];
    var airport_names = [];


    // Extend Number object with methods to convert between degrees & radians
    Number.prototype.toRadians = function () {
        return this * Math.PI / 180;
    };
    Number.prototype.toDegrees = function () {
        return this * 180 / Math.PI;
    };


    function run() {
        getDistancesFromGla();
        getAirportLatLong();
        plotAirports();
        plotFlights();
    }

    //initMap() called when Google Maps API code is loaded - when web page is opened/refreshed
    function initMap() {
        mymap = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: new google.maps.LatLng(glasgow_airport_latitude, glasgow_airport_longitude), // Center Map. Set this to any location that you like
            mapTypeId: 'terrain' // can be any valid type
        });
        google.maps.event.trigger(mymap, 'resize');
    }


    function plotAirports() {
        let infoWindow = new google.maps.InfoWindow(), marker, i;


        for (let i = 0; i < json_airports.length; i++) {
            let airport_name = json_airports[i].nameAirport;

            let station_name_includes_bus = json_airports[i].nameAirport.includes("Bus");
            let station_name_include_train = json_airports[i].nameAirport.includes("train");
            let station_name_include_railway = json_airports[i].nameAirport.includes("Railway");

            if (station_name_includes_bus === false &&
                station_name_include_train === false &&
                station_name_include_railway === false) {

                let float_airport_latitude = parseFloat(json_airports[i].latitudeAirport);
                let float_airport_longitude = parseFloat(json_airports[i].longitudeAirport);
                let position = new google.maps.LatLng(float_airport_latitude, float_airport_longitude);

                marker = new google.maps.Marker({
                    position: position,
                    map: mymap,
                    icon: airport_icon,
                    title: airport_name
                });

                // Add info window to marker
                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infoWindow.setContent(airport_name);
                        infoWindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    }


    function plotFlights() {
        let infoWindow = new google.maps.InfoWindow(), marker, i;

        for (let i = 0; i < json_flights.length; i++) {
            let float_plane_latitude = parseFloat(json_flights[i]["geography"]["latitude"]);
            let float_plane_longitude = parseFloat(json_flights[i]["geography"]["longitude"]);
            let position = new google.maps.LatLng(float_plane_latitude, float_plane_longitude);

            marker = new google.maps.Marker({
                position: position,
                map: mymap,
                icon: plane_icon,
                title: ""
            });

            // Add info window to marker
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    let string_builder = [
                        "tail number: ",

                        json_flights[i]["aircraft"]["regNumber"],
                        "<br>",
                        "depature airport: ",
                        json_flights[i]["departure"]["iataCode"],
                        "<br>",
                        "destination airport: ",
                        json_flights[i]["arrival"]["iataCode"],
                        "<br>",
                        " altitude: ",
                        json_flights[i]["geography"]["altitude"].toFixed(0),
                        "ft ",
                        "<br>",
                        "speed:  ",
                        json_flights[i]["speed"]["horizontal"].toFixed(0),
                        " kts ",
                        "<br>",
                        "distance from Glasgow Airport: ",
                        distances_from_GLA[i],
                        " km"
                    ];
                    let display_string = string_builder.join('');
                    infoWindow.setContent(display_string);
                    infoWindow.open(map, marker);
                }
            })(marker, i));
        }
    }

    function getDistancesFromGla() {
        for (let i = 0; i < json_flights.length; i++) {
            let plane_latitude = json_flights[i]["geography"]["latitude"];
            let plane_longitude = json_flights[i]["geography"]["longitude"];
            let dist = getDistance(plane_latitude, plane_longitude, glasgow_airport_latitude, glasgow_airport_longitude);
            distances_from_GLA.push(dist);
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
    function getAirportLatLong() {
        for (i = 0; i < json_airports.length; i++) {
            let station_name_includes_bus = json_airports[i].nameAirport.includes("Bus");
            let station_name_include_train = json_airports[i].nameAirport.includes("train");
            let station_name_include_railway = json_airports[i].nameAirport.includes("Railway");

            if (station_name_includes_bus === false &&
                station_name_include_train === false &&
                station_name_include_railway === false) {
                airport_latlongs.push({
                    x: json_airports[i].longitudeAirport,
                    y: json_airports[i].latitudeAirport
                }); // lat is y axis
                airport_names.push(json_airports[i].nameAirport);
            }
        }
    }

    function getJSON() {
        const flights_url = "data/flights2.txt";
        const airports_url = "data/airports.txt";
        $.when($.getJSON(flights_url), $.getJSON(airports_url)).then(function (flights, airports) {
            json_flights = flights[0];
            json_airports = airports[0];
            run();
        });
    }
</script>
</body>
</html>