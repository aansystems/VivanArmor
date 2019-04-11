<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TimedQuiz;
use frontend\models\TakenTimedQuiz;
use frontend\models\TimedQuizesSummary;
use frontend\models\Subjects;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Learners;
use frontend\models\Certificates;
use frontend\models\User;
use frontend\models\RequestNewTest;

/**
 * TimedQuizController implements the CRUD actions for TimedQuiz model.
 */
class TimedQuizController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['_form', 'create', 'index', 'intermediate-quiz', 'quiz-result', 'start-quiz', 'timed-quiz', 'view'],
                'rules' => [
                    [
                        'actions' => ['_form', 'create', 'index', 'intermediate-quiz', 'quiz-result', 'start-quiz', 'timed-quiz', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return User::findOne(['id' => Yii::$app->user->identity->id])->two_fact === 1;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all TimedQuiz models.
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Displays a single TimedQuiz model.
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
     * Creates a new TimedQuiz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TimedQuiz();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing TimedQuiz model.
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
     * Deletes an existing TimedQuiz model.
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
     * Finds the TimedQuiz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TimedQuiz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TimedQuiz::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionStartQuiz($id) {

        return $this->render('start-quiz', [
                    'subject_id' => $id
        ]);
    }

    public function actionScoreCard($id) {
        $cryptKey = '1bv4ha3ar1ts4ha3';
        $subject_id = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT)), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        $data = TakenTimedQuiz::find()->where(['subject_id' => $subject_id, 'learner_user_id' => Yii::$app->user->identity->id])->orderBy(['id' => SORT_ASC])->all();
        return $this->render('score-card', [
                    'subject_id' => $subject_id,
                    'data' => $data
        ]);
    }

    public function actionIntermediateQuiz($id) {
        $quiz_questions = TimedQuiz::find()
                ->select(['id'])
                ->where(['subject' => $id])
                ->all();
        $total_questions = count($quiz_questions);

        $keys = array_keys($quiz_questions);

        shuffle($keys);
        $random_questions = [];

        foreach ($keys as $key) {
            array_push($random_questions, $key);
        }
        $random_questions = implode(',', $random_questions);
        return $this->render('intermediate-quiz', [
                    'subject_id' => $id,
                    'random_questions' => $random_questions
        ]);
    }

    public function actionTimedQuiz($id, $random_questions) {
        $cryptKey = '1bv4ha3ar1ts4ha3';
        $random_questions = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode(str_pad(strtr($random_questions, '-_', '+/'), strlen($random_questions) % 4, '=', STR_PAD_RIGHT)), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        $random_question_no = explode(',', $random_questions);
        $attempts_count = TakenTimedQuiz::find()
                ->where(['subject_id' => $id])
                ->andWhere(['learner_user_id' => Yii::$app->user->identity->id])
                ->count();
         $data= RequestNewTest::findOne(['user_id'=>Yii::$app->user->identity->id,'subject_id'=>$id]);
        if(empty($data)){
            $number_test=3;
        }else{
             $number_test=4;  
        }
        if ($attempts_count == $number_test) :
            return $this->redirect('error');

        else :

        $connection = Yii::$app->db;
        $connection->createCommand()->insert('taken_timed_quiz', [
                    'subject_id' => $id,
                    'learner_user_id' => Yii::$app->user->identity->id,
                    'attempt' => $attempts_count + 1,
                    'created_date' => date('Y-m-d h:i:s'),
                    'created_by' => Yii::$app->user->identity->id
                ])
                ->execute();

        $query = new Query();
        $query->select(['timed_quizes_summary.id'])
                ->from('timed_quizes_summary')
                ->join('INNER JOIN', 'timed_quiz', 'timed_quizes_summary.timed_quiz_question_id =timed_quiz.id'
                )
                ->where(['timed_quiz.subject' => $id, 'timed_quizes_summary.learner_user_id' => Yii::$app->user->identity->id]);
        $command = $query->createCommand();
        $data = $command->queryAll();

        foreach ($data as $value) {
            $connection = Yii::$app->db;
            $connection->createCommand()
                    ->update('timed_quizes_summary', ['answered_option' => Null], 'id = ' . $value['id'])
                    ->execute();
        }
        $current_taken_timed_quiz_id = $attempts_count + 1;

        $duration = Subjects::findOne(['id' => $id])->duration;

        $time = explode(":", $duration);

        date_default_timezone_set('Asia/Kolkata');
        $startTime = date("M d, Y H:i:s");
        $convertedTime = date('M d, Y H:i:s', strtotime('+' . $time[0] . 'hour +' . $time[1] . 'minutes +' . $time[2] . 'seconds', strtotime($startTime)));

        $quiz_questions = TimedQuiz::find()
                ->where(['subject' => $id])
                ->all();

        $total_questions = count($quiz_questions);

        $random_questions = [];
        foreach ($random_question_no as $key) {
            $random_questions[$key] = $quiz_questions[$key];
        }

        $hours = $time[0] * 60 * 60 * 1000;
        $minutes = $time[1] * 60 * 1000;
        $seconds = $time[2] * 1000;

        $result = $hours + $minutes + $seconds;
        $connection = Yii::$app->db;
        $connection->createCommand()
                ->update('request_new_test', ['status' => 3], 'user_id = ' . Yii::$app->user->identity->id . ' AND subject_id = ' . $id )
                ->execute();

        return $this->render('timed-quiz', [
                    'random_questions' => $random_questions,
                    'total_questions' => $total_questions,
                    'duration' => $convertedTime,
                    'result' => $result,
                    'taken_timed_quiz_id' => $current_taken_timed_quiz_id,
                    'attempt' => $attempts_count + 1
        ]);
        endif;
    }

    public function actionCaptureQuizSession($id, $value, $taken_timed_quiz_id) {
        $check_entry = TimedQuizesSummary::find()
                ->where(['timed_quiz_question_id' => $id])
                ->andWhere(['learner_user_id' => Yii::$app->user->identity->id])
                ->one();

        $connection = Yii::$app->db;
        if (empty($check_entry)) :
            $connection->createCommand()->insert('timed_quizes_summary', [
                        'timed_quiz_question_id' => $id,
                        'answered_option' => $value,
                        'learner_user_id' => Yii::$app->user->identity->id,
                        'taken_timed_quiz_id' => $taken_timed_quiz_id,
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => Yii::$app->user->identity->id
                    ])
                    ->execute();

        else :
            $connection->createCommand()
                    ->update('timed_quizes_summary', ['answered_option' => $value, 'taken_timed_quiz_id' => $taken_timed_quiz_id], 'timed_quiz_question_id = ' . $id . ' AND learner_user_id = ' . Yii::$app->user->identity->id)
                    ->execute();
        endif;
    }

    public function actionQuizCompletion() {
        $session = Yii::$app->session;
        $subject_id = $session->get('subject_id');
        $attempt = $session->get('attempt');

        $total_correct = 0;
        $total_incorrect = 0;

        $question_count = TimedQuiz::find()
                ->where(['subject' => $subject_id])
                ->all();

        $query = new Query();
        $query->select([])
                ->from('timed_quizes_summary')
                ->join('INNER JOIN', 'timed_quiz', 'timed_quizes_summary.timed_quiz_question_id =timed_quiz.id'
                )
                ->where(['timed_quiz.subject' => $subject_id, 'timed_quizes_summary.learner_user_id' => Yii::$app->user->identity->id]);
        $command = $query->createCommand();
        $result = $command->queryAll();

        foreach ($result as $quiz_details) :
            $check_answer = TimedQuiz::findOne(['id' => $quiz_details['timed_quiz_question_id']])->right_answer;
            if ($quiz_details['answered_option'] == $check_answer) {
                $total_correct++;
            }
        endforeach;
        $total_incorrect = count($question_count) - $total_correct;
        $total_marks = ($total_correct / count($question_count)) * 100;

        $connection = Yii::$app->db;
        $connection->createCommand()
                ->update('taken_timed_quiz', ['total_marks_obtained' => round($total_marks)], 'subject_id = ' . $subject_id . ' AND learner_user_id = ' . Yii::$app->user->identity->id . ' AND attempt = ' . $attempt)
                ->execute();

        $course_name = Subjects::findOne(['id' => $subject_id])->quiz_name;
        $learners_id=Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id;
        $certificate = Certificates::find()->where(['certificate_name' => $course_name,'learner_id'=>$learners_id])->all();      
        if (empty($certificate) && $total_marks >= 50) {
            $length = 10;
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $certificate_no = '#' . $randomString;
            $expire_date = date('Y-m-d', strtotime("+6 months", strtotime(date("y-m-d"))));
            $connection = Yii::$app->db;
            $connection->createCommand()->insert('certificates', [
                        'learner_id' => $learners_id,
                        'certificate_name' => $course_name,
                        'certifying_authority' => 'vivaan',
                        'issue_date' => date('Y-m-d'),
                        'expire_date' => $expire_date,
                        'certificate_no' => $certificate_no,
                        'status' => 1,
                    ])
                    ->execute();
        }

        return $this->render('quiz-result', [
                    'total_incorrect' => $total_incorrect,
                    'total_correct' => $total_correct,
                    'question_count' => count($question_count),
                    'total_marks' => $total_marks
        ]);
    }
     public function actionRequestNewTest($id) {
        $cryptKey = '1bv4ha3ar1ts4ha3';
        $subject_id = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT)), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        $model=new RequestNewTest;
                    $connection = Yii::$app->db;
            $connection->createCommand()->insert('request_new_test', [
                        'user_id' =>Yii::$app->user->identity->id,
                        'subject_id' => $subject_id,
                        'status' => Null,
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => Yii::$app->user->identity->id,
                        'updated_at' => date('Y-m-d h:i:s'),
                        'updated_by'=>Yii::$app->user->identity->id
                    ])
                    ->execute();
           return $this->redirect('index');
     }
     
     public function actionError(){
                 return $this->render('error');
     }
}
