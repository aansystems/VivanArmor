<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->registerCssFile("@web/css/progressbar.css");
$this->title = 'Resiliency Dashboard';
?>
<style>
    #container_one {
        margin: -16rem 0 -5rem 0;
    }
    .btn-adjust {
        padding: 3% 2% 1% 2%;
        width: 11rem;
        margin: 0 auto 0;
        background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        vertical-align: text-top;
    }
    .fa-angle-double-right {
        vertical-align: text-top;
    }
    h5 {
        margin: 0;
    }
    .card {
        margin: 1.6rem 0;
    }
    .slide {
        opacity: 1;
    }
    #myCarousel, .carousel-inner, .block-2, .carousel-inner img {
        height: 32rem !important;
    }
    .left.carousel-control {
        margin-bottom: 0;
    }
    @media (min-width: 120rem) {
        #container_one {
            margin: -16rem 0 -5rem 0;
        }
    }
    @media (min-width: 140rem) {
        #container_one {
            margin: -15rem 0 -5rem 0;
        }
    }

    svg.total {
        margin: -8rem auto;
    }
    svg.radial-progress-i {
        margin: -3rem auto;
    }
    .green {
        stroke: #1ABC9C;
    }
    .blue {
        stroke: #049DFF;
    }
    .yellow {
        stroke: #FDBA04;
    }
    .percentage.green, .percentage-symbol.green {
        fill: #1ABC9C;
        stroke: none;
    }
    .percentage.blue, .percentage-symbol.blue {
        fill: #049DFF;
        stroke: none;
    }
    .percentage.yellow, .percentage-symbol.yellow {
        fill: #FDBA04;
        stroke: none;
    }
    .percentage {
        font-size: xx-small;
    }
    .percentage-symbol {
        font-size: 0.5rem;
    }

    svg.radial-progress {
        height: auto;
        transform: rotate(-90deg);
        width: 100%;
    }
    svg.radial-progress circle {
        fill: rgba(0,0,0,0);
        stroke: #9E9E9E;
        stroke-width: 5%;
    }
    svg.radial-progress circle.incomplete { opacity: 1; stroke-width: 1%; fill: #7B7B7B; }
    svg.radial-progress circle.complete {
        -webkit-animation: progress 1.5s linear;
        animation: progress 1.5s linear;
        stroke: #ED687C;
    }
    svg.radial-progress text {
        fill: #fff;
        text-anchor: middle;
        font-weight: bolder;
    }

    svg.radial-progress-i {
        height: auto;
        transform: rotate(-90deg);
        width: 100%;
    }
    svg.radial-progress-i circle {
        fill: rgba(0,0,0,0);
        stroke-width: 10%;
    }
    svg.radial-progress-i circle.incomplete { opacity: 1; stroke-width: 1%; stroke: #9E9E9E; }
    svg.radial-progress-i circle.complete.progress-1 {
        -webkit-animation: progress-1 1.5s linear;
        animation: progress-1 1.5s linear;
    }
    svg.radial-progress-i circle.complete.progress-2 {
        -webkit-animation: progress-2 1.5s linear;
        animation: progress-2 1.5s linear;
    }
    svg.radial-progress-i circle.complete.progress-3 {
        -webkit-animation: progress-3 1.5s linear;
        animation: progress-3 1.5s linear;
    }
    svg.radial-progress-i text {
        fill: #000;
        text-anchor: middle;
        font-weight: bolder;
    }

    @keyframes progress {
        from {
            stroke-dashoffset: <?= number_format(($learn_percentage + $process_percentage + $tech_percentage) / 3, 2) * 176 / 100 ?>;
        }
        to {
            stroke-dashoffset: 0;
        }
    }
    @keyframes progress-1 {
        from {
            stroke-dashoffset: <?= ($learn_percentage * 157) / 100 ?>;
        }
        to {
            stroke-dashoffset: 0;
        }
    }
    @keyframes progress-2 {
        from {
            stroke-dashoffset: <?= ($process_percentage * 157) / 100 ?>;
        }
        to {
            stroke-dashoffset: 0;
        }
    }
    @keyframes progress-3 {
        from {
            stroke-dashoffset: <?= ($tech_percentage * 157) / 100 ?>;
        }
        to {
            stroke-dashoffset: 0;
        }
    }
    @media (max-width: 767px){
        svg.radial-progress {
            width: 110% !important;
            min-height: 40rem;
        }
        svg.radial-progress-i {
            width: 70% !important;
        }
    }
    @media (max-width: 767px){
        .no-padding{
            margin-bottom: 35px;
        }
        .container-fluid{
    
    margin-top: 40px !important;
}
    }
    .row{
        margin-top: 0px !important;
    }
    @media (max-width: 1120px){
        .fa-angle-double-right{
            margin-top: -2px !important;
        }
    }

    ::-webkit-scrollbar {
        width: 0px;  /* remove scrollbar space */
        background: transparent;  /* optional: just make scrollbar invisible */
    }
    /* optional: show position indicator in red */
    ::-webkit-scrollbar-thumb {
        background: #FF0000;
    }

    @media (max-width: 1200px) {
        .col-md-2-point-5 {
            width: 33%;
        }
    }
    @media (min-width: 1200px) {
        .col-md-2-point-5 {
            width: 21%;
        }
    }

    .col-md-2-point-5 .card {
        background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
    }

    .col-md-2-point-5 .card-content h6 {
        font-weight: 500;
        min-height: 4rem;
    }

    .col-md-2-point-5 .card-content {
        padding-bottom: 0;
        padding-top: 5px;
    }

    #resiliency_index {
        border-top: 1px solid #EEE;
    }
    .small-header {
        width: 50px;
        background-image: linear-gradient(to right, #ed6ea0 0%, #ec8c69 100%) !important;
    }
    .btn-sm {
        background-image: linear-gradient(to right, #ed6ea0 0%, #ec8c69 100%) !important;
        padding: 3% !important;
        display: table;
        line-height: 2.5;
    }
    .fa-circle.color-red {
        color: #ff6666; /* fallback for old browsers */
        background: none;
        border: none;
    }

    .fa-circle.color-green {
        color: #38EF7D; /* fallback for old browsers */
        background: none;
        border: none;
    }

    .fa-circle.color-blue {
        color: #66CCFF; /* fallback for old browsers */
        background: none;
        border: none;
    }

    .fa-circle.color-orange {
        color: #FF9800; /* fallback for old browsers */
        background: none;
        border: none;
    }

    .fa-circle.color-grey {
        /*color: #9bc5c3;   fallback for old browsers */
        color: #222D32;
        background: none;
        border: none;
    }

    .chg {
        font-size:17px;
        margin-top: -7px !important;
    }

    @media (max-width: 450px){
        .col-md-2-point-5 {
            width: 100.333333% !important;
            margin-top: 10% !important;
            margin-left: -5% !important;
        }
    }
    @media (min-width: 451px) and (max-width: 767px){
        .know-more {
            width: 140px;
        }
        .col-md-2-point-5 {
            width: 70.333333% !important;
            margin-top: 10% !important;
            margin-left: 10% !important;
        }
        h6 {
            font-size:130%
        }
    }
    
    .card{
        margin: 25px 0  !important; 
    }
    
    .main-header .navbar{
      height:30px !important;  
    }
        
</style>
<script>
    function context_learn(e) {
        e.preventDefault();
        $('#learning_results').modal('show');
    }
    function context_process(e) {
        e.preventDefault();
        $('#process_results').modal('show');
    }
    function context_tech(e) {
        e.preventDefault();
        $('#tech_results').modal('show');
    }
</script>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 no-padding">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header1 card-header-text" data-background-color="blue">
                            <h4 class="card-title text-uppercase">Resiliency Dashboard</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <center>
                                    <div class="col-lg-4 col-md-12 col-sm-12 no-padding">
                                        <svg class="radial-progress total" data-percentage="60" viewBox="0 0 80 80">
                                        <circle class="incomplete" cx="40" cy="38" r="18"></circle>
                                        <circle class="complete" cx="40" cy="38" r="18" style="stroke-dasharray: <?= number_format(($learn_percentage + $process_percentage + $tech_percentage) / 3, 2) * 176 / 100 ?>,176;"></circle>
                                        <text class="percentage" x="45%" y="54%" transform="matrix(0, 1, -1, 0, 80, 0)"><?= number_format(($learn_percentage + $process_percentage + $tech_percentage) / 3, 2) ?><text class="percentage-symbol">%</text></text>
                                        <text class="percentage-symbol" x="64%" y="54%" transform="matrix(0, 1, -1, 0, 80, 0)">%</text>
                                        </svg>
                                    </div>
                                    <div class="col-md-2-point-5 col-sm-12">
                                        <div class="card">
                                            <div class="card-header1 small-header card-header-text" data-background-color="blue">
                                                <h5 class="card-title text-uppercase"><i class="fa fa-thumb-tack" aria-hidden="true"></i></h5>
                                            </div>
                                            <div class="card-content">
                                                <h6 class="text-uppercase"> Learning Index</h6>
                                                <svg class="radial-progress-i" data-percentage="60" viewBox="0 0 80 80">
                                                <circle class="incomplete" cx="40" cy="38" r="25"></circle>
                                                <circle class="complete green progress-1" cx="40" cy="38" r="25" style="stroke-dasharray: <?= number_format(($learn_percentage * 157) / 100, 2) ?>,176;"></circle>
                                                <text class="percentage green" x="45%" y="54%" transform="matrix(0, 1, -1, 0, 80, 0)"><?= number_format($learn_percentage, 2) ?><text class="percentage-symbol">%</text></text>
                                                <text class="percentage-symbol green" x="64%" y="54%" transform="matrix(0, 1, -1, 0, 80, 0)">%</text>
                                                </svg>
                                                <a class="btn btn-sm" href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/learn" oncontextmenu="context_learn(event);">KNOW MORE  <span class="fa fa-angle-double-right chg"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2-point-5 col-sm-12">
                                        <div class="card">
                                            <div class="card-header1 small-header card-header-text" data-background-color="blue">
                                                <h5 class="card-title text-uppercase"><i class="fa fa-thumb-tack" aria-hidden="true"></i></h5>
                                            </div>
                                            <div class="card-content">
                                                <h6 class="text-uppercase"> Process Index</h6>
                                                <svg class="radial-progress-i" data-percentage="60" viewBox="0 0 80 80">
                                                <circle class="incomplete" cx="40" cy="38" r="25"></circle>
                                                <circle class="complete blue progress-2" cx="40" cy="38" r="25" style="stroke-dasharray: <?= number_format(($process_percentage * 157) / 100, 2) ?>,176;"></circle>
                                                <text class="percentage blue" x="45%" y="54%" transform="matrix(0, 1, -1, 0, 80, 0)"><?= number_format($process_percentage, 2) ?><text class="percentage-symbol">%</text></text>
                                                <text class="percentage-symbol blue" x="64%" y="54%" transform="matrix(0, 1, -1, 0, 80, 0)">%</text>
                                                </svg>
                                                <a class="btn btn-sm" href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/process" oncontextmenu="context_process(event);">KNOW MORE <span class="fa fa-angle-double-right chg"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2-point-5 col-sm-12">
                                        <div class="card">
                                            <div class="card-header1 small-header card-header-text" data-background-color="blue">
                                                <h5 class="card-title text-uppercase"><i class="fa fa-thumb-tack" aria-hidden="true"></i></h5>
                                            </div>
                                            <div class="card-content">
                                                <h6 class="text-uppercase"> Technical Index</h6>
                                                <svg class="radial-progress-i" data-percentage="60" viewBox="0 0 80 80">
                                                <circle class="incomplete" cx="40" cy="38" r="25"></circle>
                                                <circle class="complete yellow progress-3" cx="40" cy="38" r="25" style="stroke-dasharray: <?= number_format(($tech_percentage * 157) / 100, 2) ?>,176;"></circle>
                                                <text class="percentage yellow" x="45%" y="54%" transform="matrix(0, 1, -1, 0, 80, 0)"><?= number_format($tech_percentage, 2) ?><text class="percentage-symbol">%</text></text>
                                                <text class="percentage-symbol yellow" x="64%" y="54%" transform="matrix(0, 1, -1, 0, 80, 0)">%</text>
                                                </svg>
                                                <a class="btn btn-sm" href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/tech" oncontextmenu="context_tech(event);">KNOW MORE <span class="fa fa-angle-double-right chg"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </center>
                            </div>
                            <div id="resiliency_index" class="col-lg-12 col-md-12 col-sm-12 no-padding">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Learning Index Modal -->
        <div class="modal fade" id="learning_results" tabindex="-1" role="dialog" aria-labelledby="weekly" aria-hidden="true" style="margin-top: -85px;">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <center>
                            <h3 class="modal-title">
                                Learning Statistics
                            </h3>
                            <button type="button" class="close dismiss" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times-circle-o"  style="font-size:34px;color:#333;"  aria-hidden="true"></i>
                            </button>
                        </center>
                    </div>
                    <div class="modal-body">
                        <!--<h2>List Group With Badges</h2>-->
                        <ol class="list-group">
                            <li class="list-group-item">1. No. of learners <span class="badge">12</span></li>
                            <li class="list-group-item">2. Average Score <span class="badge">5</span></li>
                            <li class="list-group-item">3. Percentage Completed <span class="badge">70%</span></li>
                            <li class="list-group-item">4. High Score <span class="badge">10</span></li>
                            <li class="list-group-item">5. Low Score <span class="badge">8</span></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Process Index Modal -->
        <div class="modal fade" id="process_results" tabindex="-1" role="dialog" aria-labelledby="weekly" aria-hidden="true" style="margin-top: -85px;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <center>
                            <h3 class="modal-title">
                                Process Statistics
                            </h3>
                            <button type="button" class="close dismiss" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times-circle-o"  style="font-size:34px;color:#333;"  aria-hidden="true"></i>
                            </button>
                        </center>
                    </div>
                    <div class="modal-body">
                        <table id="process"
                               class="table table-striped table-no-bordered table-hover dataTable dtr-inline">
                            <thead>
                                <tr class="text-rose">
                                    <th style="width: 50%">Document</th>
                                    <th>Status</th>
                                    <th style="width: 7%">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($process_data as $array) {
                                    ?>
                                    <tr>
                                        <td><?= $array['data']->template_name ?></td>
                                        <td>
                                            <?php
                                            if (!empty($array['policy_option'])) {
                                                echo $array['policy_option']->policy_option;
                                            } else {
                                                echo 'NA';
                                            }
                                            ?>
                                        </td>
                                        <td><i
                                                class="fa fa-circle <?php
                                                if (!empty($array['policy_option'])) {
                                                    switch ($array['policy_option']->id) {
                                                        case 1:
                                                            echo 'color-green';
                                                            break;
                                                        case 2:
                                                            echo 'color-red';
                                                            break;
                                                        case 3:
                                                            echo 'color-blue';
                                                            break;
                                                        case 4:
                                                            echo 'color-orange';
                                                        default:
                                                            echo 'color-grey';
                                                    }
                                                } else {
                                                    echo 'color-grey';
                                                }
                                                ?>"
                                                aria-hidden="true"></i></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //Timeline graph
    Highcharts.chart('resiliency_index', {
        chart: {
            height: 340,
            type: 'line'
        },
        title: {
            text: null
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
                name: 'Resiliency Index',
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, <?= number_format(($learn_percentage + $process_percentage + $tech_percentage) / 3, 2) ?>]
            }
        ]
    });
</script>