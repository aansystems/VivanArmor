<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'RESET PASSWORD';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .container-fluid {
        background-image: url('../images/login-background.png'); 
        height: auto; 
        min-height: 100vh !important;
        background-size: cover;
        background-repeat: no-repeat;
        margin-bottom: 0px !important;
        width: auto;
    }
    .black-block {
        background: rgba(0,0,0,0.6);
        height: 420px;
        margin: 8%;
        padding-left: 0;
    }
    .white-block {
        background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
        height: 480px; 
        margin-top: -3%; 
    }
    .video-block {
        padding-right: 0;
        padding-left: 3%;
        width: 45%;
        margin-top: 7%;
    }
    .logos-block {
        margin-top: 4%;
        margin-bottom: 5%;
        padding: 0%;
    }
    .logos-block div {
        border-right: 1px solid #999;
        padding: 0;
    }

    .logos-block div:last-child {
        border: none !important;
    }

    .logos-block div:first-child img {
        padding-top: 3px;
    }

    .logos-block div:nth-of-type(2) img {
        padding-top: 10px;
    }
    .logos-block div:nth-of-type(3) img {
        padding-top: 15px;
    }
    .input-group .input-group-addon {
        padding: 30px 40px;
    }
    h4 {
        margin-top: 50px;
        margin-bottom: 40px;
    }
    .heading, .agree-label label {
        color: #F55321 !important;
    }
    .form-group {
        margin: 0 !important;
        padding-bottom: 0px !important;
    }
    .wrapper {
        background-color: #fff !important;
    }
    .fa{
        padding-top: 10px;
        padding-left: 10px;
    }
    .form-group .form-control {
        float: left;
    }
    .form-group .help-block{
        float: left !important;
    }
    b {
        font-weight: 600;
    }
    h2 {
        font-size: 1.3em;
    }
    .btn.btn-success{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px !important;
    }
    .heading{
        margin-top: 7%;
        margin-bottom: 5%;
    }
    .text-right {
        text-align: center;
    }
    .video-block p {
        color: #FFFFFF;
    }
    p {
        margin: 0 0 10px;
    }
    strong {
        font-weight: 700;
    }
    @media (min-width: 1031px) and (max-width: 1200px){
        .logos-block div img{
            width: 120px !important; 
        }
        .logos-block div:first-child img {
            padding-top: 5px;
        }
        .black-block{
            margin-top: 10%;
        }
        .video-block {
            margin-top: 10%;
        }
    }
    @media (min-width: 951px) and (max-width: 1030px){
        .logos-block div img{
            width: 110px !important; 
        }
        .logos-block div:first-child img {
            padding-top: 5px;
        }
        .black-block{
            margin-top: 10%;
        }
        .white-block{
            margin-top: -4%;
        }
        .video-block {
            margin-top: 13%;
        }
        .heading{
            margin-top: 10%;
            margin-bottom: 7%;
        }
    }
    @media (min-width: 851px) and (max-width: 950px){
        .logos-block div img{
            width: 130px !important; 
        }
        .logos-block div:first-child img {
            padding-top: 5px;
        }
        .col-sm-6 {
            width: 55%;
        }
        .black-block{
            margin: 2%;
            margin-top: 12%;
        }
        .video-block {
            margin-top: 13%;
            width: 41%;
        }
        .heading{
            margin-top: 10%;
            margin-bottom: 5%;
        }
    }
    @media (min-width: 768px) and (max-width: 850px){
        .logos-block div img{
            width: 115px !important; 
        }
        .logos-block div:first-child img {
            padding-top: 3px;
        }
        .logos-block div:nth-of-type(2) img {
            padding-top: 9px;
        }
        .col-sm-6 {
            width: 55%;           
        }
        .black-block{
            margin: 2%;
            margin-top: 12%;
        }
        .video-block {
            margin-top: 15%;
            width: 41%;
        }
        .heading{
            margin-top: 10%;
            margin-bottom: 7%;
        }
    }
    @media (min-width: 651px) and (max-width: 767px){
        .white-block .logos-block div{
            float: left !important;
        }
        .logos-block div img{
            width: 130px !important; 
        }
        .black-block{
            height: 100% !important;
            margin-top: 12%;
            margin-bottom: 10%;
        }
        .direction{
            flex-direction: column-reverse;
            display: flex;
        }
        .col-md-4 {
            width: 33.33333333%;
        }
        .white-block{
            height: 420px;
        }
        .input-group .input-group-addon {
            padding: 18px 40px;
        }
        .col-sm-6 {
            width: 90%;
            margin-left: 6% !important;
        }
        .video-block {
            padding-right: 0;
            padding-left: 10%;
            width: 92%;
            margin-top: 7%;
        }
    }
    @media (min-width: 551px) and (max-width: 650px){
        .white-block .logos-block div{
            float: left !important;
        }
        .logos-block div img{
            width: 110px !important; 
        }
        .black-block{
            height: 100% !important;
            margin-top: 13%;
            margin-bottom: 10%;
        }
        .direction{
            flex-direction: column-reverse;
            display: flex;
        }
        .col-md-4 {
            width: 33.33333333%;
        }
        .white-block{
            height: 400px;
        }
        .input-group .input-group-addon {
            padding: 15px 40px;
        }
        .col-sm-6 {
            width: 90%;
            margin-left: 6% !important;
        }
        .logos-block div:first-child img {
            padding-top: 4px;
        }
        .logos-block div:nth-of-type(2) img {
            padding-top: 9px;
        }
        .video-block {
            padding-left: 10%;
            width: 92%;
            margin-top: 7%;
        }
    }
    @media (min-width: 501px) and (max-width: 550px){
        .logos-block div{
            float: left !important;
        }
        .logos-block div img{
            width: 100px !important; 
        }
        .black-block{
            height: 100% !important;
            margin-top: 15%;
            margin-bottom: 10%;
        }
        .logos-block div:first-child img {
            padding-top: 4px;
        }
        .logos-block div:nth-of-type(2) img {
            padding-top: 9px;
        }
        .direction{
            flex-direction: column-reverse;
            display: flex;
        }
        .col-md-4 {
            width: 33.33333333%;
        }
        .white-block{
            height: 380px;
        }
        .input-group .input-group-addon {
            padding: 15px 40px;
        }
        .logos-block div:nth-of-type(3) img {
            padding-top: 14px;
        }
        .video-block {
            padding-left: 10%;
            width: 92%;
            margin-top: 7%;
        }
    }
    @media (min-width: 401px) and (max-width: 500px){
        .logos-block div{
            float: left !important;
        }
        .logos-block div img{
            width: 90px !important; 
        }
        .black-block{
            height: 100% !important;
            margin: 3%;
            margin-top: 25%;
            margin-bottom: 10%;
        }
        .logos-block div:first-child img {
            padding-top: 4px;
        }
        .logos-block div:nth-of-type(2) img {
            padding-top: 9px;
        }
        .direction{
            flex-direction: column-reverse;
            display: flex;
        }
        .col-md-4 {
            width: 33.33333333%;
        }
        .white-block{
            height: 370px;
            margin-left: 4% !important;
            margin-top: -8%;
        }
        .input-group .input-group-addon {
            padding: 15px 40px;
        }
        .logos-block div:nth-of-type(3) img {
            padding-top: 14px;
        }
        .input-group{
            margin-left: -10%;
        }
        .video-block {
            padding-right: 0;
            padding-left: 10%;
            width: 92%;
            margin-top: 7%;
        }  
    }
    @media (min-width: 320px) and (max-width: 400px){
        .logos-block div{
            float: left !important;
        }
        .logos-block div img{
            width: 80px !important; 
        }
        .logos-block{
            margin-left: -4% !important;
            margin-right: -4% !important;
        }
        .black-block{
            height: 100% !important;
            margin: 0%;
            margin-top: 30%;
            margin-bottom: 10%;
        }
        .logos-block div:first-child img {
            padding-top: 7px;
        }
        .logos-block div:nth-of-type(2) img {
            padding-top: 11px;
        }
        .direction{
            flex-direction: column-reverse;
            display: flex;
        }
        .col-md-4 {
            width: 33.33333333%;
        }
        .white-block{
            height: 360px;
            margin-left: 4% !important;
            margin-top: -8%;
        }
        .input-group .input-group-addon {
            padding: 15px 10px;
        }     
        .input-group .form-control{
            width: 93%;
        }
        h2 {
            font-size: 1.0em;
        }
        .video-block {
            padding-right: 0;
            padding-left: 10%;
            width: 92%;
            margin-top: 7%;
        } 
    }
    @media (min-height: 801px) and (max-height: 900px){
        .black-block{
            margin-top: 15% !important;
            height: 452px !important;
        }
        .white-block{
            height: 525px !important;
        }
        .video-block{
            margin-top: 5%;
        }
    }
    @media (min-height: 701px) and (max-height: 800px){
        .black-block{
            margin-top: 14% !important;
            height: 452px !important;
        }
        .white-block{
            height: 525px !important;
        }
        .video-block{
            margin-top: 5%;
        }
    }
