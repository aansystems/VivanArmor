<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Contents */


$this->params['breadcrumbs'][] = ['label' => 'Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    table{
            margin-top: 10px;
    }
</style>
<div class="content ">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">Content View</h4>

                    </div>
                    <div class="card-content">
                        <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <embed src="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_contents/<?= $model->file_name ?>.PDF#toolbar=0" width="100%" height="400px" align="center">
                        </div>
                        <div class="col-md-2"></div>
                        </div>
                        <table id="w0" class="table table-striped table-bordered detail-view">
                            <tbody>
                                <tr><th>Content Name</th><td><?= $model->content_name ?></td></tr>
                                <tr><th>Content Description</th><td><?= $model->content_description ?></td></tr>
                                <tr><th>Author Name</th><td><?= $model->author_name ?></td></tr>
                                <tr><th>Expiry Date</th><td><?= $model->expiry_date ?></td></tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-12">
                        <?= Html::a('Back', ['/contents/index'], ['class' => 'btn btn-primary pull-right']) ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
