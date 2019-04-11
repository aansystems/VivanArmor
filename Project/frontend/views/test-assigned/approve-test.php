<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Subjects;
use frontend\models\User;

$request = Yii::$app->request;
$id = $request->get('id');

$this->title = 'Test Requests';
?>
<style>
    .modal-content .modal-body{
        padding-right: 15px;
    }
    /*   .modal .modal-header .close {
            display: none !important;
        }*/

    .modal .close {
        font-size: 40px;
        font-weight: 300;
    }

    .modal-header {
        background: linear-gradient(60deg, #2F80ED, #56CCF2);
        text-align: center;
        padding: 4px !important;
    }

    .modal-content .modal-body{
        min-height: auto ;
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

    .table.dataTable>thead>tr>th {
        border: none;
        padding-bottom: 20px !important;
    }
    @media (max-width:1600px){
        .container-fluid{
            margin-top: 40px !important;
        }
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title"> TEST REQUESTS </h4>
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
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=content_name" data-sort="content_name">Learner</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=content_type" data-sort="content_type">Subject</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=created_date" data-sort="created_date">Quiz Name</a></th>
                                                            <th class="action-column" style="padding-right: 5% !important;">&nbsp;&nbsp;&nbsp;&nbsp;Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($data)) { ?>
                                                            <?php
                                                            foreach ($data as $value) {

                                                                $subject = Subjects::findOne(['id' => $value['subject_id']]);

                                                                $user_name = User::findOne(['id' => $value->user_id]);
                                                                ?>
                                                                <tr data-key="<?= $value['id'] ?>">
                                                                    <td><?= $i ?></td>
                                                                    <td><?= $user_name['email'] ?></td>
                                                                    <td><?= $subject['subject_name'] ?></td>
                                                                    <td><?= $subject['quiz_name'] ?></td>                   
                                                                    <td class="td-actions">
                                                                        <a href="<?= Yii::$app->request->baseUrl ?>/test-assigned/approve?id=<?= $value['id'] ?>">
                                                                            <?= Html::button('Approve', ['class' => 'btn btn-success my-btn', 'style' => 'padding: 12px 1px 7px 1px  !important;;width:80px;margin-bottom: 1px;']); ?>
                                                                        </a>
                                                                        <a href="<?= Yii::$app->request->baseUrl ?>/test-assigned/reject?id=<?= $value['id'] ?>">

                                                                            <?= Html::button('Reject', ['class' => 'btn btn-danger my-btn', 'style' => 'padding: 12px 1px 7px 1px  !important;width:80px;margin-bottom: 1px;']); ?>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <?php $i++ ?>
                                                            <?php } ?>

                                                        <?php } else { ?>
                                                            <tr>
                                                                <td style="vertical-align: middle; margin:2px; text-align:center" colspan="6" class="text-center">No Records Found</td>
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
