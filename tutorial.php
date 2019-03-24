<!DOCTYPE html>
<html lang="en">

<head>
    <title>Locate-a-Quake: Tutorials</title>
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
                    <li class="breadcrumb-item active">Tutorials</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- sidebar column content -->
            <div class="col-sm-3" id="buttons">
                <h1>Tutorials</h1>
                <small class="text-muted">Click on a button below to learn more.</small>
                <div class="btn-group-vertical btn-block">
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#geoJson" aria-expanded="false" aria-controls="geoJson" onclick="clearInfo()">
                        GeoJSON
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#javaScript" aria-expanded="false" aria-controls="javaScript" onclick="clearInfo()">
                        JavaScript
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#earthQuakes" aria-expanded="false" aria-controls="earthQuakes" onclick="clearInfo()">
                        Earthquakes
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#weather" aria-expanded="false" aria-controls="weather" onclick="clearInfo()">
                        Weather
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#stocks" aria-expanded="false" aria-controls="stocks" onclick="clearInfo()">
                        Stocks
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#oilRigValve" aria-expanded="false" aria-controls="oilRigValve" onclick="clearInfo()">
                        Oil Rig Valve
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#airTraffic" aria-expanded="false" aria-controls="airTraffic" onclick="clearInfo()">
                        Live Air Traffic
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#wineProduction" aria-expanded="false" aria-controls="wineProduction" onclick="clearInfo()">
                        Wine Production
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#" aria-expanded="false" aria-controls="#" onclick="clearButtons()">
                        Close all tutorials
                    </button>
                </div>
            </div>
            <!-- end sidebar column content-->

            <!-- main column content-->
            <div class="col-sm-9">
                <div id="information" class="jumbotron">
                    <p class="lead">In this section of the website you will find information and guidance on the data and technologies we used throughout the development of the Locate-a-Quake project. Clicking each button will reveal details on that particular technology or page.</p>
                    <hr class="my-4">
                    <p>Also included will be links to APIs used and data sources accessed in the creation of the website, as well as links to official documentation on the technologies implemented.</p>
                </div>

                <div class="collapse" id="geoJson">
                    <div class="card card-body">
                        <h2>GeoJSON</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on GeoJSON</h6>
                        <div class="text-center"><a href="http://geojson.org/" target="_blank"><img src="img/tutGeoJSON.png" alt="GeoJSON image" title="Click to find out more info about GeoJSON" class="img-fluid"></a></div>
                        <p>GeoJSON is an open standard format designed for representing simple geographical features, along with their non-spatial attributes. It is based on JSON, the JavaScript Object Notation.

                            The features include points (therefore addresses and locations), line strings (therefore streets, highways and boundaries), polygons (countries, provinces, tracts of land), and multi-part collections of these types. GeoJSON features need not represent entities of the physical world only; mobile routing and navigation apps, for example, might describe their service coverage using GeoJSON.

                            The GeoJSON format differs from other GIS standards in that it was written and is maintained not by a formal standards organization, but by an Internet working group of developers.

                            A notable offspring of GeoJSON is TopoJSON, an extension of GeoJSON that encodes geospatial topology and that typically provides smaller file sizes.</p>
                        <p>Source: <a href="https://en.wikipedia.org/wiki/GeoJSON" target="_blank">Wikipedia</a><br><br>More detailed information: <a href="https://macwright.org/2015/03/23/geojson-second-bite.html" target="_blank">Via MarcWright.org</a>
                        </p>
                        <p>Locate-A-Quake has used GeoJSON within our site to plot the location of earthquakes and represent them using the data within a map provided by Google.</p>
                    </div>
                </div>

                <div class="collapse" id="javaScript">
                    <div class="card card-body">
                        <h2>JavaScript Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on JavaScript</h6>
                        <div class="text-center"><a href="http://chartjs.org/" target="_blank"><img src="img/tutChartjs.png" alt="Chart.js image" title="Click to find out more info about Chart.js" class="img-fluid"></a></div><br>
                        <p>For Locate-A-Quake we have opted to use the javascript charting library, chart.js. We have chosen to use this library as we believe it is more than capbale of representing our data in a manner which our users could find beneficial. </p>
                        <p>View more information regarding JavaScript <a href="https://techterms.com/definition/javascript" target="_blank">here</a></p>
                        <p>Advantages and Disadvantages of JavaScript
                            Like all computer languages, JavaScript has certain advantages and disadvantages. Many of the pros and cons are related to JavaScript executing often in a client’s browser, but there are other ways to use JavaScript now that allow it to have the same benefits of server-side languages.</p>

                        <h4>Advantages of JavaScript</h4>
                            <ul>
                                <li>Speed. Client-side JavaScript is very fast because it can be run immediately within the client-side browser. Unless outside resources are required, JavaScript is unhindered by network calls to a backend server. It also has no need to be compiled on the client side which gives it certain speed advantages (granted, adding some risk dependent on that quality of the code developed).</li>
                                <li>Simplicity. JavaScript is relatively simple to learn and implement.</li>
                                <li>Popularity. JavaScript is used everywhere in the web. The resources to learn JavaScript are numerous. StackOverflow and GitHub have many projects that are using Javascript and the language as a whole has gained a lot of traction in the industry in recent years especially.</li>
                                <li>Interoperability. JavaScript plays nicely with other languages and can be used in a huge variety of applications. Unlike PHP or SSI scripts, JavaScript can be inserted into any web page regardless of the file extension. JavaScript can also be used inside scripts written in other languages such as Perl and PHP.</li>
                                <li>Server Load. Being client-side reduces the demand on the website server.</li>
                                <li>Rich interfaces. Drag and drop components or slider may give a rich interface to your website.</li>
                            </ul>
                        <h4>Disadvantages of JavaScript</h4>
                        <ul>
                            <li>Client-Side Security. Because the code executes on the users’ computer, in some cases it can be exploited for malicious purposes. This is one reason some people choose to disable Javascript.</li>
                            <li>Browser Support. JavaScript is sometimes interpreted differently by different browsers. Whereas server-side scripts will always produce the same output, client-side scripts can be a little unpredictable. Don’t be overly concerned by this though - as long as you test your script in all the major browsers you should be safe. Also, there are services out there that will allow you to test your code automatically on check in of an update to make sure all browsers support your code.</li>
                        </ul>
                        <p>Source: <a href="https://guide.freecodecamp.org/javascript/advantages-and-disadvantages-of-javascript/">freeCodeCamp</a></p>
                    </div>
                </div>

                <div class="collapse" id="earthQuakes">
                    <div class="card card-body">
                        <h2>Earthquakes Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on Earthquakes</h6>
                        <div class="text-center"><a href="https://developers.google.com/maps/documentation/javascript/earthquakes" target="_blank"><img src="img/tutMaps.png" alt="Google Maps API image" title="Click to find out more info about Google Maps API" class="img-fluid"></a></div>
                        <p>EARTHQUAKES</p>
                    </div>
                </div>

                <div class="collapse" id="weather">
                    <div class="card card-body">
                        <h2>Weather Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on Weather page</h6>
                        <div class="text-center"><a href="http://geojson.org/" target="_blank"><img src="img/tutGeoJSON.png" alt="GeoJSON image" title="Click to return to find out more info about GeoJSON" class="img-fluid"></a></div>
                        <p>Weather</p>
                    </div>
                </div>

                <div class="collapse" id="stocks">
                    <div class="card card-body">
                        <h2>Stocks data Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on Stocks data</h6>
                        <div class="text-center"><a href="http://geojson.org/" target="_blank"><img src="img/tutGeoJSON.png" alt="GeoJSON image" title="Click to return to find out more info about GeoJSON" class="img-fluid"></a></div>
                        <p>stocks</p>
                    </div>
                </div>


                <div class="collapse" id="oilRigValve">
                    <div class="card card-body">
                        <h2>Oil Rig</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on oil rig page</h6>
                        <div class="text-center"><a href="data2.php"><img src="img/tutOilRig.png" alt="Oil rig image" title="Click to return to oil rig data page" class="img-fluid"></a></div>
                        <p>Valhall is a giant oilfield in the southern Norwegian North Sea. Production started in 1982 and following commissioning of the new PH platform in 2013 the field now has the potential to continue producing for several decades.

                            Displaying inlet temperature to a 1stage comparessor showing the temperature at the suction side (38-40) DegC cool and the outlet (cool side 35 DegC)

                            This chart updates in real time representing the data as and when it is received.
                            The chart can be interacted with allowing you to show only one dataset. Clicking the values at the top hides the selected source from the chart.
                            Hovering your cursor over the line will also give more detailed information about that point.</p>
                    </div>
                </div>

                <div class="collapse" id="airTraffic">
                    <div class="card card-body">
                        <h2>Air Traffic data Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on Air Traffic</h6>
                        <div class="text-center"><a href="http://geojson.org/" target="_blank"><img src="img/tutGeoJSON.png" alt="GeoJSON image" title="Click to return to find out more info about GeoJSON" class="img-fluid"></a></div>
                        <p>air traffic</p>
                    </div>
                </div>

                <div class="collapse" id="wineProduction">
                    <div class="card card-body">
                        <h2>Wine production data Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on wine production</h6>
                        <div class="text-center"><a href="http://geojson.org/" target="_blank"><img src="img/tutGeoJSON.png" alt="GeoJSON image" title="Click to return to find out more info about GeoJSON" class="img-fluid"></a></div>
                        <p>wine production</p>
                    </div>
                </div>

            </div>
            <!-- end main column content -->
        </div>

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->
</body>

<script>
    function clearInfo() {
        document.getElementById("information").hidden = true;
    }

</script>
<script>
    function clearButtons() {
        document.getElementById("information").hidden = false;
        /*        Doesn't work...

        document.getElementById("buttons").getElementsByClassName("btn btn-secondary")["aria-expanded"] = "false";
                //document.getElementsByTagName("aria-expanded").innerHTML = "false";
                $('.btn.btn-secondary').attr('aria-expanded', 'false');
                $('.btn.btn-secondary').attr('class', 'btn btn-secondary collapsed');
                
        */
    }

</script>

</html>
