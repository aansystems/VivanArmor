<?php



/* @var $this yii\web\View */
/* @var $model frontend\models\HomeScreenMessages */

$this->title = 'Create Home Screen Message';
$this->params['breadcrumbs'][] = ['label' => 'Home Screen Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
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
    
     .form-group.label-floating:not(.is-empty) label.control-label {
    top: -34px;
    }

</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">CREATE HOME SCREEN MESSAGE </h4>
                    </div>
                    <div class="card-content">
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                        ])
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>