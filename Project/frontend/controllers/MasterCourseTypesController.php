<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MasterCourseTypes AS TMasterCourseTypes;
use frontend\models\MasterCourseTypesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\MasterCourseTypes ;
use frontend\models\User;
/**
 * MasterCourseTypesController implements the CRUD actions for MasterCourseTypes model.
 */
class MasterCourseTypesController extends Controller
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
     * Lists all MasterCourseTypes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MasterCourseTypesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MasterCourseTypes model.
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
     * Creates a new MasterCourseTypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MasterCourseTypes();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
             $model->created_at = date('Y-m-d h:i:s');
            $model->updated_at = date('Y-m-d h:i:s');
            $model->save(false);

            Yii::$app->session->setFlash('success', "Record saved Successfully");

            return $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MasterCourseTypes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MasterCourseTypes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', "Record has been deleted."); //to show the confirmation message for deleting record
            return $this->redirect(['index']);
        } catch (\yii\db\IntegrityException $e) {
            Yii::$app->getSession()->setFlash('error', 'Please delete the associate table to delete this record'); //for exception handeling
            return Yii::$app->getResponse()->redirect(Yii::$app->request->referrer)->send();
        }
    }

    /**
     * Finds the MasterCourseTypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MasterCourseTypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MasterCourseTypes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /**
     * course type name validations
     * @param type $coursetype
     */
   public function actionCoursetypeValidation($coursetype) {
        
        $sql = "SELECT * FROM `master_course_types` WHERE `course_type_name` = '" . $coursetype . "'";
        
        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryOne();
       

        if (!empty($result)) {
            echo "1";
        } else {
            echo "0";
        }
    }
}
