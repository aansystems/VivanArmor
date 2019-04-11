
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UploadedCertificates */

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
                        <h4 class="card-title">Document View</h4>

                    </div>
             
                    <div class="card-content">
                        <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <embed src="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $model->file_name?>.pdf#toolbar=0" width="100%" height="400px" align="center">
                        </div>
                        <div class="col-md-2"></div>
                        </div>
                        <table id="w0" class="table table-striped table-bordered detail-view">
                            <tbody>
                                <tr><th>Document Name</th><td><?= $model->document_name ?></td></tr>
                                <tr><th>Document Description</th><td><?= $model->document_description ?></td></tr>
                                <tr><th>Author Name</th><td>My Doc</td></tr>
                                <tr><th>Author Comment</th><td><?= $model->author_comment ?></td></tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-12">
                        <?= Html::a('Back', ['/documents/index'], ['class' => 'btn btn-primary pull-right']) ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

