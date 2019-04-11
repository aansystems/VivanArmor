<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MasterDocTemplates;
use frontend\models\MasterDocTemplatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
    
use yii\data\Pagination;


/**
 * MasterDocTemplatesController implements the CRUD actions for MasterDocTemplates model.
 */
class MasterDocTemplatesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all MasterDocTemplates models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MasterDocTemplatesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = MasterDocTemplates::find()->where(['status' => 1]);
//        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4]);
//        // $pagination->setPageSize(2);
//        $array = [];
//        // limit the query using the pagination and retrieve the articles
//        $articles = $query->offset($pagination->offset)
//                ->limit($pagination->limit)
//                ->all();
        $dataQuery = $query->all();

                    
        foreach ($dataQuery as $dataQuery) {
           
            $array [] = MasterDocTemplates::find()->where(['id' => $dataQuery->id])->one();
            
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
              'array' => $array,
//            'pagination' => $pagination
        ]);
    }

    /**
     * Displays a single MasterDocTemplates model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MasterDocTemplates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterDocTemplates();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MasterDocTemplates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MasterDocTemplates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MasterDocTemplates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterDocTemplates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    

    
    protected function findModel($id)
    {
        if (($model = MasterDocTemplates::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
