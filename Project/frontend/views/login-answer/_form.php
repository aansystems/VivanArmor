<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model frontend\models\LoginAnswer */
/* @var $form yii\widgets\ActiveForm */
$connection = Yii::$app->db;
$command = $connection->createCommand("SELECT question FROM `login_questions`");
$questions = $command->queryAll();
$total = count($questions);
$commandexist = $connection->createCommand("SELECT `answered_by` FROM `login_answer` WHERE answered_by = " . Yii::$app->user->identity->id . "");
$exist = $commandexist->queryAll();

// echo'<pre/>'; print_r($a[0]);die();
?>

<style>
    body {
        width: 100%;
    }
    
    .login-block {
        background:url(<?= Yii::$app->request->baseUrl ?>/images/two-factor-auth-bg.jpg)  no-repeat center center;
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

    .login-block {
        height: 100vh;
    }
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
            <h2 class="text-center text-capitalize"><b>Security Questions</b></h2><br/><br/>
                <?php $form = ActiveForm::begin(); ?>
                <form class="login-form">
                    <?php
                    $i = 1;
                    foreach ($questions as $q1) {
                        ?> 
                        <div class="group">

                            <div class="form-group">

                                <div><h5 style="font-weight:bold;"><?= $q1['question']; ?></h5></div>
                                <div class="form-group required">
                                    <?= $form->field($model, 'answer' . $i)->textInput(['maxlength' => true]) ?>
                                </div>

                                <div class="form-group">
                                    <?= Html::submitButton('Save', ['class' => 'btn btn-login pull-right save', 'id' => 'save']) ?>
                                    <?= Html::button('Prev', ['class' => 'btn btn-secondary prev pull-left', 'name' => 'prev']) ?>
                                    <?= Html::button('Next', ['class' => 'btn btn-success next pull-right', 'name' => 'next']) ?>
                                    <?= Html::a('Back', ['site/logout'], ['class' => 'btn btn-primary pull-left back', 'name' => 'Back']) ?>                                    
                                </div>

                            </div>
                            <?php
                            $i++;
                            ?>
                        </div>
                    <?php } ?>

                </form>
            </div>
            <div class="col-md-8 banner-sec">
            </div>	   
            <?php ActiveForm::end(); ?> 

        </div>
    </div>

</section>
<?php
$script = <<< JS
        $(function() {
  var divs = $(".group");
       
  var now = 0; // currently shown div
  divs
    .hide()
    .first()
    .show(); // hide all divs except first
  $(".save").hide();
  $(".prev").hide();
  $(".back").show();
  $("button[name=next]").click(function() {
    divs.eq(now).hide();
    if (now + 1 <= divs.length) {      
      now = now + 1;
      if (now == divs.length - 1) {
        divs.eq(now).show();
        $(".next").hide();
        $(".prev").show();
        $(".save").show();
         $(".back").hide();
      } else {
        $(".prev").show();
        divs.eq(now).show();
        $(".save").hide(); // show next
         $(".back").hide();
      }
    } 
  });
  $("button[name=prev]").click(function() {
    divs.eq(now).hide();
    if (now > 0) {
      now = now - 1;
       divs
    .hide()
      divs.eq(now).show(); // show previous
         $(".next").show();
        $(".save").hide();
         $(".back").hide();
      if(now==0){
        $(".prev").hide();
        $(".back").show();
          divs
    .hide()
    .first()
    .show();
      }
    }
  });
});
$(function() {
  if ($total == count(q1)) {
  }
});
JS;
$this->registerJs($script);
?>
