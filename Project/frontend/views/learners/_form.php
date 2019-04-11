<?php

use yii\helpers\Html;
use frontend\models\Courses;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use frontend\models\Countries;
use frontend\models\CoursesAssigned;
use frontend\models\States;
use frontend\models\Cities;
use yii\db\Query;
use kartik\form\ActiveForm;
$this->registerJsFile(
    '@web/js/validation.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<style>
    .btn-save{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 1px 1px;
    }
.btn.btn-primary{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 1px 1px;
        background-color: #f44336;
    }
</style>
<?php
$query = new Query();
$role_type = Yii::$app->user->identity->role_type;


if ($role_type == 3) {
    $query->select(['courses.id', 'courses.course_name'])
            ->from('courses')
            ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned =courses.id'
            )
            ->where(['courses_assigned.user_id' => Yii::$app->user->identity->id, 'blocked_status' => 1]);

    $command = $query->createCommand();
    $filtered_courses = $command->queryAll();
}
?>

<div class="learners-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">  
        <div class="col-md-4">
            <div class="form-group label-floating">              
                <?= $form->field($model2, 'first_name')->textInput(['maxlength' => true])    ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group label-floating">
                <?= $form->field($model2, 'last_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
       
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group label-floating">               
                <?=
                $form->field($model5, 'country')->widget(Select2::classname(), [
                    'options' => ['placeholder' => 'Select Country'],
                    'data' => ArrayHelper::map(Countries::find()->all(), 'id', 'country_name'),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ])->label(false)
                ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group label-floating">    
                <?php if ($model->isNewRecord) { ?>  
                    <?=
                    $form->field($model5, 'state')->widget(Select2::classname(), [
                        'options' => ['placeholder' => 'Select State'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ])->label(false)
                    ?> 
                <?php } else {
                      $states = States::find()->where(['country_id'=>$model5->country])->all();
                    ?>
                    <?=
                    $form->field($model5, 'state')->widget(Select2::classname(), [
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

        <div class="col-md-3">
            <div class="form-group label-floating">  
                <?php if ($model->isNewRecord) { ?>            
                    <?=
                    $form->field($model5, 'city')->widget(Select2::classname(), [
                        'options' => ['placeholder' => 'Select City'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ])->label(false)
                    ?> <?php } else {
                        $cities = Cities::find()->where(['state_id'=>$model5->state])->all();
                    ?>
                    <?=
                    $form->field($model5, 'city')->widget(Select2::classname(), [
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
        <div class="col-md-3">
            <div class="form-group label-floating">
                <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

    </div>
    <div class="row">     
        <div class="col-md-9">
            <div class="form-group label-floating">
                <?= $form->field($model5, 'street')->textInput(['maxlength' => true])->label('Address') ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group label-floating">
                <?= $form->field($model5, 'pincode')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-4">
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

        <div class="col-md-3">
            <div class="form-group label-floating">

                <?=
                $form->field($model, 'alternate_email', [
                    'addon' => [
                        'append' => [
                            'content' => '<i class="fa fa-envelope" aria-hidden="true"></i>'
                        ]
                    ]
                ])->textInput(['maxlength' => true])
                ?>
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
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group label-floating">    
                <?php if ($role_type == 1) { ?>          
                    <?php if ($model->isNewRecord) { ?>
                        <?=
                        $form->field($model3, 'courses_assigned')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(Courses::find()->all(), 'id', 'course_name'),
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
                                ->where(['user_id' => $model->user_id, 'blocked_status' => 1])
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
                }
                ?>   
                <?php if ($role_type == 6) { ?>          
                    <?php if ($model->isNewRecord) { ?>
                        <?=
                        $form->field($model3, 'courses_assigned')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(Courses::find()->all(), 'id', 'course_name'),
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
                                ->where(['user_id' => $model->user_id, 'blocked_status' => 1])
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
                }
                ?>   
                <?php if ($role_type == 3) { ?>          
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
                }
                ?>   
            </div>
        </div>
    </div>
    <div class="row">
        
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right btn-save']) ?>  
        <?= Html::a('Cancel', ['/learners/index'], ['class' => 'btn btn-primary pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


