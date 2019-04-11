<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\HomeScreenMessages */


$this->params['breadcrumbs'][] = ['label' => 'Home Screen Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'View Home Screen Message';
?>
<style>
    .btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px;
        background: #e91e63;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">VIEW HOME SCREEN MESSAGE </h4>

                    </div>
                    <div class="card-content">
                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'assigned_to',
                                'title',
                                'content:ntext',
                                'attachment',
                                'start_date',
                                'end_date',
                            ],
                        ])
                        ?>

                    </div>
                    <div class="col-md-12">
<?= Html::a('Back', ['/home-screen-messages/index'], ['class' => 'btn btn-primary pull-right']) ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
