<?php

namespace frontend\controllers;

use Yii;
use frontend\models\TestAssigned;
use frontend\models\TestAssignedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\BranchManagers;
use frontend\models\User;
use frontend\models\RequestNewTest;

/**
 * TestAssignedController implements the CRUD actions for TestAssigned model.
 */
class TestAssignedController extends Controller {

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
                'only' => ['index', 'view', '_form', 'approve', 'approve-test', 'create'],
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
     * Lists all TestAssigned models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TestAssignedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TestAssigned model.
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
     * Creates a new TestAssigned model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TestAssigned();
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post()['TestAssigned'];
            if (Yii::$app->user->identity->role_type == 1) {
                foreach ($data['subject_assigned'] as $subject) {
                    foreach ($data['user_id'] as $user_id) {
                        $data1 = TestAssigned::findOne(['user_id' => $user_id, 'subject_assigned' => $subject]);
                        if (empty($data1)) {
                            $model_new = new TestAssigned();
                            $model_new->user_id = $user_id;
                            $model_new->subject_assigned = $subject;
                            $model_new->blocked_status = 1;
                            $model_new->created_at = date('Y-m-d h:i:s');
                            $model_new->created_by = Yii::$app->user->identity->id;
                            $model_new->updated_by = Yii::$app->user->identity->id;
                            $model_new->updated_at = date('Y-m-d h:i:s');
                            $model_new->save(FALSE);
                        }
                    }
                }
            } elseif (Yii::$app->user->identity->role_type == 2) {
                foreach ($data['subject_assigned'] as $subject) {
                    foreach ($data['created_by'] as $value) {
                        $user_id = BranchManagers::findOne(['branch_id' => $value])->user_id;
                        $data2 = TestAssigned::findOne(['user_id' => $user_id, 'subject_assigned' => $subject]);
                        if (empty($data2)) {
                            $model_new = new TestAssigned();
                            $model_new->user_id = $user_id;
                            $model_new->subject_assigned = $subject;
                            $model_new->blocked_status = 1;
                            $model_new->created_at = date('Y-m-d h:i:s');
                            $model_new->created_by = Yii::$app->user->identity->id;
                            $model_new->updated_by = Yii::$app->user->identity->id;
                            $model_new->updated_at = date('Y-m-d h:i:s');
                            $model_new->save(FALSE);
                        }
                    }
                }
            } elseif (Yii::$app->user->identity->role_type == 3) {
                foreach ($data['subject_assigned'] as $subject) {
                    foreach ($data['created_by'] as $user_id) {
                        $data3 = TestAssigned::findOne(['user_id' => $user_id, 'subject_assigned' => $subject]);
                        if (empty($data3)) {
                            $model_new = new TestAssigned();
                            $model_new->user_id = $user_id;
                            $model_new->subject_assigned = $subject;
                            $model_new->blocked_status = 1;
                            $model_new->created_at = date('Y-m-d h:i:s');
                            $model_new->created_by = Yii::$app->user->identity->id;
                            $model_new->updated_by = Yii::$app->user->identity->id;
                            $model_new->updated_at = date('Y-m-d h:i:s');
                            $model_new->save(FALSE);
                        }
                    }
                }
            }
            $model->save();
            return $this->redirect('index');
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }
    /**
     * Deletes an existing TestAssigned model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $user_id = TestAssigned::findOne(['id' => $id]);
        $role = User::findOne(['id' => $user_id->user_id]);
        if ($role->role_type == 2) {
            $branch_id = TestAssigned::findAll(['created_by' => $user_id->user_id, 'subject_assigned' => $user_id->subject_assigned]);
            foreach ($branch_id as $value) {
                $learner_id = TestAssigned::findAll(['created_by' => $value->user_id, 'subject_assigned' => $user_id->subject_assigned]);

                if (!empty($learner_id)) {
                    foreach ($learner_id as $value1) {
                        $this->findModel($value1->id)->delete();
                    }
                }
                $this->findModel($value->id)->delete();
            }
            $this->findModel($id)->delete();
        } elseif ($role->role_type == 3) {
            $learner_id = TestAssigned::findAll(['created_by' => $user_id->user_id, 'subject_assigned' => $user_id->subject_assigned]);
            if (!empty($learner_id)) {
                foreach ($learner_id as $value1) {
                    $this->findModel($value1->id)->delete();
                }
            }
            $this->findModel($id)->delete();
        } else {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the TestAssigned model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestAssigned the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TestAssigned::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionApproveTest() {
        $data = RequestNewTest::find()
                ->leftJoin('user', 'request_new_test.user_id=user.id')
                ->where(['user.created_by' => Yii::$app->user->identity->id, 'request_new_test.status' => Null])
                ->all();
        return $this->render('approve-test', [
                    'data' => $data,
        ]);
    }

    public function actionApprove($id) {
        $connection = Yii::$app->db;
        $connection->createCommand()
                ->update('request_new_test', ['status' => 1], 'id =' . $id)
                ->execute();
        return $this->redirect(['approve-test']);
    }

    public function actionReject($id) {
        $connection = Yii::$app->db;
        $connection->createCommand()
                ->update('request_new_test', ['status' => 2], 'id =' . $id)
                ->execute();
        return $this->redirect(['approve-test']);
    }

}
