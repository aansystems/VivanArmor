<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Courses;
use frontend\models\CoursesSearch;
use frontend\models\Tiles;
use frontend\models\Lessons;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use frontend\models\User;
/**
 * CoursesController implements the CRUD actions for Courses model.
 */
class CoursesController extends Controller {

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
     * Lists all Courses models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CoursesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Courses model.
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
     * Creates a new Courses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Courses();
        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = date('Y-m-d h:i:s');
            $model->status = 10;
            $model->created_at = date('Y-m-d h:i:s');
            $model->updated_at = date('Y-m-d h:i:s');
            $model->save(false);

            Yii::$app->session->setFlash('success', "Course saved Successfully");

            return $this->redirect('index');
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Courses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->save(false);

            Yii::$app->session->setFlash('success', "Course Updated  Successfully");

            return $this->redirect('index');
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionMyReviewMaterial($id) {
        $course = Courses::find()->where(['id' => $id])->one();
        $course_name = Courses::findOne(['id' => $id])->course_name;

        $lessons = Lessons::find()->where(['course_id' => $course->id])->all();
        $filepath = Yii::$app->request->baseUrl . '/uploads/pdf/' . $course_name . '/ebook' . '/';
        $filename = $course_name . '.pdf';

        return $this->render('my-review-material', [
                    'id' => $id,
                    'lessons' => $lessons,
                    'course' => $course,
                    'filepath' => $filepath,
                    'filename' => $filename
        ]);
    }

    /**
     * Deletes an existing Courses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', "Course has been deleted.");
            return $this->redirect(['index']);
        } catch (\yii\db\IntegrityException $e) {
            Yii::$app->getSession()->setFlash('error', 'Please delete the associate tile to delete this course');
            return Yii::$app->getResponse()->redirect(Yii::$app->request->referrer)->send();
        }
    }

    /**
     * Finds the Courses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Courses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Courses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLists($id) {
        $posts = Courses::find()
                ->where(['coursetype_id' => $id])
                ->orderBy('id DESC')
                ->all();

        if (!empty($posts)) {
            foreach ($posts as $post) {
                echo "<option value='" . $post->id . "'>" . $post->course_name . "</option>";
            }
        } else {
            echo "<option>No Option</option>";
        }
    }

    /*     * Fetch all the tiles dependent on the Tiles on courses */

    public function actionGettiles() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $course_id = $parents[0];
                if ($course_id != null) {
                    $list = Tiles::find()
                            ->where(['course_id' => $course_id])
                            ->orderBy('id DESC')->asArray()
                            ->all();
                } else {
                    $list = Tiles::find()->all();
                }

                $selected = null;
                foreach ($list as $i => $tiles) {
                    $out[] = ['id' => $tiles['id'], 'name' => $tiles['tile_name']];
                    if ($i == 0) {
                        $selected = $tiles['id'];
                    }
                }

                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * validations for course name
     * @param type $coursename
     */
    public function actionCoursenameValidation($coursename) {

        $sql = "SELECT * FROM `courses` WHERE `course_name` = '" . $coursename . "'";

        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryOne();


        if (!empty($result)) {
            echo "1";
        } else {
            echo "0";
        }
    }

}
