<?php

use frontend\models\MasterContentTemplates;
use kartik\dialog\Dialog;
use yii\helpers\Html;

$request = Yii::$app->request;
$id = $request->get('id');

echo Dialog::widget([
    'options' => [
        'title' => 'Your Attention pls!',
    ]
]);
echo Dialog::widget();
?>
<style>

    .modal-content .modal-body{
        min-height: auto;
    }
    .table .td-actions {
        display: table-cell;
    }
    .card img {
        width: 50px; 
    }
    table.dataTable > thead:first-child > tr:first-child > th:nth-child(3),
    table.dataTable > thead:first-child > tr:first-child > th:nth-child(4),
    table.dataTable > thead:first-child > tr:first-child > th:nth-child(5),
    table.dataTable > thead:first-child > tr:first-child > th:nth-child(6)
    {
        padding-right: 8% !important; 
    }
    @media (max-width:1600px){
        .table.dataTable .td-actions .btn
        {
            padding: 3px !important;
        }
    }

    .download-button{       
        padding: 0px !important;
        margin-bottom: 0px;
        color: red;
        background: transparent;
        border: 0px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title"> MY DIGITAL CONTENT </h4>
                    </div>
                    <div class="card-content ">
                        <div class="material-datatables">
                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="w0" class="grid-view">
                                                <table class="table table-striped table-no-bordered table-hover dataTable dtr-inline">
                                                    <?php $i = 1 ?>
                                                    <thead>
                                                        <tr class="text-rose">
                                                            <th style="width: 4%;">#</th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=content_name" data-sort="content_name">Content Name</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=content_name" data-sort="content_name">Content Description</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=content_type" data-sort="content_type">Content Type</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=author_name" data-sort="content_type">Author Name</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=created_date" data-sort="created_date">Uploaded Date</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=expiry_date" data-sort="expiry_date">Expiry Date</a></th>
                                                            <th class="action-column" style="padding-right: 5% !important;">&nbsp;&nbsp;&nbsp;&nbsp;Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($data as $value) {
                                                            $con_type = MasterContentTemplates::findOne(['id' => $value['content_type']])->template_name;
                                                            ?>
                                                            <tr data-key="<?= $value['id'] ?>">
                                                                <td><?= $i ?></td>
                                                                <td><?= $value['content_name'] ?></td>
                                                                <td><?= $value['content_description'] ?></td>
                                                                <td><?= $con_type ?></td>
                                                                <td><?= $value['author_name'] ?></td>   
                                                                <td><?= $value['created_at'] ?></td>                       
                                                                <td><div id="DateCountdown<?= $value['id']; ?>" data-date="<?= $value['expiry_date'] ?> 00:00:00" style="width: 100px; height: 100px; padding: 0px; box-sizing: border-box;"></div></td>
                                                        <script> $("#DateCountdown<?= $value['id'] ?>").TimeCircles({time: {Hours: {show: false}, Minutes: {show: false}, Seconds: {show: false}}});
                                                            $("#DateCountdown<?= $value['id'] ?>").TimeCircles({
                                                                "animation": "smooth",
                                                                "bg_width": 0.2,
                                                                "fg_width": 0.04,
                                                                "circle_bg_color": "#60686F",
                                                                "time": {
                                                                    "Days": {
                                                                        "text": "Days",
                                                                        "color": "#2fd5a6",
                                                                        "show": true
                                                                    }
                                                                }
                                                            });</script>
                                                        <td class="td-actions">
                                                            <?php if ($value['view'] != null && $value['download'] == null) { ?>
                                                                <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_contents/<?= $value['file_name'] ?>" title="view" target="_blank"><div class="btn btn-primary btn-simple waves-effect"><span class="fa fa-eye"></span> </div></a>
                                                            <?php } else { ?>
                                                                <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_contents/<?= $value['file_name'] ?>" title="view" target="_blank"><div class="btn btn-primary btn-simple waves-effect"><span class="fa fa-eye"></span> </div></a>
                                                                <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_contents/<?= $value['file_name'] ?>" download><div class="btn btn-primary btn-simple waves-effect"><span class="fa fa-download"></span> </div></a>
                                                            <?php } ?>
                                                        </td>
                                                        <?php $i++ ?>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
               <?= Html::submitButton('Cancel', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal']) ?>


