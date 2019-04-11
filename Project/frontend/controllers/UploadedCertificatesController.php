<?php

namespace frontend\controllers;

use Yii;
use frontend\models\UploadedCertificates;
use frontend\models\UploadedCertificatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Learners;
use yii\web\UploadedFile;
use frontend\models\User;
/**
 * UploadedCertificatesController implements the CRUD actions for UploadedCertificates model.
 */
class UploadedCertificatesController extends Controller {

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
     * Lists all UploadedCertificates models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UploadedCertificatesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UploadedCertificates model.
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
     * Creates a new UploadedCertificates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new UploadedCertificates();

        if ($model->load(Yii::$app->request->post())) {
            $model->learner_id = Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id;
            $model->certificate_name;
            $model->certifying_authority;
            $model->file = UploadedFile::getInstance($model, 'file');
            $file_name = $model->file->name;
            $assigned_to_list = explode('.', $file_name);
            $extension = (strtoupper(end($assigned_to_list)));
            $file_name_new = $assigned_to_list[0] . '.' . $extension;
            $model->file->saveAs('uploads/uploaded_certificates/' . $model->learner_id . '_' . $file_name_new);
            $model->attachment = $model->learner_id . '_' . $file_name_new;
            $model->save();
            Yii::$app->session->setFlash('success', "Certificate Uploaded Successfully");
            return $this->redirect(' ' . Yii::$app->request->baseUrl . '/certificates/index');
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing UploadedCertificates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->learner_id = Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id;
            $model->certificate_name;
            $model->certifying_authority;
            $model->file = UploadedFile::getInstance($model, 'file');
            $file_name = $model->file->name;
            $assigned_to_list = explode('.', $file_name);
            $extension = strtoupper(end($assigned_to_list));
            $file_name_new = $assigned_to_list[0] . '.' . $extension;
            $model->file->saveAs('uploads/uploaded_certificates/' . $model->learner_id . '_' . $file_name_new);
            $model->attachment = $model->learner_id . '_' . $file_name_new;
            $model->save();
            Yii::$app->session->setFlash('success', "Certificate Modified Successfully");
            return $this->redirect(' ' . Yii::$app->request->baseUrl . '/certificates/index');
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UploadedCertificates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(' ' . Yii::$app->request->baseUrl . '/certificates/index');
    }

    /**
     * Finds the UploadedCertificates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UploadedCertificates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = UploadedCertificates::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
