<?php


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
table.dataTable > thead:first-child > tr:first-child > th:nth-child(3),
table.dataTable > thead:first-child > tr:first-child > th:nth-child(4),
table.dataTable > thead:first-child > tr:first-child > th:nth-child(5),
table.dataTable > thead:first-child > tr:first-child > th:nth-child(6)
{
   /*width: 1% !important;*/
   padding-right: 8% !important; 
}
@media (max-width:1600px){
.table.dataTable .td-actions .btn
{
    padding: 3px !important;
}
}

.card  {
    padding: 15px 20px;
}

h3, .h3 {
  
    margin: 33px 0 10px;
}

.card .card-header1 {
    
    margin: -38px -4px 0;
}

  .table.dataTable>thead>tr>th {
    border: none;
    padding-bottom: 20px !important;
}
@media (max-width: 767px){
    .content {
    margin-top: 25px;
}
}
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title"> CERTIFICATES </h4>
                        <a href="<?= Yii::$app->request->baseUrl ?>/uploaded-certificates/create">
                            <button type="button" class="btn btn-primary btn-round btn-fab btn-fab-mini pull-right ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>
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
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/index?sort=certificate_name" data-sort="certificate_name">Certificate</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/index?sort=certifying_authority" data-sort="certifying_authority">Certifying Authority</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/index?sort=certificate_no" data-sort="certificate_no">Certificate Number</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/index?sort=issue_date" data-sort="issue_date">Issue Date</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/index?sort=expire_date" data-sort="expire_date">Expire Date</a></th>
                                                            <th><a href="<?= Yii::$app->request->baseUrl ?>/certificates/index?sort=Status" data-sort="Status">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status</a></th>
                                                            <th class="action-column" style="padding-right: 5% !important;">&nbsp;&nbsp;&nbsp;&nbsp;Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                           <?php if(!empty($data) || !empty($data1)){ ?>
                                                        <?php foreach ($data as $value) { ?>
            
                                                            <tr data-key="<?= $value->id ?>">
                                                                <td><?= $i ?></td>
                                                                <td><?= $value->certificate_name ?></td>
                                                                <td><span><img src="<?= Yii::$app->request->baseUrl ?>/images/LMSLogo-small.png" alt="vivaan"></span></td>
                                                                <td><?= $value->certificate_no ?></td>
                                                                <td><?= $value->issue_date ?></td>
                                                                <td><?= $value->expire_date ?></td>                         
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

                                                    <?php foreach ($data1 as $value) { ?>
                                                        <tr data-key="<?= $value->id ?>">
                                                            <td><?= $i ?></td>
                                                            <td><?= $value->certificate_name ?></td>
                                                            <td><?= $value->certifying_authority ?></td>
                                                            <td><?= $value->certificate_no ?></td>
                                                            <td><?= $value->issue_date ?></td>
                                                            <td><?= $value->expire_date ?></td>                         
                                                            <td><div id="DateCountdowns<?= $value->id ?>" data-date="<?= $value->expire_date ?> 00:00:00" style="width: 100px; height: 100px; padding: 0px; box-sizing: border-box;"></div></td>
                                                        <script> $("#DateCountdowns<?= $value->id ?>").TimeCircles({time: {Hours: {show: false}, Minutes: {show: false}, Seconds: {show: false}}});
                                                            $("#DateCountdowns<?= $value->id ?>").TimeCircles({
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
                                                            <a href="<?= Yii::$app->request->baseUrl ?>/uploaded-certificates/view?id=<?= $value->id ?>" title="view"><div class="btn btn-primary btn-simple waves-effect"><span class="fa fa-eye"></span> </div></a>
                                                            <a href="<?= Yii::$app->request->baseUrl ?>/uploaded-certificates/update?id=<?= $value->id ?>" title="update"><div class="btn btn-success btn-simple waves-effect"><span class="fa fa-edit"></span></div></a>
                                                            <a href="<?= Yii::$app->request->baseUrl ?>/uploaded-certificates/delete?id=<?= $value->id ?>" title="delete" data-method="post"><div class="btn btn-danger btn-simple waves-effect"><span class="fa fa-close"></span></div></a>
                                                        </td>
                                                        </tr>
                                                        
                                                       
                                                           <?php $i++ ?>
                                                    <?php } ?>
                                                        
                                                         <?php } else { ?>
                                                        <tr>
                                                            <td style="vertical-align: middle; margin:2px" colspan="8" class="text-center">No Records Found</td>
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