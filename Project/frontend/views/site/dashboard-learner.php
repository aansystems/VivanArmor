<?php
/* @var $this yii\web\View */

$this->title = 'Progress';

use yii\helpers\Html;
use frontend\models\Courses;
use yii\helpers\ArrayHelper;
?>


<style>
    #graph_container .col-md-12 {
        padding-left: 0;
        padding-right: 0;
    }
    .main-panel > .content {
        padding: 1% 0% 0;
    }
    .highcharts-axis-title {
        font-size: 21px;
    }
    .wrapper {
        height:auto !important;
    }
    #branch .more_info {
        height: 498px !important;
    }
    @media (max-width: 767px){
        .content {
            margin-top: 20px;
        }
    }
    .form-control{
        margin-top: -12px;
    }
    .col-md-offset-2 {
        margin-left: 11.666667%;
    }
    .col-md-4 {
        width: 31.333333%;
    }
    #dropDown{
        margin: 2px 2px;
    }
</style>

<div class="content learner-dash" id="learner">

    <div class="row" id="graph_container">
        <div class="col-md-3">
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="fa fa-book" aria-hidden="true"></i>
                </div>
                <div class="dashblock">
                    <p class="category">Total Courses</p>
                    <h3 class="title"><?= $total_acourses ?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i><span> Last 24 Hours</span>
                    </div>
                </div>
            </div>
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="material-icons">equalizer</i>
                </div>
                <div class="dashblock">
                    <p class="category">Courses In Progress</p>
                    <h3 class="title"><?= $total_acourses - $completed_count - $yet_to_start ?></h3>

                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i><span> Last 24 Hours</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">timeline</i><span class="headings">Learner Score Per Course</span>
                </div>                   
                <div id="container_three"></div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-4">
                        <label for="exampleFormControlSelect1" id="dropDown">
                            SELECT COURSES :</label>
                    </div>
                    <?php
                    $first_course = '';
                    $selectedcourse = '';
                    foreach ($assigned_courses as $courses) {
                        if ($first_course == '') {
                            $first_course = $courses;
                            $selectedcourse = 'selected';
                        } else {
                            $selectedcourse = '';
                        }
                        ?>


<?php } ?>
                    <div class="col-md-6">
                    <?=
                    Html::dropDownList('', ['class' => 'Document-Type'],ArrayHelper::map(Courses::find()
                                            ->leftJoin('courses_assigned', 'courses.id=courses_assigned.courses_assigned')
                                            ->where(['=', 'courses_assigned.user_id', Yii::$app->user->identity->id])
                                            ->all(), 'id', 'course_name') , ['id' => 'learner_id', 'class' => 'form-control']
                    );
                    ?> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="material-icons">assignment_turned_in</i>
                </div>
                <div class="dashblock">
                    <p class="category">Courses Completed</p>
                    <h3 class="title"><?= $completed_count ?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i><span>Last 24 Hours</span>
                    </div>
                </div>
            </div>
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="material-icons">flight_takeoff</i>
                </div>
                <div class="dashblock">
                    <p class="category">Courses Yet To Start</p>
                    <h3 class="title"><?= $yet_to_start ?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">access_time</i><span>Last 24 Hours</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">timeline</i><span class="headings">Course Progress</span>
                    </div>                   
                    <div id="container_one"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">timeline</i><span class="headings">Course Index Trend</span>
                    </div>                               
                    <div class="learner-trend" id="container_two"></div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

    /*----- Course Progress -----*/
    jQuery(document).ready(function () {

    var chart = new Highcharts.Chart('container_one', {
    title: {
    text: '',
            align: 'left',
            margin: 0
    },
            chart: {
            renderTo: 'container',
                    type: 'bar',
                    height: 'auto'
            },
            credits: false,
            tooltip: false,
            legend: false,
            navigation: {
            buttonOptions: {
            enabled: false
            }
            },
            xAxis: {
            categories: [
<?php foreach ($assigned_courses as $courses) {
    ?>
                '<?= $courses['course_name'] ?>',
<?php } ?>
            ]
            },
            yAxis: {
            allowDecimals: true,
                    min: 0,
                    max: 100,
                    tickInterval: 20,
                    title: {
                    text: ''
                    }
            },
            series: [{
            data: [<?php echo $totalCoursesString ?>],
                    grouping: false,
                    animation: false,
                    enableMouseTracking: false,
                    showInLegend: true,
                    color: 'green',
                    pointWidth: 25,
                    borderWidth: 0,
                    dataLabels: {
                    className: 'highlight',
                            enabled: true,
                            align: 'right',
                            format: '{point.y}%',
                            style: {
                            color: 'white',
                                    textOutline: false
                            }
                    }
            }, {
            enableMouseTracking: false,
                    data: [<?php echo $percentOfCourseCompletionString ?>],
                    borderRadiusBottomLeft: '4px',
                    borderRadiusBottomRight: '4px',
                    color: 'green',
                    borderWidth: 0,
                    pointWidth: 25,
                    animation: {
                    duration: 250
                    },
                    dataLabels: {
                    enabled: true,
                            inside: true,
                            align: 'left',
                            format: '{point.y}%',
                            style: {
                            color: 'white',
                                    display : 'none',
                                    textOutline: false
                            }
                    }
            }]
    });
    });</script>

