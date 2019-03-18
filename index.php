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
                    <li class="breadcrumb-item active">Home</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-lg-8" style="text-align: justify; text-justify: inter-word;">
                <h1>Home</h1>
                <p>This project is being undertaken as part of the Integrated Project 3 module. The module involves forming a group of six students and working together to plan, design, develop, test, and evaluate a final piece of software – all while following a relevant software development methodology. At the end of the module, a group report will be submitted alongside the complete piece of software which will be demonstrated. Additionally, each group member will complete an individual reflective report and a peer evaluation report.</p>

                <p>The concept of this project is to provide a map-based visualisation of extreme weather across the world. This will be implemented through the use of a variety of technologies, including CSS, JavaScript, jQuery, HTML and PHP. It will be easy to access and will be interactive for users, as well as being responsive so that users on any devices will be able to use the website. The <a href="tutorial.php">Tutorial</a> page provides further information on some of the technologies and techniques used throughout the implementation of the project.</p>

                <p>It will be carried out as a group, with each group member having individual specific roles. However, due to the Scrum methodology and the collaborative nature during sprints, all of the project team members will contribute across the board. The <a href="authors.php">Authors</a> page contains a profile for each group member which includes a description of the roles they played throughout the project.</p>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-lg-4">
                    <div class="card text-white bg-info mb-3" style="max-width: 100%;">
                            <div class="card-body">
                                <h4 class="card-title">Project Specification</h4>
                                <p class="card-text">Embedded below is the project specification document. Alternatively, <a href="other/spec.pdf" target="blank">click here.</a></p>
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