<!DOCTYPE html>
<html lang="en">

<head>
    <title>Locate-a-Quake: Authors</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js\bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/popper.min.js"></script>
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
                    <li class="breadcrumb-item active">Authors</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-sm-8">
                <h1>Authors...</h1>
                <small class="text-muted">Click each member's name in the sidebar to view his profile.</small>
                    <div class="collapse" id="andrewInfo">
                    <div class="card card-body">
                        <h3>Andrew McAvoy</h3>
                        <h6 class="card-subtitle mb-2 text-muted">S1316078 | AMCAVO201@caledonian.ac.uk</h6>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus quibusdam suscipit</p>
                    </div>
                    </div>

                    <div class="collapse" id="alexInfo">
                    <div class="card card-body">
                        <h3>Alex Carruthers</h3>
                        <h6 class="card-subtitle mb-2 text-muted">STUDENT NO | x@caledonian.ac.uk</h6>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus quibusdam suscipit</p>                    </div>
                    </div>

                    <div class="collapse" id="davidInfo">
                    <div class="card card-body">
                        <h3>David Fagan</h3>
                        <h6 class="card-subtitle mb-2 text-muted">STUDENT NO | x@caledonian.ac.uk</h6>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus quibusdam suscipit</p>                    </div>
                    </div>

                    <div class="collapse" id="mattInfo">
                    <div class="card card-body">
                        <h3>Matt Alston</h3>
                        <h6 class="card-subtitle mb-2 text-muted">STUDENT NO | x@caledonian.ac.uk</h6>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus quibusdam suscipit</p>                    </div>
                    </div>

                    <div class="collapse" id="afaqInfo">
                    <div class="card card-body">
                        <h3>Afaq Ahmad</h3>
                        <h6 class="card-subtitle mb-2 text-muted">STUDENT NO | x@caledonian.ac.uk</h6>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus quibusdam suscipit</p>                    </div>
                    </div>

                    <div class="collapse" id="jackInfo">
                    <div class="card card-body">
                        <h3>Jack Moore</h3>
                        <h6 class="card-subtitle mb-2 text-muted">STUDENT NO | x@caledonian.ac.uk</h6>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellendus quibusdam suscipit</p>                    </div>
                    </div>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-sm-4">
                <p>
                    <div class="btn-group-vertical">
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#andrewInfo" aria-expanded="false" aria-controls="andrewInfo">
                            Andrew
                        </button>
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#alexInfo" aria-expanded="false" aria-controls="alexInfo">
                            Alex
                        </button>
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#davidInfo" aria-expanded="false" aria-controls="davidInfo">
                            David
                        </button>
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#mattInfo" aria-expanded="false" aria-controls="mattInfo">
                            Matt
                        </button>
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#afaqInfo" aria-expanded="false" aria-controls="afaqInfo">
                            Afaq
                        </button>
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#jackInfo" aria-expanded="false" aria-controls="jackInfo">
                            Jack
                        </button>
                    </div>
                </p>
            </div>
            <!-- end sidebar column content -->
        </div>

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->
</body>

</html>