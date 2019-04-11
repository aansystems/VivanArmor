<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use frontend\models\Company;
use frontend\models\Subscription;
/* @var $this yii\web\View */
/* @var $model frontend\models\License */
/* @var $form yii\widgets\ActiveForm */
        

                  $query = "SELECT id,company_name
              FROM company
            WHERE id NOT IN  (SELECT company_id FROM license)";
                  $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $data = $command->queryAll();


?>
<style>
   .renewal{
    border: 1px solid #0FB6CB;
    padding: 10px;
    margin: 0px;
    background-image: none;
   } 
   .renewal label{
    top:-40px !important;
   } 
   
   .btn-primary{
       padding:12px 21px;
   }
   .kv-container-from,.kv-container-to{
       background-image:none !important;
   }
   
   label.control-label.checkbox label, .radio label, label {
  
    color:  #131212 !important;
   }
</style>
<div class="license-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">  
        <div class="col-md-4">
            <div class="form-group label-floating">              
            <?php $model->company_id=Company::findOne(['id' => $model->company_id])->company_name ?>
                
                <?= $form->field($model, "company_id")->textInput(['maxlength' => true,'disabled' => 'disabled'])->label('Company Name')  ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group label-floating"> 
                          <?= $form->field($model, "subscription_type")->dropDownList(ArrayHelper::map(Subscription::find()->all(), 'id', 'type'), ['prompt' => 'Select Type']); ?>
                
           
            </div>
        </div>
        
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-8">
            <?php
            echo '<label class="control-label">Select date</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'license_issued',
                'attribute2' => 'license_expired',
                'options' => ['placeholder' => 'License Issue Date'],
                'options2' => ['placeholder' => 'License Expiry Date'],
                'type' => DatePicker::TYPE_RANGE,
                'form' => $form,
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayHighlight' => true,
                 
                ]
            ]);
            ?>
        </div>
        <br>
        <div class="col-md-4">
        <?php if ($model->isNewRecord) { ?>            
                    <?php } else {
                    ?>
                     <?php
            echo '<label>License Renewal Date</label>';
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'renewal_date',
                'name' => 'check_issue_date', 
                'value' => date('d-M-Y'),
                'options' => ['placeholder' => 'Select renewal date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayHighlight' => true,
                    'renewal_date' => date("Y-m-d"),
                ]
            ]);
            ?>
                <?php } ?>    
           
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 "> 
        <?php if ($model->isNewRecord) { ?>            
                    <?php } else {
                    ?>
                    <?= $form->field($model, 'renewal_purpose')->textarea(['rows' => 1]) ?> 
                <?php } ?>    
         
        </div>
    </div>

    <div class="form-group">
         <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?> 
    <?= Html::a('Cancel', ['/license/index'], ['class' => 'btn btn-primary pull-right']) ?>
     
    </div>
    <?php ActiveForm::end(); ?>

</div>
