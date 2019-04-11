<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\User;
use kartik\date\DatePicker;

$this->registerCssFile('@web/css/progressbar.css', ['depends' => [\frontend\assets\AppAsset::className()], 'position' => \yii\web\View::POS_HEAD]);
?>


<style>
    .help-block  {
        margin-top: 15px;
    }
    .form-control{
        background-color: white;
    }
    .modal-header,.modal-body{
        padding:5px !important;
    }
    .form-control{
        display: block !important;
    }
    .kv-plugin-loading.loading-documentauthor-assigned_to {
        display: none !important;
    }


    .form-group.label-floating:not(.is-empty) label.control-label{
        top: -38px !important;   
    }   
    .btn-save{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 1px 1px;
        background-color: #4caf50 !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered{
        margin-top: 0px !important;
    }
</style>

<?php $form = ActiveForm::begin(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="author row">

                    <div class="row" >
                        <div class="col-md-10">
                            <div class="form-group required">

                                <?php
                                echo '<label class="control-label">Document Expiry Date</label>';
                                echo DatePicker::widget([
                                    'model' => $model2,
                                    'attribute' => 'expiry_date',
                                    'name' => 'Expiry_date',
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                    ]
                                ]);
                                ?>


                                <?=
                                $form->field($model2, 'assigned_for_view')->widget(Select2::classname(), [
                                    'options' => ['placeholder' => 'Select Who Can Only View', 'id' => 'select1'],
                                    'data' => ArrayHelper::map(User::find()
                                                                        ->where("`id`" . " !='" . Yii::$app->user->identity->id . "'")
                                                                        ->andwhere(['status' => 10])
                                                                        ->all(), 'id', 'email'),
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                        'multiple' => 'multiple',
                                    ],
                                ])->label('View only')
                                ?>


                                <?=
                                $form->field($model2, 'assigned_for_download')->widget(Select2::classname(), [
                                    'options' => ['placeholder' => 'Select Who Can View And Download', 'id' => 'select2'],
                                    'data' => ArrayHelper::map(User::find()
                                                                        ->where("`id`" . " !='" . Yii::$app->user->identity->id . "'")
                                                                        ->andwhere(['status' => 10])
                                                                        ->all(), 'id', 'email'),
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                        'multiple' => 'multiple',
                                    ],
                                ])->label('View And Download')
                                ?>




                                <?=
                                $form->field($model2, 'security')->widget(Select2::classname(), [
                                    'data' => ['Restricted' => 'Restricted', 'Confidential' => 'Confidential', 'Internal Use' => 'Internal Use', 'Public' => 'Public']
                                ])->label('Security For Documents')
                                ?>

                            </div>
                        </div>

                    </div>



                </div>


                <div class="form-group pull-right">

                    <?= Html::Button('Cancel', ['class' => 'btn btn-danger can', 'data-dismiss' => 'modal']) ?>
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-save']) ?>
                </div>



            </div>
        </div></div></div>
<?php ActiveForm::end(); ?>

