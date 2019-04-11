<?php

use yii\widgets\Pjax;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LearnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Process Document Templates';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
        margin-bottom: 0;
    }
    .pagie {
        margin-top: 1rem;
    }
    .window-tile {
        background: #222D32;  /* fallback for old browsers */
        /*        background-image:
                    linear-gradient(60deg, #2F80ED, #56CCF2);
                    linear-gradient(60deg, #001635, #00AEFF);*/
        /*        background-image: linear-gradient(to right, #f9d423 0%, #ff4e50 100%);*/
        /*        background: -webkit-linear-gradient(to right, #ffd452, #544a7d);   Chrome 10-25, Safari 5.1-6 
                background: linear-gradient(to right, #ffd452, #544a7d);  W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        height: 10rem;
        color: white;
        border: 0.3rem solid white;
    }
    .course-name {
        font-weight: bolder;        
    }
    .temp {
        position: absolute;
        bottom: 0;
        right: 0.5rem;
    }
    .text-center > a {
        color: white;
    }

    #policy .card .card-content{
        overflow-y: hidden;
    }
    #policy .card .card-header, #policy .card .card-header1{
        background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        /*linear-gradient(135deg, #3183ee 0%, #55cbf2 100%);*/
    }
    .pagination{
        margin: 0;
    }
    .card {
        margin: 5px 0 35px 0;
    }
    #policy .card {
        background-image: linear-gradient(-20deg, #e9defa 0%, #fbfcdb 100%);
    }
    .card-header {
        width: 60px;
        text-align: center;
        border-radius: 50% !important;
        font-size: 20px;
        margin: -30px auto 0 !important;
    }
    .scrollbar {
        height: 100px;
    }
    .know-more {
        width: 110px;
        min-height: 0 !important;
        margin: -20px auto 0 !important;
        margin-bottom: -20px !important;
    }
    @media screen and (min-width: 992px) {
        #mypolicy .material-datatables .card .card-content {
            padding-bottom: 30% !important;
        }
    }
    .course-name {
        font-weight: 400;
    }
    .container-fluid {
        min-height: 0 !important;
    }
    .content:nth-of-type(3) {
        padding-top: 10px;
    }
    .btn {
        font-size: 15px;
        text-transform: capitalize;
    }
    button i {
        font-size: 60px !important;
        opacity: 0.5;
        padding-top: 3%;
        padding-bottom: 10%;

    }
    .tile-3 {
        padding-left: 5px
    }
    .tile-3 img {
        box-shadow: 0 14px 26px -12px rgba(153, 153, 153, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(153, 153, 153, 0.2);
    }
    .flex {
        display: flex;
    }
    .col-md-2 {
        padding: 0;
    }
    .modal-header{
        background: linear-gradient(60deg, #2F80ED, #56CCF2);
        text-align: center;
    }
    .mypolicy .container-fluid, .mypolicy .container-fluid {
        padding: 0px !important;
    }
    @media screen and (min-width:501px) and (max-width:767px){
    .col-lg-3{
           
    width: 50%;
    float: left;
    }
    }
    @media screen and (min-width:320px) and (max-width:500px){
    .col-lg-3{
           
    width: 80%;
    float: left;
    margin-left:20px
    }
    
    }
    .row{
        margin-top: 10px !important;
    }
    @media (max-width: 767px){
    
    .container-fluid{
    
    margin-top: 50px !important;
}
    }
</style>
<div class="content mypolicy" id="mypolicy">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">Process Document Templates</h4>
                    </div>
                    <div class="card-content">                        
                        <div class="material-datatables">                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12" id="policy">
                                    <div style="width: 100%;"> <br/>
                                        <?php Pjax::begin(); ?>
                                        <div class="row">
                                            <?php
                                            foreach ($array as $array) {
                                                ?>
                                                <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                                                    <div class="card">
                                                        <a href="<?= Yii::$app->request->baseUrl ?>/cso-templates/index?id=<?= $array->id ?>">
                                                            <div class="card-header" data-background-color="blue">
                                                                <span class="glyphicon glyphicon-book"></span>
                                                            </div>

                                                            <div class="card-content text-center scrollbar">
                                                                <h6 class="black-text course-name text-capitalize"><?= $array->template_name; ?></h6>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="row pagie">
                                        <div class="col-sm-5">
                                            <!-- For Pagination -->
                                        </div>
                                        <div class="col-sm-7">
                                            <?=
                                            LinkPager::widget([
                                                'pagination' => $pagination,
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                    <?php Pjax::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>