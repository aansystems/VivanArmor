<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true])->label('Branch Name') ?>
             <label class="help-inline" for="signupemail" generated="true"></label>
        </div>

    </div>

    <div class="form-group">
        
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>      
        <?= Html::a('Cancel', ['/branches/index'], ['class' => 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$('#branches-branch_name').change(function() {
    branch_name = this.value;
    $.get('branch-validation', {branch_name : branch_name}, function(data){ 
            //label1 = $('.help-inline[for="signupemail"]').html();
        if(data == 0) {
            text = "Branch name  already exists!";
            $('.help-inline[for="signupemail"]').html(text).css({color:'red'});
            $('#branches-branch_name').val('');
          $('.help-inline').val('');
        }
        else if(data == 1) {
            $('.help-inline[for="signupemail"]').html("");
        }
    });
});
JS;
$this->registerJs($script);
