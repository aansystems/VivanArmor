<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use frontend\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\MasterContentTemplates;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contents */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .select2-container .select2-selection--single .select2-selection__rendered {
        margin-top: 0px;
    }
    .form-group input[type=file]{
        opacity: 1 !important;
        position: initial;
        padding-top:16px;
        z-index: 1;
        background-color: transparent;
    }
    .checkbox label, .radio label, label{
        color:#131212 !important;
    }

    @media (max-width:400px){
        .select2-container .select2-search--inline .select2-search__field{
            margin-left:-8%;
            font-size:10px;
        }
        .btn, .navbar .navbar-nav > li > a.btn  {
            font-size: 12px;
        }

    }

    @media (max-width:600px) and (min-width:400px){
        .select2-container .select2-search--inline .select2-search__field{
            margin-left:-6%;
            font-size:12px;

        }

    }

    @media (max-width:770px) and (min-width:600px){
        .select2-container .select2-search--inline .select2-search__field{
            margin-left:-3%;
            font-size:14px;
        }

    }

    @media (max-width:780px) and (min-width:300px){
        .btn{
            padding:12px 30px;
        }    }

@media (max-width:767px){
    .container-fluid{
            margin-top: 40px !important;
        }
}
</style>
<div class="contents-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group required">
                <?= $form->field($model, 'content_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group required">
                <?=
                $form->field($model, 'content_type')->widget(Select2::classname(), [
                    'options' => ['placeholder' => 'Select Folder', 'id' => 'content_type'],
                    'data' => ArrayHelper::map(MasterContentTemplates::find()->all(), 'id', 'template_name'),
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ])->label('Folder')
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group required">
                <?= $form->field($model, 'content_description')->textarea(['rows' => 3]) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group required">
                <?= $form->field($model, 'author_comment')->textarea(['rows' => 3]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group required">
                <?= $form->field($model, 'file_name')->fileInput()->label('Upload'); ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="required">
                <?php
                echo DatePicker::widget([
                    'model' => $model,
                    'form' => $form,
                    'attribute' => 'expiry_date',
                    'name' => 'Expiry_date',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'startDate' => date("Y-m-d"),
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group required">
                    <?=
                    $form->field($model1, 'security')->widget(Select2::classname(), [
                        'data' => ['Restricted' => 'Restricted', 'Confidential' => 'Confidential', 'Internal Use' => 'Internal Use', 'Public' => 'Public']
                    ])->label('Security for Documents')
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group required">
                <?=
                $form->field($model1, 'view')->widget(Select2::classname(), [
                    'options' => ['placeholder' => 'Select Who Can Only View Content', 'id' => 'select1'],
                    'data' => ArrayHelper::map(User::find()->where(['<>', 'id', Yii::$app->user->identity->id])->andWhere(['=', 'status', 10])->all(), 'id', 'email'),
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => 'multiple',
                    ],
                ])->label('View Only')
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group required">
                <?=
                $form->field($model1, 'download')->widget(Select2::classname(), [
                    'options' => ['placeholder' => 'Select Who Can View and Download Content', 'id' => 'select2'],
                    'data' => ArrayHelper::map(User::find()->where(['<>', 'id', Yii::$app->user->identity->id])->andWhere(['=', 'status', 10])->all(), 'id', 'email'),
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => 'multiple',
                    ],
                ])->label('View and Download')
                ?>
            </div>
        </div>
    </div>

    <div class="form-group pull-right">
        <?= Html::a('Cancel', ['/contents/index'], ['class' => 'btn btn-danger']) ?>
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    var ids = [];
    var i = 0;
    $('#select1').change(function () {
        ids = $(this).val();
        var options=$('#select1 option').clone();
        $('#select2').html( options.clone());
          for (i = 0; i < ids.length; i++) {
            $('#select2 option[value= ' + ids[i] + ']').remove();
        }
    });
</script>