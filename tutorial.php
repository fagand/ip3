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
                    <li class="breadcrumb-item"><a href="#">Locate-a-Quake</a></li>
                    <li class="breadcrumb-item active">Tutorials</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- sidebar column content -->
            <div class="col-sm-3">
                <h1>Tutorials</h1>
                <small class="text-muted">Click on a button below to learn more.</small>
                <div class="btn-group-vertical btn-block">
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#geoJson"
                        aria-expanded="false" aria-controls="geoJson" onclick="clearInfo()">
                        GeoJSON
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#javaScript"
                        aria-expanded="false" aria-controls="javaScript" onclick="clearInfo()">
                        JavaScript
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#earthQuakes"
                        aria-expanded="false" aria-controls="earthQuakes" onclick="clearInfo()">
                        Earthquakes
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#weather"
                        aria-expanded="false" aria-controls="weather" onclick="clearInfo()">
                        Weather
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#stocks"
                        aria-expanded="false" aria-controls="stocks" onclick="clearInfo()">
                        Stocks
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#oilRigValve"
                        aria-expanded="false" aria-controls="oilRigValve" onclick="clearInfo()">
                        Oil Rig Valve
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#stocks"
                        aria-expanded="false" aria-controls="stocks" onclick="clearInfo()">
                        Live Air Traffic
                    </button>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#wineProduction"
                        aria-expanded="false" aria-controls="wineProduction" onclick="clearInfo()">
                        Wine Production
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
                
                <div class="collapse" id="oilRigValve">
                    <div class="card card-body">
                        <h2>Andrew McAvoy <img src="authorimg\andrew.png" width="100px" height="100px" alt=""></h2>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">S1316078 | AMCAVO201@caledonian.ac.uk</h6>
                        <p>Project roles: <b>Frontend Developer</b> & <b>Tester</b></p>
                        <p>As a front-end developer I am responsible for implementing the visual elements that users see when they interact with the web application. This involves coding the CSS stylesheets and utilising frameworks. Also, there is some JavaScript scripting involved, to manipulate some of the elements on the webpage.</p>
                        <p>As tester, it is my role to design testing scenarios for usability, acceptance, and unit tests. I also interact with all developers throughout the implementation stage to ensure all deliverables are fit for purpose and meet the project specifications.</p>
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
    function clearInfo(){
        document.getElementById("information").hidden = true;
    }
    </script>

</html>