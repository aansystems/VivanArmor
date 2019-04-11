<?php

use yii\widgets\Pjax;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LearnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    #courses .card .card-content{
        overflow-y: hidden;
    }

    #courses .card .card-header, #courses .card .card-header1{
        background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .pagination{
        margin: 0;
    }

    .card {
        margin: 15px 0 0 0;
    }

    #courses .card {
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
        #mycourse .material-datatables .card .card-content {
            padding-bottom: 30% !important;
        }
        .courses-div {
            margin-top: -5%;
        }
        .col-md-4 {
            margin-top: 6%;
        }
    }

    .course-name {
        font-weight: 400;
    }

    .container-fluid {
        min-height: 0 !important;
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

    .modal-content .modal-body {
        padding-top: 5px;
        padding-right: 5px;
        padding-bottom: 5px;
        padding-left: 5px;
        min-height: auto; 
    }
    .card .card-header1{
        padding: 1px 10px;
    }
    .card .card-content{
        padding: 11px 20px;
    }
    .mycourse{
        padding-top: 10px;
    }
    .col-md-4{
        margin-top: 4%;
    }
    .courses-div{
        margin-top: -4%;
    }
    @media (max-width: 767px){
        .col-xs-3 {
            width: 50%;
        }
        .col-md-4 {
            margin-top: 7%;
        }
        .courses-div{
            margin-top: -5%;
        }
        .col-xs-7{
            margin-left: 36%;
        }
    }
    @media (max-width: 551px) and (min-width: 401px){
        .col-xs-3 {
            width: 85%;
        }
        .col-md-4 {
            margin-top: 15%;
            margin-left: 9%;
        }
        .courses-div{
            margin-top: -10%;
        }
        .pagination{
            margin-left: -41% !important;
        }
        .col-xs-7{
            margin-left: 50%;
            margin-top: 5%;
        }
    }
    @media (max-width: 400px) and (min-width: 320px){
        .col-xs-3 {
            width: 100%;
        }
        .col-md-4 {
            margin-top: 15%;
            margin-left: 0% !important;
        }
        .courses-div{
            margin-top: -10%;
        }
        h6{
            font-size: 0.9em;
        }
        .col-xs-7{
            margin-left: 60%;
            margin-top: 5%;
        }
        .pagination{
            margin-left: -95% !important;
        }
        ul, ol, li {
            margin-left: 0px !important;
        }
    }
    @media (max-width: 350px) and (min-width: 320px){
         .col-xs-7{
            margin-left: 53%;
        }
    }
    @media (max-width: 450px) and (min-width: 400px){
         .col-xs-7{
            margin-left: 42%;
        }
    }
</style>


<?= $this->render('//site/fly-box.php') ?> 
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">Learning Manager</h4>
                    </div>
                    <div class="card-content"> 
                        <div class="row">
                            <div class="col-md-12 tile-3">
                                <div id="slide">
                                    <div>
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/learner-manager/slide-1.png" width="300px"/>
                                    </div>

                                    <div>
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/learner-manager/slide-2.png" width="300px"/>
                                    </div>

                                    <div>
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/learner-manager/slide-3.png" width="300px"/>
                                    </div>
                                    <div>
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/learner-manager/slide-4.png" width="300px"/>
                                    </div>
                                    <div>
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/learner-manager/slide-5.png" width="300px"/>
                                    </div>
                                    <div>
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/learner-manager/slide-6.png" width="300px"/>
                                    </div>
                                    <div>
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/learner-manager/slide-7.png" width="300px"/>
                                    </div>
                                    <div>
                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/learner-manager/slide-8.png" width="300px"/>
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

<div class="content mycourse" id="mycourse">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">My Courses</h4>
                    </div>
                    <div class="card-content card-margin" >                        
                        <div class="material-datatables">                            
                            <div class="row">
                                <div class="col-md-12" id="courses">
                                    <div class="courses-div" style="width: 100%;"> <br/>
                                        <?php Pjax::begin(); ?>
                                        <div class="row">
                                            <!-- Loop to fetch all the courses which are assigned to the Learner -->
                                            <?php
                                            foreach ($array as $array) {
                                                ?>
                                                <div class="col-sm-6 col-md-4 col-lg-3 col-xs-3">
                                                    <div class="card">
                                                        <a href="<?= Yii::$app->request->baseUrl ?>/learner-activity/lessons?id=<?= $array->id ?>">
                                                            <div class="card-header" data-background-color="blue">
                                                                <span class="glyphicon glyphicon-book"></span>
                                                            </div>

                                                            <div class="card-content text-center scrollbar">
                                                                <h6 class="black-text course-name text-capitalize"><?php echo $array->course_name; ?></h6>
                                                            </div>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#myModal<?= $array['id'] ?>">
                                                            <div class="card-header1 know-more text-center" id="<?= $array['id'] ?>" data-background-color="blue" style="padding: 3% 3% 1% 3%!important; font-size: 12px !important;">
                                                                KNOW MORE  <i class="fa fa-angle-double-right" aria-hidden="true" style="font-size:12px !important"></i>

                                                            </div>
                                                        </a>

                                                    </div>
                                                </div>

                                                <div class="modal fade" id="myModal<?= $array['id'] ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" style="color:white"><?php echo $array['course_name'] ?> </h3>
                                                            </div>

                                                            <div class="modal-body">
                                                                <h4><b><?php echo $array['course_description'] ?></b></h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="#"  data-dismiss="modal">
                                                                    <button type="button" class="btn btn-danger">Close</button>
                                                                </a>
                                                                <a href="<?= Yii::$app->request->baseUrl ?>/learner-activity/lessons?id=<?= $array->id ?>">
                                                                    <button type="button" class="btn btn-success" >Go to Lesson</button>
                                                                </a>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   



                                            <?php } ?>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <!-- For Pagination -->
                                        </div>
                                        <div class="col-sm-7 col-xs-7">
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