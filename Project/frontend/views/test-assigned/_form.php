<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\MasterRoleTypes;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use frontend\models\Subjects;
use frontend\models\Branches;
use frontend\models\TestAssigned;
use frontend\models\User;

$roll = Yii::$app->user->identity->role_type;
/* @var $this yii\web\View */
/* @var $model frontend\models\TestAssigned */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-assigned-form">

<?php $form = ActiveForm::begin(); ?>
    <div class="row">

            <?php if ($roll == 1) { ?>
            <div class="col-md-6">
                <?php if ($model->isNewRecord) { ?>
                    <?=
                    $form->field($model, 'created_by')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(MasterRoleTypes::find()->where(['id' => [2, 4]])->all(), 'id', 'role_name'),
                        'options' => ['id' => 'roles', 'placeholder' => 'Select Role'],
                        'showToggleAll' => false,
                        'hideSearch' => false,
                        'pluginOptions' => [
                            'allowClear' => true,
                            'multiple' => 'multiple',
                        ],
                    ])->label(false)
                    ?> 
                    <?php
                } else {

                    $role = User::findOne(['id' => $model->user_id])->role_type;
                    if ($role == 2) {
                        $data = 'Company Admin';
                    } elseif ($role == 4) {
                        $data = 'Learner';
                    } ?>
 
                    <?= Select2::widget([
                        'name' => 'role_name',
                        'value' => $data,
                        'data' => ArrayHelper::map(MasterRoleTypes::find()->where(['id' => [2, 4]])->all(), 'id', 'role_name'),
                        'disabled' => true,
                        'options' => ['placeholder' => 'Select Role',
                        ],
                        'pluginOptions' => [
                            'tags' => true,
                        ],
                    ]) ?>                    
           <?php } ?> 
            
            </div>


            <div class="col-md-6">
                <?php if ($model->isNewRecord) { ?>
                    <?=
                    $form->field($model, 'user_id')->widget(DepDrop::classname(), [
                        'type' => DepDrop::TYPE_SELECT2,
                        'options' => [
                            'id' => 'users',
                            'multiple' => true,
                            'required' => true,
                        ],
                        'pluginOptions' => [
                            'showToggleAll' => false,
                            'allowClear' => true,
                            'depends' => ['roles'],
                            'placeholder' => 'Select User',
                            'url' => Url::to(['super-admin-notifications/getusers'])
                        ],
                    ])->label(false)
                    ?>  
                    <?php
                } else {
                   $data =  ArrayHelper::map(User::findOne(['id' => $model->user_id]),'id','email');
                   $data1 =  User::findOne(['id' => $model->user_id])->email;
                    echo Select2::widget([
                        'name' => 'SuperAdminNotifications[assigned_to][]',
                        'id' => 'assigned_to_id',
                        'value' => $data1,
                        'data'=>$data,
                        'maintainOrder' => true,
                        'disabled' => true,
                        'pluginOptions' => [
                            'tags' => true,
                        //'maximumInputLength' => 10
                        ],
                    ]);
                }
                ?>  

            </div>



        <?php } elseif ($roll == 2) { ?>
            <div class="col-md-6">
                          <?php if ($model->isNewRecord) { ?>
                <?= '<label class="control-label">Select Branch</label>'; ?>
                <?=
                $form->field($model, 'created_by')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Branches::find()
                                    ->rightJoin('branch_managers', 'branches.id=branch_managers.branch_id')
                                    ->where(['branches.created_by' => Yii::$app->user->identity->id])
                                    //->andWhere(['=','branch_managers.branch_id' ,'branches.id'])
                                    ->all(), 'id', 'branch_name'),
                    'options' => ['id' => 'branches', 'placeholder' => 'Select Branch'],
                    'showToggleAll' => false,
                    'hideSearch' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => 'multiple',
                    ],
                ])->label(false)
                           ?> 
                          <?php } ?>
            </div>
        <?php } elseif ($roll == 3) { ?>
            <div class="col-md-6">
                <?php if ($model->isNewRecord) { ?>
                <?= '<label class="control-label">Select Learners</label>'; ?>
                <?=
                $form->field($model, 'created_by')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(User::find()
                                    ->where(['created_by' => Yii::$app->user->identity->id])
                                    //->andWhere(['=','branch_managers.branch_id' ,'branches.id'])
                                    ->all(), 'id', 'email'),
                    'options' => [
                        'placeholder' => 'Select Subjects',
                        'multiple' => true,
                        'allowClear' => true,
                    ],
                ])->label(false)
                ?> 
                 <?php } ?>
            </div>
            <?php } ?>

    </div>
    <div class="row">
        <div class="col-md-6">
<?php if ($model->isNewRecord) { ?>
                <?php if ($roll == 1) { ?>
                    <?=
                    $form->field($model, 'subject_assigned')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(Subjects::find()->where(['created_by' => 1])->all(), 'id', 'subject_name'),
                        'options' => [
                            'placeholder' => 'Select Subjects',
                            'multiple' => true,
                            'allowClear' => true,
                        ],
                    ])->label(false)
                    ?>
                <?php
                } elseif ($roll == 2 || $roll == 3) {

                    $data1 = ArrayHelper::map(Subjects::find()
                                            ->rightJoin('test_assigned', 'subjects.id=test_assigned.subject_assigned')
                                            ->where(['test_assigned.user_id' => Yii::$app->user->identity->id])
                                            ->all(), 'id', 'subject_name');
                    $data2 = ArrayHelper::map(Subjects::findAll(['created_by' => Yii::$app->user->identity->id]), 'id', 'subject_name');
                    $data = ArrayHelper::merge($data1, $data2);
                    //   echo '<pre/>'; print_r($data);die();
                    ?>
                    <?= '<label class="control-label">Select Subjects</label>'; ?>
                    <?=
                    $form->field($model, 'subject_assigned')->widget(Select2::classname(), [
                        'data' => $data,
                        'options' => [
                            'placeholder' => 'Select Subjects',
                            'multiple' => true,
                            'allowClear' => true,
                        ],
                    ])->label(false)
                    ?>   
                <?php } ?>
                <?php
            } else {
                $courses_assigned_list = TestAssigned::find()
                        ->where(['user_id' => $model->user_id])
                        ->andWhere(['blocked_status' => 1])
                        ->all();
                $courses_array = [];
                $courses_assigned_list_array = [];

                foreach ($courses_assigned_list as $course) {
                    $course_name = Subjects::findOne(['id' => $course->subject_assigned])->subject_name;
                    $courses_array[$course->subject_assigned] = $course_name;
                    array_push($courses_assigned_list_array, $course->subject_assigned);
                }

                $data = ArrayHelper::map(Subjects::find()->all(), 'id', 'subject_name');
                  echo '<label class="control-label"></label>';  
                echo Select2::widget([
                    'name' => 'CoursesAssigned[subject_assigned][]',
                    //  'id' => 'courses_assigned_id',
                    'value' => $courses_assigned_list_array,
                    'data' => $data,
                    'maintainOrder' => true,
                    'options' => [
                        'placeholder' => 'Assign Tests',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'tags' => true,
                    //'maximumInputLength' => 10
                    ],
                ]);
            }
            ?>
        </div>
    </div>
    <div class="form-group">
<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

        <?php ActiveForm::end(); ?>

</div>
