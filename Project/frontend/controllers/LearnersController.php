<?php

namespace frontend\controllers;

use Yii;
use Behat\Gherkin\Exception\Exception;
use frontend\models\Learners;
use frontend\models\LearnersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\User;
use frontend\models\CoursesAssigned;
use frontend\models\Countries;
use frontend\models\Address;
use frontend\models\States;
use frontend\models\Cities;
use frontend\models\BlockedCourses;
use frontend\models\Company;
use frontend\models\BranchManagers;
       $connection = Yii::$app->db;
       $tooo= $connection->createCommand("DELETE FROM super_admin_notifications WHERE super_admin_notifications.assigned_to in (SELECT user_id FROM learners WHERE learners.status =0)");
       $tooo->query();

/**
 * LearnersController implements the CRUD actions for Learners model.
 */
class LearnersController extends Controller {

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
     * Lists all Learners models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LearnersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Learners model.
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
     * Creates a new Learners model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Learners();
        $model2 = new User();
        $model3 = new CoursesAssigned();
        $model4 = new Company();
        $model5 = new Address();
        function getGUID() {
            if (function_exists('com_create_guid')) {
                return com_create_guid();
            } else {
                mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
                $charid = strtoupper(md5(uniqid(rand(), true)));
                $hyphen = chr(45); // "-"
                $uuid = chr(123)// "{"
                        . substr($charid, 0, 8) . $hyphen
                        . substr($charid, 8, 4) . $hyphen
                        . substr($charid, 12, 4) . $hyphen
                        . substr($charid, 16, 4) . $hyphen
                        . substr($charid, 20, 12)
                        . chr(125); // "}"
                return $uuid;
            }
        }

        $GUID = getGUID();

        $password_guid = trim($GUID, '{}');
  
        $password=substr($password_guid, 0, 8);

