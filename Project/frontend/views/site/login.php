<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign in - VIVAAN LMS';
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
        padding-left: 5%;
    }

    .black-block, .white-block {
        border-radius: 4px;
    }

    .video-block h5 {
        color: #FFFFFF;
        font-weight: 300;
        margin-top: 10%;
        margin-bottom: 10%;
    }

    .video-block p {
        color: #FFFFFF;
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

    .heading, .agree-label label {
        color: #F55321 !important;
    }

    .form-group {
        margin: 0 !important;
        padding-bottom: 0px !important;
    }

    .form-control-feedback {
        opacity: 1;
        color: #999999;
    }

    .input-group-addon {
        text-align: left !important;
    }

    .form-group .help-block {
        text-align: center !important;
    }

    ul li:first-child {
        border-right: 1px solid #999999;
        padding-right: 10px;
    }

    ul li a:hover {
        color: #000000; 
        font-weight: 500;
    }
    .form-group.login-btn{
        padding-bottom: 10px !important;
    }
        
    .col-md-4{
        width: 33.333333%;
    }
    .form-group label{
        font-size: 13px !important;
    }
    .video-block img{
        margin-top: -3px;
    }
    .btn{
        padding: 10px 17px;
        margin: 1px 1px;
    }
    form#login-form .password a{
        font-size: 12px;
    }
    h4, .h4 {
        font-size: 1.0em;
    }
    @media (min-width: 992px) and (max-width: 1200px){
        .logos-block div img{
            width: 120px !important; 
        }
    }
    @media (min-width: 851px) and (max-width: 991px){
        .logos-block div img{
            width: 100px !important; 
        }
        .logos-block div:first-child img {
            padding-top: 5px;
        }
        form#login-form {
            margin: 5% 5%;
        }
        .white-block {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            height: 460px;
            margin-top: -3%;
        }
    }
    @media (min-width: 768px) and (max-width: 850px){
        .logos-block div img{
            width: 90px !important; 
        }
        .logos-block div:first-child img {
            padding-top: 5px;
        }
        form#login-form {
            margin: 5% 5%;
        }
        .white-block {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            height: 500px !important;
            margin-top: -3%;
        }
        .black-block {
            background: rgba(0,0,0,0.6);
            height: 380px !important;
            margin: 8%;
            padding-left: 0;
        }
    }
    @media (min-width: 996px) and (max-width: 1232px){
        h5{
            font-size: 1.0em;
        }
        .form-group label {
            font-size: 12px !important;
        }
    }
    @media (min-width: 768px) and (max-width: 995px){
        h5{
            font-size: 0.8em;
        }
        .form-group label {
            font-size: 12px !important;
        }
    }
    @media (min-width: 1001px) and (max-width: 1200px){
        .video-block h5 {
            color: #FFFFFF;
            font-weight: 300;
            margin-top: 20%;
            margin-bottom: 10%;
        }
    }
    @media (min-width: 851px) and (max-width: 1000px){
        .video-block h5 {
            color: #FFFFFF;
            font-weight: 300;
            margin-top: 25%;
            margin-bottom: 10%;
        }
        .black-block {
            background: rgba(0,0,0,0.6);
            height: 380px;
            margin: 8%;
            padding-left: 0;
        }
        .white-block {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            height: 450px !important;
            margin-top: -5%;
        }
    }
    @media (min-width: 768px) and (max-width: 850px){
        .video-block h5 {
            color: #FFFFFF;
            font-weight: 300;
            margin-top: 30%;
            margin-bottom: 10%;
        }
        .black-block {
            background: rgba(0,0,0,0.6);
            height: 380px;
            margin: 8%;
            padding-left: 0;
        }
        .white-block {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            height: 435px !important;
            margin-top: -3%;
        }
        h5 {
    font-size: 0.7em !important;
}
    }
    @media (max-width: 767px){
        .logos-block{
            display: flex;
            padding: 1%;
        }
        .container-fluid {
            background-image: url(../images/login-background.png);
            height: auto;
            min-height: 100vh !important;
            background-size: cover;
            background-repeat: no-repeat;
            /* position: fixed; */
        }
        .white-block {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            height: 480px;
            margin-top: -10%;
        }
        .logos-block div{
            margin-top: 4px;
        }
        .black-block{
            margin-top: 15% !important;
            height: 100% !important;
        }
    }
    @media (min-width: 600px) and (max-width: 700px){
        .container-fluid {
            background-image: url(../images/login-background.png);
            height: auto;
            min-height: 160vh !important;
            background-size: cover;
            background-repeat: no-repeat;
            /* position: fixed; */
        }
        .black-block{
            margin-top: 15% !important;
        }
    }
    @media (min-width: 531px) and (max-width: 601px){
        .container-fluid {
            background-image: url(../images/login-background.png);
            height: auto;
            min-height: 150vh !important;
            background-size: cover;
            background-repeat: no-repeat;
            /* position: fixed; */
        }
        .black-block{
            margin-top: 15% !important;
        }
        .heading{
            font-size: 11px;
        }
    }
    @media (min-width: 430px) and (max-width: 530px){
        h5{
            font-size: 1.0em;
        }
        .container-fluid {
            background-image: url(../images/login-background.png);
            height: auto;
            min-height: 130vh !important;
            background-size: cover;
            background-repeat: no-repeat;
            /* position: fixed; */
        }
        .black-block{
            margin-top: 15% !important;
        }
        .heading{
            font-size: 11px;
        }
    }
    @media (min-width: 341px) and (max-width: 429px){
        h5{
            font-size: 0.8em;
        }
        .container-fluid {
            background-image: url(../images/login-background.png);
            height: auto;
            min-height: 120vh !important;
            background-size: cover;
            background-repeat: no-repeat;
            /* position: fixed; */
        }
        .black-block{
            margin-top: 15% !important;
        }
        .heading{
            font-size: 11px;
        }
    }
    @media (min-width: 320px) and (max-width: 340px){
        h5{
            font-size: 0.7em;
        }
        .container-fluid {
            background-image: url(../images/login-background.png);
            height: auto;
            min-height: 140vh !important;
            background-size: cover;
            background-repeat: no-repeat;
            /* position: fixed; */
        }
        .row{
            margin-right: -2% !important;
        }
        .heading{
            font-size: 10px;
        }
    }
    @media (min-width: 320px) and (max-width: 530px){
        ul, ol, li {
            margin-left: 0px !important;
        }
    }
    @media (min-width: 551px) and (max-width: 700px){
        .logos-block div img{
            width: 120px !important; 
        }
        .white-block {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            height: 470px;
            margin-top: -10%;
        }
    }
    @media (min-width: 481px) and (max-width: 550px){
        .logos-block div img{
            width: 100px !important; 
        }
        .white-block {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            height: 460px;
            margin-top: -10%;
        }
        .logos-block div:first-child img {
            padding-top: 5px;
        }
    }
    @media (min-width: 401px) and (max-width: 480px){
        .logos-block div img{
            width: 80px !important; 
        }
        .white-block {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            height: 420px;
            margin-top: -10%;
        }
        .logos-block div:first-child img {
            padding-top: 8px;
        }
        .logos-block div:nth-of-type(2) img {
            padding-top: 12px;
        }
        .input-group .input-group-addon{
            padding: 6px 0px 0px;
        }
        .form-group label {
            font-size: 11px !important;
        }
        .btn {
            padding: 6px 17px;
            margin: 0px 0px; 
        }
        .list-inline{
            font-size: 10px;
        }
        .black-block {
            background: rgba(0,0,0,0.6);
            height: 380px;
            margin: 8%;
            padding-left: 0;
        }
    }
    @media (min-width: 320px) and (max-width: 400px){
        .logos-block div img{
            width: 75px !important; 
        }
        .white-block {
            background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);
            height: 420px;
            margin-top: -10%;
        }
        .logos-block div:first-child img {
            padding-top: 6px;
        }
        .logos-block div:nth-of-type(2) img {
            padding-top: 10px;
        }
        .input-group .input-group-addon{
            padding: 6px 0px 0px;
        }
        .form-group label {
            font-size: 10px !important;
        }
        .btn {
            padding: 6px 17px;
            margin: 0px 0px; 
        }
        .list-inline{
            font-size: 10px;
        }
        .black-block {
            background: rgba(0,0,0,0.6);
            height: 380px;
            margin: 3%;
        }
        .col-md-10 {
            width: 95.333333%;
        }
        form#login-form {
            margin: 5% 3% !important;
        }
    }
    @media (min-height: 680px) and (max-height: 720px){
        .black-block {
            background: rgba(0,0,0,0.6);
            height: 490px;
            margin: 8% !important;
            padding-left: 0;
        }
        .form-group{
            margin: 10px !important;
        }
        .white-block{
            height: 575px !important;
            margin-top: -4% !important;
        }

    }
    @media (min-height: 721px) and (max-height: 750px){
        .black-block {
            background: rgba(0,0,0,0.6);
            height: 490px;
            margin: 8%;
            padding-left: 0;
        }
        .form-group{
            margin: 10px !important;
        }
        .white-block{
            height: 575px !important;
            margin-top: -10% !important;
        }

    }
    @media (min-height: 751px) and (max-height: 785px){
        .black-block {
            background: rgba(0,0,0,0.6);
            height: 490px;
            margin: 8%;
            padding-left: 0;
        }
        .form-group{
            margin: 10px !important;
        }
        .white-block{
            height: 575px !important;
            margin-top: -10% !important;
        }

    }
    @media (min-height: 786px){
        .black-block {
            background: rgba(0,0,0,0.6);
            height: 490px;
            margin: 7%;
            padding-left: 0;
        }
        .form-group{
            margin: 10px !important;
        }
        .white-block{
            height: 575px !important;
            margin-top: -10% !important;
        }

    }
    @media (min-width: 1100px) and (max-width: 1200px){
        .black-block{
            margin-top: 10% !important;
        }
    }
    @media (min-width: 1001px) and (max-width: 1999px){
        .black-block{
            margin-top: 10% !important;
        }
    }
     @media (min-width: 992px) and (max-width: 1000px){
        .black-block{
            margin-top: 14% !important;
        }
    }
    @media (min-width: 768px) and (max-width: 991px){
        .black-block{
            margin-top: 15% !important;
        }
    }
    @media (min-width: 1401px){
        .white-block{
            height: 540px !important;
            margin-top: -2% !important;
        }
    }
    @media screen and (max-width: 995px) , screen and (max-height: 700px) {
        
    }
    @media (min-width:1025px) and (max-width:2000px){
        body{
            position: fixed !important;           
        }
    }
    .text-right {
    text-align: center;
}
    
