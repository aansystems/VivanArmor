<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Branches;
use frontend\models\Company;
use frontend\models\BranchesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\User;
/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller {

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
     * Lists all Branches models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BranchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branches model.
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
     * Creates a new Branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Branches();
        if ($model->load(Yii::$app->request->post())) {

            $model->company_id = Company::findOne(['company_admin_id' => Yii::$app->user->identity->id])->id; //fetching loggedin user id
            $model->status = 10;
            $model->created_at = date('Y-m-d h:i:s');
            $model->created_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d h:i:s');
            $model->updated_by = Yii::$app->user->identity->id;
            $model->save(false);

            Yii::$app->session->setFlash('success', "Branch Created Successfully"); //to show the confirmation message for saving the record

            return $this->redirect('index');
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post())) {
            $model->updated_by = Yii::$app->user->identity->id;
            $model->save(false);

            Yii::$app->session->setFlash('success', "Branch Updated  Successfully"); //to show the confirmation message for updating record

            return $this->redirect('index');
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Branches model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', "Branch has been deleted."); //to show the confirmation message for deleting record
            return $this->redirect(['index']);
        } catch (\yii\db\IntegrityException $e) {
            Yii::$app->getSession()->setFlash('error', 'Please delete the associate branch manager to delete this branch master'); //for exception handeling
            return Yii::$app->getResponse()->redirect(Yii::$app->request->referrer)->send();
        }
    }

    /**
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Branches::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBranchValidation($branch_name) {
        $branch_count = "";
        $company_id = Company::findOne(['company_admin_id' => Yii::$app->user->identity->id])->id;
        $branches = Branches::find()
                ->where(['branch_name' => $branch_name])
                ->andWhere(['company_id' => $company_id])
                ->all();

        $branch_count = count($branches);
        if ($branch_count == 0) {
            return 1;
        } elseif ($branch_count > 0) {
            return 0;
        }
    }

}
