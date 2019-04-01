<!DOCTYPE html>
<html lang="en">

<head>
    <title>Locate-a-Quake: Home</title>
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
                    <li class="breadcrumb-item active">Overview</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-lg-8" style="text-align: justify; text-justify: inter-word;">
                <h1>Overview</h1>
                <p><em>This project is being undertaken as part of the Integrated Project 3 module. The module involves
                    forming a group of six students and working together to plan, design, develop, test, and evaluate a
                    final piece of software – all while following a relevant software development methodology. At the
                    end of the module, a group report will be submitted alongside the complete piece of software which
                    will be demonstrated. Additionally, each group member will complete an individual reflective report
                    and a peer evaluation report.</em></p>

                <p>The main concept of this project is to provide a map-based visualisation of extreme weather across
                    the world. This will be implemented through the use of a variety of technologies, including CSS,
                    JavaScript, jQuery, HTML and PHP. It will be easy to access and will be interactive for users, as
                    well as being responsive so that users on any devices will be able to use the website.</p>

                <p>As well as the <a href="weather.php">Weather</a> and <a href="quake.php">Earthquake</a> pages, there
                    have been four extra data visualisation pages created as part of the project (Oil Rig Valve sensor,
                    Air Traffic Visualisation, Wine Production across the EU, Stocks). Each of these pages display
                    different data in interesting ways, and make use of a broad range of APIs and technologies.</p>

                <p>JavaScript has been used throughout the project, as has HTML and CSS for front-end implementation.
                    GeoJSON has also been used heavily, as it allows for map-based visualisations.</p>

                <p>For more information on the technologies used throughout the project, please visit the <a href="tutorial.php">Tutorial</a>
                    page.</p>

                <p>The project has been carried out as a group, with each group member having individual specific roles. However,
                    due to our adoption of the Scrum methodology and the collaborative nature during sprints, all team
                    members have contributed across the board. The <a href="authors.php">Authors</a> page contains a
                    profile for each group member which includes a description of the roles they played throughout the
                    project.</p>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-lg-4">
                <div class="card text-white bg-info mb-3" style="max-width: 100%;">
                    <div class="card-body">
                        <h4 class="card-title">Project Specification</h4>
                        <p class="card-text">Embedded below is the project specification document. Alternatively, <a
                                href="other/spec.pdf" target="blank">click here.</a></p>
                    </div>
                </div>
                <embed src="other/spec.pdf" width="100%" height="500px" type="application/pdf">
            </div>
            <!-- end sidebar column content -->
        </div>

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->
</body>

</html>