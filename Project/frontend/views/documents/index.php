<?php

use yii\helpers\Html;
use frontend\models\User;
use frontend\models\MasterDocTemplates;
use frontend\models\AssignedDocuments;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\dialog\Dialog;

$request = Yii::$app->request;
$id = $request->get('id');

$this->title = 'Work Flow';

echo Dialog::widget([
    'options' => [
        'title' => 'Your Attention !',
    ]
]);
echo Dialog::widget();
?>


<style>

    #modal-content .modal-header {
        border-bottom: none;
        padding-top: 0px;
        padding-right: 24px;
        padding-bottom: 0;
    }

    .container-fluid {
        min-height: 0 !important;
    }    

    .modal-header{
        background: linear-gradient(60deg, #2F80ED, #56CCF2);
        text-align: center;
    }




    .card {
        margin: 15px 0 0 0;
    }


    .my-templates-tab {
        text-align: center;
        padding:15px 0;
        background-color: #eee;
        box-shadow: 0 0 0 1px #ddd;
        top:15px;	
        transition: top .2s;
    }

    .my-templates-tab.active {
        top:0;
        transition:top .2s;
    }

    .whiteBlock {
        display:none;
    }

    .my-templates-tab.active .whiteBlock {
        display:block;
        height:2px;
        bottom:-2px;
        background-color:#fff;
        width:99%;
        position:absolute;
        z-index:1;
    }

    .my-templates-tab a {
        font-size:1.65em;
        font-weight:300;
        transition:.2s;
        color:#333;
    }

    .my-templates-tabs {
        border-bottom:2px solid #ddd;
        margin: 15px 0 0;
    }

    li.my-templates-tab a {
        padding-top: 10px;
        top:-15px;
        padding-bottom:0;
    }

    li.my-templates-tab.active a {
        padding-top: inherit;
    }

    .my-templates-tab .fa {
        font-size: 40px;
        width:100%;
        padding: 15px 0 5px;
        color:#666;
    }

    .my-templates-tab.active .fa {
        color: #cfb87c;
    }

    .my-templates-tab a:focus {
        outline:none;
    }

    .my-templates-tabContent {
        border-color: transparent;
        box-shadow: 0 -2px 0 -1px #fff, 0 0 0 1px #ddd;
        position:relative;
        background-color:#fff;
    }

    .nav-tabs > li.my-templates-tab.active > a, 
    .nav-tabs > li.my-templates-tab.active > a:focus,
    .nav-tabs > li.my-templates-tab.active > a:hover {
        border-width:0;
    }

    .nav-tabs > li.my-templates-tab:hover {
        background-color:#f9f9f9;
        box-shadow: 0 0 0 1px #ddd;
    }

    .nav-tabs > li.my-templates-tab.active:hover {
        background-color:#fff;
        box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
    }

    .nav-tabs > li.my-templates-tab:hover a {
        border-color:transparent;
    }

    .nav.nav-tabs .my-templates-tab a[data-toggle="tab"] {
        background-color:transparent;
        border-bottom:0;
    }

    .nav-tabs > li.my-templates-tab:hover a {
        border-right: 1px solid transparent;
    }

    .nav-tabs > li.my-templates-tab > a {
        margin-right: 0;
        border-top: 0;
        padding-bottom: 10px;
        margin-bottom: -20px;
    }

    .nav-tabs > li.my-templates-tab {
        margin-right:0;
        margin-bottom:0;
    }

    .nav-tabs > li.my-templates-tab:last-child a {
        border-right: 1px solid transparent;
    }

    .nav-tabs > li.my-templates-tab.active:last-child {
        border-right: 0px solid #ddd;
        box-shadow: 0px 2px 0 0px #fff, 0px 0px 0 1px #ddd;
    }

    .my-templates-tab:last-child {
        box-shadow: 0 0 0 1px #ddd;
    }

    .tabs .nav-tabs li.my-templates-tab.active a {
        box-shadow:none;
        top:0;
    }

    .my-templates-tab.active {
        background: #fff;
        box-shadow: 1px 1px 0 1px #fff, 0 0px 0 1px #ddd, -1px 1px 0 0px #ddd inset;
        padding-bottom:0px;
    }

    .arrow-down {
        display:none;
        width: 0;
        height: 0;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        border-top: 22px solid #ff8d00;
        position: absolute;
        top: -1px;
        left: calc(50% - 20px);
    }

    .arrow-down-inner {
        width: 0;
        height: 0;
        border-left: 18px solid transparent;
        border-right: 18px solid transparent;
        border-top: 12px solid #fff;
        position: absolute;
        top: -22px;
        left: -18px;
    }

    .my-templates-tab.active .arrow-down {
        display: block;
    }

    @media (max-width: 1200px) {

        .my-templates-tab .fa {
            font-size: 36px;
        }

        .my-templates-tab .hidden-xs {
            font-size:22px;
        }
        #slide img {
    height: 180px !important;
}
    }


    @media (max-width: 992px) {
        .my-templates-tab .fa {
            font-size: 33px;
        }

        .my-templates-tab .hidden-xs {
            font-size:18px;
            font-weight:normal;
        }
          #slide img {
    height: 160px !important;
}
    }


    @media (max-width: 767px) {
.container-fluid{
            margin-top: 20px;
        }
        .my-templates-tab > a {
            font-size:18px;
        }

        .nav > li.my-templates-tab > a {
            padding:15px 0;
            margin-bottom: 0px;
        }

        .my-templates-tab .fa {
            font-size:30px;
        }

        .nav-tabs > li.my-templates-tab > a {
            border-right:1px solid transparent;
            padding-bottom:0;
        }

        .my-templates-tab.active .fa {
            color: #333;
        }
        .btn {
            margin: 3px 1px;
            padding: 9px 10px 5px 10px !important;
        }
    }

    .nav-tabs {
        background: none !important;
        padding: 0;
    }

    .my-templates-tab img {
        width: 100px;
    }

    .nav-tabs > li > a, .nav-tabs > li > a:hover, .nav-tabs > li > a:focus {
        color: #656565 !important;
    }

    .my-templates-tab h6 {
        padding: 2%;
        font-weight: 500;
    }

    .btn {
        margin: 3px 1px;

    }

    .card {

        margin: 60px 0;
    } 



    .modal .close {
        font-size: 45px;
    }

    .modal-content .modal-footer button {
        margin: 3px;
    }
    @media (max-width: 767px) and (min-width: 320px){
        ul, ol, li {
            margin-left: 0px !important; 
        }
        .nav-tabs > li.my-templates-tab{
            margin-bottom: -18px;
        }
        .dataTable th{
            font-size: 12px !important;
        }
    }
    @media (max-width: 569px) and (min-width: 320px){
        h6{
            font-size: 0.8em;
        }
        .my-templates-tab img {
            width: 70px !important;
        }
        .btn.btn-info{
            padding: 12px 1px 7px 1px !important;
            width: 80px !important;
        }
        .btn.btn-success{
            padding: 12px 1px 7px 1px !important;
            width: 100px !important;
        }
        h4 {
    font-size: 1.0em !important;
}
#slide img {
    height: 80px !important;
}
    }
    h4{
        margin-top: -5px !important;
        margin-bottom: 0px !important;   
    }
    .card .card-header1{
        padding: 20px 1px 9px 10px !important;
    }
    .btn.btn-danger{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
    }
    .btn-delete{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
    }

    h4 {
        font-size: 1.3em;
    }
    @media (max-width: 400px) and (min-width: 320px){
        .btn, .navbar .navbar-nav > li > a.btn {
            font-size: 12px !important;
        }
    }
    .modal-header{
        margin-top: 0px !important;
        color:#fff;
    }
    .pending_with_others{
        margin-top: 50px !important;  

    }
    @media (max-width: 1950px) and (min-width: 1500px){
        .btn.btn-info{
            margin-right: 35% !important;
            margin-left: 30% !important;
        }
        .btn.btn-success{
            margin-right: 35% !important;
            margin-left: 30% !important;
        }
        .btn.btn-danger{
            margin-right: 35% !important;
            margin-left: 30% !important;
        }
        
        .table>thead:first-child>tr:first-child>th:nth-of-type(7){
            text-align: center;
        }
    }
    #slide img {
    height: 200px;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header1 card-header-text" data-background-color="blue">
                    <h4 class="card-title text-uppercase">Work Flow</h4>
                </div>
                <div class="card-content"> 
                    <section id="my-templates-tabWidget" class="tabs t-tabs">
                        <ul class="nav nav-tabs my-templates-tabs" role="tablist">
                            <li class="tab my-templates-tab active">
                                <div class="arrow-down">
                                    <div class="arrow-down-inner"></div>
                                </div>	
                                <a id="tab0" href="#my-templates-tab-0" role="tab" aria-controls="my-templates-tab-0" aria-selected="true" data-toggle="tab" tabindex="0">
                                    <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/add-document.png"> <br/>
                                    <h6>Create Document</h6>
                                </a>
                                <div class="whiteBlock"></div>
                            </li>

                            <li class="tab my-templates-tab">
                                <div class="arrow-down"><div class="arrow-down-inner"></div></div>
                                <a id="tab1" href="#my-templates-tab-1" role="tab" aria-controls="my-templates-tab-1" aria-selected="true" data-toggle="tab" tabindex="0">
                                    <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/pending-with-me.png">
                                    <h6>Pending With Me</h6>
                                </a>
                                <div class="whiteBlock"></div>
                            </li>

                            <li class="tab my-templates-tab">
                                <div class="arrow-down"><div class="arrow-down-inner"></div></div>
                                <a id="tab2" href="#my-templates-tab-2" role="tab" aria-controls="my-templates-tab-2" aria-selected="true" data-toggle="tab" tabindex="0">
                                    <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/pending-with-others.png">
                                    <h6>Pending With Others</h6>
                                </a>
                                <div class="whiteBlock"></div>
                            </li>
                        </ul>

                        <div id="my-templates-tab-content" class="tab-content my-templates-tabContent" aria-live="polite">
                            <div class="tab-pane fade active in" id="my-templates-tab-0" role="tabpanel" aria-labelledby="tab0" aria-hidden="false" tabindex="0">
                                <div>
                                    <div class="row">
                                        <div class="col-md-12 text-center"> <br/>
                                            <h4 class="text-uppercase text-bold">Features of Document Manager</h4>
                                            <div id="slide">
                                                <div>
                                                    <img src="<?= Yii::$app->request->baseUrl ?>/images/document-manager/Library-Design.png" width="300px"/>
                                                </div>

                                                <div>
                                                    <img src="<?= Yii::$app->request->baseUrl ?>/images/document-manager/Workflow-Design.png" width="300px"/>
                                                </div>

                                                <div>
                                                    <img src="<?= Yii::$app->request->baseUrl ?>/images/document-manager/Manager-Design.png" width="300px"/>
                                                </div>
                                            </div>  
                                            <br/>
                                            <a href="<?= Yii::$app->request->baseUrl ?>/documents/create"><button type="button" class="btn btn-md btn-success">CREATE NOW !</button></a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="my-templates-tab-1" role="tabpanel" aria-labelledby="tab1" aria-hidden="true" tabindex="0"><br/><br/>
                                <div class="row">
                                    <div class="col-md-12" style="overflow-x: auto;">
                                        <table class="table table-striped table-no-bordered table-hover dataTable dtr-inline me" style="margin-top:400px;">
                                            <?php $i = 1 ?>
                                            <thead>
                                                <tr class="text-rose">
                                                    <th style="width: 4%;">#</th>
                                                    <th>Document Name</th>
                                                    <th>Document Type</th>
                                                    <th>Author</th>
                                                    <th>Status</th>
                                                    <th>Workflow Expiry Date</th>

                                                    <th class="action-column">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($result) || !empty($result2)) { ?>
                                                    <?php
                                                    foreach ($result as $value) {
                                                        $comments = AssignedDocuments::findOne(['document_id' => $value['document_id']])->comment;

                                                        $assign_name = User::findOne(['id' => $value['assigned_to']])->email;
                                                        $user_email = User::findOne(['id' => Yii::$app->user->identity->id])->email;

                                                        $document_type = MasterDocTemplates::findOne(['id' => $value['document_type']])->template_name;

                                                        if ($value['status'] == 0 || $value['status'] == 1) {
                                                            ?>
                                                            <tr data-key="<?= $value['id'] ?>">
                                                                <td><?= $i ?></td>

                                                                <td><?= $value['document_name'] ?></td>
                                                                <td><?= $document_type ?></td>
                                                                <td><?= $user_email ?></td>
                                                                <td>
                                                                    <?php if ($value['status'] == "1") { ?>

                                                                        <span style="color:green;text-align:center;margin-right:5px;">Approved By <?= $assign_name ?></span><a href="#"  data-toggle="modal5" data-target="#comment<?= $value['document_id'] ?>"><i id="comment<?= $value['document_id'] ?>" class="fa fa-envelope" title="click her to view comment" aria-hidden="true"></i></a>
                                                                        <?php
                                                                        Modal::begin([
                                                                            'header' => '<h4>Approved Comments</h4>',
                                                                            'id' => 'modal5',
                                                                            'size' => '200px',
                                                                        ]);
                                                                        echo "<div id='modalContent'></div>"
                                                                        . "<p class='comments'></p>";
                                                                        Modal::end();
                                                                        ?>
                                                                        <script>
                                                                            $(function () {
                                                                                $("#comment<?= $value['document_id'] ?>").click(function () {

                                                                                    $('#modal5').modal('show')


                                                                                            .find('#modalContent')
                                                                                    $(".comments").html('<?= ucfirst($comments) ?>');
                                                                                });
                                                                            });
                                                                        </script>

                                                                    <?php } else { ?>
                                                                        <span style="color:red;text-align:center;margin-right:5px;">Rejected By <?= $assign_name ?></span><a id="comment_reject" data-toggle="modal6" data-target="#comment_reject"><i  title="click her to view comment" class="fa fa-envelope" aria-hidden="true"></i></a>
                                                                        <?php
                                                                        Modal::begin([
                                                                            'header' => '<h4>Reject Comments</h4>',
                                                                            'id' => 'modal6',
                                                                            'size' => '',
                                                                        ]);
                                                                        echo "<div id='modalContent'></div>"
                                                                        . "<p>$comments</p>";
                                                                        ;
                                                                        Modal::end();
                                                                        ?>
                                                                        <script>
                                                                            $(function () {
                                                                                $("#comment_reject").click(function () {
                                                                                    $('#modal6').modal('show')
                                                                                            .find('#modalContent')
                                                                                    $(".comments").html('<?= ucfirst($comments) ?>');
                                                                                });
                                                                            });
                                                                        </script>

                                                                    <?php }
                                                                    ?>
                                                                </td>

                                                                <td><div id="DateCountdown<?= $value['id'] ?>" data-date="<?= $value['workflow_expiry_date'] ?> 24:00:00" style="width: 100px; height: 100px; padding: 0px; box-sizing: border-box;"></div></td>
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

                                                        <td style="vertical-align:middle;margin:2px;">
                                                            <?= Html::button('Assign to', ['value' => Url::to(Yii::$app->request->baseUrl . '/documents/assign-to?id=' . $value['document_id']), 'class' => 'btn btn-info my-btn', 'style' => 'padding: 12px 1px 7px 1px !important; width:80px;margin-bottom: 1px;', 'id' => 'assignModal' . $value['id']]); ?>

                                                            <?php
                                                            Modal::begin([
                                                                'header' => '<h4 class="modal-header">Assign to</h4>',
                                                                'id' => 'modal10',
                                                                'size' => '',
                                                            ]);
                                                            echo "<div id='modalContent'></div>";
                                                            Modal::end();
                                                            ?>
                                                            <script>
                                                                $(function () {
                                                                    $("#assignModal<?= $value['id'] ?>").click(function () {
                                                                        $('#modal10').modal('show')
                                                                                .find('#modalContent')
                                                                                .load($(this).attr('value'));
                                                                    });
                                                                });
                                                            </script>


                                                            <?= Html::button('Finalize', ['value' => Url::to(Yii::$app->request->baseUrl . '/documents/finalize?id=' . $value['document_id']), 'class' => 'btn btn-success my-btn', 'style' => 'padding: 12px 1px 7px 1px !important; width:80px;margin-bottom: 1px;', 'id' => 'finalizeModal' . $value['id']]); ?>
                                                            <?php
                                                            Modal::begin([
                                                                'header' => '<h4 class="modal-header">Finalize Document</h4>',
                                                                'id' => 'modal9',
                                                                'size' => '',
                                                            ]);
                                                            echo "<div id='modalContent'></div>";
                                                            Modal::end();
                                                            ?>
                                                            <script>
                                                                $(function () {
                                                                    $("#finalizeModal<?= $value['id'] ?>").click(function () {
                                                                        $('#modal9').modal('show')
                                                                                .find('#modalContent')
                                                                                .load($(this).attr('value'));
                                                                    });
                                                                });
                                                            </script>                       
                                                            <a id="deleteModal<?= $value['document_id'] ?>" data-toggle="modal_1" data-target="#deleteModal<?= $value['document_id'] ?>"><button class="btn btn-margin btn-info my-btn btn-padding btndelete" style="padding: 12px 1px 7px 1px !important;background-color:#f44336;;width:80px;margin-bottom: 1px;">Delete</button></a>
                                                            <?php
                                                            Modal::begin([
                                                                'header' => '<h4>Confirmation</h4>',
                                                                'id' => 'modal_1',
                                                                'size' => '',
                                                            ]);
                                                            echo "<div id='modalContent'></div>"
                                                            . "<p>Are you sure you want to delete?</p>";
                                                            echo "<div class='modal-footer'>";
                                                            echo "<a href='#' data-dismiss='modal'>";
                                                            echo "<button type='button' class='btn btn-danger' >Close" . "</button>";
                                                            echo "</a>";
                                                            echo "<a href=" . Yii::$app->request->baseUrl . "/documents/delete?id=" . $value['document_id'] . " data-method='post'>"
                                                            . "<button type='button' class='btn btn-success btn-delete' >Delete</button>"
                                                            . "</a>"
                                                            . "</div>";
                                                            Modal::end();
                                                            ?>
                                                            <script>
                                                                $(function () {
                                                                    $("#deleteModal<?= $value['document_id'] ?>").click(function () {
                                                                        $('#modal_1').modal('show')
                                                                                .find('#modalContent')
                                                                                .load($(this).attr('value'));
                                                                    });
                                                                });
                                                            </script>  


                                                        </td>
                                                        <?php $i++ ?>
                                                        </tr>


                                                        <?php
                                                    }
                                                }
                                                ?>
                                            <?php } else { ?>
                                                <tr>

                                                    <td style="vertical-align:middle;margin:2px;" colspan="8" class="text-center">

                                                        No Records Found
                                                    </td>




                                                </tr>

                                                <?php
                                            }
                                            ?>
                                            <?php if (!empty($result2) || !empty($result)) { ?>
                                                <?php
                                                foreach ($result2 as $value) {
                                                    $file_name = $value['file_name'];




                                                    $email_id = User::findOne(['id' => $value['user_id']])->email;
                                                    $document_type = MasterDocTemplates::findOne(['id' => $value['document_type']])->template_name;
                                                    ?>
                                                    <tr data-key="<?= $value['id'] ?>">
                                                        <td><?= $i ?></td>

                                                        <td><?= $value['document_name'] ?></td>
                                                        <td><?= $document_type ?></td>
                                                        <td><?= $email_id ?></td>
                                                        <td>Action Pending</td>                       
                                                        <td><div id="DateCountdown<?= $value['id'] ?>" data-date="<?= $value['workflow_expiry_date'] ?> 24:00:00" style="width: 100px; height: 100px; padding: 0px; box-sizing: border-box;"></div></td>
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

                                                    <td style="vertical-align:middle;margin:2px;">

                                                        <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $value['file_name'] ?>" target="_blank"><button class="btn btn-info my-btn" style="padding: 12px 1px 7px 1px !important;width:80px;margin: 3px 1px;">View</button></a>
                                                        <?php
                                                        Modal::begin([
                                                            'header' => '<h4>Document View</h4>',
                                                            'id' => 'modal8',
                                                            'size' => 'modal-lg',
                                                        ]);
                                                        echo "<div id='modalContent'></div>"
                                                        . '<iframe src="../uploads/uploaded_Documents/' . $file_name . '.pdf#toolbar=0" width="100%" height="450px"></iframe>';
                                                        Modal::end();
                                                        ?>
                                                        <script>
                                                            $(function () {
                                                                $("#DocViewModal<?= $value['id'] ?>").click(function () {
                                                                    $('#modal8').modal('show')
                                                                            .find('#modalContent')
                                                                            .load($(this).attr('value'));
                                                                });
                                                            });
                                                        </script>                         
                                                        <?= Html::button('Approve', ['value' => Url::to(Yii::$app->request->baseUrl . '/documents/approve?id=' . $value['document_id']), 'class' => 'btn btn-success my-btn', 'style' => 'padding: 12px 1px 7px 1px  !important;;width:80px;margin-bottom: 1px;', 'id' => 'approveModal' . $value['id']]); ?>

                                                        <?php
                                                        Modal::begin([
                                                            'header' => '<h4 class="modal-header">Approve With Comment</h4>',
                                                            'id' => 'modal1',
                                                            'size' => '',
                                                        ]);
                                                        echo "<div id='modalContent'></div>";
                                                        Modal::end();
                                                        ?>
                                                        <script>
                                                            $(function () {
                                                                $("#approveModal<?= $value['id'] ?>").click(function () {
                                                                    $('#modal1').modal('show')
                                                                            .find('#modalContent')
                                                                            .load($(this).attr('value'));
                                                                });
                                                            });
                                                        </script>

                                                        <?= Html::button('Reject', ['value' => Url::to(Yii::$app->request->baseUrl . '/documents/reject?id=' . $value['document_id']), 'class' => 'btn btn-danger my-btn', 'style' => 'padding: 12px 1px 7px 1px  !important;width:80px;margin-bottom: 1px;', 'id' => 'rejectModal' . $value['id']]); ?>

                                                        <?php
                                                        Modal::begin([
                                                            'header' => '<h4 class="modal-header">Reject With Comment</h4>',
                                                            'id' => 'modal2',
                                                            'size' => '',
                                                        ]);
                                                        echo "<div id='modalContent'></div>";
                                                        Modal::end();
                                                        ?>
                                                        <script>
                                                            $(function () {
                                                                $("#rejectModal<?= $value['id'] ?>").click(function () {

                                                                    $('#modal2').modal('show')
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

                                                    <td style="vertical-align:middle;margin:2px;display:none" colspan="8" class="text-center">

                                                        No Results Found1
                                                    </td>



                                                    <?php $i++ ?>
                                                </tr>

                                                <?php
                                            }
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="my-templates-tab-2" role="tabpanel" aria-labelledby="tab2" aria-hidden="true" tabindex="0">
                                <div class="row">
                                    <div class="col-md-12 pending_with_others" style="overflow-x: auto;">
                                        <table class="table table-striped table-no-bordered table-hover dataTable dtr-inline others">
                                            <?php $i = 1 ?>
                                            <thead>
                                                <tr class="text-rose">
                                                    <th style="width: 4%;">#</th>
                                                    <th>Document Name</th>
                                                    <th>Document Type</th>
                                                    <th>Author</th>
                                                    <th>Assigned To</th>
                                                    <th style="width:100px;">Status</th>
                                                    <th>Workflow Expiry Date</th>
                                                    <th class="action-column">Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if (!empty($result3)) { ?>

                                                    <?php
                                                    foreach ($result3 as $value) {



                                                        $email = User::findOne(['id' => $value['assigned_to']])->email;
                                                        $user_email = User::findOne(['id' => Yii::$app->user->identity->id])->email;
                                                        $document_type = MasterDocTemplates::findOne(['id' => $value['document_type']])->template_name;
                                                        ?>


                                                        <tr data-key="<?= $value['id'] ?>">
                                                            <td><?= $i ?></td>
                                                            <td><?= $value['document_name'] ?></td>
                                                            <td><?= $document_type ?></td>
                                                            <td><?= $user_email ?></td>
                                                            <td><?= $email; ?></td>
                                                            <td>Waiting</td>
                                                            <td><div id="DateCountdown<?= $value['id'] ?>" data-date="<?= $value['workflow_expiry_date'] ?> 24:00:00" style="width: 100px; height: 100px; padding: 0px; box-sizing: border-box;"></div></td>
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
                                                        });
                                                    </script>

                                                    <td style="vertical-align:middle;margin:2px;">

                                                        <a style="margin-left:12px;" href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $value['file_name'] ?> " target="_blank"><button class="btn btn-info my-btn" style="padding: 12px 1px 7px 1px !important;width:80px;margin-bottom: 1px; margin-left:-15px !important;">View</button></a>
                                                    </td>
                                                    <?php $i++ ?>
                                                    </tr>


                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr>

                                                    <td style="vertical-align:middle;margin:2px;" colspan="8" class="text-center">

                                                        No Records Found
                                                    </td>



                                                    <?php $i++ ?>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                            </tbody>

                                        </table> 
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        var numItems = $('li.my-templates-tab').length;
        if (numItems == 12) {
            $("li.my-templates-tab").width('8.3%');
        }
        if (numItems == 11) {
            $("li.my-templates-tab").width('9%');
        }
        if (numItems == 10) {
            $("li.my-templates-tab").width('10%');
        }
        if (numItems == 9) {
            $("li.my-templates-tab").width('11.1%');
        }
        if (numItems == 8) {
            $("li.my-templates-tab").width('12.5%');
        }
        if (numItems == 7) {
            $("li.my-templates-tab").width('14.2%');
        }
        if (numItems == 6) {
            $("li.my-templates-tab").width('16.666666666666667%');
        }
        if (numItems == 5) {
            $("li.my-templates-tab").width('20%');
        }
        if (numItems == 4) {
            $("li.my-templates-tab").width('25%');
        }
        if (numItems == 3) {
            $("li.my-templates-tab").width('33.3%');
        }
        if (numItems == 2) {
            $("li.my-templates-tab").width('50%');
        }
    });

    $(window).load(function () {

        $('.my-templates-tabs').each(function () {

            var highestBox = 0;
            $('.my-templates-tab a', this).each(function () {

                if ($(this).height() > highestBox)
                    highestBox = $(this).height();
            });

            $('.my-templates-tab a', this).height(highestBox);

        });
    });
</script>



