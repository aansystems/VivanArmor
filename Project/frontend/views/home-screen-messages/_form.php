<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use frontend\models\Branches;
use yii\helpers\Url;
use frontend\models\User;


/* @var $this yii\web\View */
/* @var $model frontend\models\HomeScreenMessages */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .form-group input[type=file]{
        opacity: 1 !important;
        position: relative;
        top:16px;
        z-index: 1;
    }
    .form-control{
        background-color: white;
    }
</style>
<div class="notifications-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php if(Yii::$app->user->identity->role_type == 2) { ?>
    <div class="row">
        <div class="col-md-6">
           
                <?=
                $form->field($model, 'created_by')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Branches::find()
                            ->rightJoin('branch_managers', 'branches.id=branch_managers.branch_id')
                            ->where(['branches.created_by' => Yii::$app->user->identity->id])
                            ->all(), 'id', 'branch_name'),
                   
                    'options' => ['id' => 'branches', 'placeholder' => 'Select Branch'],
                    'showToggleAll' => false,
                    'hideSearch' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => 'multiple',
                    ],
                ])
                ?> 
          
        </div>
        

        <div class="col-md-6">
           
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
                        'depends' => ['branches'],
                        'placeholder' => 'Select User',
                        'url' => Url::to(['home-screen-messages/getusers'])
                    ],
                ])
                ?>  
             
    
    </div>
    </div>
            <?php }else {?>
       <div class="row">
        <div class="col-md-6">
      
                <?=
                $form->field($model, 'assigned_to')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(User::find()
                            ->where(['created_by' => Yii::$app->user->identity->id])
                           ->andWhere(['=','status' ,'10'])
                            ->all(), 'id', 'email'),
                   
                    'options' => ['id' => 'learners', 'placeholder' => 'Select Learner'],
                    'showToggleAll' => false,
                    'hideSearch' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => 'multiple',
                    ],
                ])->label(false)
                ?> 
        </div></div>
                <?php
            } 
            ?>
          
     
        <div class="col-md-12">
        <div class="form-group label-floating">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 message"> 

            <?=
            $form->field($model, 'content')->widget(CKEditor::className(), [
                'options' => ['rows' => 2],
                'preset' => 'basic'
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12"> 
            <?=
            $form->field($model, 'attachment')->fileInput();
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
        <?= Html::a('Cancel', ['/home-screen-messages/index'], ['class' => 'btn btn-primary pull-right']) ?>
        
    </div>
    <?php ActiveForm::end(); ?>
</div>