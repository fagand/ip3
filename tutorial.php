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
                <div class="btn-group-horizontal btn-block">
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#geoJson"
                        aria-expanded="false" aria-controls="geoJson">
                        GeoJSON
                    </button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#javaScript"
                        aria-expanded="false" aria-controls="javaScript">
                        JavaScript
                    </button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#earthQuakes"
                        aria-expanded="false" aria-controls="earthQuakes">
                        Earthquakes
                    </button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#weather"
                        aria-expanded="false" aria-controls="weather">
                        Weather
                    </button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#stocks"
                        aria-expanded="false" aria-controls="stocks">
                        Stocks
                    </button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#oilRigValve"
                        aria-expanded="false" aria-controls="oilRigValve">
                        Oil Rig Valve
                    </button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#stocks"
                        aria-expanded="false" aria-controls="stocks">
                        Live Air Traffic
                    </button>
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#oilRigValve"
                        aria-expanded="false" aria-controls="oilRigValve">
                        Wine Production
                    </button>
                </div>
            </div>
            <!-- end sidebar column content-->

            <!-- main column content-->
            <div class="col-sm-9">
                <div class="jumbotron">
                    <p class="lead">In this section of the website you will find information and guidance on the data and technologies we used throughout the development of the Locate-a-Quake project. Clicking each button will reveal details on that particular technology or page.</p>
                    <hr class="my-4">
                    <p>Also included will be links to APIs used and data sources accessed in the creation of the website, as well as links to official documentation on the technologies implemented.</p>
                </div>
            </div>
            <!-- end main column content -->
        </div>

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->
</body>

</html>