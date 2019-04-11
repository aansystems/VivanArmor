<?php

namespace frontend\controllers;

use Yii;
use frontend\models\LoginAnswer;
use frontend\models\LoginAnswerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\LoginQuestions;
use frontend\models\User;
use frontend\models\MatchForm;

/**
 * LoginAnswerController implements the CRUD actions for LoginAnswer model.
 */
class LoginAnswerController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LoginAnswer models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LoginAnswerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LoginAnswer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionMatch($id) {
        if (!Yii::$app->user->isGuest) {
            $cryptKey = '1bv4ha3ar1ts4ha3';
            $question_no = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode(str_pad(strtr($id, '-_', '+/'), strlen($id) % 4, '=', STR_PAD_RIGHT)), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
            $model = LoginAnswer::findOne(['answered_by' => Yii::$app->user->identity->id, 'question_id' => $question_no])->question_id;
        } else {
            return $this->redirect(['site/login']);
        }
        return $this->render('match', [
                    'model' => $model,
        ]);
    }

    public function actionCheckPasswords($password, $id) {


        $data = LoginAnswer::findOne(['answered_by' => Yii::$app->user->identity->id, 'question_id' => $id])->answer;
        $validate_password = Yii::$app->security->validatePassword($password, $data);
        if ($validate_password) {
            $connection = Yii::$app->db;
            $command = $connection->createCommand('UPDATE user SET two_fact = 1 WHERE (id = ' . Yii::$app->user->identity->id . ')');
            $command->execute();
            return $this->goHome();
        } else {
            return 1;
        }
    }

    /**
     * Creates a new LoginAnswer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (!Yii::$app->user->isGuest) {
            $model = new LoginAnswer();
            if ($model->load(Yii::$app->request->post())) {
                $post = Yii::$app->request->post();
                $i = 1;
                foreach ($post['LoginAnswer'] as $values) {
                    $model_new = new LoginAnswer();
                    $model_new->status = '1';
                    $model_new->created_at = date('Y-m-d h:i:s');
                    $model_new->updated_at = date('Y-m-d h:i:s');
                    $model_new->question_id = $i;
                    $model_new->answered_by = Yii::$app->user->identity->id;
                    $model_new->answer = \Yii::$app->getSecurity()->generatePasswordHash($values);
                    $model_new->save(false);
                    $i++;
                }
                $connection = Yii::$app->db;
                $command = $connection->createCommand('UPDATE user SET two_fact = 1 WHERE (id = ' . Yii::$app->user->identity->id . ')');
                $command->execute();
                return $this->redirect(['site/index']);
            }
        } else {
            return $this->redirect(['site/login']);
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing LoginAnswer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //  echo'<pre/>';   print_r($model);die();
            // $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LoginAnswer model.
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
     * Finds the LoginAnswer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LoginAnswer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LoginAnswer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
