<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\MasterCourseTypes;
$this->title = 'Courses Update';

/* @var $this yii\web\View */
/* @var $model backend\models\CoursesAvailable */
/* @var $form yii\widgets\ActiveForm */
$this->params['breadcrumbs'][] = ['label' => 'Create Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .btn-primary{
        padding:11px 21px;
    }
    .btn-success{
        padding:11px 30px;
    }
  
</style>



<?php yii\widgets\Pjax::begin(['id' => 'new_country']) ?>
<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group label-floating">

            <?= $form->field($model, "course_type_id")->dropDownList(ArrayHelper::map(MasterCourseTypes::find()->all(), 'id', 'course_type_name'), ['prompt' => 'Select CourseType']); ?>
        </div>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'course_name')->textInput() ?> <br>
        <label class="help-inline" for="signupcoursename" generated="true"></label>
    </div>
</div>
<div class="row">
    <div class="col-md-12 course_description"> 
        <br> <?= $form->field($model, 'course_description')->textarea(['rows' => 3]) ?>
    </div>
</div>

<div class="form-group">
     <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>   
    <?= Html::a('Cancel', ['/courses/index'], ['class' => 'btn btn-primary pull-right']) ?>
   
</div>
<?php ActiveForm::end(); ?>

<?php
$script = <<< JS
        //validations for course name
        
$('#courses-course_name').change(function() {
    coursename = this.value;
       
    $.get('coursename-validation', {coursename : coursename}, function(data){ 
        
        if(data == 1) {
            text = "Course Name already exists!";
            $('.help-inline[for="signupcoursename"]').html(text).css({color:'red'});
             $('#courses-course_name').val('');
          $('.help-inline').val('');
        }
        else if(data == 0) {
            $('.help-inline[for="signupcoursename"]').html("");
        }
    });
});
JS;
$this->registerJs($script);
?>