        if ($model->load(Yii::$app->request->post())) {

            if ($model2->load(Yii::$app->request->post())) {

                $post = Yii::$app->request->post();
                $model2->first_name = ucfirst($post['User']['first_name']);
                $model2->last_name = ucfirst($post['User']['last_name']);
                $model2->role_type = 4;

                if (Yii::$app->user->identity->role_type == 1  && $model2->role_type == 4 ) {
                    $model2->added_by = 0;
                }elseif (Yii::$app->user->identity->role_type == 6 && $model2->role_type == 4) {
                    $model2->added_by = 0;
                } 
                elseif (Yii::$app->user->identity->role_type == 3 && $model2->role_type == 4) {
                    $model2->added_by = 1;
                } else {
                    $model2->added_by = NULL;
                }
                
                $model2->auth_key = Yii::$app->security->generateRandomString();
                $model2->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($password);
                $model2->email = strtolower($post['User']['email']);
                $model2->phone = $post['User']['phone'];
                $model2->phone_code = $post['User']['phone_code'];
                $model2->status = 10;
                $model2->created_at = date('Y-m-d h:i:s');
                $model2->created_by = Yii::$app->user->identity->id;
                $model2->updated_at = date('Y-m-d h:i:s');
                $model2->updated_by = Yii::$app->user->identity->id;
                           Yii::$app->mailer->compose(['html' => 'userCredentials-html'], ['user' => $model2,'password' => $password]
                   
                   )
                                ->setFrom('vivaanlms@aansystems.com')
                                ->setTo($model2->email)
                                ->setSubject('Log in credentials for '.$model2->first_name)
                                ->setTextBody($password )                               
                                ->send();
                $model2->save(false);
            }

            if ($model3->load(Yii::$app->request->post())) {
                $array = $model3->courses_assigned;
                try {
                    foreach ($array as $value) {
                        $modelCoursesAssigned = new CoursesAssigned();
                        $modelCoursesAssigned->courses_assigned = $value;
                        $modelCoursesAssigned->user_id = $model2->id;
                        $modelCoursesAssigned->blocked_status = 1;
                        $modelCoursesAssigned->created_by = Yii::$app->user->identity->id;
                        $modelCoursesAssigned->created_at = date('Y-m-d h:i:s');
                        $modelCoursesAssigned->updated_by = Yii::$app->user->identity->id;
                        $modelCoursesAssigned->updated_at = date('Y-m-d h:i:s');
                        $modelCoursesAssigned->save(false);
                        if (!$modelCoursesAssigned->save(false)) {
                            break;
                        }
                    }
                    $modelCoursesAssigned->save(false);
                } catch (Exception $e) {
                    
                }
            }

            if ($model5->load(Yii::$app->request->post())) {
                $model5->country = $post['Address']['country'];
                $model5->state = $post['Address']['state'];
                $model5->city = $post['Address']['city'];
                $model5->created_at = date('Y-m-d h:i:s');
                $model5->created_by = Yii::$app->user->identity->id;
                $model5->updated_at = date('Y-m-d h:i:s');
                $model5->updated_by = Yii::$app->user->identity->id;
                $model5->save(false);
            }



            $model->user_id = $model2->id;
            $model->address_id = $model5->id;            
            $model->status = 10;
            $model->created_at = date('Y-m-d h:i:s');
            $model->created_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d h:i:s');
            $model->updated_by = Yii::$app->user->identity->id;
            $model->save(false);

            Yii::$app->session->setFlash('success', "Learner/User saved Successfully");

            return $this->redirect('index');
        }
        return $this->render('create', [
                    'model' => $model,
                    'model2' => $model2,
                    'model3' => $model3,
                    'model4' => $model4,
                    'model5' => $model5
        ]);
    }

    /**
     * Updates an existing Learners model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model2 = User::findOne(['id' => $model->user_id]);
        $model3 = new CoursesAssigned();
        $model5 = Address::findOne(['id' => $model->address_id]);
        $model6 = Countries::findOne(['id' => $model5->country]);
        $model7 = States::findOne(['id' => $model5->state]);
        $model8 = Cities::findOne(['id' => $model5->city]);


        if ($model->load(Yii::$app->request->post())) {

            if ($model2->load(Yii::$app->request->post())) {
                $post = Yii::$app->request->post();
                $model2->first_name = ucfirst($post['User']['first_name']); // to store the updated first_name in user table
                $model2->last_name = ucfirst($post['User']['last_name']); // to store the updated last_name in user table
               // $model2->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($post['User']['phone']); // to store the phone number as password
                $model2->email = strtolower($post['User']['email']); // to store the email in user table
                $model2->phone_code = $post['User']['phone_code'];
                $model2->phone = $post['User']['phone'];
                $model->updated_by = Yii::$app->user->identity->id;
                $model2->save(false);
            }

            if ($model3->load(Yii::$app->request->post())) {
                $array = $model3->courses_assigned;
                foreach ($array as $value) {
                    $modelCoursesAssigned = CoursesAssigned::findOne([
                                'courses_assigned' => $value,
                                'user_id' => $model->user_id
                    ]);
//                    echo '<pre>';
//                    print_r($modelCoursesAssigned);

                    if (!$modelCoursesAssigned) {
                        $modelCoursesAssigned = new CoursesAssigned();
                        $modelCoursesAssigned->created_by = Yii::$app->user->identity->id;
                    }
                    $modelCoursesAssigned->courses_assigned = $value;
                    $modelCoursesAssigned->user_id = $model->user_id;
                    $modelCoursesAssigned->blocked_status = 1;
                    $modelCoursesAssigned->updated_by = Yii::$app->user->identity->id;

                    $modelCoursesAssigned->save(false);

                    $connection = Yii::$app->db;
                    $connection->createCommand("DELETE FROM `blocked_courses` WHERE `course_id` = '" . $value . "' AND user_id ='" . $model->user_id . "'")
                            ->execute();
                }

                $blocked_courses = CoursesAssigned::find()
                        ->where(['user_id' => $model->user_id])
                        ->andWhere(['blocked_status' => 0])
                        ->all();

                foreach ($blocked_courses as $blocked) {
                    array_push($array, $blocked->courses_assigned);
                }

                $modelCoursesAssignedOld = CoursesAssigned::find()
                        ->where(['user_id' => $model->user_id])
                        ->all();

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


            if ($model5->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                $model5->save(false);
            }


            $model->save(false);

            Yii::$app->session->setFlash('success', "Record Updated  Successfully"); // to show the confirmation message for updating the data

            return $this->redirect('index');
        }

        return $this->render('update', [
                    'model' => $model,
                    'model2' => $model2,
                    'model3' => $model3,
                    'model5' => $model5,
                    'model6' => $model6,
                    'model7' => $model7
        ]);
    }

    /**
     * blocked courses for learners
     */
    public function actionBlockedCourses($id) {
        $model = $this->findModel($id);
        $model2 = new BlockedCourses();

        if ($model2->load(Yii::$app->request->post())) {
            $array_new = $model2->course_id;
            foreach ($array_new as $value) {
                $connection = Yii::$app->db;
                $connection->createCommand()->insert('blocked_courses', [
                            'course_id' => $value,
                            'user_id' => $model->user_id,
                            'created_at' => date('Y-m-d h:i:s'),
                            'created_by' => Yii::$app->user->identity->id
                        ])
                        ->execute();

                $command = $connection->createCommand("UPDATE `courses_assigned` SET `blocked_status` = 0 WHERE `courses_assigned` = '" . $value . "' AND `user_id` ='" . $model->user_id . "'");
                $command->execute();
            }
            return $this->redirect('index');
        }

        return $this->render('blocked-courses', [
                    'model' => $model,
                    'model2' => $model2,
        ]);
    }

    /**
     * Deletes an existing Learners model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {   
        $model = $this->findModel($id);
        $model->status = '0';
        $model->save(false);
        $user = User::findOne(['id' => $model->user_id]);
        $user->status = '0';
        $user->save(false);
        Yii::$app->session->setFlash('success', "Record Deleted Successfully");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Learners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Learners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Learners::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetStatesList($id) {
        $countStates = States::find()
                ->where(['country_id' => $id])
                ->count();

        $state = States::find()
                ->where(['country_id' => $id])
                ->all();

        if ($countStates > 0) {
            echo "<option></option>";

            foreach ($state as $states) {
                echo "<option value='" . $states->id . "'>" . $states->state_name . "</option>";
            }
        } else {
            echo "<option></option>";
        }
    }

    public function actionGetCitiesList($id) {
        $countCities = Cities::find()
                ->where(['state_id' => $id])
                ->count();

        $city = Cities::find()
                ->where(['state_id' => $id])
                ->all();

        if ($countCities > 0) {
            echo "<option></option>";

            foreach ($city as $cities) {
                echo "<option value='" . $cities->id . "'>" . $cities->city_name . "</option>";
            }
        } else {
            echo "<option></option>";
        }
    }

    public function actionGetPhonecode($id) {

        $countStates = States::find()
                ->where(['country_id' => $id])
                ->count();

        $state = States::find()
                ->where(['country_id' => $id])
                ->all();
        if ($countStates > 0) {
            echo $phone_code = Countries::findOne(['id' => $id])->phonecode;
        } else {
            echo "";
        }
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
        } else if(($phone==0)) {
            echo "0";
        }
        else{
            echo "2";
        }
        }
    

    /**
     * form validation for user limit exceeds by
     * @param type $form
     * author by Prem
     */
    public function actionFormValidation() {

        $company_admin_id = BranchManagers::findOne(['user_id' => Yii::$app->user->identity->id])->created_by;
        $user_license = Company::findOne(['company_admin_id' => $company_admin_id])->users_license;

        $query_active_users = "SELECT `email` FROM `branches` AS a, `branch_managers` AS b, `user` AS c, `company` AS d WHERE a.`company_id` = d.`id` AND d.`company_admin_id` = " . $company_admin_id . " AND b.`branch_id` = a.`id` AND b.`user_id` = c.`created_by` AND c.`status` = 10 AND c.`role_type` = 4 AND c.`added_by` = 1";
        $connection1 = Yii::$app->db;
        $command_active_users = $connection1->createCommand($query_active_users);
        $result_active_users = $command_active_users->queryAll();
        $active_users = count($result_active_users);

        if (Yii::$app->user->identity->role_type !== 1 && Yii::$app->user->identity->role_type !== 6) {
            if ($active_users !== $user_license) {
                echo "1";
            } else {
                echo "0";
            }
        }
    }

}
