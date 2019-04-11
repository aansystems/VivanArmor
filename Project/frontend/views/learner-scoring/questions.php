<?php

use yii\helpers\Html;
use frontend\models\Courses;
use frontend\models\Questions;
use frontend\models\Learners;
use frontend\models\Certificates;
use kartik\dialog\Dialog;

/* @var $this yii\web\View */
/* @var $model frontend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
$request = Yii::$app->request;
$id = $request->get('id');

echo Dialog::widget([
    'options' => [
        'title' => 'Your Attention !',
    ]
]);
echo Dialog::widget();
?>

<!--css for questions and answers-->
<style>
    @media (min-width: 320px) and (max-width: 700px) {
        #last_score {
            font-size: 19px !important;
            margin: 24px !important; 
        }
    }

    @media (min-width: 768px) and (max-width:720px) {
        #last_score {
            font-size: 20px !important;
            margin: 25px !important; 
        }
    }

    .radio-inline{
        margin-top: 1em;
        position: relative;
        display: inline-block;
        padding-left: 20px;
        margin-bottom: 1%;
        font-weight: initial;
        vertical-align: middle;
        cursor: pointer;
        font-size: 15px;
        color: black;
    }
    .result-block{
        margin-top:35px;
    }

    .question-block- .options_radio{
        counter-reset: Serial;           /* Set the Serial counter to 0 */
        font-weight: 600 !important;
        line-height: 1em !important;
    }
    td:first-child:before{
        counter-increment: Serial;      /* Increment the Serial counter */
        content: "Serial is: " counter(Serial); /* Display the counter */
    }

    input[type="radio"], input[type="checkbox"] {
        margin: 10px 0px 0 0px;
        margin-top: 1px \9;
        line-height: normal;
    }


    .check_answer {
        margin: 2% 0%;
        display: none;
    }

    .scoring {
        background-color: #00bcd440;
        height: auto;
        border-radius: 10px;
        width: 40%;
        margin-left: 270px;
        padding: 20px;
        border-left: 8px solid #caa214;
        border-radius: 0;
        border-right: 8px solid #caa214;
        text-align: center;
        font-size: 20px;
        border-radius: 10px;
        border-top: 8px solid #caa214;
        border-bottom: 8px solid #caa214;
    }
    @media (min-width: 300px) and (max-width: 382px) {
        .next{
            padding:10px !important;
        }
        .check_answer{
            padding:10px !important;
        }
        #finish {
            padding:8px 5px !important;
            width: auto;
        }
    }
    .next{
        background: #00BCD4 !important;
        margin: 2% 0%;
    }
    #finish {
        background-color: green;
        height: auto;
        margin-left: 0px;
        padding: 10px;
        border-radius: 3px;
        text-align: center;
        font-size: 15px;
        margin: 2% 0%;
    }

    .panel-title-lesson {
        color: #292525;
    }
    .panel-info {
        background-color: blue !important;
    }

    .main-panel > .content {
        padding: 2% 0% 0;
    }
    h5 {
        margin-bottom: 0;
        margin-top: 0;
    }
    h3 {
        line-height: 1.2em;
    }
    #last_score{
        font-size: 20px;
        margin: 5% 30% 0%;
    }
    .bootstrap-dialog-footer-buttons {
        display: none;
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
    }

    .col-md-12 {
        padding-left: 0;
        padding-right: 0;
    }

    .course_name{
        margin-bottom: 20px;
        z-index:999;
        width:auto;
    }

    .course_dyn{
        padding: 2px 10px;
    }

    #questions-module .card-content {
        /*height: 450px !important;*/
        margin-bottom: 0;
        min-height: 390px !important;
        max-height: 500px;
    }

    .container-fluid {
        min-height: 0 !important;
        margin-bottom: 0px;
    } 

    .content-wrapper {
        min-height: 0 !important; 
    }
    @media (max-width: 991px){
        #questions-module .result-block{
            margin-top: 40% !important;
        }
        .question_explain{
            margin-top: -40% !important;
        }
