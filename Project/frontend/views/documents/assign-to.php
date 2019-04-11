
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\AssignedDocuments;
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
.btn-save{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 1px 1px;
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

                                            <p>Assign to </p>
                                            <?=
                                            $form->field($model, 'assigned_to')->widget(Select2::classname(), [
                                                'options' => ['placeholder' => 'Assigned To'],
                                                'data' => ArrayHelper::map(User::find()->all(), 'id', 'email'),
                                                'pluginOptions' => [
                                                    'allowClear' => true,
                                                ],
                                            ])->label(false)
                                            ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group required">

                                        <?php
                                        echo '<label class="control-label">Workflow Expiry Date</label>';
                                        echo DatePicker::widget([
                                            'model' => $model,
                                            'attribute' => 'workflow_expiry_date',
                                            'name' => 'workflow_expiry_date',
                                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                            'pluginOptions' => [
                                                'required'=>true,
                                                'autoclose' => true,
                                                'format' => 'yyyy-mm-dd',
                                                'todayHighlight' => true,
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group pull-right">
                                
                             
                                <?= Html::Button('Cancel', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) ?>
                                <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-save']) ?>
                            </div>                   
                    </div>
                </div></div></div>
<?php ActiveForm::end(); ?>
