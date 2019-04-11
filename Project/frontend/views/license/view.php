<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Company;
use frontend\models\Subscription;

/* @var $this yii\web\View */
/* @var $model frontend\models\License */

$this->title = 'View License';
$this->params['breadcrumbs'][] = ['label' => 'Licenses', 'url' => ['index']];
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

<div class="license-view">
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">VIEW LICENSE </h4>

                    </div>
                    <div class="card-content">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            [
                'label' => 'Company Name',
                'value' => function ($model, $index) {
                    return Company::findOne(['id' => $model->company_id])->company_name;
                }
            ],
                                [
                'label' => 'Number of License',
                'value' => function ($model, $index) {
                    return Company::findOne(['id' => $model->company_id])->users_license;
                }
            ],
            [
                'label' => 'Subscription Type',
                'value' => function ($model, $index) {
                    return Subscription::findOne(['id' => $model->subscription_type])->type;
                }
            ],
           
            'license_issued',
            'license_expired',
            'renewal_date',
            'renewal_purpose:ntext',
        ],
    ]) ?>

   </div>
                    <div class="col-md-12">
                        <?= Html::a('Back', ['/license/index'], ['class' => 'btn btn-primary pull-right']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
