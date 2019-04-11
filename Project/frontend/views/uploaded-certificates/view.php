<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\UploadedCertificates */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Uploaded Certificates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    table{
            margin-top: 10px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">Uploaded certificates</h4>

                    </div>
                    <div class="card-content">
                        <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <iframe src="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_certificates/<?= $model->attachment ?>" width="100%" height="400" align="center"> </iframe> 
                        </div>
                        <div class="col-md-2"></div>
                        </div>
                        <table id="w0" class="table table-striped table-bordered detail-view">
                            <tbody>
                                <tr><th>Certificate Name</th><td><?= $model->certificate_name ?></td></tr>
                                <tr><th>Certifying Authority</th><td><?= $model->certifying_authority ?></td></tr>
                                <tr><th>Issue Date</th><td><?= $model->issue_date ?></td></tr>
                                <tr><th>Expire Date</th><td><?= $model->expire_date ?></td></tr>
                                <tr><th>Certificate No</th><td><?= $model->certificate_no ?></td></tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-12">
                        <?= Html::a('Back', ['/certificates/index'], ['class' => 'btn btn-primary pull-right']) ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

