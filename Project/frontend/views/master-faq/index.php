<?php

use frontend\models\MasterFaq;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$request = Yii::$app->request;
$id = $request->get('id');
?>
<style>
    .panel-heading{
        background-color: #0DB5CA !important;
    }
    #courses .card .card-content{
        overflow-y: hidden;
    }

    #courses .card .card-header, #courses .card .card-header1{
        background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .pagination{
        margin: 0;
    }

    .card {
        margin: 15px 0 0 0;
    }

    #courses .card {
        background-image: linear-gradient(-20deg, #e9defa 0%, #fbfcdb 100%);
    }

    .card-header {
        width: 60px;
        text-align: center;
        border-radius: 50% !important;
        font-size: 20px;
        margin: -30px auto 0 !important;
    }

    .scrollbar {
        height: 100px;
    }

    .know-more {
        width: 110px;
        min-height: 0 !important;
        margin: -20px auto 0 !important;
        margin-bottom: -20px !important;
    }

    @media screen and (min-width: 992px) {
        #mycourse .material-datatables .card .card-content {
            padding-bottom: 30% !important;
        }
    }

    .course-name {
        font-weight: 400;
    }

    .container-fluid {
        min-height: 0 !important;
    }

    .content:nth-of-type(2) {
        padding-top: 10px;
    }

    .grid-1, .grid-1:focus {
        background: #FF8008;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #FFC837, #FF8008);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #FFC837, #FF8008); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        margin-bottom: 3px;
        margin-top: 0;
    }

    .grid-2, .grid-2:focus {
        background-image: linear-gradient(to right, #0ba360 0%, #3cba92 100%);
        margin-top: 3px;
        margin-bottom: 0;
    }

    .grid-1, .grid-2 {    
        padding: 10% 10% 10% 10%;
        border-radius: 0;
    }

    .btn {
        font-size: 15px;
        text-transform: capitalize;
    }

    button i {
        font-size: 60px !important;
        opacity: 0.5;
        padding-top: 3%;
        padding-bottom: 10%;

    }

    .tile-3 {
        padding-left: 5px
    }

    .tile-3 img {
        box-shadow: 0 14px 26px -12px rgba(153, 153, 153, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(153, 153, 153, 0.2);
    }

    .flex {
        display: flex;
    }

    .col-md-2 {
        padding: 0;
    }
    .modal-header{
        background: linear-gradient(60deg, #2F80ED, #56CCF2);
        text-align: center;
    }
    .modal-content .modal-body {
        padding-top: 15px;
        padding-right: 45px;
        padding-bottom: 15px;
        padding-left: 45px;
        min-height: auto;
    }
    ::-webkit-scrollbar {
        width: 0px;
    }
    .panel-default{
        height:580px;

    }
    #lessons .lessons_list {
        max-height: 500px;
        overflow-y: auto;
    }
    .content{
        padding-top: 40px !important;
    }
    @media (max-width: 767px){
        #lessons .panel-group .panel {
            margin-bottom: 5px;
        }
        .content {
            padding-top: 15px !important;
        }
        #pdf_embed{
            height: 400px;
        }
        .panel-default {
            height: 230px !important;
        }
        .card .card-header1 {
            margin-top: -15px !important;
        }
        .col-sm-10, .col-md-10{
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        #lessons h4 {
            font-size: 1.0em !important;
        }
    }
    .faq-frame{
        height: 500px !important;
    }
     @media (max-width: 450px){
         #lessons .panel-group .panel {
            margin-bottom: 5px;
        }
        .content {
            padding-top: 15px !important;
        }
        #pdf_embed{
            height: 300px;
        }
        .panel-default {
            height: 300px !important;
        }
        .card .card-header1 {
            margin-top: -15px !important;
        }
        .col-sm-10, .col-md-10{
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        #lessons h4 {
            font-size: 1.0em !important;
        }
        .faq-frame{
        height: 400px !important;
    }
     }
    @media (min-width: 768px) and (max-width: 991px){
        .col-sm-2 {
            width: 20.666667% !important;
        }
        #lessons .slideshow {
            padding-right: 0px;
            width: 79%;
            padding-left: 5px;
        }
        .panel-default {
            height: 460px;
        }
        #lessons .panel-group .panel {
            margin-bottom: 10px;
        }
        .faq-frame{
        height: 481px !important;
    }
    #lessons .panel-title-lesson{
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
    }
    @media (min-height: 769px){
        .faq-frame {
    height: 650px !important;
}
.panel-default {
            height: 650px;
        }
        #lessons .lessons_list {
        max-height: 600px;
        overflow-y: auto;
    }
    }
    #pdf_embed{
            height: 650px;
        }
</style>

<div class="content" id="lessons">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 card" style="background: white !important">
                <div >
                    <div class="card-header1 card-header-text" data-background-color="blue" style="margin: -50px 0px 12px;">
                        <h4 class="card-title text-uppercase">FAQ</h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-md-2 lessons_list">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel-default">
                                    <?php
                                    $faqs = MasterFaq::find()
                                            ->select(['question', 'id'])
                                           
                                            ->all();
                                 
                                    if (!empty($faqs)) {
//                                        $first_pdf = $faqs[0]->question;

                                        foreach ($faqs as $faq) {
                                             
                                            ?>    
                                            <a class="faq" role="button"  data-id="<?php echo $faq->id; ?>"
                                               id="callout"  data-placement="bottom" >
                                                <div class="panel-heading panel" role="tab" id="headingOne">                                             
                                                    <h4 class="panel-title panel-title-lesson">
                                                        <?= $faq->question ?> 
                                                    </h4>
                                                </div>  
                                            </a>
                                        <?php }
                                        ?>
                                    <?php }
                                    ?>
                                </div>    
                            </div>
                        </div>  
                        <div class="col-sm-10 col-md-10 slideshow">
                            <div id="pdf_embed">
                                <?php if (!empty($faqs)) { ?>
                                    <embed src="<?= Yii::$app->request->baseUrl ?>/uploads/faq/pdf1.pdf" id='pdf_embeded' width="100%" class="faq-frame">                          
                                <?php } else { ?>
                                    <embed src="<?= Yii::$app->request->baseUrl ?>/uploads/default/Slide2.png" id="pdf_embeded" width="100%" class="faq-frame">  
                                <?php } ?>    
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS

    $(".faq").click(function () {
        var id = $(this).data('id');
        $.get('master-faq/faq-list', {id:id}, function(summary) {            
            $('#pdf_embed').html(summary);
            $(".slideshow").show();
        });
   });       
    
    jQuery(function () {
        var size = screen.height-400;
        $('iframe').css('height',size);   
        jQuery('#clickButton').click();
    });  

JS;
$this->registerJs($script);
?>

