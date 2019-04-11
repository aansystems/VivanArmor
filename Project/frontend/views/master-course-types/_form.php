<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MasterCourseTypes */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .btn-type{
        padding:11px 21px;
    }
    .btn-size{
        padding:11px 30px;
    }
  
</style>


<div class="master-course-types-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'course_type_name')->textInput(['maxlength' => true]) ?> <br>
            <label class="help-inline" for="signupcourse" generated="true" ></label>
        </div>
    </div>
    <div class="form-group">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right btn-size']) ?>        
        
        <?= Html::a('Cancel', ['/master-course-types/index'], ['class' => 'btn btn-primary pull-right btn-type']) ?>
   
    </div>
    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
        //validations for course type name
        
$('#mastercoursetypes-course_type_name').change(function() {
    coursetype = this.value;
       
    $.get('coursetype-validation', {coursetype : coursetype}, function(data){ 
        
        if(data == 1) {
            text = "Course Type Name already exists!";
            $('.help-inline[for="signupcourse"]').html(text).css({color:'red'});
             $('#mastercoursetypes-course_type_name').val('');
          $('.help-inline').val('');
        }
        else if(data == 0) {
            $('.help-inline[for="signupcourse"]').html("");
        }
    });
});
JS;
$this->registerJs($script);
?>