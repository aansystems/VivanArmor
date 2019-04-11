<?php

namespace frontend\controllers;
use Yii;
use common\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SettingsController extends \yii\web\Controller
{
    
        public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                        'class' => \yii\filters\AccessControl::className(),
                        'only' => ['change-password'],
                        'rules' => [
                            // allow authenticated users
                            [
                                'allow' => true,
                                'roles' => ['@'],
                                                        'matchCallback' => function ($rule, $action) {
                            return User::findOne(['id' => Yii::$app->user->identity->id])->two_fact === 1;
                        },
                            ],
                            // everything else is denied
                        ],
                    ],            
        ];
    }
    
    
    public function actionChangePassword()
    {
        $model = new User();
    
    if ($model->load(Yii::$app->request->post())) {
        $post = Yii::$app->request->post();
        $password_hash = Yii::$app->getSecurity()->generatePasswordHash($post['User']['confirm_password']);
        
        $user = User::find()
        ->where(['id' => Yii::$app->user->getId()])
        ->andWhere(['status' => 10])
        ->one();
        
        $connection = Yii::$app->db;
        $connection->createCommand()
        ->update('user', ['password_hash' => $password_hash], 'id =' . $user->id)
        ->execute();
        
        Yii::$app->session->setFlash('success', "Password Changed Successfully");//to show the confirmation message for changing the password
        
        return $this->redirect(['site/']);
        
        
    }
    
    return $this->render('change-password', [
        'model' => $model,
    ]);
    }

    public function actionMatchPasswords($password) {
        $user = User::find()
        ->where(['id' => Yii::$app->user->getId()])
        ->andWhere(['status' => 10])
        ->one();
        $validate_password = Yii::$app->security->validatePassword($password, $user->password_hash);
        if ($validate_password) {
            return 1;
        } else {
            return 0;
        }
    }
}
