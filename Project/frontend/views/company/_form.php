<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use frontend\models\Countries;
use frontend\models\States;
use frontend\models\Cities;
use kartik\form\ActiveForm;
use frontend\models\Courses;
use frontend\models\CoursesAssigned;
use frontend\models\Subscription;
use kartik\date\DatePicker;
$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
$this->registerJsFile(
        '@web/js/validation.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<style>
    .btn-save{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 1px;
    }
    .btn.btn-primary{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 1px;
        background-color: #f44336 !important;
    }
    
     .form-group.label-floating:not(.is-empty) label.control-label {
    top: -35px;
     }
</style>
<div class="learners-form">

<?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group label-floating">              
<?= $form->field($model2, 'first_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group label-floating">
<?= $form->field($model2, 'last_name')->textInput(['maxlength' => true]) ?>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group label-floating">  

<?=
$form->field($model4, 'country')->widget(Select2::classname(), [
    'options' => ['placeholder' => 'Select Country'],
    'data' => ArrayHelper::map(Countries::find()->all(), 'id', 'country_name'),
    'pluginOptions' => [
        'allowClear' => true,
    ],
])->label(false)
?>

            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group label-floating">    
<?php if ($model->isNewRecord) { ?>  
                    <?=
                    $form->field($model4, 'state')->widget(Select2::classname(), [
                        'options' => ['placeholder' => 'Select State'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ])->label(false)
                    ?> 
                <?php
                } else {
                    $states = States::find()->where(['country_id' => $model4->country])->all();
                    ?>
                    <?=
                    $form->field($model4, 'state')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($states, 'id', 'state_name'),
                        'options' => ['placeholder' => 'Select State'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ])->label(false)
                    ?>  
                <?php } ?>          
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group label-floating">  
                <?php if ($model->isNewRecord) { ?>            
                    <?=
                    $form->field($model4, 'city')->widget(Select2::classname(), [
                        'options' => ['placeholder' => 'Select City'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ])->label(false)
                    ?> <?php
                } else {
                    $cities = Cities::find()->where(['state_id' => $model4->state])->all();
                    ?>
                    <?=
                    $form->field($model4, 'city')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($cities, 'id', 'city_name'),
                        'options' => ['placeholder' => 'Select City'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ])->label(false)
                    ?> 
                <?php } ?>    
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group label-floating">
                <?= $form->field($model4, 'street')->textInput(['maxlength' => true])->label('Address') ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group label-floating">
                <?= $form->field($model4, 'pincode')->textInput(['maxlength' => true]) ?>

            </div> 
        </div>

    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group label-floating">              
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
        </div>

        <div class="col-md-2">
            <div class="form-group label-floating">
                <?= $form->field($model2, 'phone_code')->textInput(['maxlength' => true, 'readonly' => true])->label('Country Code') ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group label-floating">

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
        <div class="col-md-1">
            <div class="form-group label-floating">
                <?= $form->field($model, 'area_code')->textInput(['maxlength' => true])->label('Area Code') ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group label-floating">
                <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group label-floating">
                <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group label-floating">
                <?=
                $form->field($model, 'website', [
                    'addon' => [
                        'append' => [
                            'content' => '<i class="glyphicon glyphicon-globe" aria-hidden="true"></i>'
                        ]
                    ]
                ])->textInput(['maxlength' => true])
                ?>
                <label class="help-inline" for="signupwebsite" generated="true"></label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group label-floating">
                <?=
                $form->field($model, 'users_license', [
                    'addon' => [
                        'append' => [
                            'content' => '<i class="glyphicon glyphicon-user" aria-hidden="true"></i>'
                        ]
                    ]
                ])->textInput(['maxlength' => true])->label('No.of License')
                ?>

            </div>
        </div>

    </div>
<?php if ($base == 'company/create'){ ?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group label-floating">              
                <?= $form->field($model8, "subscription_type")->dropDownList(ArrayHelper::map(Subscription::find()->all(), 'id', 'type'), ['prompt' => 'Select Type']); ?>
            </div>   
        </div>

        <div class="col-md-4">
            <?php
        
            echo DatePicker::widget([
                'model' => $model8,
                'attribute' => 'license_expired',
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'form' => $form,
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>      
        </div>

    </div>
<?php } ?>
    <div class="row">
        <div class="col-md-12 remarks"> 
            <br> <?= $form->field($model, 'remarks')->textarea(['rows' => 2]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?php if ($model->isNewRecord) { ?>
                <?=
                $form->field($model3, 'courses_assigned')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Courses::find()->all(), 'id', 'course_name'),
                    'options' => [
                        'placeholder' => 'Select Courses',
                        'multiple' => true,
                        'allowClear' => true,
                    ],
                ])->label(false)
                ?> 
                <?php
            } else {
                $courses_assigned_list = CoursesAssigned::find()
                        ->where(['user_id' => $model->company_admin_id])
                        ->andWhere(['blocked_status' => 1])
                        ->all();
                $courses_array = [];
                $courses_assigned_list_array = [];

                foreach ($courses_assigned_list as $course) {
                    $course_name = Courses::findOne(['id' => $course->courses_assigned])->course_name;
                    $courses_array[$course->courses_assigned] = $course_name;
                    array_push($courses_assigned_list_array, $course->courses_assigned);
                }

                $data = ArrayHelper::map(Courses::find()->all(), 'id', 'course_name');

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
                'data' => ['0' => 'Normal','1' => 'privilege']
            ])->label('User Role')
            ?>
        </div>
        </div>


    </div>
    <div class="form-group">       
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right btn-save']) ?>       
        <?= Html::a('Cancel', ['/company/index'], ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

