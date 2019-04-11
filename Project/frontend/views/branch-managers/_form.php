<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use frontend\models\Branches;
use frontend\models\Courses;
use frontend\models\CoursesAssigned;
use kartik\select2\Select2;
use yii\db\Query;
use frontend\models\Company;
use frontend\models\Countries;
use kartik\form\ActiveForm;

$this->registerJsFile(
        '@web/js/validation.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<style>
    .form-group.label-floating:not(.is-empty) label.control-label {
    top: -35px;
     }
    </style>




<?php
$query = new Query();
$query->select(['courses.id', 'courses.course_name'])
        ->from('courses')
        ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned =courses.id'
        )
        ->where(['courses_assigned.user_id' => Yii::$app->user->identity->id, 'blocked_status' => 1]);
$command = $query->createCommand();
$filtered_courses = $command->queryAll();
?>

<?php
$company_id = Company::findOne(['company_admin_id' => Yii::$app->user->identity->id])->id;
?>

<div class="master-branchmanager-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-4">
            <div class="form-group label-floating">

                <?= $form->field($model, "branch_id")->dropDownList(ArrayHelper::map(Branches::find()->where(['company_id' => $company_id])->all(), 'id', 'branch_name'), ['prompt' => 'Select Branch'])->label('Branch'); ?> 
                <label class="help-inline" for="signupbranch" generated="true"></label>
            </div>
        </div>

        <div class="col-md-6">
            <?= $form->field($model2, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model2, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">        
            <?=
            $form->field($model2, 'email', [
                'addon' => [
                    'append' => [
                        'content' => '<i class="fa fa-envelope-o" aria-hidden="true"></i>'
                    ]
                ]
            ])->textInput(['maxlength' => true])
            ?>
            <label class="help-inline" for="signupemail" generated="true"></label>
        </div>
        <div class="col-md-2">
            <?=
            $form->field($model2, 'phone_code')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Countries::find()->all(), 'phonecode', 'phonecode'),
                'options' => [
                    'placeholder' => 'Select Country Code'
                ],
                'pluginOptions' => [
                ]
            ])->label(false)
            ?> 
        </div>
        <div class="col-md-5">
            <?=
            $form->field($model2, 'phone', [
                'addon' => [
                    'append' => [
                        'content' => '<i class="glyphicon glyphicon-phone" aria-hidden="true"></i>'
                    ]
                ]
            ])->textInput(['maxlength' => true])
            ?>
            <label class="help-inline" for="signupmobile" generated="true"></label>
        </div>
    </div>
    <div class="row">

        <div class="col-md-8">
            <?php if ($model->isNewRecord) { ?>
                <?=
                $form->field($model3, 'courses_assigned')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($filtered_courses, 'id', 'course_name'),
                    'options' => [
                        'placeholder' => 'Assign Courses...'
                    ],
                    'pluginOptions' => [
                        'multiple' => 'multiple'
                    ]
                ])->label(false)
                ?>        
                <?php
            } else {
                $courses_assigned_list = CoursesAssigned::find()
                        ->where(['user_id' => $model->user_id])
                        ->andWhere(['blocked_status' => 1])
                        ->all();
                $courses_array = [];
                $courses_assigned_list_array = [];

                foreach ($courses_assigned_list as $course) {
                    $course_name = Courses::findOne(['id' => $course->courses_assigned])->course_name;
                    $courses_array[$course->courses_assigned] = $course_name;
                    array_push($courses_assigned_list_array, $course->courses_assigned);
                }

                $data = ArrayHelper::map($filtered_courses, 'id', 'course_name');

                echo Select2::widget([
                    'name' => 'CoursesAssigned[courses_assigned][]',
                    'id' => 'courses_assigned_id',
                    'value' => $courses_assigned_list_array,
                    'data' => $data,
                    'maintainOrder' => true,
                    'options' => [
                        'placeholder' => 'Assign Courses ...',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'tags' => true,
                    ],
                ]);
            }
            ?>
        </div>
        <div class="col-md-4">
            <div class="form-group required">

                <?=
                $form->field($model2, 'privilege')->widget(Select2::classname(), [
                    'data' => ['0' => 'Normal', '1' => 'privilege']
                ])->label('User Role')
                ?>
            </div>
        </div>

    </div>



    <div class="form-group">
       
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>     
         <?= Html::a('Cancel', ['/branch-managers/index'], ['class' => 'btn btn-primary pull-right']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
