<?php

use frontend\models\Sections;
use frontend\models\Learners;
use frontend\models\LearnerActivity;
use frontend\models\DefaultLessonComplete;
use kartik\dialog\Dialog;
use frontend\models\Courses;

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
  
/* width */
body{
    -ms-overflow-style:none;
}

::-webkit-scrollbar {
    width: 0px;
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
        margin-bottom: 10px;
    }
    .container-fluid {
        min-height: 0 !important;
    }    

    .panel-heading a {
        color: #0DB5CA;
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
@media(min-width: 1024px) {
}
    .btn.btn-warning, .btn.btn-warning:hover{
        margin-top: 0 !important;
        margin-right: 0 !important;
        padding: 5px !important;
    }

    .bootstrap-dialog .bootstrap-dialog-title {
        color: #FFFFFF;
        display: inline-block;
        font-size: 25px;
        font-weight: 500;
        padding-bottom: 3%;
    }

    .bootstrap-dialog .bootstrap-dialog-message {
        font-size: 17px;
        font-weight: bold;
    }
    @media screen and (min-width:992px) {
        .navbar-brand {
            display: none;
        }
        .main-panel {
            overflow-y: scroll;
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
            vertical-align:top;
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
        }
    }
    @media screen and (min-width:1350px) {
        #lessons li {
            list-style-type:none;
        }
        #lessons li:before {
            content:'\00b7'; 
            font-size:93px;
            vertical-align:top;
        }
    }

    .type-primary .modal-footer .bootstrap-dialog-footer-buttons {
        display: none;
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
        .navbar .navbar-brand{
            line-height: 4px;
        }
         .type-primary .modal-dialog {
            margin: 20px 100px 20px 300px;
        }
        .no-margin{
   width:20%;
    }
    @media (min-width: 768px) and (max-width: 990px){
.no-margin{
   width:30% !important;
   /*margin-top: 10px !important;*/
}
       
    }
 @media (min-width: 767px) and (max-width: 767px)
 {
     .no-margin{
   width:5%;
}
 }
    .bootstrap-dialog.type-primary .modal-header {
        background-color: grey;
    }

    .type-primary .modal-header .close {
        color: #FFFFFF;
    }
    

    .lessons_list {
        padding: 0;
    }

    .modal-content .modal-body {
        min-height: 0 !important;
    }
    .modal-footer{
        text-align: right;
    }
    .modal-dialog{
        width: 450px !important;
    }

    .container-fluid, #lessons .card .card-content {
        padding-bottom: 0 !important;
        margin-bottom: 0 !important;
    }
    
    #lessons .card .card-content {
        padding-top: 0 !important;
    }
    
    #footer img {
        width: 40px !important;
        height: 45px !important;
    }
    
     .content-wrapper {
        min-height: 0 !important; 
    }

    @media screen and (min-width:768px)and (max-width:1197px){
        #lessons .card a {
    font-size: 12px !important;
}
.section_name {
    
    width: 40% !important;
    display: inline-block !important;
} 


.panel-body {
    
    padding-top: 15px;
    padding-right: 0px;
    padding-bottom: 15px;
    padding-left: 1px;
}
.panel-title {
    font-size: 12px;
}

    }
    @media screen and (min-width:769px)and (max-width:800px){
.panel-title {
    font-size: 9px !important;
}
    }


    @media screen and (min-width:768px)and (max-width:995px){
        .panel-title {
    font-size: 10px;
}
#lessons .panel-default>.panel-heading{
    padding: 0px 3px;
}
    }

