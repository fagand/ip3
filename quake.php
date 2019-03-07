<!DOCTYPE html>
<html lang="en">

<head>
    <title>Locate-a-Quake: Earthquakes</title>
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


    <style>
        /* Always set the map height explicitly to define the size of the div
               * element that contains the map. */
        #map {
            height: 100%;
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
                    <li class="breadcrumb-item active">Earthquakes</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- left sidebar content-->
            <div class="col-lg-2">
                <div class="card card-body" style="max-width: 100%;">
                    <button type="button" onclick="deleteMarkers();">Clear Map</button>
                    <div style="max-width: 100%" id="feedSelector"></div>
                </div>
            </div>
            <!-- end left sidebar content-->

            <!-- main column content -->
            <div class="col-lg-7">
                <div id="map"></div>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-lg-3">

                <a class="twitter-timeline" data-lang="en" data-width="max-width" data-height="100%" data-theme="light"
                    href="https://twitter.com/USGSted?ref_src=twsrc%5Etfw">Tweets by USGSted</a>
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

            </div>
            <!-- end sidebar column content -->
        </div>

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->
</body>

<!-- map scripts below -->

<script>
    var mymap;
    // window.location.href;
    var theurl = window.location.toString();
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
    //The following data is used when constructing buttons. You will have to extend this, based upon the feeds at: https://earthquake.usgs.gov/earthquakes/feed/v1.0/geojson.php
    var quakeFeeds = {
        "past hour": {
            "Significant Earthquakes": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/significant_hour.geojson",
            "M4.5+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/4.5_hour.geojson",
            "M2.5+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_hour.geojson",
            "M1.0+": "http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/1.0_hour.geojson",
            "All Earthquakes": "http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_hour.geojson"
        },
        "past day": {
            "Significant Earthquakes": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/significant_day.geojson",
            "M4.5+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/4.5_day.geojson",
            "M2.5+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_day.geojson",
            "M1.0+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/1.0_day.geojson",
            "All Earthquakes": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_day.geojson"
        },
        "past 7 days": {
            "Significant Earthquakes": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/significant_week.geojson",
            "M4.5+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/4.5_week.geojson",
            "M2.5+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojson",
            "M1.0+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/1.0_week.geojson",
            "All Earthquakes": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_week.geojson"
        },
        "past 30 days": {
            "Significant Earthquakes": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/significant_month.geojson",
            "M4.5+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/4.5_month.geojson",
            "M2.5+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_month.geojson",
            "M1.0+": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/1.0_month.geojson",
            "All Earthquakes": "https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_month.geojson"
        }
    };
    /* Function to construct a set of web page buttons of class: 'feed-name' where each button has a stored URL property */
    function makeChildProps(obj, currentProp) {
        var childProps = '';
        for (var prop in obj[currentProp]) {
            var el = "<div class='child-prop'><button class='feed-name' data-feedurl='" + obj[currentProp][prop] +
                "'>" + prop + "</button></div>";
            childProps += el;
        }
        return childProps;
    }
    /* construct the buttons (that include the geojson URL properties) */
    for (var prop in quakeFeeds) {
        if (!quakeFeeds.hasOwnProperty(prop)) {
            continue;
        }
        $('#feedSelector').append("<div class='feed-date'>" + prop + "</div>" + makeChildProps(quakeFeeds, prop));
    }
    /* end construction of buttons */
    var markers = []; // keep an array of Google Maps markers, to be used by the Google Maps clusterer
    /* respond to a button press of any button of 'feed-name' class */
    $('.feed-name').click(function (e) {
        // We fetch the earthquake feed associated with the actual button that has been pressed. 
        $.ajax({
            url: $(e.target).data(
                'feedurl'
            ), // The GeoJSON URL associated with a specific button was stored in the button's properties when the button was created
            success: function (data) { // We've received the GeoJSON data
                i = 0;
                var
                    places = []; // We store the names of earthquake locations in this array                    
                $.each(data.features, function (key,
                    val) { // Just get a single value ('place') and save it in an array
                    var coords = val.geometry.coordinates;
                    places.push("\n");
                    places.push(val.properties
                        .place); // Add a new earthquake location to the array.
                    places.push(coords); // Add a new earthquake location to the array.
                    var latLng = new google.maps.LatLng(coords[1], coords[0]);
                    if (coords[1] > 0) {
                        rhs = coords[1] + "N";
                    } else {
                        rhs = coords[1] * -1;
                        rhs = rhs + "S";
                    }
                    if (coords[0] > 0) {
                        lhs = coords[0] + "E";
                    } else {
                        lhs = coords[0] * -1;
                        lhs = lhs + "W";
                    }
                    var coords = lhs + rhs;
                    function pie() {
                        $.getJSON(
                            "http://api.wolframalpha.com/v2/query?appid=VEUWJE-29Y9QPY4T3&input=" +
                            coords +
                            "&includepodid=CartographicNearestCity&output=json",
                            function (json) {
                                var nearest_city = json.queryresult.pods[0].subpods[0]
                                    .plaintext;
                                document.getElementById('nearest_city_data').innerHTML =
                                    '<br> ' + nearest_city;
                            });
                    }
                    var url =
                        "http://api.wolframalpha.com/v1/simple?appid=VEUWJE-29Y9QPY4T3&i=" +
                        coords;
                    // Now create a new marker on the map
                    var marker = new google.maps.Marker({
                        position: latLng,
                        map: mymap,
                        label: val.properties.mag
                            .toString() // Whatever label you like. This one is the magnitude of the earthquake
                    });
                    // Add the marker to array to be used by clusterer
                    markers.push(marker);
                    var infowindow = new google.maps.InfoWindow({
                        // Form a string that holds desired marker infoWindow content. The infoWindow will pop up when you click on a marker on the map                                                            
                        content: " <h3>" + val.properties.title +
                            "</h3><p><a href='" + url +
                            "'target='_blank'> WolframAlpha API</a></p>"
                    });
                    marker.addListener('click', function (data) {
                        infowindow.open(map,
                            marker); // Open the Google maps marker infoWindow
                        pie();
                    });
                });
                var markerCluster = new MarkerClusterer(mymap, markers, {
                    imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
                });
                if (!places || !places.length) { //check if the data is empty
                    alert("No data");
                }
            }
        });
    });
</script>
<!-- Need the following code for clustering Google maps markers-->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
<!-- Need the following code for Google Maps. PLEASE INSERT YOUR OWN GOOGLE MAPS KEY BELOW -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0rO-86zPMYGXlsruR9s6kxlFOnIrBORo&callback=initMap">
    </script>

</html>