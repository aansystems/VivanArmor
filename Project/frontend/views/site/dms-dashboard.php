<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
    .hb-custom, .hb-custom:after, .hb-custom:before {
        border-radius: 5%;
        font-weight: 100;
    }

    .hexagon-1 span, .hexagon-1 span:after, .hexagon-1 span:before{
        background-color: #5B1647 !important;
        border-left: 1px solid #5B1647!important; 
        border-right: 1px solid #5B1647!important; 
    }

    .hexagon-2 span, .hexagon-2 span:after, .hexagon-2 span:before{
        background-color: #93073E !important;
        border-left: 1px solid #93073E !important; 
        border-right: 1px solid #93073E !important; 
    }

    .hexagon-3 span, .hexagon-3 span:after, .hexagon-3 span:before{
        background-color: #C90035 !important;
        border-left: 1px solid #C90035 !important; 
        border-right: 1px solid #C90035 !important; 
    }

    .hexagon-4 span, .hexagon-4 span:after, .hexagon-4 span:before{
        background-color: #FF5627 !important;
        border-left: 1px solid #FF5627 !important; 
        border-right: 1px solid #FF5627 !important; 
    }

    .hexagon-5 span, .hexagon-5 span:after, .hexagon-5 span:before{
        background-color: #FFC400 !important;
        border-left: 1px solid #FFC400 !important; 
        border-right: 1px solid #FFC400 !important; 
    }
    
    .col-md-2 {
        padding: 0;
    }


    a {
        margin: 0 !important;
    }

    .tile-name {
        font-size: 15px;
        font-weight: 500;
    }

    .card {
        margin-bottom: 10px;
    }

    .content {
        padding-top: 30px;
    }
    
    img {
        padding: 0 7%;
    }
    @media (max-width: 1120px){
        .col-md-2 {
            width: 30.666667% !important;
            float: left;
        }
    }
    @media (max-width: 450px){
        .col-md-2 {
            width: 48.666667% !important;
            float: left !important;
        }
        .tile-name{
                font-size: 12px;
        }
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">Dashboard</h4>
                    </div>
                    <div class="card-content">
                        <div class="row text-center">
                            <div class="col-md-1"></div>

                            <div class="col-md-2 hexagon-1">
                                <a href="#">
                                    <span class="hb hb-md hb-custom"><p class="text-center">28</p></span>
                                </a>
                                <p class="text-center tile-name">Total Documents</p>
                            </div>
                            <div class="col-md-2 hexagon-2">
                                <a href="#">
                                    <span class="hb hb-md hb-custom"><p class="text-center">14</p></span>
                                </a>
                                <p class="text-center tile-name">My Pending Reviews</p>
                            </div>
                            <div class="col-md-2 hexagon-3">
                                <a href="#">
                                    <span class="hb hb-md hb-custom"><p class="text-center">7</p></span>
                                </a> 
                                <p class="text-center tile-name"> Pending Reviews by Others</p>
                            </div>
                            <div class="col-md-2 hexagon-4">
                                <a href="#">
                                    <span class="hb hb-md hb-custom"><p class="text-center">5</p></span>
                                </a>
                                <p class="text-center tile-name"> Approved Documents</p>
                            </div>
                            <div class="col-md-2 hexagon-5">
                                <a href="#">
                                    <span class="hb hb-md hb-custom"><p class="text-center">2</p></span>
                                </a>
                                <p class="text-center tile-name"> Rejected Documents</p>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">ANALYTICS</h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= Yii::$app->request->baseUrl ?>/images/charts/chart-1.png" alt="document-types">
                            </div>
                            <div class="col-md-6">
                                <img src="<?= Yii::$app->request->baseUrl ?>/images/charts/chart-2.png" alt="documents-summary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


