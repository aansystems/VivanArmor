<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    @media (max-width: 400px) and (min-width: 320px){
        .btn, .navbar .navbar-nav > li > a.btn {
            font-size: 12px;
            padding: 12px 30px;
        }
        .btn-primary{
            padding:12px 21px;
        }
    }

    @media (max-width: 767px) and (min-width: 320px){
        .btn, .navbar .navbar-nav > li > a.btn {
            padding: 12px 30px;

        }
        .btn-primary{
            padding:12px 21px;  
        }
    }
    .btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px !important;
        background: #f44336;
    }
    .btn.btn-success{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px !important;
</style>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-md-12">
                    <div class="card">
                        <div class="card-header1  card-header-text"
                             data-background-color="blue">
                            <h4 class="card-title">CHANGE PASSWORD</h4>
                        </div>
                        <div class="card-content">
                            <div class="change-password">

                                <?php $form = ActiveForm::begin(); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger help-inline"
                                             style="text-align: center; display: none"
                                                 for="current_password">

                                             </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <?= $form->field($model, 'old_password')->passwordInput(['maxlength' => true])->label('Old Password') ?>
                                        </div>

                                        <div class="col-md-4">
                                            <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true])->label('New Password') ?>
                                        </div>

                                        <div class="col-md-4">
                                            <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true])->label('Confirm Password') ?>
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
                                        <?= Html::a('Cancel', ['/site'], ['class' => 'dec btn btn-primary pull-right']) ?>
                                    </div>

                                    <?php ActiveForm::end(); ?>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
        /* jquery for validating the passwords  */

        $script = <<< JS
$('#user-old_password').change(function() {
    password = $(this).val(); 
    $.get('match-passwords', {password : password}, function(data){ 
        if(data == 0) {
            $('.help-inline[for="current_password"]').html("Your current password is Incorrect! Please try again!").show();
           // $('#user-old_password').val("");
            //$('#user-old_password').focus();
        }
        else {
            $('.help-inline[for="current_password"]').html("").hide();
        }
    });
});
$('#user-new_password').change(function() {
    new_password = this.value;
       
    $.get('match-passwords', {password : password}, function(data){ 
        

       if($('#user-new_password').val() === $('#user-old_password').val() && $('#user-old_password').val()!='') {
           $('.help-inline[for="current_password"]').html("Your new password matches with current password! Please enter different password").show();
             $('#user-new_password').val('');
          $('.help-inline').val('');
        }
        else if(data == 0) {
            $('.help-inline[for="signupmobile"]').html("");
        }
    });
    
});

JS;
        $this->registerJs($script);
        ?>
