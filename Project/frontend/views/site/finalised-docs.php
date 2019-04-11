<?php

use frontend\models\Sections;
use frontend\models\MasterDocTemplates;
use frontend\models\Templates;
use kartik\dialog\Dialog;
use frontend\models\Courses;
use frontend\models\Ebooks;
use frontend\components\CustomRssReader;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
$request = Yii::$app->request;
$id = $request->get('id');

echo Dialog::widget([
    'options' => [
        'title' => 'Your Attention !',
    ]
]);
echo Dialog::widget();
?>
<!-- Internal CSS -->
<!-- To override the Dialog widget CSS -->
<style>


    body{
        -ms-overflow-style:none;
    }
    ::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1; 
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #ecf0f5; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #ecf0f5; 
    }
    @media screen and (min-height: 691px){
        .wrapper {
            height: auto !important;
        }
    }
    .container-fluid, .card .card-content {
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-bottom: 0px;
    }

    @media (min-width: 320px) and (max-width: 420px) {
        .panel-body {
            padding: 20px;
        }
    }
    @media (min-width: 767px) and (max-width: 999px) {
        .panel-body {
            padding: 5px;
        }
    }
    @media (min-width: 999px) and (max-width: 1024px) {
        .panel-body {
            padding: 25px;
        }
    }

    @media screen and (min-width:992px) {
        .navbar-brand {
            display: none;
        }
        .main-panel {
            overflow-y: hidden;
        }     
        .main-panel > .content {         
            padding-top:15px !important;
        }
        .navbar .navbar-minimize {
            padding: 0;
        }
        .btn.btn-just-icon, .navbar .navbar-nav > li > a.btn.btn-just-icon {
            padding: 1px;
        }
        .navbar {
            max-height: 0px !important;
            min-height: 18px !important;
        }
        .navbar ul.nav.navbar-nav.navbar-right {
            display:none;
        }
    }

    @media screen and (min-width:768px) {
        .main-header .sidebar-toggle {
            padding: 0px 15px;
        }
        .dropdown-toggle{
            padding: 0px 15px 0px 15px !important;
        }
        #lessons li {
            list-style-type:none;
        }
        #lessons li:before {
            content:'\00b7'; 
            font-size:80px;
            vertical-align:middle;
        }
        .btn.btn-just-icon, .navbar .navbar-nav > li > a.btn.btn-just-icon {
            padding: 3px;
        }    
        .navbar {
            max-height: 0px !important;
            min-height: 25px !important;
        }
        .content{
            padding-top: 0px;
            min-height: 720px;
            max-height: 720px;
        }
        .content>.container-fluid, .content>.container-fluid>.row, .content>.container-fluid>.row>.col-md-12{
            min-height: 650px;
            max-height: 650px;
        }
    }

    @media screen and (min-width:1350px) {
        #lessons li {
            list-style-type:none;
        }

        #lessons li:before {
            content:'\00b7'; 
            font-size:93px;
            vertical-align:middle;
        }
    }

    h3 {
        line-height: 1.2em;
    }

    .btn-success {
        background-color: #62e268 !important;
    }

    @media (min-width: 768px) {
        .type-primary .modal-content {
            width:600px;
        }

        .type-primary .modal-dialog {
            margin: 20px 100px 20px 300px;
        }
    }

    .navbar .navbar-brand {
        line-height: 25px;
        padding: 0px 15px;
    }

    .lessons_list {
        padding: 0;
    }

    .slideshow {
        padding-right: 0;
    }

    #lessons .card .card-content {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
    }
    .content-wrapper {
        min-height: 0 !important; 
    }
    .fa-download{
        
            color: #0db5ca !important;
    }
    
    .panel-body {
    padding: 10px;
}

#lessons li:before{
    
    list-style-type: none;
    font-size: 1px;
}


</style>
<?php
$course = MasterDocTemplates::find()->where(['id' => $id])->one();
?>

<div class="content" id="lessons">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col-sm-2 col-md-2 col-lg-2 lessons_list">
                                <!-- Loop to Fetch all the lessons for a specific Course -->
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel-heading" role="tab" style="background: linear-gradient(60deg, #2F80ED, #56CCF2);">
                                        <div class="panel-title panel-title-lesson" style="padding:13px 1px 1px 1px;">
                                            <p class="text-uppercase text-center">Agreements</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default" style="height:600px;">
                                        <div class="panel-heading" role="tab" id="headingOne">                                             
                                            <h4 class="panel-title panel-title-lesson">
                                                <a role="button" href="#lesson-0" >
                                                    <b>Documents</b>
                                                </a>
                                            </h4>
                                        </div>
                       
                                                <div id="lesson-0" class="panel-collapse collapse in lesson-name">
                                                    <div class="panel-body">
                                                        <ul id="menu" class="lessons">
                                                            <li id="section-0" class="sections" data-index-two="0">
                                                                <div class="section_name">
                                                                    <a  class="multiple_templates" data-id="a1" id="callout"  data-placement="bottom" >Agreements1-doc</a>
                                                                 
                                                                </div>
                                                                <div class="no-margin"></div>
                                                            </li>
                                                        </ul> 
                                                    </div>
                                                       <a style="margin-left:12px;" href="<?= Yii::$app->request->baseUrl ?>/uploads/templates/Agreements/Agreement1.docx" download>
                                            <i class="fa fa-download icons" aria-hidden="true"></i></a>
                                                </div>
                                          
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-10 col-md-10 col-lg-10 slideshow">
                                <div id="pdf_embed">
                         

                                    
                                    <iframe src="<?= Yii::$app->request->baseUrl ?>/uploads/templates/Agreements/Agreement1.pdf#toolbar=0"  width="100%" height="650px"></iframe>
                                  
                                           
  
                                  
                                </div>
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

    $(".multiple_templates").click(function () {       
        var template_id = $(this).data('id');
        $.get('template-name', {template_id:template_id,master_template_id:$id}, function(summary) {  
            $('#pdf_embed').html(summary);
          
        });
   });
        
    $("#btn-dialog").click(function () {
        $.get('update-course-name', {course_id : $id}, function(name) {
            //alert(name);
            $('#w1_title').html(name);
        });
    });
  
        
    let searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('page'))  $(".news-button").click();// true

JS;
$this->registerJs($script);
?>