@media screen and (min-width:450px) and (max-width:769px){


.panel-title {
width: auto !important;
    min-width: 100%;
}
.col-md-10{
    padding-left: 0px !important;
    padding-right: 0px !important;
    
} 

}
@media screen and (max-width:450px){
    .completion-progress{
    margin-right: -40px;
    
}   
}
@media screen and (max-width:950px){
#lessons li:before{
    font-size: 50px;
}
}
@media screen and (min-width:768px)and (max-width:1280px){
#lessons .panel-title-lesson b {
width:auto !important;
min-width:100%;
 }
 }
  @media screen and (min-width:1198px)and (max-width:1366px){
      .section_name {
    display: inline-block !important;
    width: 65% !important;
}
  }
 
  @media screen and (min-width: 411px) and (max-width: 472px) {
.modal-dialog {
    width: 270px !important;
    margin:70px;
}
}
@media screen and (min-width: 320px)and (max-width: 471px) {
.modal-dialog {
    width: 270px !important;
    margin:27px;
}
}
@media screen and (min-width: 500px)and (max-width: 600px) {
    .modal-dialog {
    margin:50px !important;
}
}
@media screen and (max-width: 320px){
    .col-xs-2 {
    width: 38.666667% !important;
}
}
@media screen and (max-width: 1600px){
#lessons .lessons_list {
    overflow-y: auto;
}
}

@media (min-width: 421px) and (max-width: 1120px){
    .btn{
        padding-top: 0px !important;
    }
    
}
@media (min-height: 680px) and (max-height: 720px){
   #lessons .card img {
    height: 50rem !important;
}
#lessons .lessons_list {
    max-height: 54rem !important;
    overflow-y: auto;
} 
.access-buttons{
    margin-top: 5px;
}
}

@media (min-height: 721px) and (max-height: 750px){
   #lessons .card img {
    height: 54rem !important;
}
#lessons .lessons_list {
    max-height: 58rem !important;
    overflow-y: auto;
} 
.access-buttons {
    margin-top: 5px;
}
}
@media (min-height: 751px) and (max-height: 785px){
   #lessons .card img {
    height: 57rem !important;
}
#lessons .lessons_list {
    max-height: 61rem !important;
    overflow-y: auto;
} 
.access-buttons{
    margin-top: 10px;
}

}
@media (min-height: 786px) and (max-height: 820px){
   #lessons .card img {
    height: 59rem !important;
}
#lessons .lessons_list {
    max-height: 64rem !important;
    overflow-y: auto;
} 
.access-buttons{
    margin-top: 10px;
}

}
@media (min-height: 821px) and (max-height: 860px){
   #lessons .card img {
    height: 60rem !important;
}
#lessons .lessons_list {
    max-height: 66rem !important;
    overflow-y: auto;
} 
.access-buttons{
    margin-top: 10px;
}

}
@media (min-height: 861px) and (max-height: 880px){
   #lessons .card img {
    height: 64rem !important;
}
#lessons .lessons_list {
    max-height: 65rem !important;
    overflow-y: auto;
} 
.access-buttons{
    margin-top: 10px;
}

}
@media (min-height: 881px) and (max-height: 900px){
   #lessons .card img {
    height: 66rem !important;
}
#lessons .lessons_list {
    max-height: 69rem !important;
    overflow-y: auto;
} 
.access-buttons{
    margin-top: 10px;
}

}
@media (min-height: 901px) and (max-height: 940px){
   #lessons .card img {
    height: 68rem !important;
}
#lessons .lessons_list {
    max-height: 71rem !important;
    overflow-y: auto;
} 

.access-buttons{
    margin-top: 10px;
}

}
@media (min-height: 941px) and (max-height: 980px){
   #lessons .card img {
    height: 72rem !important;
}
#lessons .lessons_list {
    max-height: 74rem !important;
    overflow-y: auto;
} 

.access-buttons{
    margin-top: 10px;
}
}
.btn, .navbar .navbar-nav > li > a.btn{
    padding: 5px 12px !important;
}
}
.bootstrap-dialog-header{
    text-align: center !important;
}
.modal-content .modal-header{
    padding-top: 15px;
}
.modal-content .modal-footer button{
    width: 20%;
}



