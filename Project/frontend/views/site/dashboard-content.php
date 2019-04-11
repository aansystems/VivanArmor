<head>
    <?php

    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;

/* @var $this yii\web\View */

    $this->title = 'Dashboard';
    ?>
    <link rel="stylesheet"
          href="<?= Yii::$app->request->baseUrl ?>/layoutCss/dashboard.css">

</head>

<div class="content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="purple">
                    <i class="material-icons">book</i>
                </div>
                <div class="card-content">
                    <p class="category" style="color: black;">Total Courses</p>
                    <h3 class="title">30
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats" style="color: black;">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">book</i>
                </div>
                <div class="card-content">
                    <p class="category" style="color: black;">New Course</p>
                    <h3 class="title">5
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats" style="color: black;">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">book</i>
                </div>
                <div class="card-content">
                    <p class="category" style="color: black;">Current Course</p>
                    <h3 class="title">25
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats" style="color: black;">

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">timeline</i><span style="font-size: 25px;"><b>New Courses</b></span>

                    </div>
                    <div class="card-content">

                    </div>
                    <div id="container"></div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">timeline</i><span style="font-size: 25px;"><b>Total Courses</b></span>

                    </div>
                    <div class="card-content">

                    </div>
                    <div id="container1"></div>

                </div>
            </div>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<script>
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
        },
        yAxis: {
            min: 0,
            title: {
                text: ' New Courses added'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 10,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
                name: 'IT',
                data: [2, 1, 2, 1, 2, 1]
            }, {
                name: 'HR',
                data: [1, 3, 1, 2, 1, 2]
            }, {
                name: 'Sales',
                data: [2, 1, 3, 2, 2, 1]
            }]
    });






</script>

<script>

    var chart = Highcharts.chart('container1', {

        title: {
            text: ''
        },

        subtitle: {
            text: ''
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },

        xAxis: {
            categories: ['IT', 'HR', 'SALES', ]
        },

        yAxis: {
            min: 0,
            title: {
                text: 'Courses'
            }
        },

        series: [{
                type: 'column',
                colorByPoint: true,
                data: [15, 10, 5, ],
                showInLegend: false
            }]

    });





</script>







