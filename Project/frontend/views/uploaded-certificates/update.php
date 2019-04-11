<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UploadedCertificates */

$this->title = 'Update Uploaded Certificates: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Uploaded Certificates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">UPLOAD CERTIFICATES UPDATE </h4>

                    </div>
                    <div class="card-content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

                   </div>
                </div>

            </div>
        </div>
    </div>
</div>