</style>

<div class="container-fluid login-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 black-block">
            <div class="row direction">
                <div class="col-md-5 col-sm-5 video-block">                  
                    <center>
                        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/297074614?color=ff9933&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
                    </center></br>
                    <div class="text-right">
                        <p><strong>&copy;<img src="<?= Yii::$app->request->baseUrl ?>/images/aan.png" width="55"> All rights reserved.</strong></p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 white-block" style="margin-left: 3%;">
                    <div class="row logos-block text-center">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/vivaan-lms-logo.png" width="140">
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/vivaan-engage-logo.png" width="140" >
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/vivaan-armor-logo.png" width="160">
                        </div>
                    </div>
                    <div class="heading text-center">
                        <h2><b><?= Html::encode($this->title) ?></b></h2>
                    </div>
                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                    <div class="input-group">  
                        <span class="input-group-addon">
                            <?=
                            $form->field($model, 'password', [
                                'inputTemplate' => '
					{input}
					<span class="icon">
						<i class="fa fa-key"></i>
					</span>
				']
                            )->passwordInput(['maxength' => true]
                            )->passwordInput(['css' => 'form-control']
                            )->label('New Password', ['class' => 'control-label'])
                            ?>
                        </span>
                    </div>
                    <div class="input-group">  
                        <span class="input-group-addon">
                            <?=
                            $form->field($model, 'confirm_password', [
                                'inputTemplate' => '
					{input}
					<span class="icon">
						<i class="fa fa-key"></i>
					</span>
				']
                            )->passwordInput(['maxength' => true]
                            )->passwordInput(['css' => 'form-control']
                            )->label('Confirm Password', ['class' => 'control-label'])
                            ?>
                        </span>
                    </div>
                    <div class="form-group login-btn">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div> 
        </div>
    </div>
</div>