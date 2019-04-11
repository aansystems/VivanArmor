<?php

namespace frontend\helpers;

/**
 * This is the helper class for "Question & Answers".
 * Author : Chaithra Rao
 */
class Quiz {

    public static function scoreManager($course_id) {
        $connection = \Yii::$app->db;

        /* Fetching Right Answer Count */
        $command = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE `learner_id` = " . \Yii::$app->user->identity->id . " AND `score`!=0  AND `question_id` IN (SELECT `id` FROM `questions` WHERE questions.`section_id` IN (SELECT `id` FROM `sections` WHERE `lesson_id` IN (SELECT `id` FROM `lessons` WHERE `lessons`.`course_id`= " . $course_id . " )))");
        $correct_answer = $command->queryAll();
        $total_correct_answers = count($correct_answer);


        /* Fetching Wrong Answer Count */
        $command1 = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE `learner_id` = " . \Yii::$app->user->identity->id . " AND `score`=0 AND `question_id` IN (SELECT `id` FROM `questions` WHERE `questions`.`section_id` IN (SELECT `id` FROM `sections` WHERE `lesson_id` IN (SELECT `id` FROM `lessons` WHERE `lessons`.`course_id`= " . $course_id . ")))");
        $wrong_answer = $command1->queryAll();
        $total_wrong_answers = count($wrong_answer);

        /* Fetching Grades */
        $command2 = $connection->createCommand("SELECT SUM(`score`) AS grade FROM `learner_scoring` WHERE `learner_id` = " . \Yii::$app->user->identity->id . " AND `score`!=0 AND `question_id` IN (SELECT `id` FROM `questions` WHERE `questions`.`section_id` IN (SELECT `id` FROM `sections` WHERE `lesson_id` IN (SELECT `id` FROM `lessons` WHERE `lessons`.`course_id` = " . $course_id . ")))");
        $scores = $command2->queryAll();
        $sum_scores = [];

        foreach ($scores as $grade) {
            array_push($sum_scores, $grade['grade']);
        }

        $total_score = array_sum($sum_scores);

        /* Fetching Total Questions for the course */
        $command3 = $connection->createCommand("SELECT * FROM `questions` WHERE `questions`.`section_id` IN (SELECT `id` FROM `sections` WHERE `lesson_id` IN (SELECT `id` FROM `lessons` WHERE `lessons`.`course_id` = $course_id))");
        $question_count = $command3->queryAll();
        $total_questions = count($question_count);

        $score_summary = ['total_score' => $total_score, 'total_questions' => $total_questions, 'total_correct_answers' => $total_correct_answers, 'total_wrong_answers' => $total_wrong_answers];

        return $score_summary;
    }

}
?>

