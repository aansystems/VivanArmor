<?php

use frontend\models\TimedQuiz;
use frontend\models\TakenTimedQuiz;
use frontend\models\Subjects;
use frontend\models\RequestNewTest;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TimedQuizSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Timed Quizzes';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    tbody tr td {
        font-weight: 500;
    } 

    tbody tr td h5 {
        margin: 0;
    }

    tbody tr td {
        padding: 0 !important;
    }

    tbody tr td button {
        padding: 3% !important;
        margin: 2% !important;
    }

    .progress-circle {
        margin: 2px;
        position: relative; /* so that children can be absolutely positioned */
        padding: 0;
        width: 5em;
        height: 5em;
        background-color: transparent; 
        border-radius: 50%;
        line-height: 5em;
    }

    .progress-circle:after{
        border: none;
        position: absolute;
        top: 0.35em;
        left: 0.35em;
        text-align: center;
        display: block;
        border-radius: 50%;
        width: 4.3em;
        height: 4.3em;
        background-color: #5D6B6C;
        content: " ";
    }
    /* Text inside the control */
    .progress-circle span {
        font-size: 15px;
        font-weight: 900;
        position: absolute;
        line-height: 5em;
        width: 5em;
        text-align: center;
        display: block;
        z-index: 2;
        color: #FFFFFF;
    }
    .left-half-clipper { 
        /* a round circle */
        border-radius: 50%;
        width: 5em;
        height: 5em;
        position: absolute; /* needed for clipping */
        clip: rect(0, 5em, 5em, 2.5em); /* clips the whole left half*/ 
    }
    /* when p>50, don't clip left half*/
    .progress-circle.over50 .left-half-clipper {
        clip: rect(auto,auto,auto,auto);
    }
    .value-bar {
        /*This is an overlayed square, that is made round with the border radius,
        then it is cut to display only the left half, then rotated clockwise
        to escape the outer clipping path.*/ 
        position: absolute; /*needed for clipping*/
        clip: rect(0, 2.5em, 5em, 0);
        width: 5em;
        height: 5em;
        border-radius: 50%;
        border: 1em solid #ED1941; /*The border is 0.35 but making it larger removes visual artifacts */
        /*background-color: #4D642D;*/ /* for debug */
        box-sizing: border-box;

    }
    /* Progress bar filling the whole right half for values above 50% */
    .progress-circle.over50 .first50-bar {
        /*Progress bar for the first 50%, filling the whole right half*/
        position: absolute; /*needed for clipping*/
        clip: rect(0, 5em, 5em, 2.5em);

        border-radius: 50%;
        width: 5em;
        height: 5em;
    }
    .progress-circle:not(.over50) .first50-bar{ display: none; }


    /* Progress bar rotation position */
    .progress-circle.p0 .value-bar { display: none; }
    .progress-circle.p1 .value-bar { transform: rotate(4deg); }
    .progress-circle.p2 .value-bar { transform: rotate(7deg); }
    .progress-circle.p3 .value-bar { transform: rotate(11deg); }
    .progress-circle.p4 .value-bar { transform: rotate(14deg); }
    .progress-circle.p5 .value-bar { transform: rotate(18deg); }
    .progress-circle.p6 .value-bar { transform: rotate(22deg); }
    .progress-circle.p7 .value-bar { transform: rotate(25deg); }
    .progress-circle.p8 .value-bar { transform: rotate(29deg); }
    .progress-circle.p9 .value-bar { transform: rotate(32deg); }
    .progress-circle.p10 .value-bar { transform: rotate(36deg); }
    .progress-circle.p11 .value-bar { transform: rotate(40deg); }
    .progress-circle.p12 .value-bar { transform: rotate(43deg); }
    .progress-circle.p13 .value-bar { transform: rotate(47deg); }
    .progress-circle.p14 .value-bar { transform: rotate(50deg); }
    .progress-circle.p15 .value-bar { transform: rotate(54deg); }
    .progress-circle.p16 .value-bar { transform: rotate(58deg); }
    .progress-circle.p17 .value-bar { transform: rotate(61deg); }
    .progress-circle.p18 .value-bar { transform: rotate(65deg); }
    .progress-circle.p19 .value-bar { transform: rotate(68deg); }
    .progress-circle.p20 .value-bar { transform: rotate(72deg); }
    .progress-circle.p21 .value-bar { transform: rotate(76deg); }
    .progress-circle.p22 .value-bar { transform: rotate(79deg); }
    .progress-circle.p23 .value-bar { transform: rotate(83deg); }
    .progress-circle.p24 .value-bar { transform: rotate(86deg); }
    .progress-circle.p25 .value-bar { transform: rotate(90deg); }
    .progress-circle.p26 .value-bar { transform: rotate(94deg); }
    .progress-circle.p27 .value-bar { transform: rotate(97deg); }
    .progress-circle.p28 .value-bar { transform: rotate(101deg); }
    .progress-circle.p29 .value-bar { transform: rotate(104deg); }
    .progress-circle.p30 .value-bar { transform: rotate(108deg); border: 0.7em solid #ED1941; }
    .progress-circle.p31 .value-bar { transform: rotate(112deg); }
    .progress-circle.p32 .value-bar { transform: rotate(115deg); }
    .progress-circle.p33 .value-bar { transform: rotate(119deg); }
    .progress-circle.p34 .value-bar { transform: rotate(122deg); }
    .progress-circle.p35 .value-bar { transform: rotate(126deg); }
    .progress-circle.p36 .value-bar { transform: rotate(130deg); }
    .progress-circle.p37 .value-bar { transform: rotate(133deg); }
    .progress-circle.p38 .value-bar { transform: rotate(137deg); }
    .progress-circle.p39 .value-bar { transform: rotate(140deg); }
    .progress-circle.p40 .value-bar { transform: rotate(144deg); }
    .progress-circle.p41 .value-bar { transform: rotate(148deg); }
    .progress-circle.p42 .value-bar { transform: rotate(151deg); }
    .progress-circle.p43 .value-bar { transform: rotate(155deg); }
    .progress-circle.p44 .value-bar { transform: rotate(158deg); }
    .progress-circle.p45 .value-bar { transform: rotate(162deg); }
    .progress-circle.p46 .value-bar { transform: rotate(166deg); }
    .progress-circle.p47 .value-bar { transform: rotate(169deg); }
    .progress-circle.p48 .value-bar { transform: rotate(173deg); }
    .progress-circle.p49 .value-bar { transform: rotate(176deg); }
    .progress-circle.p50 .value-bar { transform: rotate(180deg); }
    .progress-circle.p51 .value-bar { transform: rotate(184deg); }
    .progress-circle.p52 .value-bar { transform: rotate(187deg); }
    .progress-circle.p53 .value-bar { transform: rotate(191deg); }
    .progress-circle.p54 .value-bar { transform: rotate(194deg); }
    .progress-circle.p55 .value-bar { transform: rotate(198deg); }
    .progress-circle.p56 .value-bar { transform: rotate(202deg); }
    .progress-circle.p57 .value-bar { transform: rotate(205deg); }
    .progress-circle.p58 .value-bar { transform: rotate(209deg); }
    .progress-circle.p59 .value-bar { transform: rotate(212deg); }
    .progress-circle.p60 .value-bar { transform: rotate(216deg); }
    .progress-circle.p61 .value-bar { transform: rotate(220deg); }
    .progress-circle.p62 .value-bar { transform: rotate(223deg); }
    .progress-circle.p63 .value-bar { transform: rotate(227deg); }
    .progress-circle.p64 .value-bar { transform: rotate(230deg); }
    .progress-circle.p65 .value-bar { transform: rotate(234deg); }
    .progress-circle.p66 .value-bar { transform: rotate(238deg); }
    .progress-circle.p67 .value-bar { transform: rotate(241deg); }
    .progress-circle.p68 .value-bar { transform: rotate(245deg); }
    .progress-circle.p69 .value-bar { transform: rotate(248deg); }
    .progress-circle.p70 .value-bar { transform: rotate(252deg); }
    .progress-circle.p71 .value-bar { transform: rotate(256deg); }
    .progress-circle.p72 .value-bar { transform: rotate(259deg); }
    .progress-circle.p73 .value-bar { transform: rotate(263deg); }
    .progress-circle.p74 .value-bar { transform: rotate(266deg); }
    .progress-circle.p75 .value-bar { transform: rotate(270deg); }
    .progress-circle.p76 .value-bar { transform: rotate(274deg); }
    .progress-circle.p77 .value-bar { transform: rotate(277deg); }
    .progress-circle.p78 .value-bar { transform: rotate(281deg); }
    .progress-circle.p79 .value-bar { transform: rotate(284deg); }
    .progress-circle.p80 .value-bar { transform: rotate(288deg); }
    .progress-circle.p81 .value-bar { transform: rotate(292deg); }
    .progress-circle.p82 .value-bar { transform: rotate(295deg); }
    .progress-circle.p83 .value-bar { transform: rotate(299deg); }
    .progress-circle.p84 .value-bar { transform: rotate(302deg); }
    .progress-circle.p85 .value-bar { transform: rotate(306deg); }
    .progress-circle.p86 .value-bar { transform: rotate(310deg); }
    .progress-circle.p87 .value-bar { transform: rotate(313deg); }
    .progress-circle.p88 .value-bar { transform: rotate(317deg); }
    .progress-circle.p89 .value-bar { transform: rotate(320deg); }
    .progress-circle.p90 .value-bar { transform: rotate(324deg); }
    .progress-circle.p91 .value-bar { transform: rotate(328deg); }
    .progress-circle.p92 .value-bar { transform: rotate(331deg); }
    .progress-circle.p93 .value-bar { transform: rotate(335deg); }
    .progress-circle.p94 .value-bar { transform: rotate(338deg); }
    .progress-circle.p95 .value-bar { transform: rotate(342deg); }
    .progress-circle.p96 .value-bar { transform: rotate(346deg); }
    .progress-circle.p97 .value-bar { transform: rotate(349deg); }
    .progress-circle.p98 .value-bar { transform: rotate(353deg); }
    .progress-circle.p99 .value-bar { transform: rotate(356deg); }
    .progress-circle.p100 .value-bar { transform: rotate(360deg); }

    .attempts i {
        font-size: 20px;
    }

    .table tbody tr td:last-child{
        width: 20% !important;
    }
    .btn.btn-info{
        padding: 8px 1px 5px 1px !important;
        width: 80px !important;
        margin: 10px 1px !important;
        font-size: 10px;
    }
    .btn-warning{
        padding: 8px 1px 5px 1px !important;
        width: 80px !important;
        margin: 10px 1px !important;
        font-size: 10px;
    }
    .btn.btn-success{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 1px !important;
        font-size: 12px;  
    }
    .btn:not(.btn-just-icon):not(.btn-fab) .fa{
        top: 1px !important;
        font-size: 15px !important;
    }
    @media (max-width: 1120px){
        .btn.btn-info{
            padding: 4px 1px 7px 1px !important;
            width: 80px !important;
            margin: 10px 1px !important;
            font-size: 10px;
        }
        .btn-warning{
            padding: 4px 1px 7px 1px !important;
            width: 80px !important;
            margin: 10px 1px !important;
            font-size: 10px;
        }
        .btn.btn-success{
            padding: 4px 1px 7px 1px !important;
            width: 80px !important;
            margin: 10px 1px !important;
            font-size: 12px;  
        }
    }
    @media (max-width: 1228px){
        .btn.btn-info{
            padding: 4px 1px 7px 1px !important;
            width: 80px !important;
            margin: 2px 1px !important;
            font-size: 10px;
        } 
        .btn-warning{
            padding: 4px 1px 7px 1px !important;
            width: 80px !important;
            margin: 2px 1px !important;
            font-size: 10px;
        }
    }

    .btn-pass{
        padding: 8px 0px 5px 0px !important;
        width: 60px !important;
        margin: 10px 1px !important;
        font-size: 12px !important;  
        background-color: #4caf50;
    }
    .btn.btn-danger{
        padding: 8px 0px 5px 0px !important;
        width: 60px !important;
        margin: 10px 1px !important;
        font-size: 12px !important;
    }
    @media (max-width: 810px){
        .attempts i {
            font-size: 18px;
        }
    }
    .container-fluid{
        margin-top: 2% !important; 
    }
</style>

<div class="timed-quiz-index">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">Completed Tests</h4>
                    </div>
                    <div class="card-content">
                        <div class="col-md-12" style="overflow-x: auto;">
                            <table class="table table-striped table-no-bordered table-hover dataTable dtr-inline me" style="overflow-x: auto;">
                                <thead>
                                    <tr class="text-rose">
                                        <th class="text-center"><b>#</b></th>
                                        <th><b>Subject</b></th>
                                        <th><b>Tests</b></th>
                                        <th><b>&nbsp;&nbsp;&nbsp;&nbsp;Score</b></th>
                                        <th class="text-center"><b>Result</b></th>
                                        <th class="text-center"><b>Attempts</b></th>
                                        <th class="action-column text-center"><b>Actions</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subjects_list = Subjects::find()->all();
                                    $i = 1;
                                    foreach ($subjects_list as $subject) :
                                        $taken_quizes = TakenTimedQuiz::find()
                                                        ->where(['subject_id' => $subject->id])
                                                        ->andWhere(['learner_user_id' => Yii::$app->user->identity->id])
                                                        ->orderBy(['id' => SORT_DESC], ['ROWNUM' => 1])->one();
                                        if (!empty($taken_quizes)) :
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $i ?></td>
                                                <td>
                                                    <?= $subject->subject_name ?>
                                                </td>
                                                <td>
                                                    <?= $subject->quiz_name ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress-circle p<?= $taken_quizes->total_marks_obtained ?>">
                                                        <span><?= $taken_quizes->total_marks_obtained ?>%</span>
                                                        <div class="left-half-clipper">
                                                            <div class="first <?= $taken_quizes->total_marks_obtained ?>-bar"></div>
                                                            <div class="value-bar"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php if ($taken_quizes->total_marks_obtained < '50') : ?>
                                                    <td class="text-center text-red text-uppercase"><button class="btn btn-sm btn-danger text-uppercase">Fail</button></td>
                                                <?php elseif ($taken_quizes->total_marks_obtained >= '50') : ?>
                                                    <td class="text-center"><button class="btn btn-sm btn-success text-uppercase">Pass</button></td>
                                                <?php endif; ?>

                                                <td class="text-center attempts">
                                                    <?php
                                                    $attempts = TakenTimedQuiz::find()
                                                            ->where(['subject_id' => $subject->id])
                                                            ->andWhere(['learner_user_id' => Yii::$app->user->identity->id])
                                                            ->count();

                                                    if ($attempts == 1) :
                                                        ?>
                                                        <i class="fa fa-heart text-red" aria-hidden="true"></i>
                                                        <?php for ($i = 1; $i <= 2; $i++) : ?>
                                                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                        <?php endfor; ?>
                                                    <?php elseif ($attempts == 2): ?>
                                                        <?php for ($i = 1; $i <= 2; $i++) : ?>
                                                            <i class="fa fa-heart text-red" aria-hidden="true"></i>
                                                        <?php endfor; ?>
                                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                    <?php elseif ($attempts == 3): ?>
                                                        <?php for ($i = 1; $i <= 3; $i++) : ?>
                                                            <i class="fa fa-heart text-red" aria-hidden="true"></i>
                                                        <?php endfor; ?>                                             
                                                    <?php elseif ($attempts == 4): ?>
                                                        <?php for ($i = 1; $i <= 3; $i++) : ?>
                                                            <i class="fa fa-heart text-red" aria-hidden="true"></i>
                                                        <?php endfor; ?>
                                                               <i class="fa fa-stop-circle-o text-red" aria-hidden="true"></i>
                                                    <?php endif; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php
                                                    $cryptKey = '1bv4ha3ar1ts4ha3';
                                                    $id = rtrim(strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $subject->id, MCRYPT_MODE_CBC, md5(md5($cryptKey)))), '+/', '-_'), '=');
                                                    $data = RequestNewTest::findOne(['user_id' => Yii::$app->user->identity->id, 'subject_id' => $subject->id]);
                                                        ?>
        <?php if ($attempts != 3 && $taken_quizes->total_marks_obtained < 50 && empty($data)) { ?>
                                                        <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz/start-quiz?id=<?= $subject->id ?>">
                                                            <button class="btn btn-warning"><i class="fa fa-play-circle" aria-hidden="true"></i> Retake</button>
                                                        </a> 
                                                        <?php
                                                    } elseif ($taken_quizes->total_marks_obtained >= 50) {
                                                        ?>
                                                        <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz/score-card?id=<?= $id ?>">
                                                            <button class="btn btn-primary"><i class="fa fa-table" aria-hidden="true"></i> Details</button>
                                                        </a> 
                                                    <?php
                                                    } else {

                                                        if (!empty($data) && $attempts <= 4) {
                                                               
                                                            ?>
                                                            <?php if (empty($data->status)) { ?>
                                                                <button class="btn btn-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Request Sent</button>
                                                   <?php } elseif ($data->status == 1) { ?>
                                                                <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz/start-quiz?id=<?= $subject->id ?>">
                                                                    <button class="btn btn-warning"><i class="fa fa-play-circle" aria-hidden="true"></i> Retake</button>
                                                                </a> 
                                                            <?php } elseif ($data->status == 2) { ?>
                                                                <button class="btn btn-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Denied</button>
                                                              <?php }
                                                                    elseif($data->status == 3) { ?>
                                                                                                                        <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz/score-card?id=<?= $id ?>">
                                                            <button class="btn btn-primary"><i class="fa fa-table" aria-hidden="true"></i> Details</button>
                                                        </a>   
                                                                    <?php }}  else { ?>
                                                            <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz/request-new-test?id=<?= $id ?>">
                                                                <button class="btn btn-primary"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Request New Test</button>
                                                            </a> 
                                                <?php }
                                            } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        endif;
                                        $i++;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">Upcoming Tests</h4>

                    </div>
                    <div class="card-content">
                        <div class="col-md-12" style="overflow-x: auto;">
                            <table class="table table-striped table-no-bordered table-hover dataTable dtr-inline me">
                                <thead>
                                    <tr class="text-rose">
                                        <th class="text-center"><b>#</b></th>
                                        <th><b>Subject</b></th>
                                        <th><b>Tests</b></th>
                                        <th class="text-center"><b>Duration</b></th>
                                        <th class="text-center"><b>Total Questions</b></th>
                                        <th class="text-center"><b>Status</b></th>
                                        <th class="action-column text-center"><b>Actions</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subjects = Subjects::find()
                                            ->rightJoin('test_assigned', 'test_assigned.subject_assigned=subjects.id')
                                            ->where(['test_assigned.user_id' => Yii::$app->user->identity->id])
                                            ->all();
                                    ?>

                                    <?php $i = 1 ?>

                                    <?php foreach ($subjects as $subject) : ?>
                                        <?php
                                        $check_taken = TakenTimedQuiz::find()
                                                ->where(['subject_id' => $subject->id])
                                                ->andWhere(['learner_user_id' => Yii::$app->user->identity->id])
                                                ->count();

                                        if ($check_taken == 0) :
                                            ?>
                                            <tr>
                                                <td class="text-center"> <?= $i ?> </td>
                                                <td><?= $subject->subject_name ?></td>
                                                <td><?= $subject->quiz_name ?></td>
                                                <td class="text-center"><?= $subject->duration ?></td>

        <?php
        $questions_count = TimedQuiz::find()
                ->where(['subject' => $subject->id])
                ->count();
        ?>

                                                <td class="text-center"><?= $questions_count ?></td>

        <?php if ($subject->status == 1) : ?>
                                                    <td class="text-center"><i class="fa fa-circle text-green" aria-hidden="true"></i></td>
        <?php elseif ($subject->status == 0) : ?> 
                                                    <td class="text-center"><i class="fa fa-circle text-red" aria-hidden="true"></i></td>
        <?php endif; ?>
                                                <td class="text-center">
                                                    <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz/start-quiz?id=<?= $subject->id ?>">
                                                        <button class="btn btn-success"><i class="fa fa-play-circle" aria-hidden="true"></i> Start</button>
                                                    </a>
                                                </td>
                                            </tr>
        <?php
        $i++;
    endif;
endforeach;
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

