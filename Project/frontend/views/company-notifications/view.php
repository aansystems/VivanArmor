<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\User;
use frontend\models\MasterRoleTypes;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompanyNotifications */

$this->title = 'Notifications View';
$this->params['breadcrumbs'][] = $this->title;
?>

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
                                'id',
                                [
                                    'label' => 'Assigned From',
                                    'value' => function ($model, $index) {
                                        return User::findOne(['id' => $model->assigned_from])->first_name;
                                    }
                                ],
                                [
                                    'label' => 'Assigned To',
                                    'value' => function ($model, $index) {
                                        return User::findOne(['id' => $model->assigned_to])->first_name;
                                    }
                                ],
                                [
                                    'label' => 'Role Type',
                                    'value' => function ($model, $index) {
                                        $role_type = User::findOne(['id' => $model->assigned_to])->role_type;
                                        return MasterRoleTypes::findOne(['id' => $role_type])->role_name;
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
                        <?= Html::a('Back', ['company-notifications/index'], ['class' => 'btn btn-primary pull-right']) ?>

                    </div>		
                </div>

            </div>
        </div>
    </div>
