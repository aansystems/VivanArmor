<?php

use kartik\dialog\Dialog;
use frontend\models\Courses;
use frontend\models\Ebooks;
use frontend\components\CustomRssReader;

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
    /*Tags css*/
    /*a, a:hover,a:focus{color:#59b329;text-decoration:none;outline:none}*/
    ul,ol,li{display:block;margin:0;padding:0}ol,.rss_div li:before{display: none;list-style:none}
    #tags_ul li:before{display: none;list-style:none}
    .tag,.tabs-link{padding-bottom:0.5rem;-webkit-box-shadow:inset 0 -2px rgba(255,255,255,0.1),inset 0 -3px rgba(0,0,0,0.1),0 1px rgba(0,0,0,0.05);box-shadow:inset 0 -2px rgba(255,255,255,0.1),inset 0 -3px rgba(0,0,0,0.1),0 1px rgba(0,0,0,0.05)}
    .tag,.tabs-link{display:inline-block;vertical-align:top;line-height:2em;padding-top:0;font-weight:bold;color:#505050;text-align:center;text-shadow:0 1px rgba(255,255,255,0.5);background:#eaefef;border:0px white;border-radius:2px;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}
    .tag:hover,.tabs-link:hover{color:white;background:#20aae5;text-decoration:none;text-shadow:0 1px rgba(0,0,0,0.15);outline:none}
    .tag:active,.tabs-link:active{padding-bottom:2px;border-top:1px solid white;-webkit-box-shadow:inset 0 -2px rgba(0,0,0,0.1),0 1px rgba(0,0,0,0.05);box-shadow:inset 0 -2px rgba(0,0,0,0.1),0 1px rgba(0,0,0,0.05)}
    .tags-heading{height:2em;line-height:2em;margin-bottom:1em}
    .tags-heading>h4{margin:0;line-height:inherit}
    .tags-toggle{display:none;text-align:center;font-weight:bold}
    .tags-toggle:before{content:"\e010";margin-right:.5em}
    .tags-list{overflow:hidden;line-height:1.5em}
    .tags-list>li{float:left;margin:0 .5rem 0 0; display: flex; list-style: none;}
    .tag{display:block;padding:0.2rem 0.5rem;line-height:inherit;font-size:1.3rem !important;font-weight:normal;color:#778187;background:#f2f2f3}
    .tag.active {background-color: #20aae5; color: white; text-shadow: none;}
    .rss_div {
        overflow-style: scrollbar;
    }

    body{
        -ms-overflow-style:none;
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
            min-height: 540px;
            max-height: 540px;
        }
        .content>.container-fluid, .content>.container-fluid>.row, .content>.container-fluid>.row>.col-md-12{
            min-height: 540px;
            max-height: 540px;
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
    .wiki_div {
        display: none;
        min-height: 585px;
        max-height: 585px;
    }
    .rss_div {
        display: none;
        min-height: 520px;
        max-height: 520px;
        overflow-y: scroll;
    }
    .wiki_keywords {
        display: none;
        background-color: white;
        cursor: pointer;
        max-height: 15rem;
        overflow-y: auto;
    }
    .wiki_keywords>p:last-child {
        margin-bottom: 0;
    }
    .well {
        padding-top: 0;
        margin-bottom: 1.2rem;
        background-color: #ffffff;
    }
    .well > h2 {
        margin: 0 0;
    }
    .pagination {
        margin: 0;
    }
    .panel-body {
        padding: 5px 10px;
    }
    .panel-group {
        margin-bottom: 10px;
    }
    .panel-default {
        min-height: 356px;
    }
    .pagination ul,.pagination ol,.pagination > li{list-style:none !important;}
    .list-view img {
        height: auto !important;
        width: auto !important;
        max-width: 100%;
        float: left !important;
        margin-right: 1rem;
    }
    @media screen and (min-width: 768px)and (max-width: 790px) {
    #lessons li:before{
        font-size: 40px !important;
    }
}
#lessons .lessons_list{
    max-height: 520px !important;
}
.access-buttons{
    margin-top: 18px !important;
}
@media (min-height: 786px) and (max-height: 820px){
    #lessons .lessons_list{
    max-height: 650px !important;
}
.access-buttons{
    margin-top: 57px !important;
}
.content>.container-fluid, .content>.container-fluid>.row, .content>.container-fluid>.row>.col-md-12{
            min-height: 620px;
            max-height: 620px;
        }
        #pdf_embeded{
            min-height: 630px;
        }
        .rss_div {
        display: none;
        min-height: 650px;
        max-height: 650px;
        overflow-y: scroll;
    }
    .wiki_div {
        display: none;
        min-height: 650px;
        max-height: 650px;
    }
    #render_wiki{
        min-height: 650px !important;
        max-height: 650px !important;
    }
}
@media (min-height: 680px) and (max-height: 720px){
    #pdf_embeded{
            min-height: 540px;
        }
        .access-buttons{
            margin-top: 35px !important;
        }
        #lessons .lessons_list{
    max-height: 540px !important;
}
.rss_div {
        display: none;
        min-height: 540px;
        max-height: 540px;
        overflow-y: scroll;
    }
    .wiki_div {
        display: none;
        min-height: 540px;
        max-height: 540px;
    }
    #render_wiki{
        min-height: 540px !important;
        max-height: 540px !important;
    }
}
@media (min-height: 721px) and (max-height: 750px){
    #pdf_embeded{
            min-height: 590px;
        }
        .access-buttons{
            margin-top: 85px !important;
        }
        #lessons .lessons_list{
    max-height: 590px !important;
}
.rss_div {
        display: none;
        min-height: 590px;
        max-height: 590px;
        overflow-y: scroll;
    }
    .wiki_div {
        display: none;
        min-height: 590px;
        max-height: 590px;
    }
    #render_wiki{
        min-height: 590px !important;
        max-height: 590px !important;
    }
}
@media (min-height: 751px) and (max-height: 785px){
    #pdf_embeded{
            min-height: 610px;
        }
        .access-buttons{
            margin-top: 110px !important;
        }
        #lessons .lessons_list{
    max-height: 610px !important;
}
.rss_div {
        display: none;
        min-height: 610px;
        max-height: 610px;
        overflow-y: scroll;
    }
    .wiki_div {
        display: none;
        min-height: 610px;
        max-height: 610px;
    }
    #render_wiki{
        min-height: 610px !important;
        max-height: 610px !important;
    }
}
@media (max-width: 767px){
    .content {
    margin-top: 10px;
}
}
</style>
<?php
$course = Courses::find()->where(['id' => $id])->one();
?>

