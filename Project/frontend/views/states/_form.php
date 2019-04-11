<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Countries;

/* @var $this yii\web\View */
/* @var $model frontend\models\States */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .btn-primary{
        padding:12px 21px;
         background-color: #f44336 !important;

    }
</style>

<div class="states-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">
     
    <?= $form->field($model, "country_id")->dropDownList(ArrayHelper::map(Countries::find()->all(), 'id', 'country_name'), ['prompt' => 'Select Country']); ?>    
        </div>
    </div>
         <div class="col-md-6">
        <div class="form-group label-floating">
      <?= $form->field($model, 'state_name')->textInput(['maxlength' => true]) ?>
            <label class="help-inline" for="signupstate" generated="true"></label>
        </div>
    </div>
</div>
   <div class="form-group">
       <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?> 
    <?= Html::a('Cancel', ['/states/index'], ['class' => 'btn btn-primary pull-right']) ?>
      
</div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$('#states-state_name').change(function() {
    state_name = this.value;

       
    $.get('state-validation', {state_name : state_name}, function(data){ 
        
//            label1 = $('.help-inline[for="signupstate"]').html();
        if(data == 1) {
            text = "State name  already exists!";
            $('.help-inline[for="signupstate"]').html(text).css({color:'red'});
            $('#states-state_name').val('');
          $('.help-inline').val('');
        }
        else if(data == 0) {
            $('.help-inline[for="signupstate"]').html("");
        }
    });
});
JS;
$this->registerJs($script);