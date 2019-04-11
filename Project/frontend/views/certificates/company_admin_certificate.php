<?php

use frontend\models\Learners;
use frontend\models\User;
use frontend\models\Branches;
use frontend\models\BranchManagers;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CertificatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Certificates';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .modal-content .modal-body{
        min-height: auto ;
    }
    .table .td-actions {
        display: table-cell;
    }
    .card img {
        width: 50px; 
    }
    .input-append .btn.dropdown-toggle {
        float: none;
    }
    .dropdown-toggle{
        padding:6px 15px 4px 15px;
    }
    table.dataTable>tbody>tr>td{
        padding: 8px !important;
    }

    input{
        height: 28px;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title"> CERTIFICATES </h4>
                    </div>
                    <div class="card-content ">
                        <div class="material-datatables">
                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">
                                    <div class="row">

                                        <div class=" col-md-3">   
                                            <div class="input-append btn-group">
                                                <select id="drop-branch" class="form-control">
                                                    <option  value="All">All</option>
                                                    <?php foreach ($out4 as $value) { ?>
                                                        <option value="<?php echo $value ?>"><?php echo $value ?></option>
                                                    <?php } ?>                                               
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-striped table-no-bordered table-hover dataTable dtr-inline">
                                                <?php $i = 1 ?>
                                                <thead>

                                                    <tr class="text-rose">
                                                        <th style="width: 4%;">#</th>

                                                        <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/company-admin-certificate?sort=id" data-sort="certifying_authority">Employee Name</a></th>
                                                        <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/company-admin-certificate?sort=certificate_no" data-sort="certificate_no">Designation</a></th>
                                                        <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/company-admin-certificate?sort=branch" data-sort="certificate_no">Branch Name</a></th>
                                                        <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/company-admin-certificate?sort=issue_date" data-sort="issue_date" style="word-break:break-word">Certificate Number</a></th>
                                                        <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/company-admin-certificate?sort=expire_date" data-sort="expire_date">Course Name</a></th>
                                                        <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/company-admin-certificate?sort=Status" data-sort="Status">Status</a></th>
                                                        <th class="action-column">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($out5)) {
                                                        ?>
                                                        <?php
                                                        foreach ($out5 as $value) {
                                                            $user_id = Learners::findOne(['id' => $value->learner_id])->user_id;
                                                            $user_name = User::findOne(['id' => $user_id]);
                                                            $branch_id = BranchManagers::findOne(['user_id' => $user_name->created_by])->branch_id;
                                                            $branch = Branches::findOne(['id' => $branch_id])->branch_name;
                                                            ?>
                                                            <tr>                                                                
                                                                <td><?= $i ?></td>
                                                                <td><?= $user_name->email ?></td>
                                                                <td>Learner</td>
                                                                <td class="search_drs"> <?= $branch ?></td>
                                                                <td><?= $value->certificate_no ?></td>
                                                                <td><?= $value->certificate_name ?></td>

                                                                <td><div id="DateCountdown<?= $value->id ?>" data-date="<?= $value->expire_date ?> 00:00:00" style="width: 100px; height: 100px; padding: 0px; box-sizing: border-box;"></div></td>
                                                        <script> $("#DateCountdown<?= $value->id ?>").TimeCircles({time: {Hours: {show: false}, Minutes: {show: false}, Seconds: {show: false}}});
                                                            $("#DateCountdown<?= $value->id ?>").TimeCircles({
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
                                                        <td><a class="btn btn-primary btn-simple waves-effect" href="<?= Yii::$app->request->baseUrl ?>/certificates/view?id=<?= $value->id ?>" title="View" aria-label="View" data-pjax="0"><span class="fa fa-eye"></span></a></td>
                                                        <?php $i++ ?>
                                                        </tr>
                                                    <?php } ?>
                                                    <?php //} ?> 
                                                <?php } else { ?>
                                                    <tr>
                                                        <td style="vertical-align: middle; margin:2px; text-align:center" colspan="8" class="text-center">No Records Found</td>
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
<script>
    $("#drop-branch").on('change', function () {
        alert($(this).val());
        var g = $(this).val().toLowerCase();

        $('tr:has(td.search_drs)').each(function () {
            var s = $(this).text().toLowerCase();
            $(this).closest('tr:has(td.search_drs)')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
        });
    });
</script>