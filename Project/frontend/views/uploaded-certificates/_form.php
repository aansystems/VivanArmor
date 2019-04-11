<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\UploadedCertificates */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
  .help-block  {
        margin-top: 15px;
}
    .form-group input[type=file]{
        opacity: 1 !important;
        position: initial;
        padding-top:16px;
        z-index: 1;
    }
    .form-control{
        background-color: white;
    }
    .datepicker {
        top: 50px !important;      
    }
</style>
<div class="uploaded-certificates-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">  
        <div class="col-md-6">
            <div class="form-group label-floating"> 
                <?= $form->field($model, 'certificate_name')->textInput(['maxlength' => true])->label('Certificate') ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating"> 
                <?= $form->field($model, 'certifying_authority')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                echo '<label class="control-label">Select date</label>';
                echo DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'issue_date',
                    'attribute2' => 'expire_date',
                    'options' => ['placeholder' => 'Issue Date'],
                    'options2' => ['placeholder' => 'Expire date'],
                    'type' => DatePicker::TYPE_RANGE,
                    'form' => $form,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="row" style="margin-top: 35px;">
            <div class="col-md-6">
                <div class="form-group label-floating"> 
                    <?= $form->field($model, 'certificate_no')->textInput(['maxlength' => true])->label('Certificate Number') ?>
                </div>
            </div>

            <div class="col-md-6"> 
                <?=
                $form->field($model, 'file')->fileInput();
                ?>
            </div>

        </div>

        <div class="form-group">             
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?> 
        <?= Html::a('Cancel', ['/certificates/index'], ['class' => 'btn btn-primary pull-right']) ?>
         
    
        </div>

        <?php ActiveForm::end(); ?>

    </div>
