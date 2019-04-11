<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Certificates;
use frontend\models\Learners;
use frontend\models\User;
use frontend\models\DocumentsLog;
use frontend\models\Documents;
use frontend\models\MasterDocTemplates;
use yii\widgets\LinkPager;
use yii\data\Pagination;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CertificatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Documents Log';
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
    .table.dataTable>thead>tr>th {
        border: none;
        padding-bottom: 1% !important;
    }
    table.dataTable>thead>tr>th, table.dataTable>tbody>tr>th, table.dataTable>tfoot>tr>th, table.dataTable>thead>tr>td, table.dataTable>tbody>tr>td, table.dataTable>tfoot>tr>td {
        padding: 1% !important;
        outline: 0;
    }
    button, input, optgroup, select, textarea{
        margin: 0px !important;
        padding-right: -10px;
    }
    .document{

        width:20% !important;  
    }
    .table>thead>tr:first-child>th:first-child,.table>tbody>tr:first-child>td:first-child{
        width:5% !important;
    }
    .col-sm-5 {
        width: 28.666667%;
    }
    .form-control{
        width:100% !important;
    }
    .table>thead>tr>th{
        line-height: 1.2;
    }
/*    .table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th{
      white-space: nowrap;  
    }*/
</style>
<?php
$id = '';
$role_type = Yii::$app->user->identity->role_type;
if ($role_type == 1) {
    if (isset($_GET['document_type']) && $_GET['document_type'] != 'All') {
        $id = $_GET['document_type'];
        $query = DocumentsLog::find()->where(['document_type' => $id]);
        $documents_count = DocumentsLog::find()->where(['document_type' => $id])->count();
        $pagination = new Pagination(['totalCount' => $documents_count, 'pageSize' => 5]);
        $array = [];
        $articles = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        $documents_log = $query->all();
    } else {
        $query = DocumentsLog::find();
        $documents_count = DocumentsLog::find()->count();
        $pagination = new Pagination(['totalCount' => $documents_count, 'pageSize' => 5]);
        $array = [];
        $articles = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        $documents_log = $query->all();
    }
} elseif ($role_type == 2) {
    if (isset($_GET['document_type']) && $_GET['document_type'] != 'All') {
        $id = $_GET['document_type'];
        $documents_log = [];
        $branch_id = User::findAll(['created_by' => yii::$app->user->identity->id]);
        foreach ($branch_id as $branches_id) {
            $learner_id = User::findAll(['created_by' => $branches_id->id]);
            foreach ($learner_id as $learners_id) {
                $document = DocumentsLog::findAll(['user_id' => $learners_id->id, 'document_type' => $id]);
                foreach ($document as $value) {
                    array_push($documents_log, $value);
                }
            }
        }
        $documents_count = sizeof($documents_log);
        $pagination = new Pagination(['totalCount' => $documents_count, 'pageSize' => 5]);
        $array = [];
    } else {
        $documents_log = [];
        $branch_id = User::findAll(['created_by' => yii::$app->user->identity->id]);
        foreach ($branch_id as $branches_id) {
            $learner_id = User::findAll(['created_by' => $branches_id->id]);
            foreach ($learner_id as $learners_id) {
                $document = DocumentsLog::findAll(['user_id' => $learners_id->id]);
                foreach ($document as $value) {
                    array_push($documents_log, $value);
                }
            }
        }
        $documents_count = sizeof($documents_log);
        $pagination = new Pagination(['totalCount' => $documents_count, 'pageSize' => 5]);
        $array = [];
    }
} elseif ($role_type == 3) {
    if (isset($_GET['document_type']) && $_GET['document_type'] != 'All') {
        $id = $_GET['document_type'];
        $documents_log = [];
        $learner_id = User::findAll(['created_by' => yii::$app->user->identity->id]);
        foreach ($learner_id as $learners_id) {
            $document = DocumentsLog::findAll(['user_id' => $learners_id->id, 'document_type' => $id]);
            foreach ($document as $value) {
                array_push($documents_log, $value);
            }
        }
        $documents_count = sizeof($documents_log);
        $pagination = new Pagination(['totalCount' => $documents_count, 'pageSize' => 5]);
        $array = [];
    } else {
        $documents_log = [];
        $learner_id = User::findAll(['created_by' => yii::$app->user->identity->id]);
        foreach ($learner_id as $learners_id) {
            $document = DocumentsLog::findAll(['user_id' => $learners_id->id]);
            foreach ($document as $value) {
                array_push($documents_log, $value);
            }
        }
        $documents_count = sizeof($documents_log);
        $pagination = new Pagination(['totalCount' => $documents_count, 'pageSize' => 5]);
        $array = [];
    }
}
$document_type_id = MasterDocTemplates::find()->select(['id', 'template_name'])->all();
?>
<div class="content change">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header1 card-header-text" data-background-color="blue">
                <h4 class="card-title"> DOCUMENTS LOG </h4>
            </div>
            <div class="card-content ">
                <div class="material-datatables">
                    <div class="row">
                        <div class="col-md-12" style="overflow-x: auto;">
                            <div class="col-md-12">
                                <table class="table table-striped table-no-bordered table-hover dataTable dtr-inline">
                                    <thead>
                                        <tr class="text-rose">
                                            <th style="width:10%">#</th>
                                            <th>Document Author</th>
                                            <th style="white-space: nowrap;">Document Type</th>
                                            <th style="white-space: nowrap;">Document Name</th>
                                            <th>Assigned To</th>
                                            <th>Status</th>
                                            <th style="white-space: nowrap;">Date & Time</th>
                                        </tr>
                                        <tr>
                                    <th></th>
                                    <th><input type="text" class="form-control" id="search_author" placeholder="Search"></th>
                                    <th class="document">                                          
                                        <select id="select_document_type" class="form-control">