<?= $this->render('//site/fly-box.php') ?>
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
                                            <p class="text-uppercase text-center"><?php echo $course->course_name ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-group" role="tablist" aria-multiselectable="true">
                                    <div class="panel-body">
                                        <button class="btn news-button"><i class="fa fa-info-circle" aria-hidden="true"></i> News Feed</button>
                                        <button class="btn wiki-button"><i class="fa fa-wikipedia-w" aria-hidden="true"></i> Wikipedia</button>
                                    </div>
                                    <div class="panel-body wiki_keywords tags" id="tags">
                                        <ul class="tags-list keywords_name" id="tags_ul">
                                            <?php
                                            if (!empty($keywords)) {
                                                $keywords_array = yii\helpers\StringHelper::explode($keywords, ',');
                                                asort($keywords_array);
                                                foreach ($keywords_array as $keyword) {
                                                    ?>
                                                    <li>
                                                        <span class="keyword tag" data-placement="bottom"><?= $keyword ?></span>
                                                    </li>
                                                    <?php
                                                }
                                            } else {
                                                echo 'No Keywords!';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">                                             
                                            <h4 class="panel-title panel-title-lesson">
                                                <a role="button" href="#lesson-0" >
                                                    <b>Review Materials</b>
                                                </a>
                                            </h4>
                                        </div>
                                        <?php
                                        $list_of_ebooks = Ebooks::find()
                                                ->select(['file_name', 'id'])
                                                ->where(['course_id' => $id])
                                                ->all();
                                        if (!empty($list_of_ebooks)) {
                                            $first_pdf = $list_of_ebooks[0]->file_name;
                                            foreach ($list_of_ebooks as $list_of_ebook) {
                                                ?>
                                                <div id="lesson-0" class="panel-collapse collapse in lesson-name">
                                                    <div class="panel-body">
                                                        <ul id="menu" class="lessons">
                                                            <li id="section-0" class="sections" data-index-two="0">
                                                                <div class="section_name">
                                                                    <a class="multiple_ebooks" data-id="<?php echo $list_of_ebook->id; ?>" id="callout"  data-placement="bottom" ><?= $list_of_ebook->file_name ?></a>
                                                                </div>
                                                                <div class="no-margin"></div>
                                                            </li>
                                                        </ul> 
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10 col-md-10 col-lg-10 rss_div">
                                <?php
                                if ($rss_feeds) {
                                    echo CustomRssReader::widget([
                                        'channel' => $rss_feeds,
                                        'itemView' => 'item',
                                        'pageSize' => 10,
                                        'wrapClass' => 'rss-wrap',
                                        'wrapTag' => 'div',
                                    ]);
                                } else {
                                    echo 'No feeds available!';
                                }
                                ?>
                            </div>
                            <div class="col-sm-10 col-md-10 col-lg-10 wiki_div">
                                <iframe id="render_wiki" src="" width="100%" style="min-height: 520px; max-height: 520px;"></iframe>
                            </div>
                            <div class="col-sm-10 col-md-10 col-lg-10 slideshow">
                                <div id="pdf_embed">
                                    <?php if (!empty($list_of_ebooks)) { ?>
                                        <embed src="<?= Yii::$app->request->baseUrl ?>/uploads/pdf/<?= $course->course_name ?>/ebook/<?= $first_pdf ?>.pdf#toolbar=0" id='pdf_embeded' width="100%" height="520">                          
                                    <?php } else { ?>
                                        <embed src="<?= Yii::$app->request->baseUrl ?>/uploads/default/Slide2.png" id="pdf_embeded" width="100%" height="520">  
                                    <?php } ?>    
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
$base_url = Yii::$app->request->baseUrl;
$course_name = Courses::findOne(['id' => $id])->course_name;

$script = <<< JS

    $(".multiple_ebooks").click(function () {
        var ebook_id = $(this).data('id');
        $.get('ebook-name', {ebook_id:ebook_id,course_id:$id}, function(summary) {            
            $('#pdf_embed').html(summary);
            $(".wiki_div").hide();
            $(".rss_div").hide();
            $(".wiki_keywords").hide();
            $(".slideshow").show();
            $(".keyword").each(function() {
                $(this).hasClass("active")?$(this).removeClass("active"):'';
            });
        });
   });
        
    $("#btn-dialog").click(function () {
        $.get('update-course-name', {course_id : $id}, function(name) {
            $('#w1_title').html(name);
        });
    });
    jQuery(function () {
              var size = screen.height-400;
        $('iframe').css('height',size);   
        jQuery('#clickButton').click();
    });  
          
    $(".wiki-button").click(function(){
        $(".keyword").each(function() {
            $(this).hasClass("active")?$(this).removeClass("active"):'';
        });
        $("#render_wiki").attr("src","https://en.wikipedia.org/wiki/"+$(".keyword").first().html().trim());
        $(".keyword").first().addClass("active");
        $(".wiki_div").show();
        $(".rss_div").hide();
        $(".slideshow").hide();
        $(".wiki_keywords").show();
    });
        
    $(".news-button").click(function(){
        $(".wiki_keywords").hide();
        $(".rss_div").show();
        $(".wiki_div").hide();
        $(".slideshow").hide();
        $(".keyword").each(function() {
            $(this).hasClass("active")?$(this).removeClass("active"):'';
        });
    });
        
    $(".keyword").click(function(){
        if(!$(this).hasClass("active")) {
            $(".keyword").each(function() {
                $(this).hasClass("active")?$(this).removeClass("active"):'';
            });
            $("#render_wiki").attr("src","https://en.wikipedia.org/wiki/"+$(this).html().trim());
            $(".wiki_div").show();
            $(".rss_div").hide();
            $(".slideshow").hide();
            $(".wiki_keywords").show();
            $(this).addClass("active");
        }
    });
        
    let searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('page'))  $(".news-button").click();// true

JS;
$this->registerJs($script);
?>