<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\MasterRoleTypes;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use frontend\models\SuperAdminNotifications;
use frontend\models\User;
use dosamigos\ckeditor\CKEditor;

//use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\SuperAdminNotifications */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    .input-group.input-daterange .input-group-addon {
        border-left: 0px;
    }
</style>

<div class="notifications-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?php if ($model->isNewRecord) { ?>
                <?=
                $form->field($model, 'assigned_from')->widget(Select2::classname(), [
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
                
                $data = ArrayHelper::map(MasterRoleTypes::find()->where(['id' => [2, 4]])->all(), 'id', 'role_name');

                echo Select2::widget([
                    'name' => 'role_name',
                    'id' => 'id',
                    //'value' => $courses_assigned_list_array,
                    'data' => $data,
                    'maintainOrder' => true,
                    'options' => ['id' => 'roles', 'placeholder' => 'Select Role',
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
        

        <div class="col-md-6">
            <?php if ($model->isNewRecord) { ?>
                <?=
                $form->field($model, 'assigned_to')->widget(DepDrop::classname(), [
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
                $user_assigned_list = SuperAdminNotifications::find()
                        ->where(['assigned_to' => $model->assigned_to])
                        ->all();
                $users_array = [];
                $user_assigned_list_array = [];
                foreach ($user_assigned_list as $user_assigned) {
                    $user_name = User::findOne(['id' => $user_assigned->assigned_to])->email;
                    $users_array[$user_assigned->assigned_to] = $user_name;
                    array_push($user_assigned_list_array, $user_assigned->assigned_to);
                }

                $data = ArrayHelper::map(User::find()->where(['role_type' => [2, 4]])
                                        ->andWhere(['created_by' => Yii::$app->user->identity->id,'status'=>10])
                                        ->all(), 'id', 'email');
                echo Select2::widget([
                    'name' => 'SuperAdminNotifications[assigned_to][]',
                    'id' => 'assigned_to_id',
                    'value' => $user_assigned_list_array,
                    'data' => $data,
                    'maintainOrder' => true,
                    'options' => [
                        'placeholder' => 'Select User',
                        'multiple' => true,
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
    <div class="row">
        <div class="col-md-12 message"> 
            <br> 
            <?=
            $form->field($model, 'message')->widget(CKEditor::className(), [
                'options' => ['rows' => 3],
                'preset' => 'basic'
            ])
            ?>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12">
            <?php
            echo '<label class="control-label">Select date</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'start_date',
                'attribute2' => 'end_date',
                'options' => ['placeholder' => 'Start date'],
                'options2' => ['placeholder' => 'End date'],
                'type' => DatePicker::TYPE_RANGE,
                'form' => $form,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'startDate' => date("Y-m-d"),
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
        <?= Html::a('Cancel', ['/super-admin-notifications/index'], ['class' => 'btn btn-primary pull-right']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
