<?php

use frontend\models\MasterContentTemplates;
use kartik\dialog\Dialog;
use yii\bootstrap\Modal;

$request = Yii::$app->request;
$id = $request->get('id');

$this->title = 'My Digital Content';

echo Dialog::widget([
    'options' => [
        'title' => 'Your Attention pls!',
    ]
]);
echo Dialog::widget();
?>
<style>
    .modal-content .modal-body{
        padding-right: 15px;
    }

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
    .content {
  
    padding-top: 11px !important;
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
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=content_type" data-sort="content_type">Content Type</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=created_date" data-sort="created_date">Uploaded Date</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/contents/index?sort=expiry_date" data-sort="expiry_date">Expiry Date</a></th>
                                                            <th class="action-column" style="padding-right: 5% !important;">&nbsp;&nbsp;&nbsp;&nbsp;Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (!empty($data) || !empty($data1)) { ?>
                                                            <?php
                                                            foreach ($data as $value) {
                                                                $con_type = MasterContentTemplates::findOne(['id' => $value['content_type']])->template_name;
                                                                ?>
                                                                <tr data-key="<?= $value['id'] ?>">
                                                                    <td><?= $i ?></td>
                                                                    <td><?= $value['content_name'] ?></td>
                                                                    <td><?= $con_type ?></td>
                                                                    <td><?= $value['created_at'] ?></td>                       
                                                                    <td><div id="DateCountdown<?= $value['id'] ?>" data-date="<?= $value['expiry_date'] ?> 24:00:00" style="width: 100px; height: 100px; padding: 0px; box-sizing: border-box;"></div></td>
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
                                                                <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_contents/<?= $value['file_name'] ?>" title="view" target="_blank"><div class="btn btn-primary btn-simple waves-effect"><span class="fa fa-eye"></span> </div></a>
                                                                <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_contents/<?= $value['file_name'] ?>" title="download" download><div class="btn btn-success btn-simple waves-effect"><span class="fa fa-arrow-down icons"></span></div></a>
                                                                <a href="#" id="deleteModal<?= $value['id'] ?>" data-toggle="modal1" data-target="#deleteModal<?= $value['id'] ?>" title="delete"><div class="btn btn-danger btn-simple delete"><span class="fa fa-close"></span></div></a>
                                                                <?php
                                                                Modal::begin([
                                                                    'header' => '<h3 style="margin:0px !important">Confirmation</h3>',
                                                                    'id' => 'modal'.$value['id'],
                                                                    'size' => '',
                                                                ]);
                                                                echo "<div id='modalContent'></div>"
                                                                . "<p>Are you sure you want to delete?</p>";
                                                                echo "<div class='modal-footer'>";
                                                                echo "<a href='#' data-dismiss='modal'>";
                                                                echo "<button type='button' class='btn btn-danger' style='padding: 12px 1px 7px 1px !important; width: 80px !important;'>Close" . "</button>";
                                                                echo "</a>";
                                                                echo "&nbsp;";
                                                                echo "<a href=" . Yii::$app->request->baseUrl . "/contents/delete?id=" . $value['id'] . " data-method='post'>"
                                                                . "<button type='button' class='btn btn-success' style='padding: 12px 1px 7px 1px !important; width: 80px !important;'>Delete</button>"
                                                                . "</a>"
                                                                . "</div>";
                                                                Modal::end();
                                                                ?>
                                                                <script>
                                                                    $(function () {
                                                                        $("#deleteModal<?= $value['id'] ?>").click(function () {
                                                                            $('#modal<?= $value['id'] ?>').modal('show')
                                                                                    .find('#modalContent')
                                                                                    .load($(this).attr('value'));
                                                                        });
                                                                    });

                                                                </script>  
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
