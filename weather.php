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
    <script
        src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
        </script>
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
                    <li class="breadcrumb-item"><a href="#">Locate-a-Quake</a></li>
                    <li class="breadcrumb-item active">Weather</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-sm-8">
                <h1>Weather</h1>

                <input class="form-control mr-sm-2" type="text" id="location" placeholder="enter location">
                <button class="btn btn-secondary my-2 my-sm-0" onclick="getWeather()">Get Weather Data</button>
                <br>
                <div id="map"></div>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-sm-4">
                <h2>Weather Data</h2>
                <div id="weatherImage"></div>
                <div id="weatherInfo"></div>
                <br>

                <div class="card text-white bg-info mb-3" style="max-width: 100%;">
                    <div class="card-header">UV Index Info: Index Exposure</div>
                    <div class="card-body">
                        <p class="card-text">
                            <ul>
                                <li>1-2: Low</li>
                                <li>3-5: Moderate</li>
                                <li>6-7: High</li>
                                <li>8-10: Very High</li>
                                <li>11: Extreme</li>
                            </ul>
                        </p>
                    </div>
                </div>

            </div>
        </div>
        <!-- end sidebar column content -->

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->

    <script>
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

            google.maps.event.addListener(mymap, 'click', function(event) {
                var searchterm = event.latLng.lat() + "," + event.latLng.lng();
                pie(searchterm);
            });
        }

        function pie(searchterm) {
            var url = "http://api.apixu.com/v1/current.json?key=3b4f627ba14c47d5a8103303191502&q=";
            var query_url = url + searchterm;
            $.getJSON(query_url, function(json) {


            })
                .done(function(json) {
                    console.log(json);
                    image.src = "http:" + json.current.condition.icon; // icon is specified within the data
                    $('#weatherInfo').html('<p>Currently: ' + json.current.condition.text +
                        '</p>'); // current weather in text format
                    $('#weatherInfo').append('<p> name:' + json.location.name + '</p>');
                    $('#weatherInfo').append('<p> region:' + json.location.region + '</p>');
                    $('#weatherInfo').append('<p> current temp:' + json.current.temp_c + ' C</p>');
                    $('#weatherInfo').append('<p> feels like:' + json.current.feelslike_c + ' C</p>');
                    $('#weatherInfo').append('<p> wind speed:' + json.current.wind_mph + ' mph</p>');
                    $('#weatherInfo').append('<p> uv index: ' + json.current.uv + '</p>');
                    $('#weatherInfo').append('<p> humidity: ' + json.current.humidity + '%</p>');
                    $('#weatherInfo').append('<p> Last updated: ' + json.current.last_updated + '</p>');
                    image.onload = function() {
                        $('#weatherImage').empty().append(image);
                    };
                })
                .fail(function() {
                    alert('getJSON request failed! ');
                    $('#weatherInfo').html('<p>no data</p>');
                    $('#weatherImage').empty()

                })
        }

        function getWeather() {
            pie(document.getElementById("location").value);
        }
    </script>
    <!-- Need the following code for Google Maps. PLEASE INSERT YOUR OWN GOOGLE MAPS KEY BELOW -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0rO-86zPMYGXlsruR9s6kxlFOnIrBORo&callback=initMap">
        </script>
</body>

</html>