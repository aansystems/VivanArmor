<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SuperAdminNotifications;
use frontend\models\SuperAdminNotificationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\MasterRoleTypes;
use frontend\models\User;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * SuperAdminNotificationsController implements the CRUD actions for SuperAdminNotifications model.
 */
class SuperAdminNotificationsController extends Controller {

    /**
     * @inheritdoc
     */
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
                        'only' => ['index','create','update','view'],
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

    /**
     * Lists all SuperAdminNotifications models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SuperAdminNotificationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuperAdminNotifications model.
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
     * Creates a new SuperAdminNotifications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new SuperAdminNotifications();
        $model2 = new MasterRoleTypes();


        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->post('SuperAdminNotifications') != NULL) {
                $assigned_to = Yii::$app->request->post('SuperAdminNotifications')['assigned_to'];
            
                foreach ($assigned_to as $assigned_to) {
                    $model_new = new SuperAdminNotifications();
                    if ($model_new->load(Yii::$app->request->post())) {
                        $message = $model_new->message;
                        $model_new->assigned_from = Yii::$app->user->identity->id;
                        $model_new->assigned_to = $assigned_to;
                        $model_new->message = strip_tags($message);
                        $model_new->created_at = date('Y-m-d h:i:s');
                        $model_new->created_by = Yii::$app->user->identity->id;
                        $model_new->updated_at = date('Y-m-d h:i:s');
                        $model_new->updated_by = Yii::$app->user->identity->id;
                        $user = user::find()->where(['id' => $assigned_to])->one();
                                Yii::$app->mailer->compose(['html' => 'notifications-html'], ['message' => $message,'user'=>$user])
                                ->setFrom('vivaanlms@aansystems.com')
                                ->setTo($user->email)
                                ->setSubject('notification from vivaan-lms')
                                ->send();                                               
                        $model_new->save(false);
                    }
                }
            }
            Yii::$app->session->setFlash('success', "Notification saved Successfully");

            return $this->redirect('index');
        }



        return $this->render('create', [
                    'model' => $model,
                    'model2' => $model2,
        ]);
    }

    /**
     * Updates an existing SuperAdminNotifications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model2 = new MasterRoleTypes();

        if ($model->load(Yii::$app->request->post())) {
            $message = $model->message;
            if (Yii::$app->request->post('SuperAdminNotifications') != NULL) {
                $assigned_to = Yii::$app->request->post('SuperAdminNotifications')['assigned_to'];
                foreach ($assigned_to as $assigned_to) {
                    $model->assigned_to = $assigned_to;
                    $model->message = strip_tags($message);
                    $model->updated_by = Yii::$app->user->identity->id;
                }
            }
            $model->save(false);

            Yii::$app->session->setFlash('success', "Notification Updated  Successfully"); // to show the confirmation message for updating the data

            return $this->redirect('index');
        }

        return $this->render('update', [
                    'model' => $model,
                    'model2' => $model2
        ]);
    }

    /**
     * Deletes an existing SuperAdminNotifications model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', "Notification has been deleted."); //to show the confirmation message for deleting record
            return $this->redirect(['index']);
        } catch (\yii\db\IntegrityException $e) {
            Yii::$app->getSession()->setFlash('error', 'Please delete the associate record to delete this record'); //for exception handeling
            return Yii::$app->getResponse()->redirect(Yii::$app->request->referrer)->send();
        }
    }

    /**
     * Finds the SuperAdminNotifications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SuperAdminNotifications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = SuperAdminNotifications::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*     * Fetch all the users dependent on the roles */

    public function actionGetusers() {
        $out1 = [];
        $out2 = [];
        if (isset($_POST['depdrop_all_params']) && isset($_POST['depdrop_all_params']['roles'])) {
            $roles = $_POST['depdrop_all_params']['roles'];
            if ($roles != NULL) {
                foreach ($roles as $roles) {
                    if ($roles === '2') {
                        $out1 = ArrayHelper::toArray(User::find()->select('id,email')->where(['created_by' => Yii::$app->user->identity->id, 'role_type' => 2,'status'=>10])->all(), [
                                    'frontend\models\User' => [
                                        'id' => 'id',
                                        'name' => function ($user) {
                                            return $user->email;
                                        }
                                    ]
                        ]);
                    }
                    if ($roles === '4') {
                    $out2 = ArrayHelper::toArray(User::find()->select('id,email')->where(['created_by' => Yii::$app->user->identity->id, 'added_by' => 0,'status'=>10])->all(), [
                                    'frontend\models\User' => [
                                        'id' => 'id',
                                        'name' => function ($user) {
                                            return $user->email;
                                        }
                                    ]
                        ]);
                    }
                }
                echo Json::encode(['output' => ArrayHelper::merge($out2, $out1), 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

}
