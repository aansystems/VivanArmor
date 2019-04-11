<?php

use yii\helpers\Inflector;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'Learning Index';
?>
<style>
    #learning_index {
        margin-top: -13rem;
    }
    h5 {
        margin: 0;
    }
    .slide {
        opacity: 1;
    }
    #myCarousel, .carousel-inner, .block-2, .carousel-inner img {
        height: 25rem !important;
    }
    .left.carousel-control {
        margin-bottom: 0;
    }

    /* Style the tab */
    .tab {
        float: left;
        width: 30%;
        height: 500px;
        overflow-y: auto;
        max-height: 500px;
        border-right: 1px solid white;
    }

    /* Style the buttons inside the tab */
    .tab button {
        display: block;
        background-color: inherit;
        color: white;
        padding: 22px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        /*background-color: #ddd;*/
        font-weight: bold;
        /*background: linear-gradient(60deg, #2F80ED, #56CCF2);*/
    }

    /* Create an active/current "tab button" class */


    /* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px;
        width: 100%;
        border-left: none;
        min-height: 30rem;
        font-weight: bold;
       
    }

    .list-group-item {
        border: none;
    }

    .stat-tile {
        color: white;
    }
    .stat-tile span {
        font-weight: bolder;
    }
    ::-webkit-scrollbar {
        width: 0px;  /* remove scrollbar space */
        background: transparent;  /* optional: just make scrollbar invisible */
    }
    /* optional: show position indicator in red */
    ::-webkit-scrollbar-thumb {
        background: #FF0000;
    }
    @media (max-width: 991px){
        .tab{
            height: 600px;
            max-height: 60px;
        }
    }
    @media (max-width: 400px){
        .row {
            margin-right: -15px !important;
        }
        .col-lg-7, .col-md-7, .col-sm-6{
            margin-left: -14px !important;
        }
    }
    @media (max-width: 767px){
        .col-lg-7, .col-md-7, .col-sm-6{
            padding-left: 0px;
        }
        .container-fluid{

            margin-top: 40px !important;
        }
    }

    .card-header-primary {
        /*        background-image: linear-gradient(-225deg, #AC32E4 0%, #7918F2 48%, #4801FF 100%) !important;*/
        background-image: linear-gradient(180deg, #8baaaa 0%, #ae8b9c 100%) !important;
        margin: -10px -25px -10px 10px !important;
    }

    .learning-index-card {
        box-shadow: 0 1px 4px 0 rgba(7, 7, 7, 0.27);
    }

    .learning-index-card h6 {
        font-weight: 600;
    }

    .tab-pane h1 {
        margin-top: 30%;
        font-weight: 700;
    }

    tspan {
        font-family: 'Josefin Sans' !important;
        font-weight: 500;
    }

    .learning-index-card{
        height: auto !important;   

    }
    
    .learn-index-card{
       height: 430px !important;  
    }

    .card-header-primary{
        height: 450px !important;
    }
    
    li a.active {
    background-color: #a5b9ba !important;
}

</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">Learning Index</h4>
                    </div>

                    <div class="card-content">
                        <!-- learnig-graph-->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <div class="card learn-index-card">
                                    <div class="card-content"><br/>
                                        <h6 class="text-center text-uppercase">Percentage of Learners</h6>
                                        <div id="learning_index"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-content">
                                        <div id="timeline"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 0.2rem;">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <!-- Tabs with icons on Card -->
                                <div class="card card-nav-tabs learning-index-card">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="card-header card-header-primary">
                                                 <div class="nav-tabs-navigation">
                                                <div class="nav-tabs-wrapper">
                                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                                        <li class="nav-item ">
                                             
                                <?php if (empty($branches)) { ?>
                                    <a class="tablinks" onclick="openCity(event, 'NA')" <?= 'id="defaultOpen"' ?>>No Branches Available</a>
                                    <?php
                                } else {
                                    foreach ($branches as $index => $branch) {
                                        ?>
                                        <a class="tablinks" onclick="openCity(event, '<?= Inflector::underscore($branch->branch_name) ?>')" <?= (!$index) ? 'id="defaultOpen"' : '' ?>><?= $branch->branch_name ?></a>
                                        <?php
                                    }
                                }
                                ?>
                                                        </li>
                                                             </ul>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- End Tabs with icons on Card -->

                                        <div class="col-md-10">
                                            <div class="card-body">
                                                <?php
                                                $sum_avg = 0.0;
                                                $count = 0;
                          
                                                foreach ($branches as $index1 => $branch1) {
                                                   
                                                    $per_course_completed = array_column($stats_array[$branch1->id], 'percentOfCourseCompleted');
                                                    $per_score_average = array_column($stats_array[$branch1->id], 'total_percent_course');
                                                    $average_course_completed = count($per_course_completed) ? (array_sum($per_course_completed) / count($per_course_completed)) : 0;
                                                    $average_score = count($per_score_average) ? number_format(array_sum($per_score_average) / count($per_score_average), 2) : 0;
                                                    $sum_avg = $sum_avg + $average_course_completed;
                                                    $count++;
                                                    
                                                    ?>

                                                    <div class=" text-center">
                                                          <div id="<?= Inflector::underscore($branch1->branch_name) ?>" class="tabcontent">
                                                            
                                                         <div class="col-md-4">   <h1><?= count($stats_array[$branch1->id]) ?></h1><span>No. of learners</span></div>
                                                          <div class="col-md-4">  <h1><?= number_format(count($stats_array[$branch1->id]) ? $average_score : 0,1) ?></h1><span>Average Score</span></div>
                                                           <div class="col-md-4"> <h1><?= number_format($average_course_completed,1) ?></h1><span>Percentage Completed</span></div>
                                                         <div class="col-md-4">   <h1>0</h1><span>High Score</span></div>
                                                         <div class="col-md-4">   <h1>0</h1><span>Low Score</span></div>

                                                      
</div>
                                                    </div>

                                                <?php }
                                                ?>
                                            </div>
                                        </div>


                                        <?php if (empty($branches)) {
                                            ?>

                                            <div class="col-md-9">
                                                <div class="card-body">
                                                    <div class="tab-content text-center">
                                                       <div class=" col-md-12 tab-pane active" class="tabcontent">
                                                         <div class="col-md-4"><h1>0</h1><span>No. of learners</span> </div>
                                                        <div class=" col-md-4"> <h1>0</h1><span>Average Score</span> </div>
                                                       <div class=" col-md-4">  <h1>0</h1><span>Percentage Completed</span> </div>
                                                        <div class=" col-md-4"> <h1>0</h1><span>High Score</span> </div>
                                                        <div class=" col-md-4">  <h1>0</h1><span>Low Score</span> </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

// Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    /*----- Cyber Progress -----*/
    $(function () {
        var gaugeOptions = {
            chart: {
                type: 'solidgauge',
                title: {text: null},
                backgroundColor: 'transparent'
            },
            title: {text: null},
            pane: {
                center: ['50%', '85%'],
                //size: '80%',
                startAngle: -90,
                endAngle: 90,
                background: {
                    //backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'rgba(255, 255, 255, 0.0)',
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
                    [0.2, '#DF5353'], // red
                    [0.5, '#DDDF0D'], // yellow
                    [0.95, '#55BF3B'] // green
                ],
                lineWidth: 0,
                minorTickInterval: null,
                tickAmount: 5,
                //                title: {
                //                    y: -70
                //                },
                labels: {
                    y: 15
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
        // The Learning index
        var learning_index = Highcharts.chart('learning_index', Highcharts.merge(gaugeOptions, {
            yAxis: {
                min: 0,
                max: 100,
                title: {text: null}
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Learning Index',
                    data: [<?= number_format($sum_avg / ($count ? $count : 1), 2) ?>],
                    dataLabels: {
                        format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                                ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                '<span style="font-size:12px;color:silver">%</span></div>'
                    },
                    tooltip: {
                        valueSuffix: ' %'
                    }
                }]
        }));

        //Timeline graph
        Highcharts.chart('timeline', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Timeline'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Percentage (%)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                    name: 'Learning Index',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, <?= number_format($sum_avg / ($count ? $count : 1), 2) ?>]
                }
            ]
        });
    });
</script>