<!--                                                    <option value="select" disabled selected>Select Document Type</option>-->
                                                    <option  value="All">All</option>
                                                    <?php
                                                    foreach ($document_type_id as $document_type1) {
                                                        ?>
                                                        <option value="<?php echo $document_type1->id ?>" <?php if ($document_type1->id == $id || $document_type1->id == '') echo "selected" ?>><?php echo $document_type1->template_name ?></option>
                                                    <?php } ?>                                               
                                                </select>                                       
                                    </th>
                                    <th><input type="text" class="form-control" id="search_name" placeholder="Search"></th>
                                    <th><input type="text" class="form-control" id="search_assign" placeholder="Search"></th>
                                    <th>  
                                                <form class="form-inline " >
                                                    <input id="search_criteria" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                                </form>
                                            </th>
                                            <th></th>
                                </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($documents_log)) { ?>
                                            <?php
                                            $i = 1;
                                            foreach ($documents_log as $document_log) {
                                                $doc_type = Documents::find()->select(['document_name', 'document_type'])->where(['id' => $document_log['document_id']])->One();
                                                $document_type = MasterDocTemplates::findOne(['id' => $doc_type])->template_name;
                                                $assigned_to = User::findOne(['id' => $document_log['assigned_to']])->email;
                                                $document_author = User::findOne(['id' => $document_log['user_id']])->email;
                                                ?>
                                                <tr>                                                                
                                                    <td><?= $i ?></td>
                                                    <td><?= $document_author ?></td>   
                                                    <td><?= $document_type ?></td>
                                                    <td><?= $doc_type['document_name'] ?></td>
                                                    <td><?= $assigned_to ?></td>
                                                    <td class="actions"><?= $document_log['actions'] ?></td>
                                                    <td><?= $document_log['created_at'] ?></td>
                                                </tr>
                                                <?php $i++ ?>
                                            <?php } ?>
                                        <?php } else {
                                            ?>
                                            <tr>
                                                <td style="vertical-align: middle; margin:2px; text-align:center" colspan="7" class="text-center">No Records Found</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5"></div> 
                                <div class="col-sm-7">
                                        <?=
                                            LinkPager::widget([
                                            'pagination' => $pagination,
                                            ]);
                                        ?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#select_document_type').change(function (e) {
        var document_type = $(this).val();
        if (document_type == "" || document_type == "All") {
            window.location.href = 'documents-data-log';
        } else {
            window.location.href = 'documents-data-log?document_type=' + document_type;
        }
    });
    $("#search_criteria").on("keyup", function () {
        var g = $(this).val().toLowerCase();
        $('tr:has(td.actions)').each(function () {
            var s = $(this).text().toLowerCase();
            $(this).closest('tr:has(td.actions)')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
        });
    });
    $("#search_author").on("keyup", function () {
        var g = $(this).val().toLowerCase();
        $('tr:has(td.actions)').each(function () {
            var s = $(this).text().toLowerCase();
            $(this).closest('tr:has(td.actions)')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
        });
    });
    $("#search_name").on("keyup", function () {
        var g = $(this).val().toLowerCase();
        $('tr:has(td.actions)').each(function () {
            var s = $(this).text().toLowerCase();
            $(this).closest('tr:has(td.actions)')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
        });
    });
    $("#search_assign").on("keyup", function () {
        var g = $(this).val().toLowerCase();
        $('tr:has(td.actions)').each(function () {
            var s = $(this).text().toLowerCase();
            $(this).closest('tr:has(td.actions)')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
        });
    });
</script>