.modal-header{
    background: linear-gradient(60deg, #2F80ED, #56CCF2);
}
.btn.btn-default, .btn.btn-default:hover, .btn.btn-default:focus, .btn.btn-default:active, .btn.btn-default.active, .btn.btn-default:active:focus, .btn.btn-default:active:hover, .btn.btn-default.active:focus, .btn.btn-default.active:hover{
    padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px !important;
        background: #4caf50 !important;
}
.btn.btn-warning, .btn.btn-warning:hover, .btn.btn-warning:focus, .btn.btn-warning:active, .btn.btn-warning.active, .btn.btn-warning:active:focus, .btn.btn-warning:active:hover, .btn.btn-warning.active:focus, .btn.btn-warning.active:hover, .open > .btn.btn-warning.dropdown-toggle, .open > .btn.btn-warning.dropdown-toggle:focus, .open > .btn.btn-warning.dropdown-toggle:hover{
    padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px !important;
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

                            <div class="col-sm-2 col-md-2 lessons_list">
                                <!-- Loop to Fetch all the lessons for a specific Course -->

                                <div class="panel-group" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" style="background: linear-gradient(60deg, #2F80ED, #56CCF2);">
                                            <div class="panel-title panel-title-lesson" style="padding:13px 1px 1px 1px;">
                                                <p class="text-uppercase text-center"><?php echo $course->course_name ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                                    <?php
                                    if (!empty($lessons)) {
                                        ?>
                                        <?php
                                        foreach ($lessons as $lesson) {
                                            $check_section_in_progress = LearnerActivity::find()
                                                    ->where(['lesson_id' => $lesson->id])
                                                    ->andWhere(['learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id])
                                                    ->andWhere(['completion_status' => 0])
                                                    ->count();
                                            ?>

                                            <div class="panel panel-default">         

                                                <?php if ($check_section_in_progress > 0) { ?>

                                                    <a class="lesson-<?= $lesson->id ?>" role="button" data-toggle="collapse" data-parent="#accordion" href="#lesson-<?= $lesson->id ?>" aria-expanded="true" aria-controls="collapseThree">
                                                        <div class="panel-heading" role="tab" id="headingThree">
                                                            <h4 class="panel-title panel-title-lesson">
                                                            <?php } else { ?>
                                                                <a class="collapsed lesson-<?= $lesson->id ?>" role="button" data-toggle="collapse" data-parent="#accordion" href="#lesson-<?= $lesson->id ?>" aria-expanded="false" aria-controls="collapseThree">
                                                                    <div class="panel-heading" role="tab" id="headingThree">
                                                                        <h4 class="panel-title panel-title-lesson">
                                                                        <?php } ?>

                                                                        <b><?= $lesson->lesson_name; ?></b>
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                            </a>

                                                            <?php
                                                            if ($check_section_in_progress > 0) {
                                                                ?>
                                                                <div id="lesson-<?php echo $lesson->id; ?>" class="panel-collapse collapse in lesson-name" role="tabpanel" aria-labelledby="headingThree">
                                                                <?php } else {
                                                                    ?>
                                                                    <div id="lesson-<?php echo $lesson->id; ?>" class="panel-collapse collapse lesson-name" role="tabpanel" aria-labelledby="headingThree"> 
                                                                    <?php }
                                                                    ?>
                                                                    <div class="panel-body">
                                                                        <ul id="menu" class="lessons">
                                                                            <!-- Loop to Fetch all the Sections for a Specific Lesson -->
                                                                            <?php
                                                                            $sections = Sections::find()->where(['lesson_id' => $lesson->id])->all();
                                                                            if (!empty($sections)) {
                                                                                foreach ($sections as $section) {

                                                                                    $check_completion = LearnerActivity::find()
                                                                                            ->where(['learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id])
                                                                                            ->andWhere(['lesson_id' => $lesson->id])
                                                                                            ->andWhere(['section_id' => $section->id])
                                                                                            ->andWhere(['completion_status' => 1])
                                                                                            ->one();

                                                                                    $check_accessibility = LearnerActivity::find()
                                                                                            ->where(['learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id])
                                                                                            ->andWhere(['lesson_id' => $lesson->id])
                                                                                            ->andWhere(['section_id' => $section->id])
                                                                                            ->one();
                                                                                    ?>

                                                                                    <?php if (empty($check_completion) && empty($check_accessibility)) { ?>

                                                                                        <li id="section-<?= $section->id ?>" class="sections disabled" data-index-one="<?= $id ?>" data-index-two="<?= $lesson->id ?>" data-index-three="<?= $section->id ?>">
                                                                                            <div class="section_name">
                                                                                                <a><?php echo $section->folder_name ?></a>
                                                                                            </div>
                                                                                            <div class="no-margin"></div>
                                                                                        </li>
                                                                                    <?php } elseif (empty($check_completion) && !empty($check_accessibility)) { ?>
                                                                                        <li id="section-<?= $section->id ?>" class="sections" data-index-one="<?= $id ?>" data-index-two="<?= $lesson->id ?>" data-index-three="<?= $section->id ?>">
                                                                                            <div class="section_name">
                                                                                                <a><?php echo $section->folder_name ?></a>
                                                                                            </div>
                                                                                            <div class="no-margin">
                                                                                                <?php $model = LearnerActivity::findOne(['learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id, 'lesson_id' => $lesson->id, 'section_id' => $section->id]); ?>
                                                                                                <?php if (!empty($model)) { ?>
                                                                                                    <?php $progress_complete = round(($model->current_slide_no / $model->total_slides) * 100); ?>
                                                                                                    <div class="progress">
                                                                                                        <?php
                                                                                                        if ($progress_complete >= 0 && $progress_complete <= 25) {
                                                                                                            $status = "danger";
                                                                                                        } elseif ($progress_complete > 25 && $progress_complete <= 50) {
                                                                                                            $status = "info";
                                                                                                        } elseif ($progress_complete > 50 && $progress_complete <= 75) {
                                                                                                            $status = "warning";
                                                                                                        } elseif ($progress_complete > 75 && $progress_complete <= 100) {
                                                                                                            $status = "success";
                                                                                                        }
                                                                                                        ?>
                                                                                                        <div class="progress-bar progress-bar-<?= $status ?>" role="progressbar" aria-valuenow="<?= $progress_complete ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $progress_complete ?>%"><?= $progress_complete ?>%</div>
                                                                                                    </div>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </li>
                                                                                    <?php } elseif (!empty($check_completion)) { ?>
                                                                                        <li id="section-<?= $section->id ?>" class="sections swiper-no-swiping" data-index-one="<?= $id ?>" data-index-two="<?= $lesson->id ?>" data-index-three="<?= $section->id ?>">
                                                                                            <div class="section_name">
                                                                                                <a><?php echo $section->folder_name ?></a>
                                                                                            </div>
                                                                                            <div class="no-margin">
                                                                                                <i class="fa fa-check-circle" aria-hidden="true" style="float: right; color: green;"></i>
                                                                                            </div>
                                                                                        </li>
                                                                                    <?php } else { ?>
                                                                                        <li id="section-<?= $section->id ?>" class="sections disabled" data-index-one="<?= $id ?>" data-index-two="<?= $lesson->id ?>" data-index-three="<?= $section->id ?>">
                                                                                            <div class="section_name">
                                                                                                <a><?php echo $section->folder_name ?></a>
                                                                                            </div>
                                                                                            <div class="no-margin">
                                                                                                <?php if (!empty($check_completion)) { ?>
                                                                                                    <i class="fa fa-check-circle" aria-hidden="true" style="float: right; color: green;"></i>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </li>
                                                                                    <?php } ?>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </ul> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <?php
                                                    } else {
                                                        echo "No lessons Available";
                                                    }
                                                    ?>
                                            </div>
                                    </div>

                                    <div class="col-sm-10 col-md-10 slideshow">
                                        <!--  Default Landing Image For Swiper -->
                                        <?php
                                        $check_default_visited = DefaultLessonComplete::find()
                                                ->where(['course_id' => $id])
                                                ->andWhere(['learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id])
                                                ->one();

                                        $path = Yii::$app->request->baseUrl . '/uploads/default/';

                                        $dir_path = 'uploads/default';

                                        $extensions_array = ['jpg', 'png', 'jpeg', 'gif'];

                                        $files = scandir($dir_path);

                                        $total_slides = count($files) - 2;

                                        $unordered_files = [];

                                        if (is_dir($dir_path)) {
                                            for ($i = 1; $i < count($files); $i++) {
                                                if ($files[$i] != '.' && $files[$i] != '..' && $files[$i] != '.svn') {
                                                    $unordered_files[$i] = $files[$i];
                                                }
                                            }

                                            natsort($unordered_files);
                                            ?>
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper swiper-no-swiping disableRightClick">
                                                    <?php
                                                    if (!empty($check_default_visited) && !empty($check_completion)) {
                                                        if ($check_completion->completion_status == 1) {
                                                            foreach ($unordered_files as $ordered_file) {

                                                                $extension = explode(".", $ordered_file);

                                                                if ($extension[1] == "JPG" || $extension[1] == "jpg" || $extension[1] == "png" || $extension[1] == "jpeg" || $extension[1] == "gif" || $extension[1] == "PNG") {
                                                                    echo '<div class="swiper-slide">';
                                                                    echo '<img draggable="false" src="' . $path . $ordered_file . '">';
                                                                    echo '</div>';
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                </div>
                                                <div class="swiper-pagination swiper-no-swiping"></div>
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
        if (empty($check_default_visited)) {
            $status = 0;
        } else {
            $status = $check_default_visited->completion_status;
        }
        ?>

        <?php
        $script = <<< JS
            var i=$status;           
           if(i != 1){
                $.get('complete-default-section', {course_id: $id}, function(data) {
        data = JSON.parse(data);
        enable_section = data.section_id;
        enable_lesson = data.lesson_id;
        $.get("enable-next-section", {course_id: $id, lesson_id: data.lesson_id, section_id: data.section_id}, function(data) {
            $("#section-" + enable_section).trigger("click");
            $("#section-" + enable_section + " div:nth-child(2n)").html(data);
            $("#section-" + enable_section).removeClass("disabled");
            
            $(".lesson-" + enable_lesson).trigger("click");
            });
        });
           }
$(document).bind("contextmenu",function(e) { 
    e.preventDefault();
});
  
/* For default VIVAAN LMS slides STOP */

$('.sections').click(function() {
    id = this.id;
    course_id = $('#'+id).attr('data-index-one');
    lesson_id = $('#'+id).attr('data-index-two');
    section_id = $('#'+id).attr('data-index-three');
	
if(lesson_id !=0) {
    $.get('get-course-materials', {course_id : course_id, lesson_id : lesson_id, section_id : section_id}, function(data) { 
        
        $.get('get-session', {course_id : course_id, lesson_id : lesson_id, section_id : section_id}, function(slide_no) { 
               
        $('.swiper-container').html(data);

        $('.disableRightClick').on("contextmenu",function(e){
            return false;
        });
        
        var swiper = new Swiper('.swiper-container', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
                renderBullet: function (index, className) {
                return '<span class="' + className + '">' + (index + 1) + '</span>';
                },
            },
        });
        
        swiper.slideTo(slide_no - 1);
        
        /* On Load Capture Session START */

                active = $(".swiper-pagination-bullet-active").html();
                next = $(".swiper-pagination-bullet-active").next().html();

                /* Slide Progress Display Status START */

                total_slides = $('.swiper-pagination-bullet').length;
                $('.completion-progress').html(active + ' / ' + total_slides);

                /* Slide Progress Display Status END */

                if (Number(total_slides) == Number(active)) {
                    $('.button-complete').prop("disabled", false);
                }

                /* On Load Capture Session END */

                $.get('check-revised', {lesson_id: lesson_id, section_id: section_id}, function(check) {
                    if (check == "in progress") {
                        progress_complete = Math.floor((slide_no / total_slides) * 100);

                        if (progress_complete >= 0 && progress_complete <= 25) {
                            status = "danger";
                        } else if (progress_complete > 25 && progress_complete <= 50) {
                            status = "info";
                        } else if (progress_complete > 50 && progress_complete <= 75) {
                            status = "warning";
                        } else if (progress_complete > 75 && progress_complete <= 100) {
                            status = "success";
                        }

                        var progress = '<div class="progress"><div class="progress-bar progress-bar-' + status + '" role="progressbar" aria-valuenow="status" aria-valuemin="0" aria-valuemax="100" style="width:' + progress_complete + '%">' + progress_complete + '% </div></div>';

                $('#section-' + section_id + ' div:nth-child(2n)').html(progress);
            }
        });
        
            if(Number(total_slides) == Number(active)) {
                $('.button-complete').prop("disabled", false);
            }
        
            $('.swiper-pagination-bullet').each(function() {
                bullets_no = $(this).html();
        
                if(Number(bullets_no) < Number(active)) {
                    $(this).css({
                    "background-color": "#a9a9a9",
                    "cursor" : "pointer",
                    "pointer-events" : "auto"
                });
            }

            if(Number(bullets_no) > Number(next)) {
                $(this).addClass("swiper-pagination-bullet-inactive");
            }

            if(Number(bullets_no) == Number(active)) {
                $(this).css({
                "background-color": "#04AFC3",
                "cursor" : "pointer",
                "pointer-events" : "auto"
            }); 

                $(this).next().css({
                "background-color": "#a9a9a9",
                "cursor" : "pointer",
                "pointer-events" : "auto"
                });
            }
        });
            
        /* On Load Capture Session END */

        $('.swiper-pagination-bullet').click( function() {
            active = $(".swiper-pagination-bullet-active").html();
            current = $(this).html();
            next = $(this).next().html();
        
         
        $.get('update-session', {lesson_id : lesson_id, section_id : section_id, current : current}, function(status) {
            $('.progress').html(status);  
        });
        

            if(Number(current) < Number(active)) {
                $(this).css({
                    "background-color": "#a9a9a9",
                    "cursor" : "pointer",
                    "pointer-events" : "auto"
            });
        }
        
        /* Slide Progress Display Status START */
        
        total_slides = $('.swiper-pagination-bullet').length;
        $('.completion-progress').html(current + ' / ' + total_slides);
        
        /* Slide Progress Display Status END */
        
        if(Number(total_slides) == Number(active) + 1) { 
            $('.button-complete').prop("disabled", false);
        }
                
        $('.swiper-pagination-bullet').each(function() {
            bullets_no = $(this).html();
                if(Number(bullets_no) < Number(current)) {
                    $(this).css({
                    "background-color": "#a9a9a9",
                    "cursor" : "pointer",
                    "pointer-events" : "auto"
                });
            }

            if(Number(bullets_no) > Number(next)) {
                $(this).addClass("swiper-pagination-bullet-inactive");
            }

            if(Number(bullets_no) == Number(current)) {
                $(this).css({
                "background-color": "#04AFC3",
                "cursor" : "pointer",
                "pointer-events" : "auto"
            });

            $(this).next().css({
            "background-color": "#a9a9a9",
            "cursor" : "pointer",
            "pointer-events" : "auto"
            });
            }
        });

        if(Number(current) < Number(active)) {
            $(".swiper-pagination-bullet-active").css({
                "background-color": "#a9a9a9",
                "cursor" : "pointer",
                "pointer-events" : "auto"
            });
           }
           });
        });
        });
    }
});
            
    /* Code to disable right click */
    $(document).ready(function(){
        $("img").bind("contextmenu",function(e){
            return false;
        });
    });
            
     
            
    $("#btn-dialog").click(function () {
        $.get('update-course-name', {course_id : $id}, function(name) {
            $('#w1_title').html(name);
        });
   });
     $(".dropdown").click(function () {
        $(".dropdown-toggle").dropdown('toggle');
    });           

JS;
        $this->registerJs($script);
        ?>

        <?php
        $active_lesson_id = "";
        $active_section_id = "";

        foreach ($lessons as $lesson) {
            $check_active_lesson = LearnerActivity::find()
                    ->where(['lesson_id' => $lesson->id])
                    ->andWhere(['learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id])
                    ->andWhere(['completion_status' => 0])
                    ->one();

            if (!empty($check_active_lesson)) {
                $active_lesson_id = $check_active_lesson->lesson_id;
                $active_section_id = $check_active_lesson->section_id;
            }
        }

        if ($active_lesson_id != "") {
            $script1 = <<< JS
            $('#section-$active_section_id').trigger('click');
JS;
            $this->registerJs($script1);
        }
        ?>							
        <script>

            jQuery(function () {
                jQuery('#clickButton').click();
            });
        </script>