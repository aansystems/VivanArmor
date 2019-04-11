<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\MasterRoleTypes;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use frontend\models\CompanyNotifications;
use frontend\models\User;
use dosamigos\ckeditor\CKEditor;
use frontend\models\BranchManagers;
use frontend\models\Learners;

/* @var $this yii\web\View */
/* @var $model app\models\CompanyNotifications */
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
                    'data' => ArrayHelper::map(MasterRoleTypes::find()->where(['id' => [3, 4]])->all(), 'id', 'role_name'),
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
                $data = ArrayHelper::map(MasterRoleTypes::find()->where(['id' => [3, 4]])->all(), 'id', 'role_name');
                echo Select2::widget([
                    'name' => 'role_name',
                    'id' => 'id',
                    'data' => $data,
                    'maintainOrder' => true,
                    'options' => ['id' => 'roles', 'placeholder' => 'Select Role',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'tags' => true,
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
                    'options' => ['id' => 'users', 'multiple' => true],
                    'pluginOptions' => [
                        'showToggleAll' => false,
                        'allowClear' => true,
                        'depends' => ['roles'],
                        'placeholder' => 'Select User',
                        'url' => Url::to(['company-notifications/getusers'])
                    ],
                ])->label(false)
                ?>  
                <?php
            } else {
                /**
                 * query to fetch the users who assigned the notifications
                 */
                $user_assigned_list = CompanyNotifications::find()
                        ->where(['assigned_to' => $model->assigned_to])
                        ->all();

                $users_array = [];
                $user_assigned_list_array = [];
                foreach ($user_assigned_list as $user_assigned) {
                    $user_name = User::findOne(['id' => $user_assigned->assigned_to])->first_name;
                    $users_array[$user_assigned->assigned_to] = $user_name;
                    array_push($user_assigned_list_array, $user_assigned->assigned_to);
                }
                /**
                 * query to fetch the branch managers and learners under the company
                 */
                $branch_managers = BranchManagers::find()->where(['created_by' => Yii::$app->user->identity->id])->all();
                foreach ($branch_managers as $branch_manager) {
                    $manager_id = $branch_manager->user_id;
                    $learners = Learners::find()->where(['created_by' => $manager_id])->all();
                    foreach ($learners as $learner) {
                        $learner_id = $learner->user_id;
                    }
                }
                $data1 = ArrayHelper::map(User::find()->where(['id' => $manager_id])
                                        ->all(), 'id', 'first_name');

                $data2 = ArrayHelper::map(User::find()->where(['id' => $learner_id])
                                        ->all(), 'id', 'first_name');

                $data = ArrayHelper::merge($data1, $data2);

                echo Select2::widget([
                    'name' => 'CompanyNotifications[assigned_to][]',
                    'id' => 'assigned_to_id',
                    'value' => $user_assigned_list_array,
                    'data' => $data,
                    'maintainOrder' => true,
                    'options' => [
                        'placeholder' => 'Select User',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'tags' => true,
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
        <?= Html::a('Cancel', ['/company-notifications/index'], ['class' => 'btn btn-primary pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
         $('.selection__rendered').each(function(){
        var sickfull        = $(this).val();
        var errormessage    = "";

        if (!search__field)
            errormessage = "Please select an option";

        if (errormessage != "") {
            $.Zebra_Dialog(errormessage, { 'type': 'warning', 'title': 'Error', 'width': '500' });
            return false;
        }
    });
JS;
$this->registerJs($script);
?>
