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
                    <!-- Removed becuase the information would be very similar to the GeoJSON info

                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#earthQuakes" aria-expanded="false" aria-controls="earthQuakes" onclick="clearInfo()">
                        Earthquakes
                    </button>
-->
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
                    <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#" aria-expanded="false" aria-controls="#" onclick="clearBtns()">
                        Close all buttons
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
                        <h5>Explanation</h5>
                        <p>GeoJSON is an open standard format designed for representing simple geographical features, along with their non-spatial attributes. It is based on JSON, the JavaScript Object Notation.

                            The features include points (therefore addresses and locations), line strings (therefore streets, highways and boundaries), polygons (countries, provinces, tracts of land), and multi-part collections of these types. GeoJSON features need not represent entities of the physical world only; mobile routing and navigation apps, for example, might describe their service coverage using GeoJSON.

                            The GeoJSON format differs from other GIS standards in that it was written and is maintained not by a formal standards organization, but by an Internet working group of developers.

                            A notable offspring of GeoJSON is TopoJSON, an extension of GeoJSON that encodes geospatial topology and that typically provides smaller file sizes.</p>

                        <h5>Benefit to us</h5>
                        <p>Locate-A-Quake has used GeoJSON within our site to plot the location of earthquakes and represent them using the data within a map provided by Google. This was done using JavaScript (<a href="https://www.w3schools.com/xml/ajax_intro.asp" target="_blank">Ajax</a>) calls made to the USGS website seeking data earthquakes. We were able to use the dataset received by USGS to plot locations onto our map by using the co-ordinates gathered from USGS. </p>
                        <h5>Sources</h5>
                        <p><a href="https://developers.google.com/maps/documentation/" target="_blank">Google Maps</a><br><a href="https://en.wikipedia.org/wiki/GeoJSON" target="_blank">Wikipedia</a><br>More detailed information: <a href="https://macwright.org/2015/03/23/geojson-second-bite.html" target="_blank">MarcWright.org</a>
                        </p>
                    </div>
                </div>

                <div class="collapse" id="javaScript">
                    <div class="card card-body">
                        <h2>JavaScript Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on JavaScript</h6>
                        <div class="text-center"><a href="http://chartjs.org/" target="_blank"><img src="img/tutChartjs.png" alt="Chart.js image" title="Click to find out more info about Chart.js" class="img-fluid"></a></div><br>
                        <h5>Explanation</h5>
                        <p>Like server-side scripting languages, such as <a href="https://techterms.com/definition/php" target="_blank">PHP</a> and <a href="https://techterms.com/definition/asp" target="_blank">ASP</a>, JavaScript code can be inserted anywhere within the <a href="https://techterms.com/definition/html" target="_blank">HTML</a> of a <a href="https://techterms.com/definition/webpage" target="_blank">webpage</a>. However, only the <a href="https://techterms.com/definition/output" target="_blank">output</a> of server-side code is displayed in the HTML, while JavaScript code remains fully visible in the source of the webpage. It can also be referenced in a separate <a href="https://fileinfo.com/extension/js" target="fileinfo" target="_blank">.JS</a> file, which may also be viewed in a browser.</p>

                        <p>Advantages and Disadvantages of JavaScript
                            Like all computer languages, JavaScript has certain advantages and disadvantages. Many of the pros and cons are related to JavaScript executing often in a client’s browser, but there are other ways to use JavaScript now that allow it to have the same benefits of server-side languages.</p>

                        <h6>Advantages of JavaScript</h6>
                        <ul>
                            <li>Speed. Client-side JavaScript is very fast because it can be run immediately within the client-side browser. Unless outside resources are required, JavaScript is unhindered by network calls to a backend server. It also has no need to be compiled on the client side which gives it certain speed advantages (granted, adding some risk dependent on that quality of the code developed).</li>
                            <li>Simplicity. JavaScript is relatively simple to learn and implement.</li>
                            <li>Popularity. JavaScript is used everywhere in the web. The resources to learn JavaScript are numerous. StackOverflow and GitHub have many projects that are using Javascript and the language as a whole has gained a lot of traction in the industry in recent years especially.</li>
                            <li>Interoperability. JavaScript plays nicely with other languages and can be used in a huge variety of applications. Unlike PHP or SSI scripts, JavaScript can be inserted into any web page regardless of the file extension. JavaScript can also be used inside scripts written in other languages such as Perl and PHP.</li>
                            <li>Server Load. Being client-side reduces the demand on the website server.</li>
                            <li>Rich interfaces. Drag and drop components or slider may give a rich interface to your website.</li>
                        </ul>
                        <h6>Disadvantages of JavaScript</h6>
                        <ul>
                            <li>Client-Side Security. Because the code executes on the users’ computer, in some cases it can be exploited for malicious purposes. This is one reason some people choose to disable Javascript.</li>
                            <li>Browser Support. JavaScript is sometimes interpreted differently by different browsers. Whereas server-side scripts will always produce the same output, client-side scripts can be a little unpredictable. Don’t be overly concerned by this though - as long as you test your script in all the major browsers you should be safe. Also, there are services out there that will allow you to test your code automatically on check in of an update to make sure all browsers support your code.</li>
                        </ul>
                        <h6>AJAX</h6>
                        <p><a href="https://www.w3schools.com/xml/ajax_intro.asp" target="_blank">Ajax</a> represents Asynchronous Javascript and XML. XML is a report organizing language. It's fundamental advantage is that it stores information so that the people and computers can without much of a stretch read it. Javascript is a web scripting language used to give some dimension of rationale to a HTML page (HTML itself is just a design language for showing static information). Asynchronous is the essential piece of <a href="https://www.w3schools.com/xml/ajax_intro.asp" target="_blank">Ajax</a>. It lets developers make "asynchronous" requests to a server. This ultimately means that the website will not be "waiting" for the request to finish. If it wasn't asynchronous, every time you wanted to refresh something, the site would sort of freeze and nothing would work until the response came back from the server. Asynchronous means things will work while the request is happening and the user doesn't even know about it.</p>
                        <code>$.ajax({<br>
                            type: "GET",<br>
                            url: "data/winedata.csv",<br>
                            dataType: "text",<br>
                            success: function(response) {<br>
                            mydata = $.csv.toArrays(response);</code><br>
                        <p>In the above code we are making use of an <a href="https://www.w3schools.com/xml/ajax_intro.asp" target="_blank">Ajax</a> call to bring in our data for the wine chart, the data is received and then converted into an array allowing us to use it within our <a href="http://chartjs.org/" target="_blank">chart</a>.</p>
                        <h5>Benefit to us</h5>
                        <p>JavaScript has been a key element in developing our site. We have used JavaScript across all pages to perform functions within Bootstrap. Ås well as using it to implement Chart.js, Google Maps and also our own user defined functions. For Locate-A-Quake we have opted to use the JavaScript charting library, <a href="http://chartjs.org/" target="_blank">chart.js</a> to display our charts. We have chosen to use this library as we believe it is more than capbale of representing our data in a manner which our users could find beneficial. Chart.js gives also gives us additional functionality such as the ability to hover over teh chart elements to see more data and the ability to zoom in and out of the chart using the scroll wheel on the mouse to localize data sets.</p>
                        <h5>Sources</h5>
                        <p><a href="https://guide.freecodecamp.org/javascript/advantages-and-disadvantages-of-javascript/" target="_blank">Freecodecamp</a><br>
                            <a href="https://techterms.com/definition/javascript" target="_blank">Techterms</a><br>
                        <a href="https://www.w3schools.com/" target="_blank">w3schools</a></p>
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
                        <div class="text-center"><a href="http://geojson.org/" target="_blank"><img src="img/tutWeatherAPIXU.png" alt="APIXU image" title="Click to find out more info about APIXU" class="img-fluid"></a></div>
                        <h5>Explanation</h5>
                        <p>Apixu.com is owned and managed by Mzemo (http://mzemo.com), a Dubai based mobile and app development company.
                            Apixu.com provides current and 10 day weather data and geo data via. REST API in JSON format.
                            The API will also provide time zone information, astronomy data and geo location data. The weather data is provided in partnership with World Weather Online. We also get our data from different government and metreological agencies.</p>
                        <h5>Benefit to us</h5>
                        <p>To allow us to display weather information on our site we used the APIXU API dataset. APIXU provides current and 10 day weather data in JSON format. We used this data to display information within our Google map. We retrieved the data using <a href="https://www.w3schools.com/xml/ajax_intro.asp" target="_blank">Ajax</a>, then it is displayed using <a href="https://www.w3schools.com/jquery/default.asp" target="_blank">jQuery</a>.</p>
                        <p>When a user clicks a location on the map the are presented with the current weather for that location. Our talented developers also managed to implement a UV Index feature that displays the recommended skin protection as recommmended by <a href="https://www.cbc.ca/news/canada/kitchener-waterloo/high-uv-index-here-s-what-to-wear-to-protect-yourself-from-the-sun-1.3607369" target="_blank">CBC</a> and <a href="https://www.aimatmelanoma.org/prevention/uv-index/" target="_blank">others.</a></p>
                        <p>Depending on the UV rating returnign form the API, different guidance is offered the user.</p>
                        <div><img src="img/dynamic_weather_uv.png" alt="dynamic uv example" class="img-fluid"></div>
                        <p><small><i>For fun click Scotland on the <a href="weather.php">map</a> to be told that you should be wearing Sunglasses and Sunscreen. Presuming you're Scottish, you'll understand why this is funny, but who are we to argue with the experts </i>🤷🏻‍♂️</small></p>
                        <h5>Sources</h5>
                        <p><a href="https://developers.google.com/maps/documentation/" target="_blank">Google Maps</a><br>
                            <a href="https://www.apixu.com/about.aspx" target="_blank">apixu.com</a><br>
                            <a href="http://w3schools.com" target="_blank">w3schools</a></p>
                    </div>
                </div>

                <div class="collapse" id="stocks">
                    <div class="card card-body">
                        <h2>Stocks data Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on Stocks data</h6>
                        <div class="text-center"><a href="https://www.alphavantage.co/#about" target="_blank"><img src="img/tutStocks.jpg" alt="Stock Market image" title="Click to find out more info about Alpha Vantage" class="img-fluid"></a></div><br>
                        <h5>Explanation</h5>
                        <p>About Alpha Vantage
                            Composed of a tight-knit community of researchers, engineers, and business professionals, Alpha Vantage Inc. is a leading provider of free APIs for realtime and historical data on stocks, forex (FX), and digital/crypto currencies. Our success is driven by rigorous research, cutting edge technology, and a disciplined focus on democratizing access to data.</p>
                        <h5>benefit to us</h5>
                        <p>To display our data on the <a href="data1.php">stocks</a> page, we used data provided by Alpha Vantage. This data was brought in via an Ajax call to get a JSON data set which we then used to display the information the chart.</p>
                        <p>Chart.js was used to model financial data from AlphaVantage. AlphaVantage also provide search functions based on the user input.</p>
                        <h5>Sources</h5>
                        <p><a href="http://chartjs.org/" target="_blank">chart.js</a><br><a href="https://www.alphavantage.co/#about" target="_blank">Alpha Vantage</a><br>
                            <a href="https://www.chartjs.org/chartjs-chart-financial/" target="_blank">Chart.js - OHLC Example</a><br>
                            <a href="https://en.wikipedia.org/wiki/Open-high-low-close_chart" target="_blank">OHLC Chart Description</a></p>
                    </div>
                </div>


                <div class="collapse" id="oilRigValve">
                    <div class="card card-body">
                        <h2>Oil Rig</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on oil rig page</h6>
                        <div class="text-center"><a href="data2.php"><img src="img/tutOilRig.png" alt="Oil rig image" title="Click to return to oil rig data page" class="img-fluid"></a></div>
                        <h5>Explanation</h5>

                        <p>Valhall is a giant oilfield in the southern Norwegian North Sea. Production started in 1982 and following commissioning of the new PH platform in 2013 the field now has the potential to continue producing for several decades.

                            Displaying inlet temperature to a 1stage comparessor showing the temperature at the suction side (38-40) DegC cool and the outlet (cool side 35 DegC).</p>
                        <p> This chart updates in real time representing the data as and when it is received.
                            The chart can be interacted with allowing you to show only one dataset. Clicking the values at the top hides the selected source from the chart.
                            Hovering your cursor over the line will also give more detailed information about that point.</p>

                        <h5>benefit to us</h5>
                        <p>To display data on the oil rig we sourced data via <a href="https://www.w3schools.com/xml/ajax_intro.asp" target="_blank">Ajax</a> again, this time we saved the data locally in a .csv file. We done this to allow us to present the data in a decorative fashion without dispalying any delay to the user. </p>
                        <p>Google Cloud is the platform for the IIoT (Industrial Internet of Things) data. This can deliver real time sensor changes with 200 to 300 millisecond response times for data access.</p>
                        <h5>Sources</h5>
                        <p><a href="http://chartjs.org/" target="_blank">chart.js</a><br><a href="https://www.akerbp.com/en/our-assets/production/valhall/" target="_blank">AkerBP</a>
                            <a href="https://cloud.google.com/customers/cognite/" target="_blank">Google Cloud with Cognite</a><br>
                            <a href="https://openindustrialdata.com/" target="_blank">Open Industrial Data</a><br>
                            <a href="https://www.cognite.com/" target="_blank">Cognite</a><br>
                            <a href="https://doc.cognitedata.com/guides/" target="_blank">Cognite Docs</a>
                        </p>
                    </div>
                </div>

                <div class="collapse" id="airTraffic">
                    <div class="card card-body">
                        <h2>Air Traffic data Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on Air Traffic</h6>
                        <div class="text-center"><img src="img/tutAirTraffic.png" alt="Air traffic image" title="Air traffic image" class="img-fluid"></div>
                        <h5>Explanation</h5>
                        <p>Need some info on the source etc?</p>
                        <h5>Benefit to us</h5>
                        <p>To display data on the Air traffic map we sourced data via <a href="https://www.w3schools.com/xml/ajax_intro.asp" target="_blank">Ajax</a> again, this time we saved the data locally to allow us to present the data without any delay. Displaying the data within a map provided by Google.</p>
                        <p>The air traffic page shows data regarding flight information of flights in and out of Glasgow Airport. Within the information is distance of each journey, this distance is calculated using...</p>
                        <p>

                            The chart can be zoomed in using your mouse and the data within the chart is clickable; e.g.
                            Clicking/highlighting the plottings on the map displays the information of that selected airport.
                            Clicking the flight icon displays information for that selected flight.</p>
                        <h5>Sources</h5>
                        <p><a href="https://developers.google.com/maps/documentation/" target="_blank">Google Maps</a><br>
                            <a href="http://w3schools.com" target="_blank">w3schools</a>
                        </p>
                    </div>
                </div>

                <div class="collapse" id="wineProduction">
                    <div class="card card-body">
                        <h2>Wine production data Tutorial</h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">tutorial on wine production</h6>
                        <div class="text-center"><img src="img/tutWine.png" alt="Wine Production image" title="Wine production image" class="img-fluid"></div>
                        <h5>Explanation</h5>
                        <p>Need some info about source etc?</p>
                        <h5>Benefit to us</h5>
                        <p>To display data on the wine production chart we sourced data via <a href="https://www.w3schools.com/xml/ajax_intro.asp" target="_blank">Ajax</a> again.
                            This data was stored locally to allow us to present the data without any delay. We then used <a href="https://www.w3schools.com/jquery/default.asp" target="_blank">jQuery</a> to display the data within a chart by <a href="http://chartjs.org/" target="_blank">chart.js</a>.</p>
                        <p>The wine production chart shows the wine-grower holdings by degree of specialisation based on regions across Europe.</p>
                        <p>The chart can be zoomed in using your mouse and the data within the chart is clickable; e.g. Clicking the years at the top hides them from the chart / reclicking them unhides them.
                            Highlighting your cursor over the bar displays the hectares for that country/year.</p>
                        <p>The haversine formula was used to calculate the great-circle distance between two points. More information is cited below</p>
                        <h5>Sources</h5>
                        <p><a href="http://chartjs.org/" target="_blank">chart.js</a><br>
                            <a href="http://w3schools.com" target="_blank">w3schools</a><br>
                            <a href="https://www.movable-type.co.uk/scripts/latlong.html" target="_blank">JavaScript distance library</a> </p>
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

    function clearBtns() {
        location.reload(); // this reloads the page to initial state (eg. when all tutorial cards were not expanded)
    }

</script>

</html>
