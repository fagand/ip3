<!DOCTYPE html>
<html lang="en">

<head>
    <title>Locate-a-Quake: Weather</title>
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

    <!-- Need the following code for clustering Google maps markers-->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

    <style>
        /* Always set the map height explicitly to define the size of the div
               * element that contains the map.

            changed map height to 600px to ensure it doesn't overlap sidebar/footer when resized
        */
        #map {
            height: 600px;
            width: 100%;
            position: inherit
        }
    </style>
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
                    <li class="breadcrumb-item active">Weather</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-sm-8">
                <h1>Weather</h1>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" id="location" onkeypress="clickEnter(event)"
                        placeholder="enter place or lat/long">
                    <button class="btn btn-info my-2 my-sm-0" type="button" onclick="getWeather()">Get Weather
                        Data</button>
                </form>
                <small><strong>Drop a pin on the map to display weather data for that location. Alternatively, input a place name or latitude/longitude and click Get Weather Data.</strong></small>
                <br>
                <div id="map"></div>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-sm-4">
                <h2>Weather Data</h2>
                <div id="defaultText">
                    <p>Drop a pin on the map to display weather data for that location. <br><br>
                    Alternatively, input a place name or latitude/longitude and click Get Weather Data.</p>
                </div>
                <div id="weatherImage"></div>
                <div id="weatherInfo"></div>
                <br>

                <div id="uvInfo"></div>

            </div>
            <!-- end sidebar column content -->

        </div>

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->

    <script>
        // executes get weather function when user clicks enter key on input field
        function clickEnter(e) {
            if (e.keyCode === 13) {
                e.preventDefault();
                getWeather();
            }
        }

        var markers = []; //holds all placed markers
        var mymap;
        // window.location.href;
        var theurl = window.location.toString();
        //initMap()// called when Google Maps API code is loaded - when web page is opened/refreshed 
        image = new Image();

        function initMap() {
            mymap = new google.maps.Map(document.getElementById('map'), {
                zoom: 2,
                center: new google.maps.LatLng(55.86515, -
                    4.25763), // Center Map. Set this to any location that you like
                mapTypeId: 'terrain' // can be any valid type
            });
            google.maps.event.trigger(mymap, 'resize');

            google.maps.event.addListener(mymap, 'click', function (event) {
                var searchterm = event.latLng.lat() + "," + event.latLng.lng();
                pie(searchterm);
                deleteMarkers();
                addMarker(event.latLng);

            });
        }
        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }
        // Adds a marker to the map and push to the array.
        function addMarker(location) {
            var marker = new google.maps.Marker({
                position: location,
                map: mymap
            });
            markers.push(marker);
        }


        function pie(searchterm) {
            var url = "http://api.apixu.com/v1/current.json?key=3b4f627ba14c47d5a8103303191502&q=";
            var query_url = url + searchterm;
            $.getJSON(query_url, function (json) {

            })
                .done(function (json) {
                    console.log(json);


                    //get lat long from json return
                    //create new event lat lng
                    var myLatLng = new google.maps.LatLng({ lat: json.location.lat, lng: json.location.lon });
                    //clear any existing markers
                    deleteMarkers();
                    //add marker at that loc
                    addMarker(myLatLng);

                    $('#defaultText').empty(); // remove the info text from sidebar before weather data is displayed
                    $('#uvInfo').html(''); // remove previous UV index info card
                    image.src = "http:" + json.current.condition.icon; // icon is specified within the data
                    $('#weatherInfo').html('<p>Name: ' + json.location.name + '</p>'); // current weather in text format
                    $('#weatherInfo').append('<p>Currently: ' + json.current.condition.text + '</p>');
                    $('#weatherInfo').append('<p>Region: ' + json.location.region + '</p>');
                    $('#weatherInfo').append('<p>Current temp: ' + json.current.temp_c + ' C</p>');
                    $('#weatherInfo').append('<p>Feels like: ' + json.current.feelslike_c + ' C</p>');
                    $('#weatherInfo').append('<p>Wind speed: ' + json.current.wind_mph + ' mph</p>');
                    $('#weatherInfo').append('<p>UV index: ' + json.current.uv + '</p>');
                    $('#weatherInfo').append('<p>Humidity: ' + json.current.humidity + '%</p>');
                    $('#weatherInfo').append('<p>Last updated: ' + json.current.last_updated + '</p>');
                    image.onload = function () {
                        $('#weatherImage').empty().append(image);
                    };

                    uvCard(json.current.uv); // call method which displays UV index info cards, passing in the UV value

                })
                .fail(function () {
                    // alert('getJSON request failed!');
                    $('#weatherInfo').html('<p>No weather data to display.</p>');
                    $('#weatherImage').empty();
                    $('#uvInfo').empty()

                })
        }

        // dynamically displays a card below the weather info with UV index information relating to the area selected on the map
        function uvCard(uv) {
            var lowUV = $('<div class="card bg-light mb-3" style="max-width: 100%;"><div class="card-header">UV Index Information</div><div class="card-body"><h4 class="card-title">0-2: Low</h4><p class="card-text"><ul><li>Sunscreen SPF 30+</li><li>Sunglasses</li></ul></p></div></div>');

            var moderateUV = $('<div class="card text-white bg-success mb-3" style="max-width: 100%;"><div class="card-header">UV Index Information</div><div class="card-body"><h4 class="card-title">3-5: Moderate</h4><p class="card-text"><ul><li>Sunscreen SPF 30+</li><li>Sunglasses</li><li>Hat</li><li>Seek shade (midday)</li></ul></p></div></div>');

            var highUV = $('<div class="card text-white bg-warning mb-3" style="max-width: 100%;"><div class="card-header">UV Index Information</div><div class="card-body"><h4 class="card-title">6-7: High</h4><p class="card-text"><ul><li>Sunscreen SPF 30+</li><li>Sunglasses</li><li>Hat</li><li>Seek shade</li><li>Limit sun from 11am-5pm</li></ul></p></div></div>');

            var veryHighUV = $('<div class="card text-white bg-danger mb-3" style="max-width: 100%;"><div class="card-header">UV Index Information</div><div class="card-body"><h4 class="card-title">8-10: Very High</h4><p class="card-text"><ul><li>Sunscreen SPF 30+</li><li>Sunglasses</li><li>Hat</li><li>Seek shade</li><li>Avoid sun from 11am-5pm</li></ul></p></div></div>');

            var extremeUV = $('<div class="card text-white bg-dark mb-3" style="max-width: 100%;"><div class="card-header">UV Index Information</div><div class="card-body"><h4 class="card-title">11+: Extreme</h4><p class="card-text"><ul><li>Sunscreen SPF 30+</li><li>Sunglasses</li><li>Hat</li><li>Seek shade</li><li>Avoid sun from 11am-5pm</li></ul></p></div></div>');


            if (uv >= 0 && uv <= 2) {
                $('#uvInfo').append(lowUV);
            }

            if (uv >= 3 && uv <= 5) {
                $('#uvInfo').append(moderateUV);
            }

            if (uv >= 6 && uv <= 7) {
                $('#uvInfo').append(highUV);
            }

            if (uv >= 8 && uv <= 10) {
                $('#uvInfo').append(veryHighUV);
            }

            if (uv >= 11) {
                $('#uvInfo').append(extremeUV);
            }
        }

        function getWeather() {
            pie(document.getElementById("location").value);
        }
    </script>
    <!-- Need the following code for Google Maps. PLEASE INSERT YOUR OWN GOOGLE MAPS KEY BELOW -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJFdzFzjYX5JD0d-xcz5q7s68LZEH3X90&callback=initMap">
        </script>
</body>

</html>