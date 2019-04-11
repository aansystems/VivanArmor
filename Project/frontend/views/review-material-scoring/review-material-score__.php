<?php

use yii\helpers\Html;
use frontend\models\Courses;

$notifydaily = count($daily);
$notifyweekly = count($weekly);
$notifymonthly = count($monthly);

/* @var $this yii\web\View */
/* @var $model frontend\models\ReviewMaterialScoring */
/* @var $form yii\widgets\ActiveForm */

$request = Yii::$app->request;
$id = $request->get('id');
?>

<style>  
    .container-fluid {
        min-height: 0 !important;
    }    

    header { 
        width:1000px; 
    }

    @media only screen and (max-width: 990px){

        header { width:990px; }


    }
    @media (min-width: 600px) and (max-width: 991px) {
        #btn1, #btn2, #btn3{
            padding: 3px 3px;
        }
        .col-md-4{
            width: 33.333333%;
            float: left;
        }
        .badge-no{
            padding: 1px 5px !important;
        }
        .day-none h1, .week-none h1, .month-none h1{
            font-size: 75px !important;
            height: 90px !important;
            margin-bottom: 8px !important;
        }
        .tile {

            height: 110px;
        }
        .btn, .navbar .navbar-nav > li > a.btn{
            font-size: 11px;
        }
        .review-icons .card {
            width: 85% !important;
        }
    }

    @media (min-width: 992px) and (max-width: 1120px) {
        .review-icons .card {
            width: 100% !important;
        }
    }
    @media (min-width: 320px) and (max-width: 599px) {
        .tile {   
            height: 110px;
        }
        .day-none h1, .week-none h1, .month-none h1{
            font-size: 75px !important;
            height: 80px !important;
            margin-bottom: 17px !important;
        }
        #btn1, #btn2, #btn3{
            padding: 5px 15px;
        }
        .d-w-m{
            max-height: 750px !important;
        }
        .h4, .h5, .h6, h4, h5, h6{
            margin-top: 3px;
            margin-bottom: 3px;
        }
        h4 {
            font-size: 1.3em !important;
        }
    }

    @media (min-width: 320px) and (max-width: 420px) {
        .customAlert {
            min-width: 80% !important;
        }
    }

    @media (min-width: 421px) and (max-width: 920px) {
        .customAlert {
            min-width: 80% !important;
        }
    }

    .main-panel {
        background-color:#f5f5f5;
    }
    .popover-content{
        display:none !important;
    }
    .badge{
        background-color: #f30c0c;
    }
    .wronganswer{
        background-color: red !important;
    }
    .btn-blue {
        background-color: #0fd850 !important;
    }
    .col-md-12, .col-md-8 {
        padding-left: 0;
        padding-right: 0;
    }
    .dismiss{
        margin-top: -35px !important;   
    }
    .review-icons .card {
        width: 70%;
        height:120px;
    }
    .review-icons .col-md-4 {
        text-align: center;
    }
    #dailydiv h1, #weeklydiv h1, #monthlydiv h1 {
        line-height: 0.7em;
        margin: 0;
        text-align: center;
        font-weight: 500;
    }
    #dailydiv h3, #weeklydiv h3, #monthlydiv h3 {
        margin: 0 !important;
        color: #000000;
    }

    #dailydiv .col5, #weeklydiv .col5, #monthlydiv .col5 {
        border-bottom: 1px solid #808080;
        border-left: 1px solid #808080;
        border-right: 1px solid #808080;
        padding: 5px;
    }
    .check_answer, .check_answer1, .check_answer2 {
        display: none;
    }

    .modal .close {
        font-size: 54px;
        font-weight: 300;
        margin-right: 20px;
    }
    .bootstrap-dialog .bootstrap-dialog-title {
        color: #FFFFFF;
        display: inline-block;
        font-size: 25px;
        font-weight: 500;
        padding-bottom: 3%;
    }
    .bootstrap-dialog-footer-buttons {
        display: none;
    }

    @media (min-width: 768px) {
        .modal-xl {
            width: 60%;
            max-width:1000px;
        }
    }
    #toolbar{
        display: none;
    }

    .day-none h1 {
        background: #ee0979;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to bottom, #ff6a00, #ee0979);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to bottom, #ff6a00, #ee0979); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */  
    }

    .week-none h1 {
        background-image: linear-gradient(to top, #0fd850 0%, #f9f047 100%);
    }

    .month-none h1 {
        background-image: linear-gradient(to top, #3ab5b0 0%, #3d99be 31%, #56317a 100%);
    }

    .day-none h1, .week-none h1, .month-none h1 {
        margin-top: 0;
        margin-bottom: 0;
        font-size: 85px;
        font-weight: 900;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        height: 90px;
    }

    .day-none .card, .week-none .card, .month-none .card {
        background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
    }

    .d-w-m {
        margin-bottom: 0;
        min-height: 440px;
        max-height: 500px;
    }

    .content-wrapper {
        min-height: 0 !important;  
    }
    .card .card-content {
        padding: 0px 20px; 
    }

    .all-micro-lesson{
        max-height: 110px !important;
        overflow-y: scroll !important;

    }
    body{
        -ms-overflow-style:none;
    }

    ::-webkit-scrollbar {
        width: 0px;
    }
    .review-material {
        margin-top: 0px;
    }

    .card .card-content{
        margin-top: -15px;
    }
    .card .card-header1{
        padding: 1px 10px;
        margin: -30px 15px 0;
    }
    @media (min-height: 786px) and (max-height: 820px){
        .d-w-m {
            margin-bottom: 0;
            min-height: 570px;
            max-height: 850px !important;
        }
        .review-material {
            margin-top: 5px;
        }
        .card .card-content{
            margin-top: 0px;
        }
        .card .card-header1{
            padding: 5px 10px;
            margin: -20px 15px 0;
        }
        .all-micro-lesson{
            max-height: 170px !important;
            overflow-y: scroll !important;
        }
    }
    @media (min-height: 680px) and (max-height: 720px){
        .d-w-m {
            margin-bottom: 0;
            min-height: 480px;
            max-height: 570px;
        }
    }
    @media (min-height: 721px) and (max-height: 750px){
        .d-w-m {
            margin-bottom: 0;
            min-height: 515px;
            max-height: 780px !important;
        }
        .all-micro-lesson{
            max-height: 150px !important;
            overflow-y: scroll !important;
        }
    }
    @media (min-height: 751px) and (max-height: 785px){
        .d-w-m {
            margin-bottom: 0;
            min-height: 545px;
            max-height: 570px;
        }
        .all-micro-lesson{
            max-height: 150px !important;
            overflow-y: scroll !important;
        }
        .card .card-content{
            margin-top: 0px;
            padding: 0px 0px;
        }
        .review-icons .card{
            width: 80%;
            height: 150px;
        }
        .day-none h1, .week-none h1, .month-none h1{
            height: 115px;
        }
    }
    @media (min-width: 992px){
        .col-md-8 {
            width: 93.666667%;
        }
    }
    .customAlert {
        min-height: 17% !important;
    }
    @media (max-width: 767px){
    .content {
    margin-top: 25px;
}
audio, canvas, progress, video{
    width:100%;
}
.card .card-header1{
        padding: 1px 10px;
        margin: -20px 15px 0;
    }
}
#myDIV{
    display: none;
}


#myDIV1{
    display: none;
}

