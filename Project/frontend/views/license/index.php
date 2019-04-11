<?php

use yii\grid\GridView;
use frontend\models\Company;
use frontend\models\Subscription;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LicenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'License Manager';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .table>thead>tr:first-child>th:first-child, .table>tbody>tr:first-child>td:first-child {
    width: 5% !important;
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">LICENSE MANAGER </h4>
                       
                    </div>
                    <div class="card-content ">

                        <div class="material-datatables">


                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">
                                <?php $dataProvider->pagination->pageSize = 5;  ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Company Name',
                'value' => function ($model, $index) {
                    return Company::findOne(['id' => $model->company_id])->company_name;
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

              ['class' => 'yii\grid\ActionColumn',
                                                'header' => 'Actions',
                                            ],
        ],
    ]); ?>
 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