.question_explain{
            width: 100% !important;
        }
    }
    @media screen and (min-width: 400px)and (max-width: 600px) {
        #questions-module .result-block{
            margin-top: 60% !important;
        }
        .question_explain{
            margin-top: -60% !important;
        }
    }
    @media screen and (min-width: 320px)and (max-width: 399px) {
        #questions-module .result-block{
            margin-top: 85% !important;
        }
        .question_explain{
            margin-top: -85% !important;
        }
    }
    @media (min-height: 890px){
        h1{
            line-height: 2.5em;
        }
        #questions-module .card-content{
           min-height: 600px !important; 
        }
    }
    h1{
            line-height: 1.5em;
        }
@media (min-height: 680px) and (max-height: 720px){
    #questions-module .card-content{
           min-height: 420px !important; 
        }
}
@media (min-height: 786px) and (max-height: 820px){
   #questions-module .card-content{
           min-height: 520px !important; 
        }
}
@media (min-height: 721px) and (max-height: 750px){
    #questions-module .card-content{
           min-height: 455px !important; 
        }
}
@media (min-height: 751px) and (max-height: 785px){
    #questions-module .card-content{
           min-height: 490px !important; 
        }
}
@media (max-width: 767px){
    .content {
    margin-top: 20px;
}
}
</style>

<?php
$course = Courses::find()->where(['id' => $id])->one();
?>

