<?php

use frontend\models\MasterDocTemplates;
use kartik\dialog\Dialog;
use frontend\models\User;

/* @var $this yii\web\View */
$request = Yii::$app->request;
$id = $request->get('id');
$this->title = 'Finalized Documents';

echo Dialog::widget([
    'options' => [
        'title' => 'Your Attention!',
    ]
]);
echo Dialog::widget();
?>
<!-- Internal CSS -->
<!-- To override the Dialog widget CSS -->
<style>
    @media screen and (min-width:1440px){
         .col-md-2 {
    width: 20% !important;
}
    }
    @media screen and (min-width:1071px) and (max-width:1439px){
       .col-md-2 {
    width: 25% !important;
}
    }
     @media screen and (min-width:831px) and (max-width:1070px){
       .col-md-2, .col-sm-2{
    width: 33%;
    float:left;
}
    }
     @media screen and (min-width:768px) and (max-width:830px){
       .col-md-2,.col-sm-2{
    width: 50% !important;
    float:left;
}
    }
    @media screen and (min-width:661px) and (max-width:767px){
       .col-md-2,.col-sm-2{
    width: 33% !important;
    float:left;
}
    }
    @media screen and (min-width:471px) and (max-width:660px){
       .col-md-2, .col-sm-2, .col-xs-2{
    width: 50% !important;
    float:left;
}
    }
    @media screen and (min-width:320px) and (max-width:470px){
       .col-md-2, .col-sm-2, .col-xs-2{
    width: 100% !important;
    float:left;
}
    }

    .final-header, .action-buttons button {
        width: 50px;
    }

    .final-header, .action-buttons button:hover, .action-buttons button:focus, .popover-title {
        background-image: linear-gradient(-20deg, #fc6076 0%, #ff9a44 100%) !important;
    }

    .finalized-block {
        background-image: linear-gradient(to top, #fff2e2 0%, #fffee8 99%, #ffffff 100%);
        box-shadow: 0 1px 4px 0 rgba(7, 7, 7, 0.27);
    }

    .finalized-block h6 {
        font-size: 14px;
        font-weight: 500;
        min-height: 65px;
        text-transform: capitalize;
    }

    .finalized-block .card-content {
        padding: 2%;
    }

    .action-buttons button {
        background: transparent;
        color: #fc6076;
        box-shadow: none;
    }

    .card .card-footer {
        margin: 0;
        padding: 0;
        border-top: 1px solid #FFFFFF;
        height: 40px;
    }

    .btn {
        margin: 5px 1px;
    }

    .col-md-2 {
        padding-left: 10px;
        padding-right: 10px;
    }

    .popover {
        width: 200px;
    }

    .popover-title {
        text-align: center;
        font-size: 14px;
        font-weight: 500;
        color: #FFFFFF;
        padding: 10px 15px 10px;
        text-transform: uppercase;
    }

    .popover-content {
        font-family: 'Josefin Sans';
         max-width:200px;
    word-wrap:break-word;
    }
    
    .container-fluid {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: 10px;
    min-height: 77vh !important;
    margin-top: 50px;
}
</style>

<?php
$document = MasterDocTemplates::find()->where(['id' => $id])->one();
?>

<div class="container-fluid">
    <div class="row">
        <div class=" col-md-12">
            <div class="card">
                <div class="card-header1 card-header-text" data-background-color="blue">
                    <h4 class="card-title text-uppercase"><?= $document->template_name ?></h4>
                </div>
                <div class="card-content">
                    <div class="row">
                        <?php
                        foreach ($data as $value){
                            $connection = Yii::$app->db;
                            $command3 = $connection->createCommand("
                                            SELECT user_id FROM `documents` INNER join approved_documents on documents.id= '" . $value['document_id'] . "'");
                            $doc_author = $command3->queryOne();
                            $author_name = User::findOne(['id' => $doc_author['user_id']])->email;

                            $file_name = explode('.', $value['file_name']);
                            $extension = (end($file_name));
                            ?>

                            <?php if ($value['assigned_for_download'] != NULL) { ?>
                                <?php if ($extension == 'DOCX' || $extension == 'docx' || $extension == 'DOC' || $extension == 'doc') { ?>

                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="card finalized-block text-center">
                                            <div class="card-header1 final-header" data-background-color="blue">
                                                <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/dms/word.png">
                                            </div>
                                            <div class="card-content">

                                                <h6  class="black-text course-name text-capitalize" style="margin-top: 15px !important;" ><?= $value['document_name'] ?></h6>
                                            </div>
                                            <div class="card-footer">
                                                <div class="action-buttons">

                                                    <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $value['file_name'] ?>" target="_blank" > <button class="btn btn-xs download-button doc" value="<?= Yii::$app->request->baseUrl ?>/documents/authenticate?id=<?= $value['document_type'] ?>" id='passwordModal<?= $value['document_id'] ?>' ><i class="fa fa-eye" aria-hidden="true"></i></button>                                   
                                                    </a>
                                                    <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $value['file_name'] ?>" target="_blank" > <button class="btn btn-xs download-button doc" value="<?= Yii::$app->request->baseUrl ?>/documents/authenticate?id=<?= $value['document_type'] ?>" id='download<?= $value['document_id']?>' ><i class="fa fa-download" aria-hidden="true"></i></button>                                   
                                                    </a>
                                                    <a data-toggle="popover" title="Author Information" data-placement="left" data-content="<b>Author</b>:<?= $author_name ?> <br/> <b>Security</b>:<?= $value['security'] ?> <br/> <b>Expiry date</b>:<?= $value['expiry_date'] ?> <br/> <b>Created date</b>:<?= $value['created_at'] ?>" data-html="true" data-trigger="focus">
                                                        <button class="btn btn-xs info-button"><i class="fa fa-info" aria-hidden="true"></i></button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="card finalized-block text-center">
                                            <div class="card-header1 final-header" data-background-color="blue">
                                                <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/dms/pdf.png">
                                            </div>
                                            <div class="card-content">
                                                <h6  class="black-text course-name text-capitalize" style="margin-top:15px !important" ><?= $value['document_name'] ?></h6>
                                            </div>
                                            <div class="card-footer">
                                                <div class="action-buttons">
                                                    <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $value['file_name'] ?>" target="_blank" > <button class="btn btn-xs download-button doc" value="<?= Yii::$app->request->baseUrl ?>/documents/authenticate?id=<?= $value['document_type'] ?>" id='passwordModal<?= $value['document_id'] ?>' ><i class="fa fa-eye" aria-hidden="true"></i></button>                                   
                                                    </a>
                                                    <a id='download<?= $value['document_id'] ?>' href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $value['file_name'] ?>" download > <button id='download<?= $value['document_id'] ?>' class="btn btn-xs download-button doc" value="<?= Yii::$app->request->baseUrl ?>/documents/authenticate?id=<?= $value['document_type'] ?>" id='download<?= $value['document_id'] ?>' ><i id='download<?= $value['document_id'] ?>' class="fa fa-download" aria-hidden="true"></i></button>                                   
                                                    </a>
                                                     <a data-toggle="popover" title="Author Information" data-placement="left" data-content="<b>Author</b>:<?= $author_name ?> <br/> <b>Security</b>:<?= $value['security'] ?> <br/> <b>Expiry date</b>:<?= $value['expiry_date'] ?> <br/> <b>Created date</b>:<?= $value['created_at'] ?>" data-html="true" data-trigger="focus">
                                                        <button class="btn btn-xs info-button"><i class="fa fa-info" aria-hidden="true"></i></button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?> 
                            <?php } else { ?>
                                <?php if ($extension == 'DOCX' || $extension == 'docx' || $extension == 'DOC' || $extension == 'doc') { ?>
                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="card finalized-block text-center">
                                            <div class="card-header1 final-header" data-background-color="blue">
                                                <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/dms/word.png">
                                            </div>
                                            <div class="card-content">
                                                <h6  class="black-text course-name text-capitalize" style="margin-top:15px !important" ><?= $value['document_name'] ?></h6>
                                            </div>
                                            <div class="card-footer">
                                                <div class="action-buttons">
                                                    <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $value['file_name'] ?>" download > <button id='passwordModal<?= $value['document_id'] ?>' class="btn btn-xs download-button doc" value="<?= Yii::$app->request->baseUrl ?>/documents/authenticate?id=<?= $value['document_type'] ?>" id='passwordModal<?= $value['document_id'] ?>' ><i class="fa fa-eye" aria-hidden="true"></i></button>                                   
                                                    </a>
                                                    <button class="btn btn-xs download-button" disabled><i class="fa fa-download" aria-hidden="true" ></i><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                    <a data-toggle="popover" title="Author Information" data-placement="left" data-content="<b>Author</b>:<?= $author_name ?> <br/> <b>Security</b>:<?= $value['security'] ?> <br/> <b>Expiry date</b>:<?= $value['expiry_date'] ?> <br/> <b>Created date</b>:<?= $value['created_at'] ?>" data-html="true" data-trigger="focus">
                                                        <button class="btn btn-xs info-button"><i class="fa fa-info" aria-hidden="true"></i></button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>


                                    <div class="col-md-2 col-sm-2 col-xs-2">
                                        <div class="card finalized-block text-center">
                                            <div class="card-header1 final-header" data-background-color="blue">
                                                <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/dms/pdf.png">
                                            </div>
                                            <div class="card-content">
                                                <h6  class="black-text course-name text-capitalize" style="margin-top:15px !important" ><?= $value['document_name'] ?></h6>
                                            </div>
                                            <div class="card-footer">
                                                <div class="action-buttons">
                                                    <a href="<?= Yii::$app->request->baseUrl ?>/uploads/uploaded_Documents/<?= $value['file_name'] ?>" target="_blank" > <button class="btn btn-xs download-button doc" value="<?= Yii::$app->request->baseUrl ?>/documents/authenticate?id=<?= $value['document_type'] ?>" id='passwordModal<?= $value['document_id'] ?>' ><i class="fa fa-eye" aria-hidden="true"></i></button>                                   
                                                    </a>
                                                    <button class="btn btn-xs download-button" disabled><i class="fa fa-download" aria-hidden="true"></i><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                    <a data-toggle="popover" title="Author Information" data-placement="left" data-content="<b>Author</b>:<?= $author_name ?> <br/> <b>Security</b>:<?= $value['security'] ?> <br/> <b>Expiry date</b>:<?= $value['expiry_date'] ?> <br/> <b>Created date</b>:<?= $value['created_at'] ?>" data-html="true" data-trigger="focus">
                                                        <button class="btn btn-xs info-button"><i class="fa fa-info" aria-hidden="true"></i></button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <?php } ?> 


                            <?php } ?>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>


<?php
$doc_id = $value['document_id'];

$script = <<< JS

   $("#passwordModal$doc_id").click(function () {
    
        $.get('view-datalog', {doc_id:$doc_id}, function(data) {        
        });
    });   
        
         $("#download$doc_id").click(function () {    
        $.get('download-data', {doc_id:$doc_id}, function(data) {
                
        });
    });  

JS;
$this->registerJs($script);
?>