</style>

<div class="container-fluid login-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 black-block">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-md-offset-1 col-sm-offset-1 white-block" style="margin-left: 3%;">
                    <div class="login-details">
                        <div class="row logos-block text-center">
                            <div class="col-md-4 col-sm-4">
                                <img src="<?= Yii::$app->request->baseUrl ?>/images/vivaan-lms-logo.png" width="140">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <img src="<?= Yii::$app->request->baseUrl ?>/images/vivaan-engage-logo.png" width="140">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <img src="<?= Yii::$app->request->baseUrl ?>/images/vivaan-armor-logo.png" width="160">
                            </div>
                        </div>
                        <div class="heading text-center">
                            <h4><b>SIGN IN</b></h4>
                        </div>
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <div class="input-group">  
                            <span class="input-group-addon">
                                <?php
                                $field_options_1 = [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'inputTemplate' => "{input}<i class='fa fa-envelope form-control-feedback' aria-hidden='true'></i>"
                                ];
                                ?>

                                <?= $form->field($model, 'email', $field_options_1)->textInput()->label('EMAIL') ?>
                            </span>
                        </div>
                        <div class="input-group">  
                            <span class="input-group-addon">
                                <?php
                                $field_options_2 = [
                                    'options' => ['class' => 'form-group has-feedback'],
                                    'inputTemplate' => "{input}<i class='fa fa-key form-control-feedback' aria-hidden='true'></i>"
                                ];
                                ?>
                                <?= $form->field($model, 'password', $field_options_2)->passwordInput()->label('PASSWORD') ?>
                            </span>
                        </div>
                        <div class="form-group agree-label">
                            <?= Html::checkbox('agree', false, ['label' => 'I agree to the Privacy Statement and Terms & Conditions']); ?>
                        </div>                        
                                <div class="form-group login-btn">
                            <?= Html::submitButton('LOGIN', ['class' => 'btn', 'name' => 'login-button']) ?>
                        </div>
                        <div class="password text-right">
                            <?= Html::a('Forgot Password?', ['site/request-password-reset']) ?>
                        </div>               
                        <ul class="mb-0 list-inline text-center mt-4">
                            <li class="text-muted"><a target="_blank" href='http://vivaanarmor.com/privacy-policy.html'>Privacy Policy</a></li>
                            <li class="text-muted"><a target="_blank" href='http://vivaanarmor.com/terms-and-conditions.html'>Terms & Conditions</a></li>
                        </ul>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5 video-block">
                    <h5 class="text-center"><strong>VIVAAN-ARMOR</strong> YOUR TRAINING, DATA AND SECURITY MANAGEMENT PLATFORM</h5>
                    <center>
                        <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/297074614?color=ff9933&title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
                    </center><br/>
                    <div class="text-right">
                        <p><strong>&copy;<img src="<?= Yii::$app->request->baseUrl ?>/images/aan.png" width="55"> All rights reserved.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$script = <<< JS
        $(document).ready(function () {
           $("form input:text, form textarea").first().focus();
            });
JS;
$this->registerJs($script);
?>