
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
.btn-danger{
 
    padding: 12px 20px;

}
.btn-save{
    padding: 12px 1px 7px 1px !important;
    width: 80px !important;
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

                                     
                                            <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                                           
                                        </div>
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