<?= $this->render('//site/fly-box.php') ?>
<div class="content" id="questions-module">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title"><i class="material-icons">library_books</i><?php echo $course->course_name ?></h4>
                    </div>
                    <div class="card-content scrollbar style-2" id="style-1">
                        <div class="force-overflow">
                            <div id="group">
                                <?php
                                $course = Courses::find()->where(['id' => $id])->one();
                                $course_id = $course->id;
                                //for correct answer questions
                                $connection = Yii::$app->db;
                                $command = $connection->createCommand("SELECT COUNT(*) FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND score!=0  AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $course_id . " )))");
                                $correct_options = $command->queryAll();
                                ?>

                                <?php
                                //for wrong answer questions
                                $command1 = $connection->createCommand("SELECT COUNT(*) FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND score=0 AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $course_id . ")))");
                                $wrong_answers = $command1->queryAll();
                                $total_wrong_answers = count($wrong_answers);
                                ?>


                                <?php
                                //for grades
                                $command2 = $connection->createCommand("SELECT sum(score) as grade FROM `learner_scoring` WHERE learner_id =" . Yii::$app->user->identity->id . " AND score!=0 AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $course_id . ")))");
                                $grades = $command2->queryAll();
                                ?>


                                <?php
                                $i = 1;
                                $sum_scores = [];

                                //total questions
                                $questionsCommand = $connection->createCommand("SELECT * FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $course_id . " ))");
                                $total_question = $questionsCommand->queryAll();
                                $questions_count = count($total_question);

                                //total quesitons learner answerd
                                $questionCommand = $connection->createCommand("SELECT * FROM questions WHERE questions.id NOT IN (SELECT `question_id` FROM learner_scoring WHERE learner_id = " . Yii::$app->user->identity->id . ") AND questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $course_id . ")) ORDER BY id ASC ");
                                $total_questions = $questionCommand->queryAll();
                                $question_count = count($total_questions);

                                $topquestionCommand = $connection->createCommand("SELECT id FROM questions WHERE questions.id NOT IN (SELECT `question_id` FROM learner_scoring WHERE learner_id = " . Yii::$app->user->identity->id . ") AND questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $course_id . ")) ORDER BY 1 DESC LIMIT 1");
                                $top_question = $topquestionCommand->queryAll();

                                if (!empty($total_questions)) {
                                    foreach ($total_questions as $index => $question) {
                                        if (isset($total_questions[$index + 1]['id'])) {
                                            $next_q_id = $total_questions[$index + 1]['id'];
                                        } else {
                                            $next_q_id = $question['id'];
                                        }
                                        $question_no = [];
                                        $question_grade = [];
                                        $question_no = $question['id'];
                                        $question_grade = $question['grade'];
                                        $options_array = '';
                                        $options = explode(",", $question['options']);
                                        $finish = count($total_questions);
                                        ?>


                                        <?php
                                        if ($i == 1) {
                                            ?>
                                            <div id="question-block-<?= $question['id'] ?>" class="row current">
                                                <?php
                                            } else {
                                                ?>
                                                <div id="question-block-<?= $question['id'] ?>" class="row" style="display:none">
                                                    <?php
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <h3><b> <?php echo $question['question'] ?> </b></h3>

                                                        <?php
                                                        $j = 1;
                                                        foreach ($correct_options as $correct) {
                                                            $correct_answer = $correct['COUNT(*)'];
                                                        }
                                                        foreach ($wrong_answers as $wrong_answer) {
                                                            $wrong = $wrong_answer['COUNT(*)'];
                                                        }

                                                        foreach ($grades as $grade) {
                                                            array_push($sum_scores, $grade['grade']);
                                                        }

                                                        $correctanswer_grades = array_sum($sum_scores);


                                                        foreach ($options as $option) {
                                                            ?>
                                                            <h5><input type="radio" class="options_radio distance" name="learner_questions_<?= $question['id'] ?>[answer]" value="<?= $j ?>"> <?= $option ?></h5>
                                                            <?php
                                                            $j++;
                                                        }
                                                        ?>
                                                        <?= Html::button('Check My Answer', ['class' => 'btn btn-primary check_answer', 'value' => $question['id']]) ?>

                                                        <?php if ($question['id'] == $top_question[0]['id']) { ?>
                                                            <?= Html::button('Finish', ['class' => 'btn btn-primary finish pull-right', 'id' => 'finish']) ?>
                                                        <?php } else { ?>
                                                            <?= Html::button('Next', ['class' => 'btn btn-primary next pull-right', 'id' => 'next', 'value' => $next_q_id, 'style' => 'display:none']) ?>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div id="result-block-<?= $question['id'] ?>">
                                                            <div class="result-block correct">
                                                                <h3 class="text-center">Score Board</h3>


                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h6 class="text-center result-block-no-margin"> Questions in Quiz </h6>
                                                                        <div class="col-md-12">
                                                                            <h1 id="question_count1-<?= $question['id'] ?>" class="text-center result-block-no-margin result-block-heavy-font"> <?= $questions_count ?> </h1>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="col-md-6 right">
                                                                            <h6 class="text-center result-block-no-margin"> Correct </h6>
                                                                            <h1 id="correcta_answer-<?= $question['id'] ?>" class="text-center result-block-no-margin result-block-heavy-font"> <?= $correct_answer ?> </h1>
                                                                        </div>
                                                                        <div class="col-md-6 wrong">
                                                                            <h6 class="text-center result-block-no-margin"> Incorrect </h6>
                                                                            <h1  id="wrong_answer-<?= $question['id'] ?>" class="text-center result-block-no-margin result-block-heavy-font"> <?= $wrong ?> </h1>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card" style="background-color:#FFC100;">
                                                                    <div class="card-body">
                                                                        <h6 class="text-center result-block-no-margin"> Weighted Score </h6>
                                                                        <div class="col-md-12">
                                                                            <h1 id="correcta_grade-<?= $question['id'] ?>" class="text-center result-block-no-margin result-block-heavy-font"> <?= $correctanswer_grades ?> </h1>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="explanation">
                                                    <div class="col-md-9 col-sm-12">                              
                                                        <h4 class="question_explain" id ="question_explanation-<?= $question['id'] ?>" style="color : #FFFFFF;margin-top: 1%; width: auto; margin-bottom: 0%;"></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    <?php } else if ($questions_count !== 0 && $question_count === 0) {
                                        ?>
                                        <div id="last_score" class="current" style="line-height: 35px;">
                                            <?php
                                            $resultCommand = $connection->createCommand("SELECT SUM(`score`) AS total_score, SUM(CASE WHEN (`score` != 0) THEN 1 ELSE 0 END) AS correct_answer, SUM(CASE WHEN (`score` = 0) THEN 1 ELSE 0 END) AS wrong_answer  FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $course_id . " )))");
                                            $result = $resultCommand->queryAll();

                                            echo '<div id="questions-count" style ="color: #3498DB;">Questions in Quiz-' . $questions_count . ' </div> ';
                                            echo '<div id="correct-answers-count" style="color:#5CDB95 ">Correct - ' . $result[0]['correct_answer'] . '</div>';
                                            echo '<div id="wrong-answers-count" style = "color : #FF2C44">Incorrect - ' . $result[0]['wrong_answer'] . '</div>';
                                            echo '<div id="total-score" style ="color: #FFC100;"> Weighted Score - ' . $result[0]['total_score'] . '</div>';

                                            echo '<div id="total-percentage">Percentage Scored - ' . round(($result[0]['correct_answer'] / $questions_count) * 100) . '</div>';
                                            if (round(($result[0]['correct_answer'] / $questions_count) * 100) < 60) {
                                                echo '<b style=" color:red;">Your Performance is Poor</b>';
                                            } else if (round(($result[0]['correct_answer'] / $questions_count) * 100) >= 60 && round(($result[0]['correct_answer'] / $questions_count) * 100) < 80) {
                                                echo '<b style="color:#FFA126;">Your Performance is Good</b>';
                                            } elseif (round(($result[0]['correct_answer'] / $questions_count) * 100) >= 80) {
                                                echo '<b style=" color:green;">Your Performance is Excellent</b>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    } else {
                                        echo "No Questions Available";
                                    }
                                    ?>   
                                </div>
                                <div id="last_score" class="current" style="display:none; line-height: 35px;">
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
    ?>




    <?php
    $script = <<< JS
            
$(".check_answer").hide();
$("#finish").hide();

$(".options_radio").on("click", function(){
$(".check_answer").show();

});
            
$('.check_answer').click(function() {
 $(this).prop('disabled', true);
    button_value = this.value;
    //$('#question-block-' + button_value + '#next').show();
    option_value = $("input[name='learner_questions_" + button_value + "[answer]']:checked").val();
    $.get('capture-question-session', { question_id : button_value, answered_option : option_value}, function(data) {
        var obj = $.parseJSON(data);
            $('#correcta_grade-' + button_value).html(obj.correctanswer_grades);
            $('#question_count1-' + button_value).html(obj.question_count);
            $('#correcta_answer-' + button_value).html(obj.total_correct_answers);
            $('#wrong_answer-' + button_value).html(obj.total_wrong_answers);
            $('#question-block-' + button_value + ' #next').css("display", "block");
            $('#question-block-' + button_value + ' #finish').css("display", "block");  
           
    });
        $.get('question-explanation', { question_id : button_value, answered_option : option_value}, function(data) {
        $('#question_explanation-' + button_value).html(data)
            
        });
        
        $.get('final-scoring', { question_id : button_value, answered_option : option_value}, function(summary) {
           $('#scoring-' + button_value).css("display","block"); 
           $('#scoring-' + button_value).html(summary);
        });
});
        
    $('#finish').click(function() {
        $.get('final-scoring', { question_id : button_value, answered_option : option_value}, function(summary) {
           $('#scoring-' + button_value).css("display","block"); 
           $('#scoring-' + button_value).html(summary);
           $('#last_score').append($('#question-block-' + button_value).html(summary).css("display","block"));
        });
    });     
        
    $('.next').click(function() {
        button_value = this.value;
            $.get('next',{ question_id : button_value}, function(data) {
                var obj = $.parseJSON(data);
                $('#correcta_grade-' + button_value).html(obj.correctanswer_grades);
                $('#question_count1-' + button_value).html(obj.question_count);
                $('#correcta_answer-' + button_value).html(obj.total_correct_answers);
                $('#wrong_answer-' + button_value).html(obj.total_wrong_answers);
            });
   });
               
        $(function() {
        var updateDiv = function(trigger) {
            var currentDiv = $(".current");
            $("#group div").removeClass("current").hide();
            if (trigger.hasClass("next") && currentDiv.next("div").length > 0) {
             currentDiv.next("div").addClass("current").show();
             $(".current div").show();
            } else if (trigger.hasClass("prev") && currentDiv.prev("div").length > 0) {
                currentDiv.prev("div").addClass("current").show();
            }
            updateNavigation();
        };

       var updateNavigation = function() {
            var intialDiv = $(".current");
            intialDiv.show();
            var intialDivIndex = intialDiv.index();
            intialDivIndex > 0 ? $("#prev").show() : $("#prev").hide();
            intialDivIndex < totalDivs - 1 ? $("#next").show() : $("#next").hide();
            $("#next").hide();
       };

       var totalDivs = $("#group div").length;
       updateNavigation();
       $("#next, #prev").on("click", function() {
           $(".check_answer").hide();
           $("#next").hide();
       updateDiv($(this));
        });
    });

JS;
    $this->registerJs($script);
    ?>