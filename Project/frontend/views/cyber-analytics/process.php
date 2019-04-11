<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'Process Index';
?>
<style>
    .index-card-header {
        width: 20%;
    }

    .green-card {
        border-left: 3px solid #0ba360;
    }

    .green-header {
        background-image: linear-gradient(to top, #0ba360 0%, #3cba92 100%) !important;
    }

    .red-card {
        border-left: 3px solid #e52d27;
    }

    .red-header {
        background: #e52d27 !important;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #b31217, #e52d27) !important;  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #b31217, #e52d27) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .blue-card {
        border-left: 3px solid #4A00E0;
    }

    .blue-header {
        background: #8E2DE2 !important;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #4A00E0, #8E2DE2) !important;  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #4A00E0, #8E2DE2) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .orange-card {
        border-left: 3px solid #f12711;
    }

    .orange-header {
        background: #f12711 !important;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #f5af19, #f12711) !important;  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #f5af19, #f12711) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .card-footer h6, .graph-card h6 {
        font-weight: 500;
        color: #000000 !important;
        font-size: 10px;
    }

    .graph-card {
        box-shadow: 0 1px 4px 0 rgba(7, 7, 7, 0.27);
    }

    .graph-card h6 {
        margin-top: 19.6%;
    }

    #learning_index .highcharts-container {
        height: 300px !important;
    }
    
    .card-block {
        min-height: 110px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">Process Index</h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card graph-card">
                                    <div class="card-content">
                                        <h6 class="text-center text-uppercase">Analysis of Process Documents</h6>
                                        <div id="learning_index"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card graph-card">
                                    <div class="card-content">
                                        <div id="timeline"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    foreach ($array1 as $array) {
                        $option = (!empty($array['policy_status'])) ? $array['policy_status']->policy_option_id : 5;
                        ?>
                        <div class="col-md-3">
                            <div class="card <?php
                                switch ($option) {
                                    case 1: echo 'green-card';
                                        break;
                                    case 2: echo 'red-card';
                                        break;
                                    case 3: echo 'blue-card';
                                        break;
                                    case 4: echo 'orange-card';
                                        break;
                                    default: echo 'not-started';
                                }?>">
                                <div class="card-header1 index-card-header 
                                      text-center <?php
                                switch ($option) {
                                    case 1: echo 'green-header';
                                        break;
                                    case 2: echo 'red-header';
                                        break;
                                    case 3: echo 'blue-header';
                                        break;
                                    case 4: echo 'orange-header';
                                        break;
                                    default: echo 'not-started';
                                }
                                ?>" data-background-color="blue">
                                    <i class="fa fa-file-text fa-2x" aria-hidden="true"></i>
                                </div>
                                <div class="card-block"><br/>
                                    <ul>
                                        <li>    <?php
                                            if (!empty($array['policy_option'])) {
                                                echo $array['policy_option']->policy_option;
                                            } else {
                                                echo 'Action required';
                                            }
                                            ?></li>
                                        <li> <?= (!empty($array['policy_status'])) ? $array['policy_status']->created_at : 'NA' ?></li>
                                        <li> <?= (!empty($array['policy_status'])) ? $array['policy_status']->getCreatedBy()->select(["CONCAT(first_name, ' ', last_name) AS full_name"])->scalar() : 'NA' ?> </li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <h6 class="text-center"> <?= $array['data']->template_name ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /*----- Cyber Progress -----*/
    $(document).ready(function () {
        $('#process').DataTable();
    });
    $(function () {
        var gaugeOptions = {
            chart: {
                type: 'solidgauge',
                title: null,
                backgroundColor: 'transparent'
            },
            title: null,
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
                title: null
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Process Index',
                    data: [<?= $percentage ?>],
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
                    name: 'Process Index',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, <?= $percentage ?>]
                }
            ]
        });
    });
</script>