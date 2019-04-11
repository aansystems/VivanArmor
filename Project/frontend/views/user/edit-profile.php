<?php

use frontend\models\Cities;
use frontend\models\Countries;
use frontend\models\States;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
$base_url = Yii::$app->request->baseUrl;
$roll = Yii::$app->user->identity->role_type;
$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;

$this->title = 'Edit Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 0;
        padding-right: 0;
        height: auto;
        margin-top: 0px; 
    }
    @media (max-width: 400px) and (min-width: 320px){
        .btn, .navbar .navbar-nav > li > a.btn {
            font-size: 12px;
            padding: 12px 30px;
        } 
    }
        .btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover{
            padding: 12px 1px 7px 1px !important;
            width: 80px !important;
            margin: 10px 3px !important;
            background: #f44336;
        }
        .btn.btn-success{
            padding: 12px 1px 7px 1px !important;
            width: 80px !important;
            margin: 10px 3px !important;
        }
    </style>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-md-12">
                    <div class="card">
                        <div class="card-header1  card-header-text" data-background-color="blue">
                            <h4 class="card-title">EDIT PROFILE </h4>

                        </div>
                        <div class="card-content">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="row">  
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group label-floating">
                                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label('Mobile Number') ?>
                                    </div>
                                </div>
                                <?php if ($roll == 4) { ?>           

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group label-floating">  

                                                <?=
                                                $form->field($model3, 'country')->widget(Select2::classname(), [
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
                                                    $form->field($model3, 'state')->widget(Select2::classname(), [
                                                        //'data' => ArrayHelper::map(States::find()->all(), 'id', 'state_name'),
                                                        'options' => ['placeholder' => 'Select State'],
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                        ],
                                                    ])->label(false)
                                                    ?> 
                                                    <?php
                                                } else {
                                                    $states = States::find()->where(['country_id' => $model3->country])->all();
                                                    ?>
                                                    <?=
                                                    $form->field($model3, 'state')->widget(Select2::classname(), [
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
                                                    $form->field($model3, 'city')->widget(Select2::classname(), [
                                                        // 'data' => ArrayHelper::map(Cities::find()->all(), 'id', 'city_name'),
                                                        'options' => ['placeholder' => 'Select City'],
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                        ],
                                                    ])->label(false)
                                                    ?> <?php
                                                } else {
                                                    $cities = Cities::find()->where(['state_id' => $model3->state])->all();
                                                    ?>
                                                    <?=
                                                    $form->field($model3, 'city')->widget(Select2::classname(), [
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
                                        <div class="col-md-8">
                                            <div class="form-group label-floating">
                                                <?= $form->field($model3, 'street')->textInput(['maxlength' => true]) ?>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group label-floating">
                                                <?= $form->field($model3, 'pincode')->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
                                <?= Html::a('Cancel', ['user/my-profile'], ['class' => 'btn btn-primary pull-right']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- code for fetching the countries, states, and cities for learners -->

    <?php
    $script = <<< JS
      $('#address-country').change(function() {
            country_id = $(this).val();
            $.get('get-states-list', { id : country_id }, function(data){ 
                $('#address-state').html(data);
            }); 
        });
        
        $('#address-state').change(function() {
            state_id = $(this).val();
            $.get('get-cities-list', { id : state_id }, function(data){
                $('#address-city').html(data);
            });
        });     
JS;
    $this->registerJs($script);
    ?>