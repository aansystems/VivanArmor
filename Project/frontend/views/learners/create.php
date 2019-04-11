<?php


/* @var $this yii\web\View */
/* @var $model frontend\models\Learners */

$this->title = 'Learners Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .alert {
        float: right;
        position: absolute;
        padding: 10px;
        font-size: 16px;
        right: -920px;
        margin-right: 228px;
    }

    .alert span {
        display: inline-block;
    }
    .select2-container .select2-selection--single .select2-selection__rendered{
        margin-top: 0px !important;
    }
    .btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 1px 1px;
        background: #f44336;
    }
    .btn.btn-success{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 1px 1px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">CREATE USER/LEARNER </h4>

                    </div>
                    <div class="card-content">
                        
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                            'model2' => $model2,
                            'model3' => $model3,
                            'model5' => $model5
                        ])
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
         //validation for disabling the form by prem
$(document).ready(function(){     
    $.get('form-validation', function(data){ 
        if(data == 1) {
            $(".learners-form :input").prop("disabled", false);
        }
        else if(data == 0) {
            $(".learners-form :input").prop("disabled", true);
        }
    });        
});
JS;
$this->registerJs($script);
?>