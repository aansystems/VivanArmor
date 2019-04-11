<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MasterFaq;
use frontend\models\MasterFaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use frontend\models\User;


/**
 * MasterFaqController implements the CRUD actions for MasterFaq model.
 */
class MasterFaqController extends Controller
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
     * Lists all MasterFaq models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        
        
        return $this->render('index', [
            
        ]);
    }

    public function actionFaqList($id) {
        $faqs = MasterFaq::findOne(['id' => $id])->file_name;
        
        echo '<div>';
        echo '<iframe src="uploads/faq/' . $faqs. '.pdf" width="100%" height="500"></iframe>';
        echo '</div>';
    }
    /**
     * Displays a single MasterFaq model.
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
     * Creates a new MasterFaq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterFaq();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MasterFaq model.
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
     * Deletes an existing MasterFaq model.
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
     * Finds the MasterFaq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterFaq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasterFaq::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
