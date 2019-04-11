<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UploadedCertificatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uploaded Certificates';
$this->params['breadcrumbs'][] = $this->title;
?><style>
    .glyphicon-ban-circle{
        margin-top: 0.5rem !important;
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">Uploaded Certificates</h4>

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

            //'id',
           // 'learner_id',
            'certificate_name',
            'certifying_authority',
            'issue_date',
            'expire_date',
            'certificate_no',

            ['class' => 'yii\grid\ActionColumn'],
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

