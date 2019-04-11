<?php

use yii\helpers\Html;
use frontend\models\LoginQuestions;
$this->title = 'Secured Login';

/* @var $this yii\web\View */
/* @var $model frontend\models\LoginAnswer */
/* @var $form yii\widgets\ActiveForm */

$questions = LoginQuestions::findOne(['id' => $model])->question;
?>
<style>
    body {
        width: 100%;
    }

    .login-block {
        background:url(../images/login-background.png);  no-repeat center center;
        background-size: cover;
        min-height: 500px;
        padding: 0;
    }

    .container {
        background:#fff; 
        border-radius: 10px; 
        box-shadow:15px 20px 0px rgba(0,0,0,0.1);
        width: 30%;
        border-top: 3px solid #4e77e7;
    }

    .login-sec {
        padding: 20px 30px;
        position:relative;
    }

    .login-sec h2 {
        color: #F55321;
    }

    .btn-login {
        background:#1a2980; 
        color:#fff;
        font-weight:600;
    }

    .displaybutton {
        display: none;
    }

/*    .login-block {
        height: 100vh;
    }*/
    .vertical-center {
        min-height: 100%; 
        min-height: 100vh; 
        display: flex;
        align-items: center;
    }

    .btn-success{
        padding: 12px 25px;
    }

    @media (max-width: 767px) and (min-width: 320px){
        .btn-primary{
            padding: 12px 30px;
        }
        
    }

    .security-header {
        margin-top: -45px;
        background: #FFFFFF;
        width: 23%;
        border-radius: 50%;
        border-top: 10px solid #4e77e7;
    }

    .security-header img {
        padding: 15%;
        width: 80px;
    }
    
     @media (max-width: 450px) and (min-width: 320px){
         .container{
             width:90%;
     }
     }
     
     @media (max-width: 767px) and (min-width:450px){
         .container{
             width:75%;
     }
     }
     
       @media (max-width: 992px) and (min-width:768px){
         .container{
             width:45%;
     }
     }
     
     @media (max-width: 1130px) and (min-width:  992px){
         .container{
             width:40% !important;
     }
     }
     
     @media (min-width:1130px){
         .container{
             width:30%;
     }
     }
</style>

<section class="login-block vertical-center">
    <div class="container">
        <center>
            <div class="card-header1 card-header-text security-header" data-background-color="blue">
                <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/encrypt.png">
            </div>
            <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/vivaan-armor-logo.png" width="150">
        </center><br/>
        <div class="col-md-12 login-sec">
            <h2 class="text-center text-capitalize"><b>Secured Login</b></h2><br/><br/>
            <form class="match-form">
                <div class="group">

                    <div class="form-group">
                        <div class="question"><h5 style="text-align:left"><b><?= $questions ?></b></h5></div>
                        <div class="form-group">
                            <?= Html::input('password', 'password', '', ['class' => 'form-control','autofocus' => 'autofocus' , 'maxlength' => 26, 'placeholder' => 'Enter Password', 'id' => "search-criteria"]) ?>
                        </div>

                        <div class=" wrong-password" style="display:none"> 
                            <p class="text-red"> Answer Entered is Incorrect </p>
                        </div>

                        <div class="form-group"><br/><br/>
                            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(['site/logout']) ?>"> 
                                <?= Html::Button('<< Back', ['class' => 'btn btn-primary pull-left']) ?>
                            </a>

                            <?= Html::submitButton('Submit >>', ['class' => 'btn btn-success check-password pull-right']) ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
$script = <<< JS
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
function passwordCheck(){
               var password = document.getElementById('search-criteria').value;
        $.get('check-passwords', {password ,id:$model}, function(data) {
            if(data == 1) {
                $('.wrong-password').css('display','block');
            }
        }); 
        }
        $("form").submit(function (e) {
            e.preventDefault();
passwordCheck();
        }); 
                  $(".check-password").click(function () {
passwordCheck();
    });

JS;
$this->registerJs($script);
?>
