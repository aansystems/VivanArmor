<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .btn-primary{
        padding:12px 21px;
    }
</style>

<div class="countries-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group label-floating">
                <?= $form->field($model, 'sortname')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group label-floating">
                <?= $form->field($model, 'country_name')->textInput(['maxlength' => true]) ?>
                <label class="help-inline" for="signupcountry" generated="true"></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group label-floating">
                <?= $form->field($model, 'phonecode')->textInput() ?>
            </div>
        </div>
    </div>
   <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?> 
    <?= Html::a('Cancel', ['/countries/index'], ['class' => 'btn btn-primary pull-right']) ?>
      
</div>

    <?php ActiveForm::end(); ?>

<?php
$script = <<< JS
$('#countries-country_name').change(function() {
    country_name = this.value;

       
    $.get('countries-validation', {country_name : country_name}, function(data){ 
        
        if(data == 1) {
            text = "Country Name  already exists!";
            $('.help-inline[for="signupcountry"]').html(text).css({color:'red'});
            $('#countries-country_name').val('');
          $('.help-inline').val('');
        }
        else if(data == 0) {
            $('.help-inline[for="signupcountry"]').html("");
        }
    });
});
JS;
$this->registerJs($script);