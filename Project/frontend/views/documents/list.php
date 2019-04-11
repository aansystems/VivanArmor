
<?php
use yii\helpers\Html;
use frontend\models\MasterDocTemplates;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
$request = Yii::$app->request;
$id = $request->get('id');

$base_url = Yii::$app->request->baseUrl;
$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;

$this->title = 'My Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    html,
    body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
        height: 100%;
        font-family: 'Josefin Sans' !important;
    }
    .form-border{
        width:60%;
        margin:10% auto;
        border:1px solid black;
    }
    .document-form{
        margin: 4% auto;
        padding:2%;
    }
    .heading{
        font-weight:500;
    }

    .modal-content .modal-footer button {
        margin-left: 3px;
        padding-left: 16px;
        padding-right: 16px;
        width: auto;
    }

    .modal-header {
        background: linear-gradient(60deg, #2F80ED, #56CCF2);
        text-align: center;
        padding: 4px !important;
    }



    .form-group input[type=file] {
        opacity: 1;
        position: inherit;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 100;
    }
    .form-group.required .control-label:after { 
        color: #d00;
        content: "*";
        position: absolute;
        margin-left: 8px;
        top: 22%;
        font-size: 24px;
    }
    .form-group label.control-label {
        font-size: 14px;
        line-height: 1.07143;
        color: black;
        font-weight: 400;
        margin: 16px 0 0 0;
    }
    .row{
        margin:0;
    }
    .header-section{
        margin-top:2%;
    }
    .icons{
        font-size: 20px;
        margin: 15px;
    }
    textarea{
        margin-top:3px;
    }
    .form-group {
        padding-bottom: 7px;
        margin: 0;
    }
    td{
        text-align:center;
    }
    th{
        text-align:center;
    }
    .rejected{
        color:red;
    }
    .approved{
        color:green;
    }
    .pending{
        color:blue;
    }
    .hide{
        display:none;
    }
    .show{
        display:show;
    }
    @media (max-width:1600px){
        table.dataTable>tbody>tr>td 
        {
            padding: 3px !important;
        }
    }
    @media (max-width:1200px){
        .icons{
            font-size: 16px;
            margin-left: 15px;
            margin-right: 15px;
        }
    }
    @media (min-width:851px) and (max-width:1058px){
        .icons{
            margin-left: 9px !important;
            margin-right: 9px !important;
        }

    }
    @media (min-width:1201px) and (max-width:1121px){
        .icons{
            font-size: 14px;
            margin-left: 8px;
            margin-right: 8px;
        }
    }
    @media (min-width:671px) and (max-width:850px){
        .icons{
            font-size: 14px;
            margin-left: 4px;
            margin-right: 5px;
        }
        table.dataTable>tbody>tr>td:nth-of-type(5){
            padding-left: 19px !important;
        } 
    }
    @media (min-width:320px) and (max-width:670px){
        .btn.btn-fab.btn-fab-mini{
            margin-top: -10px;
        }
        .icons{
            font-size: 14px;
            margin-left: 3px !important;
            margin-right: 3px !important;
        }
    }
    table.dataTable>tbody>tr>td{
        text-align: left;
        padding-left: 30px !important;
    }
    .table>thead:first-child>tr:first-child>th{
        text-align: left;
        padding-left: 30px !important;
    }
    @media (min-width:851px) and (max-width:1600px){
        table.dataTable>tbody>tr>td:nth-of-type(5){
            padding-left: 0px !important;
        } 
    }

    .card .card-header1 {
        margin: -36px 15px 0;
    }
    .card{
        padding:12px 3px;
    }
    @media (max-width:1157px){
        .btn-margin{
            margin-left: 13px !important;
        }
        .btn-padding{
            padding: 9px 1px 4px 1px !important;
        }
    }
    .btn-padding{
        padding: 12px 1px 7px 1px;
    }
    .btn.btn-danger{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
    }
    .btn.btn-success{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
    }

    .table.dataTable>thead>tr>th {
        border: none;
        padding-bottom: 0px !important;
    }

    .modal .close {
        font-size: 40px;
        font-weight: 300;
    }
    @media (max-width:767px){
        .container-fluid{
            margin-top: 50px !important;
        }
    }
    tbody {
        display:block;
        height:60vh;
        overflow-y:auto;
    }
    thead, tbody tr {
        display:table;
        width:100%;
        table-layout:fixed;/* even columns width , fix width of table too*/
    }
    .content-wrapper{
        min-height:50vh !important;
    }
    .text-green{
        color:green;
        text-align:center;
        margin-right:5px;
    }
    .text-red{
        color:red;
        text-align:center;
        margin-right:5px;
    }
    .text-blue{
        color:blue;
        text-align:center;
        margin-right:5px;
    }
    .text-orange{
        color:orange;
        text-align:center;
        margin-right:5px;
    }
</style>
<?php
$document_rol_type = MasterDocTemplates::find()->select(['id', 'template_name'])->all();
?>
<div class="content" id="questions-module">
    <div class="container-fluid"  id="Table1">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">MY DOCUMENTS</h4>
                    </div>
                    <div class="card-content grid-view col-md-12" style="overflow-x: auto !important;">
                        <table class="table table-striped table-no-bordered table-hover dataTable dtr-inline">     
                            <thead>
                                <tr class="text-rose">
                                    <th style="width: 5%;">#</th>
                                    <th>Document Name</th>
                                    <th>Document Type</th>
                                    <th>Status</th>
                                    <th class="action-column" style="text-align:left!important;">Actions</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th><input type="text" class="form-control" id="doc-name" placeholder="Search"></th>
                                    <th>                                          
                                        <?=
                                        Html::dropDownList('select-id', ['class' => 'Document-Type'], ArrayHelper::map(MasterDocTemplates::find()->all(), 'id', 'template_name' ), ['prompt' => 'All', 'id' => 'user_dropdown', 'class' => 'form-control']
                                        );
                                        ?>                                         
                                    </th>
                                    <th><input type="text" class="form-control" id="status" placeholder="Search"></th>
                                    <th></th>
                                </tr>
                            </thead>                         
                            <tbody id ="document_type">                                   
                                <?php if (!empty($result) || !empty($data1)) { ?>
                                    <?php
                                    $i = 1;
                                    foreach ($result as $value) {
                                        $document_type = MasterDocTemplates::findOne(['id' => $value['document_type']])->template_name;
                                        ?>                                         
                                        <tr data-key="<?= $value['id'] ?>" id ="document_list" >
                                            <td style="width: 5%;"><?= $i ?></td>
                                            <td class="docname"><?= $value['document_name'] ?>
                                            </td>
                                            <td><?= $document_type ?></td>
                                            <td class="status_type" >    
                                                <?php if ($value['status'] == "1") { ?>
                                                    <span class="text-green">Approved</span><a href="#"  data-toggle="modal5" data-target="#comment<?= $value['id'] ?>"></a>
                                                <?php } elseif ($value['status'] == "0") { ?>
                                                    <span class="text-red">Rejected</span><a id="comment_reject" data-toggle="modal6" data-target="#comment_reject"></a>                                                       
                                                <?php } elseif ($value['status'] == "3") { ?>
                                                    <span class="text-blue">Finalized</span><a id="comment_reject" data-toggle="modal6" data-target="#comment_reject"></a>
                                                <?php } else { ?>
                                                    <span class="text-orange">Action Pending</span><a id="comment_reject" data-toggle="modal6" data-target="#comment_reject"></a>
                                                <?php } ?>
                                            </td>      
                                            <td style="vertical-align:middle;margin:2px;">
                                                <a style="margin-left:12px;" href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $value['file_name'] ?>" target="_blank"><button class="btn btn-info my-btn btn-padding" style="width: 80px; margin-bottom: 10px;">View</button></a>
                                                <a id="deleteModal<?= $value['id'] ?>" data-toggle="modal<?= $value['id'] ?>" data-target="#deleteModal<?= $value['id'] ?>"><button class="btn btn-margin btn-info my-btn btn-padding" style="background-color:#e91e63;;width:80px;margin-bottom: 10px;">Delete</button></a>
                                                <?php
                                                Modal::begin([
                                                    'header' => '<h3 style="margin:0px !important;color:#fff;">Confirmation</h3>',
                                                    'id' => 'modal'.$value['id'],
                                                    'size' => '',
                                                ]);
                                                echo "<div id='modalContent'></div>"
                                                . "<p>Are you sure you want to delete?</p>";
                                                echo "<div class='modal-footer'>";
                                                echo "<a href='#' data-dismiss='modal'>";
                                                echo "<button type='button' class='btn btn-danger' style='padding: 10px 6px 6px 6px !important;'>Close"
                                                . "</button>";
                                                echo "</a>";
                                                echo "<a href=" . Yii::$app->request->baseUrl . "/documents/deletetwo?id=" . $value['id'] . " data-method='post'>"
                                                . "<button type='button' class='btn btn-success' style='padding: 10px 6px 6px 6px !important;'>Delete</button>"
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
                                    <tr class="empty">
                                        <td style="vertical-align: middle; margin:2px; text-align:center" colspan="5" class="text-center">No Records Found</td>
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

<?php
$script = <<< JS
    $('#user_dropdown').change(function () { 
        var dropdown_value = $(this).val();        
        if( dropdown_value == "") {
            window.location.reload(true);
        }        
        else {
            $.get('templates', {dropdown_value}, function(data) {      
                $('#document_type').html('');
                $('#document_type').append(data);
            }); 
        }
    });
           
   $("#status").on("keyup", function () {
        var g = $(this).val().toLowerCase();
        if(g == 0){
            location.reload();
        } 
        else {        
            $('tr:has(td.status_type)').each(function () {
                var s = $(this).text().toLowerCase();
                $(this).closest('tr:has(td.status_type)')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();
            });
                var numOfVisibleRows = $('tr:visible').length;
                if(numOfVisibleRows-1 == 0){
                    $('#document_type').html('<tr> <td style="vertical-align: middle; margin:2px; text-align:center" colspan="5" class="text-center">No Records Found</td></tr>');
                }
        }
    });
        
    $("#doc-name").on("keyup", function () {
        var g = $(this).val().toLowerCase();
        if(g == 0){
            location.reload();
        }
        else { 
            $('tr:has(td.docname)').each(function () {
                var s = $(this).text().toLowerCase();
                $(this).closest('tr:has(td.docname)')[ s.indexOf(g) !== -1 ? 'show' : 'hide' ]();   
            });
                var numOfVisibleRows = $('tr:visible').length;
                if(numOfVisibleRows-1 == 0){
                    $('#document_type').html('<tr> <td style="vertical-align: middle; margin:2px; text-align:center" colspan="5" class="text-center">No Records Found</td></tr>');
                }
        }
    });  
JS;
$this->registerJs($script);
?>
