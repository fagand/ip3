<!DOCTYPE html>
<html lang="en">

<head>
    <title>Locate-a-Quake: Data 4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js\bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/popper.min.js"></script>
    <!--We will use JQuery library (https://jquery.com/) -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>
    <!-- javascript csv parse -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <!-- js chart -->
    <script src="..\ip3\hammer\hammer.js"></script><!-- hammer js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/0.6.6/chartjs-plugin-zoom.js">
    </script>
    <!-- js chart zoom -->
    <style>
    .chart-container {
        position: relative;
        margin: auto;
        height: 80vh;
        width: 80vw;
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
                    <li class="breadcrumb-item active">Data 4</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-sm-8">
                <h1>Data 4...</h1>
                <div class="chart-container" style="max-width:8000px; max-height:400px">
                    <canvas id="myChart" width="800" height="400"></canvas>

                </div>
                <!-- end main column content-->

                <!-- sidebar column content-->
                <div class="col-sm-4">
                    <h2>Infomation</h2>
                    <h3>EU Wine Grouping Countries</h3>
                    Wine-grower holdings by degree of specialisation
                </div>
                <!-- end sidebar column content -->
            </div>

            <?php include 'includes/footer.php' ?>
        </div>
        <!-- end content-->
        <script>
        var mydata;

        var year_1999_dataset = [];
        var year_2009_dataset = [];
        var year_2015_dataset = [];

        var countries = [];

        var mydatasets = [{
                label: '1999',
                data: year_1999_dataset,
                backgroundColor: "red"


            },
            {
                label: '2009',
                data: year_2009_dataset,
                backgroundColor: "green"
            },
            {
                label: '2015',
                data: year_2015_dataset,
                backgroundColor: "blue"
            }
        ]



        function drawChart() {
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: countries, //countries

                    datasets: mydatasets
                },
                options: {
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: 'Wine-grower holdings by degree of specialisation \n Holdings with areas under vines exclusively intended for wine production'
                    },
                    scales: {
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: "Countries"
                            },
                            ticks: {
                                autoSkip: false
                            }
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: "Hectares"
                            },
                            ticks: {
                                //     min: 800,
                                //   max: 1420000,
                                //   stepSize: 100000,
                                beginAtZero: true,
                                autoSkip: false
                            }
                        }]
                    },

                    //
                    // Container for pan options
                    pan: {
                        // Boolean to enable panning
                        enabled: true,

                        // Panning directions. Remove the appropriate direction to disable 
                        // Eg. 'y' would only allow panning in the y direction
                        mode: 'y'
                    },

                    // Container for zoom options
                    zoom: {
                        // Boolean to enable zooming
                        enabled: true,

                        // Zooming directions. Remove the appropriate direction to disable 
                        // Eg. 'y' would only allow zooming in the y direction
                        mode: 'y',
                    }
                }
            });
        }

        $.ajax({
            type: "GET",
            url: "./data/winedata.csv",
            dataType: "text",
            success: function(response) {
                mydata = $.csv.toArrays(response);

                console.log(mydata);


                var i;
                var country;
                for (i = 0; i < mydata.length; i++) {
                    if (mydata[i][0] == "1999") { //year = 1999
                        if (mydata[i][5] == ":") {
                            year_1999_dataset.push(0);
                        } else {
                            var datapoint = mydata[i][5];
                            datapoint = removeCommas(datapoint);
                            var int_datapoint = parseInt(datapoint, 10); //cast to number
                            year_1999_dataset.push(datapoint);
                        }
                        countries.push(mydata[i][1]);
                    }
                    if (mydata[i][0] == "2009") { //year = 2009
                        if (mydata[i][5] == ":") {
                            year_2009_dataset.push(0);
                        } else {
                            var datapoint = mydata[i][5];
                            datapoint = removeCommas(datapoint);
                            var int_datapoint = parseInt(datapoint, 10); //cast to number
                            year_2009_dataset.push(datapoint);

                        }
                    }
                    if (mydata[i][0] == "2015") { //year = 2015
                        if (mydata[i][5] == ":") {
                            year_2015_dataset.push(0);
                        } else {
                            var datapoint = mydata[i][5];
                            //console.log(datapoint);
                            datapoint = removeCommas(datapoint);
                            //console.log(datapoint);
                            var int_datapoint = parseInt(datapoint, 10); //cast to number
                            //console.log(int_datapoint);
                            // console.log("");
                            year_2015_dataset.push(datapoint);
                        }
                    }

                }

                drawChart();
            }


        });

        function removeCommas(str) {
            return (str.replace(/,/g, ''));
        }
        </script>
</body>

</html>