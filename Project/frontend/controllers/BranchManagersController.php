<?php

namespace frontend\controllers;

use Yii;
use frontend\models\BranchManagers;
use frontend\models\BranchManagersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Behat\Gherkin\Exception\Exception;
use frontend\models\User;
use frontend\models\CoursesAssigned;
use frontend\models\Learners;

$present_date = date('Y-m-d h:i:s');

/**
 * BranchManagersController implements the CRUD actions for BranchManagers model.
 */
class BranchManagersController extends Controller {

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
     * Lists all BranchManagers models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BranchManagersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BranchManagers model.
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
     * Creates a new BranchManagers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new BranchManagers();
        $model2 = new User(); //assigning the user model to model2
        $model3 = new CoursesAssigned(); //assigning the courses assigned model to model3
        $model5 = new Learners();


        if (function_exists('com_create_guid')) {
            $GUID = com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $GUID = chr(123)// "{"
                    . substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12)
                    . chr(125); // "}"         
        }

        $password_guid = trim($GUID, '{}');
        $password = substr($password_guid, 0, 8);

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();


            if ($model2->load(Yii::$app->request->post())) {// to load the data into user table
                $model2->first_name = ucfirst($post['User']['first_name']); // to store the first_name in user table
                $model2->last_name = ucfirst($post['User']['last_name']); // to store the last_name in user table
                $model2->role_type = 3;
                $model2->auth_key = Yii::$app->security->generateRandomString();
                $model2->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($password); // to store the phone number as password
                $model2->email = strtolower($post['User']['email']); // to store the email in user table
                $model2->phone_code = $post['User']['phone_code'];
                $model2->phone = $post['User']['phone']; // to store the phone in user table
                $model2->status = 10;
                $model2->created_at = $present_date;
                $model2->created_by = Yii::$app->user->identity->id;
                $model2->updated_at = $present_date;
                $model2->updated_by = Yii::$app->user->identity->id;
                Yii::$app->mailer->compose(['html' => 'userCredentials-html'], ['user' => $model2, 'password' => $password])
                        ->setFrom('vivaanlms@aansystems.com')
                        ->setTo($model2->email)
                        ->setSubject('Log in credentials for ' . $model2->first_name)
                        ->setTextBody($password)
                        ->send();
                $model2->save(false);
            }
            if ($model3->load(Yii::$app->request->post())) {// to load the data into courses assigned table
                $array = $model3->courses_assigned; // to store the assigned courses to array              
                foreach ($array as $value) {
                    $model3 = new CoursesAssigned();
                    $model3->courses_assigned = $value;
                    $model3->user_id = $model2->id;
                    $model3->blocked_status = 1;
                    $model3->created_by = Yii::$app->user->getId();
                    $model3->created_at = $present_date;
                    $model3->updated_by = Yii::$app->user->getId();
                    $model3->updated_at = $present_date;
                    $model3->save(false);
                    if (!$model3->save(false)) {
                        break;
                    }
                }
                $model3->save(false);
            }


            $model->user_id = $model2->id; //storing the branch manager id to user id in user table
            $model->status = 10;
            $model->created_at = $present_date;
            $model->created_by = Yii::$app->user->identity->id;
            $model->updated_at = $present_date;
            $model->updated_by = Yii::$app->user->identity->id;
            if ($model2->privilege == 1) {
                $model5->user_id = $model2->id;
                $model5->address_id = null;
                $model5->status = 10;
                $model5->designation = 'privileged user';
                $model5->created_at = $present_date;
                $model5->created_by = Yii::$app->user->identity->id;
                $model5->updated_at = $present_date;
                $model5->updated_by = Yii::$app->user->identity->id;
                $model5->save(false);
            }
            $model->save(false);

            Yii::$app->session->setFlash('success', "Branch Manager Created Successfully"); // to show the confirmation message for saving the data

            return $this->redirect('index');
        }

        return $this->render('create', [
                    'model' => $model,
                    'model2' => $model2,
                    'model3' => $model3
        ]);
    }

    /**
     * Updates an existing BranchManagers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model2 = User::findOne(['id' => $model->user_id]);
        $model9 = new Learners();
        $model3 = new CoursesAssigned();


        if ($model->load(Yii::$app->request->post())) {
            if ($model2->load(Yii::$app->request->post())) {
                $post = Yii::$app->request->post();
                $model2->first_name = ucfirst($post['User']['first_name']); // to store the updated first_name in user table
                $model2->last_name = ucfirst($post['User']['last_name']); // to store the updated last_name in user table
                $model2->email = strtolower($post['User']['email']); // to store the email in user table
                $model2->phone_code = $post['User']['phone_code'];
                $model2->phone = $post['User']['phone']; // to store the phone in user table
                $model2->updated_by = Yii::$app->user->identity->id;
                $model2->save(false);
            }


            if ($model3->load(Yii::$app->request->post())) {
                $array = $model3->courses_assigned;
                foreach ($array as $value) {

                    $modelCoursesAssigned = CoursesAssigned::findOne([
                                'courses_assigned' => $value,
                                'user_id' => $model->user_id
                    ]);

                    if (!$modelCoursesAssigned) {
                        $modelCoursesAssigned = new CoursesAssigned();
                        $modelCoursesAssigned->created_by = Yii::$app->user->identity->id;
                    }
                    $modelCoursesAssigned->courses_assigned = $value;
                    $modelCoursesAssigned->user_id = $model->user_id;
                    $modelCoursesAssigned->blocked_status = 1;
                    $modelCoursesAssigned->updated_by = Yii::$app->user->identity->id;
                    $modelCoursesAssigned->save(false);
                }

                $modelCoursesAssignedOld = CoursesAssigned::findAll(
                                ['user_id' => $model->user_id]);

                foreach ($modelCoursesAssignedOld as $item) {
                    if (!in_array($item->courses_assigned, $array)) {
                        $item->delete();
                    }
                }
            } else {
                $modelCoursesAssignedOld = CoursesAssigned::findAll(
                                ['user_id' => $model->user_id]);

                foreach ($modelCoursesAssignedOld as $item) {
                    $item->delete();
                }
            }


            $model->created_at = $present_date;
            $learner_id = Learners::findOne(['user_id' => $model2->id]);
            if ($model2->privilege == 1 && empty($learner_id)) {
                $model9->user_id = $model2->id;
                $model9->address_id = $model4->id;
                $model9->status = 10;
                $model9->designation = 'privileged user';
                $model9->created_at = $present_date;
                $model9->created_by = Yii::$app->user->identity->id;
                $model9->updated_at = $present_date;
                $model9->updated_by = Yii::$app->user->identity->id;
                $model9->save(false);
            }
            $model->save(false);

            Yii::$app->session->setFlash('success', "Branch Manager Updated  Successfully"); // to show the confirmation message for updating the data

            return $this->redirect('index');
        }

        return $this->render('update', [
                    'model' => $model,
                    'model2' => $model2,
                    'model3' => $model3
        ]);
    }

    /**
     * Deletes an existing BranchManagers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        try {
            $this->findModel($id)->delete();
            Yii::$app->getSession()->setFlash('success', "Branch Manager has been deleted."); // to show the confirmation message for deleting the data
            return $this->redirect(['index']);
        } catch (\yii\db\IntegrityException $e) {
            Yii::$app->getSession()->setFlash('error', 'Please delete the associate table to delete this table'); // for exception handeling
            return Yii::$app->getResponse()->redirect(Yii::$app->request->referrer)->send();
        }
    }

    /**
     * Finds the BranchManagers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BranchManagers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = BranchManagers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * validations for email
     * @param type $email
     */
    public function actionEmailValidation($email) {

        $sql = "SELECT * FROM `user` WHERE `email` = '" . $email . "'";

        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryOne();


        if (!empty($result)) {
            echo "1";
        } else {
            echo "0";
        }
    }

    /**
     * validations for phone

     *  by bharath
     */
    public function actionPhoneValidation($phone) {

        $sql = "SELECT * FROM `user` WHERE `phone` = '" . $phone . "'";

        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryOne();
        if (!empty($result)) {
            echo "1";
        } else if (0000000001 << $phone << 9999999999) {
            echo "0";
        } else {
            echo "2";
        }
    }

    /**
     * validations for branch
     * @param type $branch
     */
    public function actionBranchValidation($branch_name) {

        $sql = "SELECT * FROM `branch_managers` WHERE `branch_id` = '" . $branch_name . "'";

        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryOne();


        if (!empty($result)) {
            echo "1";
        } else {
            echo "0";
        }
    }

}
