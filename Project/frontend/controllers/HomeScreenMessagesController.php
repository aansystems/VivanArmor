<?php

namespace frontend\controllers;

use Yii;
use frontend\models\HomeScreenMessages;
use frontend\models\HomeScreenMessagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use frontend\models\User;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use frontend\models\BranchManagers;

/**
 * HomeScreenMessagesController implements the CRUD actions for HomeScreenMessages model.
 */
class HomeScreenMessagesController extends Controller {

    /**
     * @inheritdoc
     */
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
                'only' => ['index', 'create', 'update', 'view'],
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
     * Lists all HomeScreenMessages models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new HomeScreenMessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HomeScreenMessages model.
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
     * Creates a new HomeScreenMessages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new HomeScreenMessages();

        if ($model->load(Yii::$app->request->post())) {
            $assigned_to_list = [];
            $assigned_to = Yii::$app->request->post('HomeScreenMessages')['assigned_to'];
            if (!empty($model->assigned_to) && (Yii::$app->user->identity->role_type == 2 || Yii::$app->user->identity->role_type == 1)) {
              
                foreach ($assigned_to as $assigned_to) {
                    $query = User::findOne(['id' => $assigned_to])->email;
                    array_push($assigned_to_list, $query);
                }
            } 
            $assigned_to_list = implode(',', $assigned_to_list);
            $model->assigned_to = $assigned_to_list;
            $model->title;
            $content = $model->content;
            $model->content = strip_tags($content);
            $model->attachment = UploadedFile::getInstance($model, 'attachment');
            if(!empty($model->attachment)){
            $file_name = $model->attachment->name;     
            $model->attachment->saveAs('uploads/messageBox/' . $file_name);
            $model->attachment = $file_name;
            }
            $model->created_by = Yii::$app->user->identity->id;
            $model->save(false);
            Yii::$app->session->setFlash('success', "Message Created Successfully");
            return $this->redirect('index');
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing HomeScreenMessages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $assigned_to_list = [];
            $assigned_to = Yii::$app->request->post('HomeScreenMessages')['assigned_to'];
            if (Yii::$app->user->identity->role_type == 2 || Yii::$app->user->identity->role_type == 1) {
              
                foreach ($assigned_to as $assigned_to) {
                    $query = User::findOne(['id' => $assigned_to])->email;
                    array_push($assigned_to_list, $query);
                }
            } 
            $assigned_to_list = implode(',', $assigned_to_list);
            $model->assigned_to = $assigned_to_list;
            $model->title;
            $content = $model->content;
            $model->content = strip_tags($content);
            $model->attachment = UploadedFile::getInstance($model, 'attachment');
              if(!empty($model->attachment)){
            $file_name = $model->attachment->name;
            $model->attachment->saveAs('uploads/messageBox/' . $file_name);
            $model->attachment = $file_name;
              }
            $model->created_by = Yii::$app->user->identity->id; 
            $model->save(false);

            Yii::$app->session->setFlash('success', "Message Updated Successfully");
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HomeScreenMessages model.
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
     * Finds the HomeScreenMessages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HomeScreenMessages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = HomeScreenMessages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetusers() {


        $out1 = [];
        $out2 = [];

        if (isset($_POST['depdrop_all_params']) && isset($_POST['depdrop_all_params']['branches'])) {
            $roles = $_POST['depdrop_all_params']['branches'];
            if ($roles != NULL) {
                foreach ($roles as $role) {
                    $branch_manager_id = BranchManagers::findOne(['branch_id' => $role])->user_id;
                    $out1 = ArrayHelper::toArray(User::find()->select('id,first_name,last_name,email')->where(['created_by' => $branch_manager_id, 'added_by' => 1, 'status' => 10])->all(), [
                                'frontend\models\User' => [
                                    'id' => 'id',
                                    'name' => function ($user) {
                                        return $user->email;
                                    }
                                ]
                    ]);
                    $out2 = ArrayHelper::merge($out2, $out1);
                }
                echo Json::encode(['output' => $out2, 'selected' => '']);
                return;
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }

}
