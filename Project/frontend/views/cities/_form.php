<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\States;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cities */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .btn-primary{
        padding:12px 21px;
        background-color: #f44336 !important;
    }
</style>

<div class="cities-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group label-floating">
                <?= $form->field($model, "state_id")->dropDownList(ArrayHelper::map(States::find()->all(), 'id', 'state_name'), ['prompt' => 'Select State']); ?>     
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group label-floating">
                <?= $form->field($model, 'city_name')->textInput(['maxlength' => true]) ?>   
                <label class="help-inline" for="city" generated="true"></label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group label-floating">
                <?= $form->field($model, 'area_code')->textInput(['maxlength' => true]) ?>   
            </div>
        </div>
    </div>       
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>   
        <?= Html::a('Cancel', ['/cities/index'], ['class' => 'btn btn-primary pull-right']) ?>
             
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$('#cities-city_name').change(function() {
    city_name = this.value;

       
    $.get('cities-validation', {city_name : city_name}, function(data){ 
        if(data == 1) {
            text = "City Name  already exists!";
            $('.help-inline[for="city"]').html(text).css({color:'red'});
            $('#cities-city_name').val('');
          $('.help-inline').val('');
        }
        else if(data == 0) {
            $('.help-inline[for="city"]').html("");
        }
    });
});
JS;
$this->registerJs($script);