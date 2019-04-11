<?php


/* @var $this yii\web\View */
/* @var $model frontend\models\Contents */

$this->title = 'Create Content';
$this->params['breadcrumbs'][] = ['label' => 'Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .form-group.label-floating:not(.is-empty) label.control-label{
        top: -38px !important;   
    } 
    .btn.btn-danger, .btn.btn-danger:hover, .btn.btn-danger:focus, .btn.btn-danger:active, .btn.btn-danger.active, .btn.btn-danger:active:focus, .btn.btn-danger:active:hover, .btn.btn-danger.active:focus, .btn.btn-danger.active:hover{
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
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">CREATE CONTENT </h4>
                    </div>
                    <div class="card-content">
    <?= $this->render('_form', [
        'model' => $model,
        'model1' => $model1,
    ]) ?>

 </div>
                </div>

            </div>
        </div>
    </div>
</div>

