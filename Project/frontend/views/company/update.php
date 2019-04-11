<?php


/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Company Admins Update';
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
    .select2-container .select2-selection--single .select2-selection__rendered {
    
    margin-top: 0px !important;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">UPDATE USER/LEARNER </h4>
                        <div class="col-md-3">

                        </div>
                    </div>
                    <div class="card-content">

                        <?=
                        $this->render('_form', [
                            'model' => $model,
                            'model2' => $model2,
                            'model3' => $model3,
                            'model4' => $model4
                            
                        ])
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
