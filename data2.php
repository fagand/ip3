<html lang="en">

<head>
    <title>Locate-a-Quake: Oil Valve Data</title>
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


    <script src="chartjs-chart-financial-master\docs\moment.js" type="text/javascript"></script>
    <script src="chartjs-chart-financial-master\docs\Chart.js" type="text/javascript"></script>
    <script src="chartjs-chart-financial-master\docs\Chart.Financial.js" type="text/javascript"></script>
    <script src="chartjs-chart-financial-master\docs\utils.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/0.71/jquery.csv-0.71.min.js"></script>


    <!-- javascript csv parse -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script> <!-- js chart -->

    <style>
        .chart-container {
            position: relative;
            margin: auto;
            height: 80vh;
            width: 100%;
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
                    <li class="breadcrumb-item active">Oil Valve Data</li>
                </ol>
            </div>
        </div>
        <!-- breadcrumb end -->

        <div class="row">
            <!-- main column content -->
            <div class="col-sm-8">
                <h1>Oil Valve Data</h1>
                <div class="chart-container" style="max-width:8000px; max-height:400px">
                    <canvas id="myChart" width="800" height="400"></canvas>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas, excepturi. Consequuntur
                        molestias, minus dolorum obcaecati, quis, laboriosam voluptas rem reiciendis praesentium
                        delectus
                        corrupti deserunt rerum suscipit non error. Amet, facere.</p>
                </div>
            </div>
            <!-- end main column content-->

            <!-- sidebar column content-->
            <div class="col-sm-4">
                <h2>Information</h2>
                <h3>Valhall</h3>
                <p>Valhall is a giant oilfield in the southern Norwegian North Sea. Production started in 1982 and
                    following commissioning of the new PH platform in 2013 the field now has the potential to
                    continue producing for several decades.</p>
            </div>
            <!-- end sidebar column content -->
        </div>

        <?php include 'includes/footer.php' ?>
    </div>
    <!-- end content-->
    <script>
        var canvas = document.getElementById('myChart');
        var data = {
            labels: [],
            datasets: [{
                label: "ph 1st stg suct cool gas out output VAL_23-LIC-92521:Z.Y.Value",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(75,192,192,0.4)",
                borderColor: "rgba(75,192,192,1)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(75,192,192,1)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 0,
                pointHitRadius: 10,
                data: [],
            },
            {
                label: "ph 1st stg suct cool gas out measured value VAL_23-LIC-92521:Z.X.Value",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(99, 132, 0, 0.6)",
                borderColor: "rgba(99, 132, 0, 0.6)",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                pointBorderColor: "rgba(99, 132, 0, 0.6)",
                pointBackgroundColor: "#fff",
                pointBorderWidth: 1,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(75,192,192,1)",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointHoverBorderWidth: 2,
                pointRadius: 0,
                pointHitRadius: 10,
                data: [],
            }
            ]
        };

        var option = {
            responsive: false,
            showLines: true
        };
        var myLineChart = Chart.Line(canvas, {
            data: data,
            options: option
        });
        var mydata;
        var i = 1;

        function adddata() {

            myLineChart.data.datasets[0].data[i] = mydata[i][1]; //index then value y axis
            myLineChart.data.labels[i] = new Date(mydata[i][0]).toLocaleString(); //x

            myLineChart.data.datasets[1].data[i] = mydata[i][2]; //index then value y axis
            myLineChart.data.labels[i] = new Date(mydata[i][0]).toLocaleString(); //x
            myLineChart.update();
        }

        $(function () {
            setInterval(oneSecondFunction, 1000);
        });




        function oneSecondFunction() {
            adddata();
            console.log(mydata[i][0]); //time
            console.log(mydata[i][1]); //z.y
            console.log(mydata[i][2]); //z.x
            console.log(" "); //z.x
            i++;

        }

        $.ajax({
            type: "GET",
            url: "./data/valvedata.csv",
            dataType: "text",
            success: function (response) {
                mydata = $.csv.toArrays(response);




                // console.log(data[1][0]);
                //generateHtmlTable(data);
            }
        });

        function generateHtmlTable(data) {
            var html = '<table  class="table table-condensed table-hover table-striped">';

            if (typeof (data[0]) === 'undefined') {
                return null;
            } else {
                $.each(data, function (index, row) {
                    //bind header
                    if (index == 0) {
                        html += '<thead>';
                        html += '<tr>';
                        $.each(row, function (index, colData) {
                            html += '<th>';
                            html += colData;
                            html += '</th>';
                        });
                        html += '</tr>';
                        html += '</thead>';
                        html += '<tbody>';
                    } else {
                        html += '<tr>';
                        $.each(row, function (index, colData) {
                            html += '<td>';
                            html += colData;
                            html += '</td>';
                        });
                        html += '</tr>';
                    }
                });
                html += '</tbody>';
                html += '</table>';
                //alert(html);
                //$('#csv-display').append(html);
            }
        }
    </script>
</body>

</html>