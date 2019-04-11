<?php

namespace frontend\controllers;

use Yii;
use frontend\models\learnerscoring;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Questions;
use frontend\models\Learners;
use frontend\models\Courses;
use frontend\models\Certificates;
use frontend\models\User;

/**
 * LearnerScoringController implements the CRUD actions for learnerscoring model.
 */
class LearnerScoringController extends Controller {

    /**
     * @inheritdoc
     */
    protected $correct = 0;
    protected $wrong = 0;

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view', 'questions'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                                                'matchCallback' => function () {
                            return User::findOne(['id' => Yii::$app->user->identity->id])->two_fact === 1;
                        },
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Fetches the Question and Answers to the learners.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * Author : Premkumar
     */
    public function actionQuestions($id) {

        $questions = new Questions();



        return $this->render('questions', [
                    'questions' => $questions,
        ]);
    }

    /**
     * Fetches the Questions to the learners.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * Author : Premkumar
     */
    public function actionCaptureQuestionSession($question_id, $answered_option) {

        $check_correct_answer = questions::find()
                ->where(['id' => $question_id])
                ->one();

        $grades = Questions::find()->where(['id' => $question_id])->one();
        $grade = $grades->grade;

        $connection = Yii::$app->db;
        if ($check_correct_answer->answer == $answered_option) {

            $connection->createCommand()->insert('learner_scoring', [
                        'learner_id' => Yii::$app->user->identity->id,
                        'question_id' => $question_id,
                        'answer' => $answered_option,
                        'score' => $grade,
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => Yii::$app->user->identity->id
                    ])
                    ->execute();
        } else {

            $connection->createCommand()->insert('learner_scoring', [
                        'learner_id' => Yii::$app->user->identity->id,
                        'question_id' => $question_id,
                        'answer' => $answered_option,
                        'score' => 0,
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => Yii::$app->user->identity->id
                    ])
                    ->execute();
        }

        //Correct Options    
        $connection = Yii::$app->db;
        $courseId = Yii::$app->session['Course'];


        $command = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND score!=0  AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $courseId . " )))");
        $correct_answer = $command->queryAll();
        $total_correct_answers = count($correct_answer);


        //Wrong Answer
        $command1 = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND score=0 AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $courseId . ")))");
        $wrong_answers = $command1->queryAll();
        $total_wrong_answers = count($wrong_answers);

        //Grades
        $command2 = $connection->createCommand("SELECT sum(score) as grade FROM `learner_scoring` WHERE learner_id =" . Yii::$app->user->identity->id . " AND score!=0 AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $courseId . ")))");
        $scores = $command2->queryAll();
        $sum_scores = [];
        foreach ($scores as $grade) {
            array_push($sum_scores, $grade['grade']);
        }

        $correctanswer_grades = array_sum($sum_scores);
        //Total Questions

        $questionCommand = $connection->createCommand("SELECT * FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=$courseId))");
        $total_question = $questionCommand->queryAll();
        $question_count = count($total_question);


        $grades = Questions::find()->where(['id' => $question_id])->one();
        $grade = $grades->grade;

        $check_answer = questions::find()
                ->where(['id' => $question_id])
                ->one();


        if ($check_answer->answer == $answered_option) {

            $test = array("correctanswer_grades" => $correctanswer_grades, "question_count" => $question_count, "total_correct_answers" => $total_correct_answers, "total_wrong_answers" => $total_wrong_answers);

            return json_encode($test);
        } else {
            $test = array("correctanswer_grades" => $correctanswer_grades, "question_count" => $question_count, "total_correct_answers" => $total_correct_answers, "total_wrong_answers" => $total_wrong_answers);

            return json_encode($test);
        }
    }

    /**
     * Sends data to the Score Board if user click on next.
     * @param integer $question_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * Author : Prem
     */
    public function actionNext($question_id = NULL) {
        $connection = Yii::$app->db;
        $courseId = Yii::$app->session['Course'];


        $command = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND score!=0  AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $courseId . " )))");
        $correct_answer = $command->queryAll();
        $total_correct_answers = count($correct_answer);


        //Wrong Answer
        $command1 = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND score=0 AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $courseId . ")))");
        $wrong_answers = $command1->queryAll();
        $total_wrong_answers = count($wrong_answers);

        //Grades
        $command2 = $connection->createCommand("SELECT sum(score) as grade FROM `learner_scoring` WHERE learner_id =" . Yii::$app->user->identity->id . " AND score!=0 AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $courseId . ")))");
        $scores = $command2->queryAll();
        $sum_scores = [];
        foreach ($scores as $grade) {
            array_push($sum_scores, $grade['grade']);
        }

        $correctanswer_grades = array_sum($sum_scores);
        //Total Questions

        $questionCommand = $connection->createCommand("SELECT * FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $courseId . " ))");
        $total_question = $questionCommand->queryAll();
        $question_count = count($total_question);

        $test = array("correctanswer_grades" => $correctanswer_grades, "question_count" => $question_count, "total_correct_answers" => $total_correct_answers, "total_wrong_answers" => $total_wrong_answers);

        return json_encode($test);
    }

    /**
     * Sends Summary to the Score Board.
     * @param integer $question_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * Author : Prem
     */
    public function actionFinalScoring($question_id = NULL, $answered_option = NULL) {

        $connection = Yii::$app->db;
        $courseId = Yii::$app->session['Course'];
         $course_name = Courses::findOne(['id' => $courseId])->course_name;
        //changing the certificate status to 1 and enabling the download
        $learner_id = Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id;
        
        $certificates = Certificates::find()->where(['learner_id' => $learner_id, 'certificate_name' => $course_name])->one();
        if (!empty($certificates)) {
            $status=1;
            $command = $connection->createCommand('UPDATE certificates SET status ='. $status .' WHERE (learner_id = ' . $learner_id . ' && certificate_name = "' . $course_name . '" )');
            $command->execute();
        }
        
        $command = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND score!=0  AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $courseId . " )))");
        $correct_answer = $command->queryAll();
        $total_correct_answers = count($correct_answer);


        //Wrong Answer
        $command1 = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND score=0 AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $courseId . ")))");
        $wrong_answers = $command1->queryAll();
        $total_wrong_answers = count($wrong_answers);

        //Grades
        $command2 = $connection->createCommand("SELECT sum(score) as grade FROM `learner_scoring` WHERE learner_id =" . Yii::$app->user->identity->id . " AND score!=0 AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=" . $courseId . ")))");
        $scores = $command2->queryAll();
        $sum_scores = [];
        foreach ($scores as $grade) {
            array_push($sum_scores, $grade['grade']);
        }

        $correctanswer_grades = array_sum($sum_scores);
        //Total Questions

        $questionCommand = $connection->createCommand("SELECT * FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id=$courseId))");
        $total_question = $questionCommand->queryAll();
        $question_count = count($total_question);
        echo '<div>';

        echo '<h1 style="font-size: 33px; font-family: Josefin sans, serif;"><span style="color: #8a9c2d;">Your Final Score</span></h1>';
        echo'<div class="score"  >';
        echo '<div id="questions-count" style ="color:#3498DB; font-size:20px;">Questions in Quiz-' . $question_count . ' </div> ';
        echo '<div id="correct-answers-count" style="color:#5CDB95; font-size:20px; ">Correct - ' . $total_correct_answers . '</div>';
        echo '<div id="wrong-answers-count" style = "color :#FF2C44; font-size:20px;">Incorrect - ' . $total_wrong_answers . '</div>';
        echo '<div id="total-score" style ="color: #FFC100; font-size:20px;"> Weighted Score - ' . $correctanswer_grades . '</div>';
        echo '<div id="total-percentage" style ="color:#47755b; font-size:20px;" >Percentage Scored - ' . round(($total_correct_answers / $question_count) * 100) . '</div>';
        if (round(($total_correct_answers / $question_count) * 100) < 60) {
            echo '<b style=" margin-left: 100px; color:red; font-size:20px; margin-left: 3px;">Your Performance is Poor!!</b>';
        } else if (round(($total_correct_answers / $question_count) * 100) >= 60 && round(($total_correct_answers / $question_count) * 100) < 80) {
            echo '<b style=" margin-left: 100px; color:#FFA126; font-size:20px;  margin-left: 3px;">Your Performance is Good!!</b>';
        } elseif (round(($total_correct_answers / $question_count) * 100) >= 80) {
            echo '<b style=" margin-left: 100px; color:green; font-size:20px; margin-left: 3px;">Your Performance is Excellent!!</b>';
        }

        echo'</div>';
        echo'</div>';
    }

    /**
     * Sends Explanation to the user in questions view.
     * @param integer $question_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * Author : Prem
     */
    public function actionQuestionExplanation($question_id, $answered_option) {

        $checked_answer = questions::find()
                ->where(['id' => $question_id])
                ->one();
        $explanation = Questions::find()
                ->where(['id' => $question_id])
                ->one();
        $question_explanation = $explanation->explanation;

        if ($checked_answer->answer == $answered_option) {
            echo '<div class="scrollbar" id="style-1">';
            echo '<div class="force-overflow">';
            echo '<p class="text-center" style="color:#3082ED; padding : 5px; font-size : 16px; background: #C4E5FF; margin-bottom: 0;"><b> You are correct </b><i class="fa fa-thumbs-up" aria-hidden="true" style = "color : #3082ED !important;"></i> </p>';
            echo '<h4 id ="question_explanation-"  style="color: black;padding:0% 2% 1%;font-size: 16px;margin:0;text-align: left;box-sizing: border-box;background: #C4E5FF; height: auto;">  ' . $question_explanation . ' </h4>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="scrollbar" id="style-1">';
            echo '<div class="force-overflow">';
            echo '<p class="text-center" style="color:#FF0000;  padding : 5px; font-size : 16px;  background: #C4E5FF; margin-bottom: 0;"><b> You are wrong </b><i class="fa fa-thumbs-down" aria-hidden="true" style = "color: #FF0000 !important;"></i> </p>';
            echo '<h4 id ="question_explanation-" style="color:black ;padding:0% 2% 1%;font-size: 16px;margin:0;text-align: left;box-sizing: border-box;background: #C4E5FF; height: auto;"> ' . $question_explanation . ' </h4>';
            echo '</div>';
            echo '</div>';
        }
    }

    /**
     * Lists all learnerscoring models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LearnerScoring();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single learnerscoring model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new learnerscoring model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new learnerscoring();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing learnerscoring model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing learnerscoring model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the learnerscoring model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return learnerscoring the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = learnerscoring::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