#myDIV2{
    display: none;
}


@media (max-width: 414px){
    .modal-content .modal-body {
    padding-right: 25px !important;
}
h3{
    font-size: 1.5em;
}
.modal .modal-header .close i{
    font-size: 25px !important;
}
.dismiss {
    margin-top: -47px !important;
}
}

</style>
<?php
$course = Courses::find()->where(['id' => $id])->one();
?>
<script>
    var answers = [];
    answers = <?= json_encode($answered) ?>;
    var videoelm = document.createElement("video");
    videoelm.width = 500;
    videoelm.height = 240;
    videoelm.controls = true
    videoelm.controlsList = "nodownload";
    var sourceMP4 = document.createElement("source");
    sourceMP4.type = "video/mp4";
    videoelm.append(sourceMP4);
</script>
<div class="content review-material">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card d-w-m">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title"><i class="material-icons">library_books</i>Pending Micro-lessons</h4>
                    </div>
                    <div class="card-content review-icons">
                        <br/>
                        <div class="row">
                            <div class="day-none">
                                <div class="col-md-4">
                                    <div class="card tile ">
                                        <center>  
                                            <h1>D</h1>
                                            <a type="button" id="btn1" data-toggle="modal" data-target="#Daily" data-backdrop="static" data-keyboard="false" class="btn btn-info">
                                                Daily <data-toggle="modal" data-target="#Daily" class="badge-no badge-default"><?= $notifydaily ?>
                                            </a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="week-none">
                                <div class="col-md-4">
                                    <div class="card tile">
                                        <center>  
                                            <h1>W</h1>
                                            <a id="btn2" type="button" data-toggle="modal" data-target="#Weekly" data-backdrop="static" data-keyboard="false" class="btn btn-blue">
                                                Weekly <data-toggle="modal" data-target="#Weekly"  class="badge-no badge-default "><?= $notifyweekly ?>
                                            </a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="month-none">
                                <div class="col-md-4">
                                    <div class="card tile">
                                        <center>
                                            <h1>M</h1>
                                            <a id="btn3" type="button" data-toggle="modal" data-target="#Monthly" data-backdrop="static" data-keyboard="false" class="btn">
                                                Monthly <data-toggle="modal" data-target="#Monthly" class="badge-no badge-default"><?= $notifymonthly ?>
                                            </a>
                                        </center>
                                    </div>                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <br> <br>
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title"><i class="material-icons">library_books</i>All Micro-lessons</h4>
                    </div>

                    <div class="row all-micro-lesson"  style="margin-top:10px;">
                        <div class=" col-md-offset-1 col-sm-3">
                            <h4>
                                <ul id="daily-index">

                                    <?php
                                    $z = 1;
                                    foreach ($answered[1] as $index1 => $daily_answer) {
                                        ?>
                                        <li><a class="review_res" href="#" data-toggle="modal" data-target="#review_results" data-backdrop="static" data-index="<?= $index1 ?>" review_type="1">Cyber Security Daily <?= $z++ ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </h4>


                        </div>
                        <div class=" col-md-offset-1 col-sm-3">
                            <h4>
                                <ul id="weekly-index">
                                    <?php
                                    unset($z);
                                    $z = 1;
                                    foreach ($answered[2] as $index2 => $weekly_answer) {
                                        ?>
                                        <li><a class="review_res" href="#" data-toggle="modal" data-target="#review_results" data-backdrop="static" data-index="<?= $index2 ?>" review_type="2">Cyber Security Weekly <?= $z++ ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </h4>


                        </div>
                        <div class=" col-md-offset-1  col-sm-3">
                            <h4>
                                <ul id="monthly-index">
                                    <?php
                                    unset($z);
                                    $z = 1;
                                    foreach ($answered[3] as $index3 => $monthly_answer) {
                                        ?>
                                        <li><a class="review_res" href="#" data-toggle="modal" data-target="#review_results" data-backdrop="static" data-index="<?= $index3 ?>" review_type="3">Cyber Security Monthly <?= $z++ ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </h4>

                        </div>
                    </div>
                    <?= Html::a('Back', ['/courses-assigned/my-courses'], ['class' => 'btn btn-primary pull-right', 'style' => 'margin-right: 20px;']) ?>       
                </div>


            </div>

        </div>

    </div>

</div>

<?php
$base_url = Yii::$app->request->baseUrl;
$course_name = Courses::findOne(['id' => $id])->course_name;
?>

<!--Review Results Modal -->

<div class="modal fade" id="review_results" tabindex="-1" role="dialog" aria-labelledby="weekly" aria-hidden="true" style="margin-top: -85px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center><h3 class="modal-title" id="res_title">
                        Weekly Material
                    </h3>
                </center>
                <button type="button" id="week-close" class="close weeklyclose dismiss" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times-circle-o"  style="font-size:34px;color:#333;"  aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body" id="res_body">
                <div id="res_video" class="text-center"></div>
                <b><h4 id="res_description"></h4></b>
                <p id="res_answered"></p>
                <p id="res_correct_answer"></p>
                <b><p>Explanation:</p></b><p id="res_explanation"></p>
            </div>
        </div>
    </div>
</div>

<!--Daily Modal -->
<div class="modal fade" id="Daily" tabindex="-1" role="dialog" aria-labelledby="daily" aria-hidden="true" style="margin-top: -85px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>  <h3 class="modal-title" id="exampleModalLongTitle">
                        Daily Material
                    </h3></center>
                <button type="button" id="day-close" class="close dailyclose dismiss" onclick="location.href = '<?= Yii::$app->request->baseUrl ?>/review-material-scoring/review-material-score?id=<?= $id ?>'" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times-circle-o"  style="font-size:34px;color:#333;"  aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="review-material-scoring">
                    <div id="group">
                    <?php if(!empty($daily)){ ?>
                        <?php
                       
                        $i = 1; 
                        foreach ($daily as $review_daily) {
                            if ($review_daily->description_type == 1 || $review_daily->description_type == 2) {
                                ?>

                                <?php
                                $last = count($daily);
                                if ($i == 1) {
                                    ?>
                                    <div class="current" id="question-block-<?= $review_daily->id ?>"
                                    <?php
                                } else {
                                    ?>
                                         <div  id="question-block-<?= $review_daily->id ?>" style="display:none">
                                             <?php }
                                             ?>
                                        <b><h4 class="question"><?= $review_daily->description ?></h4></b>
                                        <?php
                                        $options = explode(",", $review_daily->options);
                                        $j = 1;
                                        foreach ($options as $option) {
                                            ?>
                                            <b> <input type='radio' onclick="$(this).parent().siblings('.check_answer').show();" class="options_radio" name='review_material_<?= $review_daily->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                            <?php
                                            $j++;
                                        }
                                        ?>
                                        </br> <div id="result-block-<?= $review_daily->id ?>"></div>

                                        <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer', 'value' => $review_daily->id]) ?>
                                        <?php if ($last == $i) {
                                            ?>
                                            <button id="finish" type="button" data-toggle="modal" data-target="#dailyresult" style=" float:right; color:white; " class="finish nxt btn btn-info ">Finish</button>
                                            <?php
                                        } else {
                                            ?>
                                            <button id="next" type="button"   style=" float:right; color:white; " class="next nxt btn btn-info ">next</button>


                                            <?php
                                        };
                                    }
                                    ?>
                                    <?php if ($review_daily->description_type == 3) {
                                        ?> 
                                        <?php
                                        $last = count($daily);
                                        if ($i == 1) {
                                            ?>
                                            <div class="current " id="question-block-<?= $review_daily->id ?>"
                                            <?php
                                        } else {
                                            ?>
                                                 <div  id="question-block-<?= $review_daily->id ?>" style="display:none">
                                                     <?php }
                                                     ?>                                                         
                                                <b><h4 class="question stickynotes"><?= $review_daily->description ?></h4></b>
                                                <?php
                                                $options = explode(",", $review_daily->options);
                                                $j = 1;
                                                foreach ($options as $option) {
                                                    ?>
                                                    <b> <input type='radio' onclick="$(this).parent().siblings('.check_answer').show();" class="options_radio" name='review_material_<?= $review_daily->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                    <?php
                                                    $j++;
                                                }
                                                ?>
                                                </br> <div id="result-block-<?= $review_daily->id ?>"></div>

                                                <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer', 'value' => $review_daily->id]) ?>
                                                <?php if ($last == $i) {
                                                    ?>
                                                    <button id="finish" type="button" data-toggle="modal" data-target="#dailyresult" style=" float:right; color:white; " class="finish nxt btn btn-info ">Finish</button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button id="next" type="button"  data-toggle="modal" data-target="#dailyresult" style=" float:right; color:white; " class="next nxt btn btn-info ">next</button>


                                                    <?php
                                                };
                                            }
                                            ?>   
                                            <?php if ($review_daily->description_type == 5) {
                                                ?> 

                                                <?php
                                                $last = count($daily);
                                                if ($i == 1) {
                                                    ?>
                                                    <div class="current " id="question-block-<?= $review_daily->id ?>">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div  id="question-block-<?= $review_daily->id ?>" style="display:none">
                                                        <?php }
                                                        ?>

                                                        <video class="question" height= 240 controls controlsList="nodownload" style="width: auto;">
                                                            <source src="../uploads/video/<?= $review_daily->link ?>.mp4"  type="video/mp4">
                                                        </video>
                                                        <p style="color:red">*NOTE:please watch the video before answering the question</p>


                                                        <b><h4 class="question"><?= $review_daily->description ?></h4></b>
                                                        <?php
                                                        $options = explode(",", $review_daily->options);
                                                        $j = 1;
                                                        $option_array_length = sizeof($options);

                                                        foreach ($options as $option) {
                                                            ?>
                                                            <b> <input type='radio' onclick="$(this).parent().siblings('.check_answer').show();" class="options_radio" name='review_material_<?= $review_daily->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                            <?php
                                                            $j++;
                                                        }
                                                        ?>
                                                        </br> <div id="result-block-<?= $review_daily->id ?>"></div>

                                                        <?php if ($option_array_length == 1) {
                                                            ?>
                                                            <?= Html::button('watched', ['class' => 'btn btn-primary check_answer', 'value' => $review_daily->id]) ?>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer', 'value' => $review_daily->id]) ?>
                                                        <?php } ?>
                                                        <?php if ($last == $i) {
                                                            ?>
                                                            <button id="finish" type="button" data-toggle="modal" data-target="#dailyresult" style=" float:right; color:white; " class="finish nxt btn btn-info ">Finish</button>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button id="next" type="button" style=" float:right; color:white; " class="next nxt btn btn-info ">next</button>
                                                            <?php
                                                        };
                                                    }
                                                    ?> 



                                                    <?php if ($review_daily->description_type == 6) {
                                                        ?> 

                                                        <?php
                                                        $last = count($daily);
                                                        if ($i == 1) {
                                                            ?>
                                                            <div class="current " id="question-block-<?= $review_daily->id ?>">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <div  id="question-block-<?= $review_daily->id ?>" style="display:none">
                                                                <?php }
                                                                ?>

                                                                <b><h4 class="question"><?= $review_daily->description ?></h4></b>
                                                                <?php
                                                                $options = explode(",", $review_daily->options);
                                                                $j = 1;
                                                                $option_array_length = sizeof($options);

                                                                foreach ($options as $option) {
                                                                    ?>
                                                                    <b> <input type='radio' onclick="$(this).parent().siblings('.check_answer').show();" class="options_radio" name='review_material_<?= $review_daily->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                                    <?php
                                                                    $j++;
                                                                }
                                                                ?>
                                                                </br> <div id="result-block-<?= $review_daily->id ?>"></div>

                                                                <?php if ($option_array_length == 1) {
                                                                    ?>
                                                                    <?= Html::button('Ok', ['class' => 'btn btn-primary check_answer', 'value' => $review_daily->id]) ?>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer', 'value' => $review_daily->id]) ?>
                                                                <?php } ?>
                                                                <?php if ($last == $i) {
                                                                    ?>
                                                                    <button type="button" id="finish" data-toggle="modal" data-target="#dailyresult" style=" float:right; color:white; " class="finish nxt btn btn-info ">Finish</button>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <button id="next" type="button" style=" float:right; color:white; " class="next nxt btn btn-info ">next</button>
                                                                    <?php
                                                                };
                                                            }
                                                            ?>  
                                                                    
                                                            



                                                        </div>
                                                                 

                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                    <?php ?>
                                                                
                            <?php } else { ?>
                                <p style="text-align:center;">
                                    You have Successfully completed daily material
                                </p>                         
                        <?php } ?>
                                                            
                             
                                                </div>

                                            </div>
                                        
                                             <p id="myDIV" style="text-align:center;">
                                                You have Successfully completed daily material
                                            </p>

                                         
                                        </div>
                                    </div>
                                </div>
                                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Weekly Modal -->
        <div class="modal fade" id="Weekly" tabindex="-1" role="dialog" aria-labelledby="weekly" aria-hidden="true" style="margin-top: -85px;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <center><h3 class="modal-title" id="exampleModalLongTitle">
                                Weekly Material
                            </h3></center>
                        <button type="button" id="week-close" class="close weeklyclose dismiss" onclick="location.href = '<?= Yii::$app->request->baseUrl ?>/review-material-scoring/review-material-score?id=<?= $id ?>'" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times-circle-o"  style="font-size:34px;color:#333;"  aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="review-material-scoring">
                            <div id="group1">
                             <?php if(!empty($weekly)){ ?>
                                <?php
                                $i = 1;
                                foreach ($weekly as $review_weekly) {
                                    if ($review_weekly->description_type == 1 || $review_weekly->description_type == 2) {
                                        ?>
                                        <?php
                                        $last = count($weekly);
                                        if ($i == 1) {
                                            ?>
                                            <div class="current1" id="question-block-<?= $review_weekly->id ?>"
                                            <?php
                                        } else {
                                            ?>
                                                 <div  id="question-block-<?= $review_weekly->id ?>" style="display:none">
                                                     <?php } ?>
                                                <b><h4 class="question"><?= $review_weekly->description ?></h4></b>
                                                <?php
                                                $options = explode(",", $review_weekly->options);
                                                $j = 1;
                                                foreach ($options as $option) {
                                                    ?>
                                                    <b><input type='radio' onclick="$(this).parent().siblings('.check_answer1').show();"  name='review_material_<?= $review_weekly->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                    <?php
                                                    $j++;
                                                }
                                                ?>
                                                </br> <div id="result-block-<?= $review_weekly->id ?>"></div>

                                                <?= Html::button('Check Answer', ['class' => 'btn btn-primary  check_answer1', 'value' => $review_weekly->id]) ?>
                                                <?php if ($last == $i) {
                                                    ?>
                                                    <button id="finish1" data-toggle="modal" data-target="#weeklyresult" type="button" style=" float:right; color:white;" class="finish1 nxt btn btn-info">Finish</button>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <button id="next1" type="button" style=" float:right; color:white;" class="next1 nxt btn btn-info">next</button>

                                                    <?php
                                                };
                                            }
                                            ?>
                                            <?php if ($review_weekly->description_type == 3) {
                                                ?>
                                                <?php
                                                $last = count($weekly);
                                                if ($i == 1) {
                                                    ?>
                                                    <div class="current1" id="question-block-<?= $review_weekly->id ?>"
                                                    <?php
                                                } else {
                                                    ?>
                                                         <div  id="question-block-<?= $review_weekly->id ?>" style="display:none">
                                                             <?php }
                                                             ?>
                                                        <b><h4 class="question stickynotes"><?= $review_weekly->description ?></h4></b>
                                                        <?php
                                                        $options = explode(",", $review_weekly->options);
                                                        $j = 1;
                                                        foreach ($options as $option) {
                                                            ?>
                                                            <b><input type='radio' onclick="$(this).parent().siblings('.check_answer1').show();" name='review_material_<?= $review_weekly->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                            <?php
                                                            $j++;
                                                        }
                                                        ?>
                                                        </br> <div id="result-block-<?= $review_weekly->id ?>"></div>

                                                        <?= Html::button('Check Answer', ['class' => 'btn btn-primary  check_answer1', 'value' => $review_weekly->id]) ?>
                                                        <?php if ($last == $i) {
                                                            ?>
                                                            <button id="finish1" data-toggle="modal" data-target="#weeklyresult" type="button" style=" float:right; color:white;" class="finish1 nxt btn btn-info">Finish</button>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button id="next1" type="button" style=" float:right; color:white;" class="next1 nxt btn btn-info">next</button>

                                                            <?php
                                                        };
                                                    }
                                                    ?>
                                                    <?php if ($review_weekly->description_type == 5) {
                                                        ?>
                                                        <?php
                                                        $last = count($weekly);
                                                        if ($i == 1) {
                                                            ?>
                                                            <div class="current1" id="question-block-<?= $review_weekly->id ?>">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <div  id="question-block-<?= $review_weekly->id ?>" style="display:none">
                                                                <?php }
                                                                ?>

                                                                <video width="100%" height="240" controls controlsList="nodownload">
                                                                    <source src="../uploads/video/<?= $review_weekly->link ?>.mp4"  type="video/mp4">
                                                                </video>
                                                                <p style="color:red">*NOTE:please watch the video before answering the question</p>

                                                                <b><h4 class="question"><?= $review_weekly->description ?></h4></b>
                                                                <?php
                                                                $options = explode(",", $review_weekly->options);
                                                                $j = 1;
                                                                $option_array_length = sizeof($options);
                                                                foreach ($options as $option) {
                                                                    ?>
                                                                    <b><input type='radio' onclick="$(this).parent().siblings('.check_answer1').show();" name='review_material_<?= $review_weekly->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                                    <?php
                                                                    $j++;
                                                                }
                                                                ?>
                                                                </br> <div id="result-block-<?= $review_weekly->id ?>"></div>

                                                                <?php if ($option_array_length == 1) {
                                                                    ?>
                                                                    <?= Html::button('watched', ['class' => 'btn btn-primary check_answer1', 'value' => $review_weekly->id]) ?>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer1', 'value' => $review_weekly->id]) ?>
                                                                <?php } ?>
                                                                <?php if ($last == $i) {
                                                                    ?>
                                                                    <button id="finish1" data-toggle="modal" data-target="#weeklyresult" type="button" style=" float:right; color:white;" class="finish1 nxt btn btn-info">Finish</button>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <button id="next1" type="button" style=" float:right; color:white;" class="next1 nxt btn btn-info">next</button>

                                                                    <?php
                                                                };
                                                            }
                                                            ?>


                                                            <?php if ($review_weekly->description_type == 6) {
                                                                ?>
                                                                <?php
                                                                $last = count($weekly);
                                                                if ($i == 1) {
                                                                    ?>
                                                                    <div class="current1" id="question-block-<?= $review_weekly->id ?>">
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div  id="question-block-<?= $review_weekly->id ?>" style="display:none">
                                                                        <?php }
                                                                        ?>
                                                                            
                                                                        <b><h4 class="question" style="height: 300px;overflow-y:scroll;"><?= $review_weekly->description ?></h4></b>
                                                                        <?php
                                                                        $options = explode(",", $review_weekly->options);
                                                                        $j = 1;
                                                                        $option_array_length = sizeof($options);
                                                                        foreach ($options as $option) {
                                                                            ?>
                                                                            <b><input type='radio' onclick="$(this).parent().siblings('.check_answer1').show();" name='review_material_<?= $review_weekly->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                                            <?php
                                                                            $j++;
                                                                        }
                                                                        ?>
                                                                        </br> <div id="result-block-<?= $review_weekly->id ?>"></div>

                                                                        <?php if ($option_array_length == 1) {
                                                                            ?>
                                                                            <?= Html::button('Ok', ['class' => 'btn btn-primary check_answer1', 'value' => $review_weekly->id]) ?>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer1', 'value' => $review_weekly->id]) ?>
                                                                        <?php } ?>
                                                                        <?php if ($last == $i) {
                                                                            ?>
                                                                            <button id="finish1" data-toggle="modal" data-target="#weeklyresult" type="button" style=" float:right; color:white;" class="finish1 nxt btn btn-info">Finish</button>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <button id="next1" type="button" style=" float:right; color:white;" class="next1 nxt btn btn-info">next</button>

                                                                            <?php
                                                                        };
                                                                    }
                                                                    ?>



                                                                </div>
                                                                <?php
                                                                $i++;
                                                            }
                                                            ?>
                                                            <?php ?>
                                                                          <?php } else { ?>
                                <p style="text-align:center;">
                                    You have Successfully completed Weekly Material
                                </p>                         
                        <?php } ?>
                                                        </div>
                                                    </div>

                                                     <p id="myDIV1" style="text-align:center;">
                                                You have Successfully completed Weekly Material
                                            </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Monthly Modal -->
                <div class="modal fade" id="Monthly" tabindex="-1" role="dialog" aria-labelledby="monthly" aria-hidden="true" style="margin-top: -85px;">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <center> <h3 class="modal-title" id="exampleModalLongTitle">
                                        Monthly Material
                                    </h3></center>
                                <button type="button" id="month-close" class="close monthlyclose dismiss" onclick="location.href = '<?= Yii::$app->request->baseUrl ?>/review-material-scoring/review-material-score?id=<?= $id ?>'" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-times-circle-o"  style="font-size:34px;color:#333;" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="review-material-scoring">
                                            <div id="group2">
                                                  <?php if(!empty($monthly)){ ?>
                                                <?php
                                                $i = 1;
                                                foreach ($monthly as $review_weekly) {
                                                    if ($review_weekly->description_type == 1 || $review_weekly->description_type == 2) {
                                                        ?>
                                                        <?php
                                                        $last = count($monthly);
                                                        if ($i == 1) {
                                                            ?>
                                                            <div class="current2" id="question-block-<?= $review_weekly->id ?>"
                                                            <?php
                                                        } else {
                                                            ?>
                                                                 <div  id="question-block-<?= $review_weekly->id ?>" style="display:none">
                                                                     <?php }
                                                                     ?>
                                                                <b><h4 class="question"><?= $review_weekly->description ?></h4></b>
                                                                <?php
                                                                $options = explode(",", $review_weekly->options);
                                                                $j = 1;
                                                                foreach ($options as $option) {
                                                                    ?>
                                                                    <b><input type='radio' onclick="$(this).parent().siblings('.check_answer2').show();" name='review_material_<?= $review_weekly->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                                    <?php
                                                                    $j++;
                                                                }
                                                                ?>
                                                                </br> <div id="result-block-<?= $review_weekly->id ?>"></div>

                                                                <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer2', 'value' => $review_weekly->id]) ?>
                                                                <?php if ($last == $i) {
                                                                    ?>
                                                                    <button id="finish2" data-toggle="modal" data-target="#monthlyresult" type="button" style=" float:right; color:white;" class="finish2 nxt btn btn-info">Finish</button>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <button id="next2" type="button" style=" float:right; color:white;" class="next2 nxt btn btn-info">next</button>
                                                                    <?php
                                                                };
                                                            }
                                                            ?>
                                                            <?php if ($review_weekly->description_type == 3) {
                                                                ?>
                                                                <?php
                                                                $last = count($monthly);
                                                                if ($i == 1) {
                                                                    ?>
                                                                    <div class="current2" id="question-block-<?= $review_weekly->id ?>"
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                         <div  id="question-block-<?= $review_weekly->id ?>" style="display:none">
                                                                             <?php }
                                                                             ?>
                                                                        <b><h4 class="question stickynotes"><?= $review_weekly->description ?></h4></b>
                                                                        <?php
                                                                        $options = explode(",", $review_weekly->options);
                                                                        $j = 1;
                                                                        foreach ($options as $option) {
                                                                            ?>
                                                                            <b><input type='radio' onclick="$(this).parent().siblings('.check_answer2').show();" name='review_material_<?= $review_weekly->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                                            <?php
                                                                            $j++;
                                                                        }
                                                                        ?>
                                                                        </br> <div id="result-block-<?= $review_weekly->id ?>"></div>

                                                                        <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer2', 'value' => $review_weekly->id]) ?>
                                                                        <?php if ($last == $i) {
                                                                            ?>
                                                                            <button id="finish2" data-toggle="modal" data-target="#monthlyresult" type="button" style=" float:right; color:white;" class="finish2 nxt btn btn-info">Finish</button>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <button id="next2" type="button" style=" float:right; color:white;" class="next2 nxt btn btn-info">next</button>
                                                                            <?php
                                                                        };
                                                                    }
                                                                    ?>

                                                                    <?php if ($review_weekly->description_type == 5) {
                                                                        ?>
                                                                        <?php
                                                                        $last = count($monthly);
                                                                        if ($i == 1) {
                                                                            ?>
                                                                            <div class="current2" id="question-block-<?= $review_weekly->id ?>">
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <div  id="question-block-<?= $review_weekly->id ?>" style="display:none">
                                                                                <?php }
                                                                                ?>

                                                                                <video width="100%" height="240" controls controlsList="nodownload">
                                                                                    <source src="../uploads/video/<?= $review_weekly->link ?>.mp4"  type="video/mp4">
                                                                                </video>
                                                                                <p style="color:red">*NOTE:please watch the video before answering the question</p>
                                                                                <b><h4 class="question"><?= $review_weekly->description ?></h4></b>
                                                                                <?php
                                                                                $options = explode(",", $review_weekly->options);
                                                                                $option_array_length = sizeof($options);
                                                                                $j = 1;
                                                                                foreach ($options as $option) {
                                                                                    ?>
                                                                                    <b><input type='radio' onclick="$(this).parent().siblings('.check_answer2').show();" name='review_material_<?= $review_weekly->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                                                    <?php
                                                                                    $j++;
                                                                                }
                                                                                ?>
                                                                                </br> <div id="result-block-<?= $review_weekly->id ?>"></div>
                                                                                <?php if ($option_array_length == 1) {
                                                                                    ?>
                                                                                    <?= Html::button('watched', ['class' => 'btn btn-primary check_answer2', 'value' => $review_weekly->id]) ?>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer2', 'value' => $review_weekly->id]) ?>
                                                                                <?php } ?>

                                                                                <?php if ($last == $i) {
                                                                                    ?>
                                                                                    <button id="finish2" data-toggle="modal" data-target="#monthlyresult" type="button" style=" float:right; color:white;" class="finish2 nxt btn btn-info">Finish</button>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <button id="next2" type="button" style=" float:right; color:white;" class="next2 nxt btn btn-info">next</button>
                                                                                    <?php
                                                                                };
                                                                            }
                                                                            ?>




                                                                            <?php if ($review_weekly->description_type == 6) {
                                                                                ?>
                                                                                <?php
                                                                                $last = count($monthly);
                                                                                if ($i == 1) {
                                                                                    ?>
                                                                                    <div class="current2" id="question-block-<?= $review_weekly->id ?>">
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                        <div  id="question-block-<?= $review_weekly->id ?>" style="display:none">
                                                                                        <?php }
                                                                                        ?>

                                                                                        <?php if ($review_weekly->link != null) { ?>
                                                                                            <iframe src="../uploads/ReviewMaterial/<?= $review_weekly->link ?>.pdf" width="100%" height="470px" controls controlsList="nodownload">
                                                                                                <p>Your browser does not support iframes.</p>
                                                                                            </iframe>
                                                                                        <?php } ?>
                                                                                        <b><h4 class="question"><?= $review_weekly->description ?></h4></b>
                                                                                        <?php
                                                                                        $options = explode(",", $review_weekly->options);
                                                                                        $option_array_length = sizeof($options);
                                                                                        $j = 1;
                                                                                        foreach ($options as $option) {
                                                                                            ?>
                                                                                            <b><input type='radio' onclick="$(this).parent().siblings('.check_answer2').show();" name='review_material_<?= $review_weekly->id ?>[answer]' value='<?= $j ?>'> <?= $option ?></b> <br/>
                                                                                            <?php
                                                                                            $j++;
                                                                                        }
                                                                                        ?>
                                                                                        </br> <div id="result-block-<?= $review_weekly->id ?>"></div>
                                                                                        <?php if ($option_array_length == 1) {
                                                                                            ?>
                                                                                            <?= Html::button('ok', ['class' => 'btn btn-primary check_answer2', 'value' => $review_weekly->id]) ?>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                            <?= Html::button('Check Answer', ['class' => 'btn btn-primary check_answer2', 'value' => $review_weekly->id]) ?>
                                                                                        <?php } ?>

                                                                                        <?php if ($last == $i) {
                                                                                            ?>
                                                                                            <button id="finish2" data-toggle="modal" data-target="#monthlyresult" type="button" style=" float:right; color:white;" class="finish2 nxt btn btn-info">Finish</button>
                                                                                            <?php
                                                                                        } else {
                                                                                            ?>
                                                                                            <button id="next2" type="button" style=" float:right; color:white;" class="next2 nxt btn btn-info">next</button>
                                                                                            <?php
                                                                                        };
                                                                                    }
                                                                                    ?>      

                                                                                </div>

                                                                                <?php
                                                                                $i++;
                                                                            }
                                                                            ?>
                                                                            <?php ?>
                                                                                                                                   <?php } else { ?>
                                <p style="text-align:center;">
                                    You have Successfully completed Monthly Material
                                </p>                         
                        <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                                
                                            <p id="myDIV2" style="text-align:center;">
                                                You have Successfully completed Monthly Material
                                            </p>
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
                    
            <script>

                $('#finish').click(function(){
                    $('#myDIV').css('display','block');
                });
                 
                 
                   $('#finish1').click(function(){
                    $('#myDIV1').css('display','block');
                });
                 
                  $('#finish2').click(function(){
                    $('#myDIV2').css('display','block');
                });
                 
            </script>   
     <?php
                    $script = <<< JS

/* function to get the result: Author panda */
function getResult(typeid){
    $.get('review-material-result', { review_material_typeid : typeid}, function(data) {
     if(typeid==1){
        $('#score').html(data);
     }
     if(typeid==2){
        $('#score1').html(data);
     }
     if(typeid==3){
        $('#score2').html(data);
     }
    });
}

/* When radio button clicked Check Answer will Appear : Author panda */
$(document).ready(function() {
    $('#btn1').click(function(){getResult(1)});
    $('#btn2').click(function(){getResult(2)});
    $('#btn3').click(function(){getResult(3)});
    $('input[type=radio]').on('change', function() {
            parent_div = $(this).parent().closest('div').attr('id');
        $("#" + parent_div + " .check_answer").css("display","inline-block");
    });
 /* Capturing data in session : Author panda */
 $('.check_answer').click(function() {
        $(this).prop('disabled', true);
            button_value = this.value;
            option_value = $("input[name='review_material_" + button_value + "[answer]']:checked").val();
            $.get('capture-question-session', { review_material_id : button_value, answered_option : option_value}, function(data) {
                $('#result-block-' + button_value).html(data);
                getResult(1);
            });
                                
 /* When check answer clicked next button  will Appear : Author panda */
        parent_div = $(this).parent().closest('div').attr('id');
        $("#" + parent_div + " .nxt").css("display","inline-block");
        
 });
        /* showig score in scoreboard on click of check answer for weekly review material : Author Prem */ 
   $('.check_answer1').click(function() {
        $(this).prop('disabled', true);
            button_value = this.value;
            option_value = $("input[name='review_material_" + button_value + "[answer]']:checked").val();
            $.get('capture-question-session', { review_material_id : button_value, answered_option : option_value}, function(data) {
                $('#result-block-' + button_value).html(data);
                getResult(2);
            });
             /* When check answer clicked next button  will Appear : Author panda */
        parent_div = $(this).parent().closest('div').attr('id');
        $("#" + parent_div + " .nxt").css("display","inline-block");
        
 });
        /* showig score in scoreboard on click of check answer for monthly review material : Author Panda */ 
    $('.check_answer2').click(function() {
        $(this).prop('disabled', true);
            button_value = this.value;
            option_value = $("input[name='review_material_" + button_value + "[answer]']:checked").val();
            $.get('capture-question-session', { review_material_id : button_value, answered_option : option_value}, function(data) {
                $('#result-block-' + button_value).html(data);
                getResult(3);
            });
 /* When check answer clicked next button  will Appear : Author panda */
        parent_div = $(this).parent().closest('div').attr('id');
        $("#" + parent_div + " .nxt").css("display","inline-block");
        
 });

});

/*For Notification*/
$('.nodaily').click(function(){
    $(this).css('display','none');
});
$('.noweekly').click(function(){
    $(this).css('display','none');
});
$('.nomonthly').click(function(){
    $(this).css('display','none');
});
$('#btn1').click(function(){
    $('.nodaily').css('display','none');
});
$('#btn2').click(function(){
    $('.noweekly').css('display','none');
});
$('#btn3').click(function(){
    $('.nomonthly').css('display','none');
});
/* For Score Dispalay : Author panda */

 /* For Pagination : Author panda */
$(function () {
    var updateDiv = function (trigger) {
        var currentDiv = $(".current");
    $("#group").children().removeClass("current").hide();
    if (trigger.hasClass("next") && currentDiv.next("div").length > 0) {
        currentDiv.next("div").addClass("current").show();
        //var userid= $('#loggedinuser').val();
        getResult(1);
    }
    else if(trigger.hasClass("finish")){
    }
    updateNavigation();
};
var updateNavigation = function () {
    var intialDiv = $(".current");
    intialDiv.show();
    var intialDivIndex = intialDiv.index();
};
var totalDivs = $("#group").children().length;
updateNavigation();
$("#next,#finish").on("click", function () {
    updateDiv($(this));
});

var updateDiv1 = function (trigger) {
    var currentDiv = $(".current1");
$("#group1").children().removeClass("current1").hide();
if (trigger.hasClass("next1") && currentDiv.next("div").length > 0) {
    currentDiv.next("div").first().addClass("current1").show();
        getResult(2);
}
else if(trigger.hasClass("finish1")){
        getResult(2);
}
updateNavigation1();
};
var updateNavigation1 = function () {
var intialDiv = $(".current1");
intialDiv.show();
var intialDivIndex = intialDiv.index();
};
var totalDivs1 = $("#group1").children().length;
$("#next1,#finish1").on("click", function () {
updateDiv1($(this));
});

                                
var updateDiv2 = function (trigger) {
    var currentDiv = $(".current2");
$("#group2").children().removeClass("current2").hide();
if (trigger.hasClass("next2") && currentDiv.next("div").length > 0) {
    currentDiv.next("div").first().addClass("current2").show();

        getResult(3);
}
else if(trigger.hasClass("finish2")){

        getResult(3);

}
updateNavigation2();
};
var updateNavigation2 = function () {
var intialDiv = $(".current2");
intialDiv.show();
var intialDivIndex = intialDiv.index();

};
var totalDivs2 = $("#group2").children().length;
$("#next2,#finish2").on("click", function () {
updateDiv2($(this));
});
});


$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
}); 
   
/*   for mobile view :author bharath */
          $(document).ready(function() {                         
       if ((screen.width<=1024) && (screen.height>=400)){         
    $('#btn1').click(function(){
    $('.week-none').css('display','none');
    $('.month-none').css('display','none');                            
});
  $('#finish').click(function(){
    $('.week-none').css('display','block');
    $('.month-none').css('display','block');                         
 }); 
   $('#day-close').click(function(){                                
    $('.week-none').css('display','block');
    $('.month-none').css('display','block');                                                       
  });                       
       $('#btn2').click(function(){
    $('.day-none').css('display','none');
    $('.month-none').css('display','none');                            
});
  $('#finish1').click(function(){
    $('.day-none').css('display','block');
    $('.month-none').css('display','block');                         
 });   
  $('#week-close').click(function(){                                
    $('.day-none').css('display','block');
    $('.month-none').css('display','block');                                                       
  });
     
$('#btn3').click(function(){
    $('.day-none').css('display','none');
    $('.week-none').css('display','none');                            
});
  $('#finish2').click(function(){
    $('.day-none').css('display','block');
    $('.week-none').css('display','block');                         
 });
                                
   $('#month-close').click(function(){                                
    $('.day-none').css('display','block');
    $('.week-none').css('display','block');                                                       
  });                          
  }

});
               
    $('.review_res').click(function() {
        var i = $(this).attr('review_type');
        var j = $(this).attr('data-index');                            
        var options = answers[i][j]['options'].split(",");
        $("#res_title").html(answers[i][j]['review_material_type'] + " Material");
        $("#res_description").html(answers[i][j]['description']);
        $("#res_answered").html("Your answer: " + options[answers[i][j]['answer']-1]);
        $("#res_correct_answer").html("Correct answer: " + options[answers[i][j]['right_answer']-1]);
        $("#res_explanation").html(answers[i][j]['explanation']);
        if(answers[i][j]['link']) {
            var vid_link = answers[i][j]['link'];
                          
                            if(vid_link != ''){
            $('#res_video').html('<video width=auto height=240 controls controlsList="nodownload"><source id="video_src" src="../uploads/video/' + vid_link + '.mp4"  type="video/mp4"></video>');
        }
   } else {
            $('#res_video').html('');
        }
    });
                           
JS;
                    $this->registerJs($script);
                    