<script type="text/javascript">

    /*----- Course Index Trend -----*/
    jQuery(document).ready(function () {
    Highcharts.chart('container_two', {
    chart: {
    type: 'column'
    },
            title: {
            text: ''
            },
            xAxis: {
            categories: []
            },
            yAxis: {
            min: 0,
                    max: 100,
                    tickInterval: 20,
                    lineColor: '',
                    title: {
                    text: ''
                    }
            },
            legend: {
            title: {
            text: '<span style="color:red;">0-60 : Poor</span><br/><span style="color:orange;">60-80 : Good</span><br/><span style="color:green;">80-100: Excellent</span>',
                    style: {
                    fontStyle: 'normal'
                    }
            },
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: 0,
                    y: 100
            },
            plotOptions: {
            line: {
            dataLabels: {
            enabled: false
            },
                    enableMouseTracking: true
            }
            },
            series: [ <?= $dataStringForCourseIndex ?> ]
    });
    });</script>

<script type="text/javascript">
<?php
if ($first_course != '') {
    ?>

        learner_id = <?= $first_course['id'] ?>;
        jQuery.get('learner', {id: learner_id}, function (data) {

        var finalData = JSON.parse(data);
        var gaugeOptions = {

        chart: {
        type: 'solidgauge'
        },
                title: null,
                pane: {
                center: ['50%', '85%'],
                        size: '100%',
                        startAngle: - 90,
                        endAngle: 90,
                        background: {
                        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                                innerRadius: '60%',
                                outerRadius: '100%',
                                shape: 'arc'
                        }
                },
                tooltip: {
                enabled: false
                },
                // the value axis
                yAxis: {
                stops: [
                [0, '#EEE'],
                [1 / 59, '#FF0000'],
                [60 / 79, '#FFA126'],
                [80 / 100, '#008000'],
                ],
                        lineWidth: 0,
                        minorTickInterval: null,
                        tickAmount: 2,
                        title: {
                        y: - 125
                        },
                        labels: {
                        y: 16
                        }
                },
                plotOptions: {
                solidgauge: {
                dataLabels: {
                y: 5,
                        borderWidth: 0,
                        useHTML: true
                }
                }
                }
        };
        // The speed gauge
        var chartSpeed = Highcharts.chart('container_three', Highcharts.merge(gaugeOptions, {
        yAxis: {
        min: 0,
                max: 100,
                title: {
                text: 'Score'
                }
        },
                credits: {
                enabled: false
                },
                series: [{

                data: finalData,
                        dataLabels: {
                        format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                '<span style="font-size:12px;color:silver">%</span></div>'
                        },
                }]

        }));
        });
    <?php
}
?>
</script>

<script type="text/javascript">
    jQuery('#learner_id').change(function () {
    learner_id = jQuery(this).val();
    jQuery.get('learner', {id: learner_id}, function (data) {

    var finalData = JSON.parse(data);
    var gaugeOptions = {

    chart: {
    type: 'solidgauge'
    },
            title: null,
            pane: {
            center: ['50%', '85%'],
                    size: '100%',
                    startAngle: - 90,
                    endAngle: 90,
                    background: {
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                            innerRadius: '60%',
                            outerRadius: '100%',
                            shape: 'arc'
                    }
            },
            tooltip: {
            enabled: false
            },
            // the value axis
            yAxis: {
            stops: [
            [0, '#EEE'],
            [1 / 59, '#FF0000'],
            [60 / 79, '#FFA126'],
            [80 / 100, '#008000'],
            ],
                    lineWidth: 0,
                    minorTickInterval: null,
                    tickAmount: 2,
                    title: {
                    y: - 125
                    },
                    labels: {
                    y: 16
                    }
            },
            plotOptions: {
            solidgauge: {
            dataLabels: {
            y: 5,
                    borderWidth: 0,
                    useHTML: true
            }
            }
            }
    };
// The speed gauge
    var chartSpeed = Highcharts.chart('container_three', Highcharts.merge(gaugeOptions, {
    yAxis: {
    min: 0,
            max: 100,
            title: {
            text: 'Score'
            }
    },
            credits: {
            enabled: false
            },
            series: [{

            data: finalData,
                    dataLabels: {
                    format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                            ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                            '<span style="font-size:12px;color:silver">%</span></div>'
                    },
            }]

    }));
    });
    });
</script>