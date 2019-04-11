<?php

use frontend\models\MasterDocTemplates;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .template-header {
        margin: 25px 5px 20px -40px !important;
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
        margin: 34px auto;
        font-weight: 400;
        margin-left: -40% !important;
    }

    .card {
        margin: 55px 0 0 0;
    }

    .card img {
        width: 60px !important;
        height: auto;
    }

    .templates-block button {
        background: transparent;
        border: 0;
    }
    @media (min-width: 1201px) and (max-width: 1300px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 34px auto;
            font-weight: 400;
            font-size:12px;
            margin-left: -40% !important;
        }
    }
    @media (min-width: 1101px) and (max-width: 1200px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 37px auto;
            font-weight: 400;
            font-size:11px;
            margin-left: -60% !important;
        }
        .template-header{
            padding: 1px 6px !important;
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .card .card-content {
            padding: 5px 15px;
        }
    }
    @media (min-width: 901px) and (max-width: 1100px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 37px auto;
            font-weight: 400;
            font-size:13px;
            margin-left: -30% !important;
        }
        .template-header{
            padding: 1px 6px !important;
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .card .card-content {
            padding: 5px 15px;
        }
        .col-md-3 {
    width: 33%;
}
    }
@media (min-width: 841px) and (max-width: 900px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 37px auto;
            font-weight: 400;
            font-size:11px;
            margin-left: -30% !important;
        }
        .template-header{
            padding: 1px 6px !important;
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .card .card-content {
            padding: 5px 15px;
        }
        .col-md-3 {
    width: 33%;
}
    }
    @media (min-width: 768px) and (max-width: 840px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 37px auto;
            font-weight: 400;
            font-size:13px;
            margin-left: -30% !important;
        }
        .template-header{
            padding: 1px 6px !important;
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .card .card-content {
            padding: 5px 15px;
        }
        .col-md-3 {
    width: 45%;
    margin-left: 4%;
}
    }
    @media (min-width: 701px) and (max-width: 767px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 37px auto;
            font-weight: 400;
            font-size:11px;
            margin-left: -30% !important;
        }
        .template-header{
            padding: 1px 6px !important;
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .card .card-content {
            padding: 5px 15px;
        }
        .col-md-3 {
    width: 33%;
}
    }
    @media (min-width: 601px) and (max-width: 700px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 37px auto;
            font-weight: 400;
            font-size:13px;
            margin-left: -30% !important;
        }
        .template-header{
            padding: 1px 6px !important;
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .card .card-content {
            padding: 5px 15px;
        }
        .col-md-3 {
    width: 45%;
    margin-left: 4%;
}
    }
    @media (min-width: 501px) and (max-width: 600px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 37px auto;
            font-weight: 400;
            font-size:11px;
            margin-left: -30% !important;
        }
        .template-header{
            padding: 1px 6px !important;
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .card .card-content {
            padding: 5px 8px;
        }
        .col-md-3 {
    width: 45%;
    margin-left: 4%;
}
    }
    @media (min-width: 415px) and (max-width: 501px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 37px auto;
            font-weight: 400;
            font-size:10px;
            margin-left: -30% !important;
        }
        .template-header{
            padding: 1px 6px !important;
        }
        .card img {
            width: 40px !important;
            height: auto;
        }
        .card .card-content {
            padding: 5px 3px;
        }
        .col-md-3 {
    width: 48%;
    margin-left: 2%;
}
    }
    @media (min-width: 320px) and (max-width: 414px) {
        .templates-block .col-md-8 .card-content h6 {
            margin: 37px auto;
            font-weight: 400;
            font-size:13px;
            margin-left: -15% !important;
        }
        .template-header{
            padding: 5px 6px !important;
        }
        .card img {
            width: 40px !important;
            height: auto;
        }
        .card .card-content {
            padding: 5px 3px;
        }
        .col-md-3 {
    width: 80%;
    margin-left: 11%;
}
.col-xs-4 {
    width: 27.333333%;
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
                    <h4 class="card-title text-uppercase">Finalized Documents</h4>
                </div>
                <div class="card-content"> 
                    <div class="row">
                        <?php if (!empty($data)) { ?>
                            <?php
                            foreach ($data as $value) {
                                $doc_type = MasterDocTemplates::find()->select(['template_name', 'image_name'])->where(['id' => $value['document_type']])->One();
                                ?>
                                <div class="col-md-3 col-sm-3 col-xs-3 templates-block">
                                    <div class="card">
                                        <div class="row">
                                            <button value="<?= Yii::$app->request->baseUrl ?>/documents/authenticate?id=<?= $value['document_type'] ?>" id='passwordModal<?= $value['document_type'] ?>'>
                                                <div class="col-md-4 col-sm-3 col-xs-4">
                                                    <div class="card-header1 card-header-text template-header" data-background-color="blue">
                                                        <center><h4 class="card-title text-uppercase"><img src="<?= Yii::$app->request->baseUrl ?>/images/my-templates/<?= $doc_type['image_name'] ?>"></h4></center>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <div class="card-content">                        
                                                        <h6 class="black-text course-name text-capitalize"><?= strtoupper($doc_type['template_name']) . "S" ?></h6>
                                                    </div>
                                                </div>
                                            </button>
                                            <?php
                                            Modal::begin([
                                                'id' => 'modal',
                                                'header' => '<h4 class="pull-left text-capitalize" style="text-transform: uppercase;"</h4>',
                                                'clientOptions' => ['backdrop' => 'static', 'keyboard' => false],
                                                'size' => 'modal-lg'
                                            ]);
                                            echo "<div id='modalContent'></div>";
                                            Modal::end();
                                            ?>
                                            <script>
                                                $(function () {
                                                    $("#passwordModal<?= $value['document_type'] ?>").click(function () {
                                                        $('#modal').modal('show')
                                                                .find('#modalContent')
                                                                .load($(this).attr('value'));
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>                                             
                            <?php } ?>                                    
                        <?php } else { ?>                   
                            <p style="vertical-align: middle; margin:2px; font-size:16px; text-align:center" colspan="5" class="text-center">No Records Found</p>                                                                                     
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>