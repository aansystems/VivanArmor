<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LearnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'My Templates';

$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .template-header {
        margin: 20px 5px 20px -35px !important;
        background-image: linear-gradient(-20deg, #1bbba1 0%, #8ddad5 100%) !important;
        border-radius: 10px !important;
    }
    .templates-block .col-md-4 {
        padding-right: 0;
    }
    .templates-block .card {
        background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
        box-shadow: 0 1px 4px 0 rgba(7, 7, 7, 0.27)
    }
    .templates-block .col-md-8 .card-content h6 {
        margin: 25px auto;
        font-weight: 400;
        margin-left: -20%;
    }
    .card {
        margin: 55px 0 0 0;
    }
    .card img {
        width: 60px !important;
        height: auto;
    }
    @media (min-width: 1201px) and (max-width:1350px) {
        .templates-block .col-md-8 .card-content h6{
            margin-left: -27% !important;
            font-size: 12px !important;
            margin: 32px auto;

        }
        .sidebar-mini.sidebar-collapse .main-sidebar .templates-block .col-md-8 .card-content h6{
            margin-left: -25% !important;
            font-size: 12px !important;
            margin: 32px auto;
        }
    }
    @media (min-width: 1100px) and (max-width:1200px) {
        .templates-block .col-md-8 .card-content h6{
            margin-left: -45% !important;
            font-size: 11px !important;
            margin: 32px auto;

        }
        .sidebar-mini.sidebar-collapse .main-sidebar .templates-block .col-md-8 .card-content h6{
            margin-left: -40% !important;
            font-size: 11px !important;
            margin: 32px auto;
        }
        .template-header{
            padding: 1px 6px !important;
        }
    }
    @media (min-width: 992px) and (max-width:1101px) {
        .templates-block .col-md-8 .card-content h6{
            margin-left: -30% !important;
            font-size: 12px !important;
            margin: 32px auto;

        }
        .col-md-3 {
            width: 33%;
        }
    }
    @media (min-width: 841px) and (max-width:991px) {
        .templates-block .col-sm-8 .card-content h6{
            margin-left: -30% !important;
            font-size: 11px !important;
            margin: 32px auto;

        }
        .col-md-3 {
            width: 33%;
        }
        .template-header{
/*            margin: 20px -11px 20px -37px !important;*/
    margin: 23px -4px 20px -32px !important;
        }
        .card img {
            width: 50px !important;
        }
    }
    @media (min-width: 768px) and (max-width:840px) {
        .templates-block .col-sm-8 .card-content h6{
            margin-left: 0% !important;
            font-size: 12px !important;
            margin: 32px auto;

        }
        .col-md-3 {
            width: 45%;
            margin-left: 20px;
        }
        .template-header{
            margin: 20px -11px 20px -37px !important;
        }
    }
    @media (min-width: 700px) and (max-width:767px) {
        .templates-block .col-xs-8 .card-content h6{
            margin-left: -50% !important;
            font-size: 11px !important;
            margin: 32px auto;

        }
        .col-md-3 {
            width: 33%;
        }
        .card img {
            width: 47px !important;
        }
        .container-fluid{
            margin-top: 20px;
        }
    }
    @media (min-width: 600px) and (max-width:699px) {
        .templates-block .col-xs-8 .card-content h6{
            margin-left: -20% !important;
            font-size: 12px !important;
            margin: 32px auto;

        }
        .col-md-3 {
            width: 45%;
            margin-left: 20px;

        }
        .card img {
            width: 50px !important;
        }
        .template-header {
            margin: 20px 5px 20px -30px !important;
        }
        .container-fluid{
            margin-top: 20px;
        }
    }
    @media (min-width: 500px) and (max-width:599px) {
        .templates-block .col-xs-8 .card-content h6{
            margin-left: -35% !important;
            font-size: 11px !important;
            margin: 32px auto;

        }
        .col-md-3 {
            width: 50%; 
        }
        .card img {
            width: 50px !important;
        }
        .template-header {
            margin: 26px -3px 20px -30px !important;
        }.container-fluid{
            margin-top: 20px;
        }
        
    }   
    @media (min-width: 400px) and (max-width:499px) {
        .templates-block .col-xs-8 .card-content h6{
            margin-left: -5% !important;
            font-size: 10px !important;
            margin: 32px auto;

        }
        .col-md-3 {
            width: 50%;
            margin-left: -1px;

        }
        .card img {
            width: 40px !important;
        }
        .template-header {
            margin: 26px -3px 20px -30px !important;
        }
        .card .card-content {
            padding: 15px 6px !important;
        }.container-fluid{
            margin-top: 20px;
        }        
    }   
    @media (min-width: 400px) and (max-width:459px) {
        .templates-block .col-xs-8 .card-content h6{
            margin-left: -10% !important;
            font-size: 8px !important;
            margin: 32px auto;

        }
        .col-md-3 {
            width: 50%;
            margin-left: -5px;

        }
        .card img {
            width: 40px !important;
        }
        .template-header {
            margin: 26px -3px 20px -30px !important;
        }
        .card .card-content {
            padding: 15px 6px !important;
        }
        .container-fluid{
            margin-top: 20px;
        }
    } 
    @media (min-width: 320px) and (max-width:399px) {
        .templates-block .col-xs-8 .card-content h6{
            margin-left: -10% !important;
            font-size: 14px !important;
            margin: 32px auto;

        }
        .col-md-3 {
            width: 99%;
        }
        .template-header {
            margin: 26px -3px 20px -30px !important;
        }
        .container-fluid{
            margin-top: 20px;
        }

    }   
.col-md-3{
        margin-top: -3%;
    }
   
</style>

<div class="container-fluid">
    <div class="row">
        <div class=" col-md-12">
            <div class="card">
                <div class="card-header1 card-header-text" data-background-color="blue">
                    <h4 class="card-title text-uppercase">My Templates</h4>
                </div>
                <div class="card-content"> 
                    <div class="row">
                        <?php
                        foreach ($array as $array1) {
                            ?>
                            <div class="col-md-3 col-sm-3 col-xs-3 templates-block">
                                <div class="card">
                                    <div class="row">
                                        <a href="<?= Yii::$app->request->baseUrl ?>/templates/index?id=<?= $array1->id ?>">
                                            <div class="col-md-4 col-sm-3 col-xs-4">
                                                <div class="card-header1 card-header-text template-header" data-background-color="blue">
                                                    <center> <h4 class="card-title text-uppercase"><img src="<?= Yii::$app->request->baseUrl ?>/images/my-templates/<?= $array1['image_name'] ?>"></h4></center>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-8">
                                                <div class="card-content">                        
                                                    <h6 class="black-text course-name text-capitalize"><?= strtoupper($array1->template_name) . "S" ?></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



