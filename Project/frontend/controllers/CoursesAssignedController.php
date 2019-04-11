<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Courses;
use frontend\models\CoursesAssigned;
use frontend\models\CoursesAssignedSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use frontend\models\User;
/**
 * CoursesAssignedController implements the CRUD actions for CoursesAssigned model.
 */
class CoursesAssignedController extends Controller {

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
                        'only' => ['index','create','update','view','my-courses'],
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
     * Lists all CoursesAssigned models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new CoursesAssignedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CoursesAssigned model.
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
     * Creates a new CoursesAssigned model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Updates an existing CoursesAssigned model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionMyCourses() {
        $searchModel = new CoursesAssignedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = CoursesAssigned::find()->where(['user_id' => Yii::$app->user->id, 'blocked_status' => 1]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4]);
        $array = [];
        // limit the query using the pagination and retrieve the articles
                $articles = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        $dataQuery = $query->all();

                    
        foreach ($dataQuery as $dataQuery) {
            $array [] = Courses::find()->where(['id' => $dataQuery->courses_assigned])->one();
        }
        return $this->render('my-courses', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'query' => $query,
                        'array' => $array,
                        'pagination' => $pagination
            ]);
    
    }
        public function actionCourseExplanation($course_id) {

        return Courses::findOne(['id' => $course_id])->course_description;

      
    }


    /**
     * Deletes an existing CoursesAssigned model.
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
     * Finds the CoursesAssigned model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CoursesAssigned the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CoursesAssigned::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
