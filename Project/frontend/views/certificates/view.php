<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Certificates */

$this->params['breadcrumbs'][] = ['label' => 'Certificates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

    h1,h2,h3,h4,p{
        padding: 0px;
        line-height: 1em;
    }
    .content{
        margin: 4% 0% 0% 0%;
        overflow-x: scroll;
    }
    .card .card-content{
        padding: 0px !important;
    }
    .back_g{
        background-image: url("../images/1.png");
        background-repeat: no-repeat;
        background-size: cover;
        height: -webkit-fill-available;
        height:-moz-available; 
        height: fill-available;
        height: 600px;
    }
    .card-content{

        background-image: url("../images/3.png");
        background-repeat: no-repeat;
        background-size: cover;
        height: -webkit-fill-available;
        height:-moz-available; 
        height: fill-available;
        height: 600px;
    }
    .card_text{
        background-image: url("../images/2.png");
        background-repeat: no-repeat;
        background-size: cover;
        height: -webkit-fill-available;
        height:-moz-available; 
        height: fill-available;
        height: 600px;
    }
    .top_logo{
        background-image: url("../images/5.png");
        background-repeat: no-repeat;
        background-size: cover;
        height: -webkit-fill-available;
        height:-moz-available; 
        height: fill-available;
    }
    body{
        -ms-overflow-style:none;
    }

    ::-webkit-scrollbar {
        width: 0px;
    }
    .btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, 
    .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, 
    .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover{
        padding: 12px 1px 7px 1px !important;
        width: 105px !important; 
        background: #f44336;  
    }
    .btn.btn-success{
        padding: 12px 1px 7px 1px !important;
        width: 105px !important;
    }

</style>
<div style="float:right;">

</div>

<div class="container-fluid" style="width:879px;height:600px;">
    <div class="back_g">
        <div class="card-content">

            <div class="card_text">
                <div class="top_logo">
                    <br>
                    <div><br><p class='bodytext'><center style="margin-top:11%;"><h4><b>This certificate has been awarded to</b><h4> </p></div>
                                    <div><center><h2><?= $user_name->first_name; ?></h2></div>
                                    <div><p class='bodytext'><center><h3> For successfully completing the course </h3></p></div>
                                    <div><br><p class='bodytext'><center><h2  style='color:#660033;'><?= $model->certificate_name; ?></h2> </p></div>
                                    <div><center><h2><p class='normalred' style='color:#FF0000; margin-bottom:10px;'>Award Date:<?= $model->issue_date; ?></p></h2></div>
                                    <div style='float:left;'><br><br></div>

                                    <div style='float:left;text-align:center;position:relative;left:80%;'><b><br_____________<br>Councilor</b></div>

                                                <div style='margin-left: 10%'><b><br_____________> Training Manager  </b></div>
                                                </div></div></div></div></div>

<div class="form-group text-center">
                                                <?php if ($model->status == 1) { ?>
                                                    <?= Html::a(Yii::t('app', 'download'), ['sample-pdf', 'id' => $model->id, 'user_name' => $user_name->first_name], ['class' => 'btn btn-success']) ?>                                     

                                                <?php } ?>
                                                <?= Html::a('Back', ['/certificates/index'], ['class' => 'btn btn-primary']) ?>
</div>
