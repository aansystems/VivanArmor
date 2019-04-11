<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\User;
use frontend\models\MasterRoleTypes;

/* @var $this yii\web\View */
/* @var $model frontend\models\SuperAdminNotifications */

$this->title = 'View Notifications';
$this->params['breadcrumbs'][] = $this->title;
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
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">VIEW NOTIFICATIONS </h4>
                    </div>
                    <div class="card-content">
                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
//                                'id',
                                [
                                    'label' => 'Role Type',
                                    'value' => function ($model, $index) {
                                        $role_type = User::findOne(['id' => $model->assigned_to])->role_type;
                                        return MasterRoleTypes::findOne(['id' => $role_type])->role_name;
                                    }
                                ],
                                [
                                    'label' => 'Assigned From',
                                    'value' => function ($model, $index) {
                                        return User::findOne(['id' => $model->assigned_from])->first_name;
                                    }
                                ],
                                [
                                    'label' => 'Assigned To',
                                    'value' => function ($model, $index) {
                                        return User::findOne(['id' => $model->assigned_to])->email;
                                    }
                                ],

                                'message:ntext',
                                'start_date',
                                'end_date',
                            ],
                        ])
                        ?>


                    </div>
                    <div class="col-md-12">
                        <?= Html::a('Back', ['super-admin-notifications/index'], ['class' => 'btn btn-primary pull-right']) ?>

                    </div>		
                </div>

            </div>
        </div>
    </div>
