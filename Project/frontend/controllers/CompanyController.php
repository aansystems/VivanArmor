<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Company;
use frontend\models\CompanySearch;
use frontend\models\User;
use frontend\models\Address;
use frontend\models\Countries;
use frontend\models\States;
use frontend\models\Cities;
use yii\helpers\Json;
use frontend\models\Tiles;
use frontend\models\BranchManagers;
use frontend\models\Branches;
use frontend\models\BlockedCourses;
use frontend\models\CoursesAssigned;
use frontend\models\Learners;
use frontend\models\License;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller {

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
                'only' => ['index', 'create', 'update', 'view','blocked-courses'],
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Company();
        $model2 = new User();
        $model3 = new CoursesAssigned();
        $model4 = new Address();
        $model5 = new Learners();
        $model8 = new License();
       

        
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
            if ($model2->load(Yii::$app->request->post())) {
                $post = Yii::$app->request->post();

                $model2->first_name = ucfirst($post['User']['first_name']);
                $model2->last_name = ucfirst($post['User']['last_name']);
                $model2->role_type = 2;
                $model2->auth_key = Yii::$app->security->generateRandomString();
                $model2->password_hash = \Yii::$app->getSecurity()->generatePasswordHash($password);
                $model2->email = strtolower($post['User']['email']);
                $model2->phone_code = $post['User']['phone_code'];
                $model2->phone = $post['User']['phone'];
                $model2->status = 10;
                $model2->created_at = date('Y-m-d h:i:s');
                $model2->created_by = Yii::$app->user->identity->id;
                $model2->updated_at = date('Y-m-d h:i:s');
                $model2->updated_by = Yii::$app->user->identity->id;
                Yii::$app->mailer->compose(['html' => 'userCredentials-html'], ['user' => $model2, 'password' => $password])
                        ->setFrom('vivaanlms@aansystems.com')
                        ->setTo($model2->email)
                        ->setSubject('Log in credentials for ' . $model2->first_name)
                        ->setTextBody($password)
                        ->send();
                 
                $model2->save(false);
            }
            if ($model3->load(Yii::$app->request->post())) {
                $array = $model3->courses_assigned;              
                    foreach ($array as $value) {
                        $modelCoursesAssigned = new CoursesAssigned();
                        $modelCoursesAssigned->courses_assigned = $value;
                        $modelCoursesAssigned->blocked_status = 1;
                        $modelCoursesAssigned->user_id = $model2->id;
                        $modelCoursesAssigned->created_by = Yii::$app->user->getId();
                        $modelCoursesAssigned->created_at = date('Y-m-d h:i:s');
                        $modelCoursesAssigned->updated_by = Yii::$app->user->getId();
                        $modelCoursesAssigned->updated_at = date('Y-m-d h:i:s');
                        $modelCoursesAssigned->save(false);
                        if (!$modelCoursesAssigned->save(false)) {
                            break;
                        }
                    }
                    $modelCoursesAssigned->save(false);
            }


            if ($model4->load(Yii::$app->request->post())) {
                $post = Yii::$app->request->post();

                $model4->country = $post['Address']['country'];
                $model4->state = $post['Address']['state'];
                $model4->city = $post['Address']['city'];
                $model4->street = $post['Address']['street'];
                $model4->pincode = $post['Address']['pincode'];
                $model4->created_at = date('Y-m-d h:i:s');
                $model4->created_by = Yii::$app->user->identity->id;
                $model4->updated_at = date('Y-m-d h:i:s');
                $model4->updated_by = Yii::$app->user->identity->id;

                $model4->save(false);
            }
            
            $model->company_name = strtoupper($model['company_name']);
            $model->address_id = $model4->id;
            $model->company_admin_id = $model2->id;
            $model->status = 10;
            $model->created_at = date('Y-m-d h:i:s');
            $model->created_by = Yii::$app->user->identity->id;
            $model->updated_at = date('Y-m-d h:i:s');
            $model->updated_by = Yii::$app->user->identity->id;
           
            if ($model2->privilege== 1) {
                $model5->user_id = $model2->id;
                $model5->address_id = $model4->id;
                $model5->status = 10;
                $model5->designation = 'Privileged user';
                $model5->created_at = date('Y-m-d h:i:s');
                $model5->created_by = Yii::$app->user->identity->id;
                $model5->updated_at = date('Y-m-d h:i:s');
                $model5->updated_by = Yii::$app->user->identity->id;
                $model5->save(false);
            }
            $model->save(false);
                          if ($model8->load(Yii::$app->request->post())) {
                $post = Yii::$app->request->post();
                
                 $model8->subscription_type = ucfirst($post['License']['subscription_type']);
                $model8->license_expired = ucfirst($post['License']['license_expired']);
                $model8->company_id = $model->id;
                $model8->license_issued = date('Y-m-d h:i:s');
                $model8->renewal_date = date('Y-m-d h:i:s');
             $model8->created_by =Yii::$app->user->identity->id;
            $model8->updated_by =Yii::$app->user->identity->id;
            $model8->created_at = date('Y-m-d');
                $model8->save(false);
            }

            Yii::$app->session->setFlash('success', "Company saved Successfully");

            return $this->redirect('index');
        }
        return $this->render('create', [
                    'model' => $model,
                    'model2' => $model2,
                    'model3' => $model3,
                    'model4' => $model4,
                    'model8' => $model8
        ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model2 = User::findOne(['id' => $model->company_admin_id]);
        $model3 = new CoursesAssigned();
        $model4 = Address::findOne(['id' => $model->address_id]);
        $model9 = new Learners();

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
                                'user_id' => $model->company_admin_id
                    ]);

                    if (!$modelCoursesAssigned) {
                        $modelCoursesAssigned = new CoursesAssigned();
                        $modelCoursesAssigned->created_by = Yii::$app->user->identity->id;
                    }
                    $modelCoursesAssigned->courses_assigned = $value;
                    $modelCoursesAssigned->user_id = $model->company_admin_id;
                    $modelCoursesAssigned->blocked_status = 1;
                    $modelCoursesAssigned->updated_by = Yii::$app->user->identity->id;
                    $modelCoursesAssigned->save(false);

                    $connection = Yii::$app->db;
                    $connection->createCommand("DELETE FROM `blocked_courses` WHERE `course_id` = '" . $value . "' AND user_id ='" . $model->company_admin_id . "'")
                            ->execute();
                  
                    $branches = Branches::find()
                            ->where(['company_id' => $model->id])
                            ->all();

                    if (!empty($branches)) {

                        foreach ($branches as $branch) {
                            $branch_admin = BranchManagers::findOne(['branch_id' => $branch->id]);

                           if($branch_admin){

                            $command_one = $connection->createCommand("UPDATE `courses_assigned` SET `blocked_status` = 1 WHERE `courses_assigned` = " . $value . " AND `user_id` =" . $branch_admin->user_id . "");
                            $command_one->execute();

                            $connection->createCommand("DELETE FROM `blocked_courses` WHERE `course_id` = '" . $value . "' AND user_id ='" . $branch_admin->user_id . "'")
                                    ->execute();
                     
                            $learners = User::find()
                                    ->where(['created_by' => $branch_admin->user_id])
                                    ->andWhere(['role_type' => 4])
                                    ->all();
                           }
                            if (!empty($learners)) {
                                foreach ($learners as $learner) {
                                    $command_two = $connection->createCommand("UPDATE `courses_assigned` SET `blocked_status` = 1 WHERE `courses_assigned` = '" . $value . "' AND `user_id` ='" . $learner->id . "'");
                                    $command_two->execute();

                                    $connection->createCommand("DELETE FROM `blocked_courses` WHERE `course_id` = '" . $value . "' AND user_id ='" . $learner->id . "'")
                                            ->execute();
                                }
                            }
                        }
                    }
                }

                $blocked_courses = CoursesAssigned::find()
                        ->where(['user_id' => $model->company_admin_id])
                        ->andWhere(['blocked_status' => 0])
                        ->all();

                if (!empty($blocked_courses)) {

                    foreach ($blocked_courses as $blocked) {
                        array_push($array, $blocked->courses_assigned);
                    }
                }

                $modelCoursesAssignedOld = CoursesAssigned::find()
                        ->where(['user_id' => $model->company_admin_id])
                        ->all();

                foreach ($modelCoursesAssignedOld as $item) {
                    if (!in_array($item->courses_assigned, $array)) {
                        $item->delete();
                    }
                }
            } else {
                $modelCoursesAssignedOld = CoursesAssigned::findAll(
                                ['user_id' => $model->company_admin_id]);

                foreach ($modelCoursesAssignedOld as $item) {
                    $item->delete();
                }
            }


            $model->company_name = strtoupper($model['company_name']);
            $model->address_id = $model4->id;
            $learner_id= Learners::findOne(['user_id'=> $model2->id]);
            if ($model2->privilege == 1 && empty($learner_id)) {
                $model9->user_id = $model2->id;
                $model9->address_id = $model4->id;
                $model9->status = 10;
                $model9->designation = 'privileged user';
                $model9->created_at = date('Y-m-d h:i:s');
                $model9->created_by = Yii::$app->user->identity->id;
                $model9->updated_at = date('Y-m-d h:i:s');
                $model9->updated_by = Yii::$app->user->identity->id;
                $model9->save(false);
            }
            $model->save(false);


            Yii::$app->session->setFlash('success', "Company Updated  Successfully"); // to show the confirmation message for updating the data

            return $this->redirect('index');
        }

        return $this->render('update', [
                    'model' => $model,
                    'model2' => $model2,
                    'model3' => $model3,
                    'model4' => $model4,
                                       
        ]);
    }

    public function actionBlockedCourses($id) {
        $model = $this->findModel($id);
        $model2 = new BlockedCourses();

        if ($model2->load(Yii::$app->request->post())) {
            $array_new = $model2->course_id;

            foreach ($array_new as $value) {
                $connection = Yii::$app->db;
                $connection->createCommand()->insert('blocked_courses', [
                            'course_id' => $value,
                            'user_id' => $model->company_admin_id,
                            'created_at' => date('Y-m-d h:i:s'),
                            'created_by' => Yii::$app->user->identity->id
                        ])
                        ->execute();

                $command = $connection->createCommand("UPDATE `courses_assigned` SET `blocked_status` = 0 WHERE `courses_assigned` = '" . $value . "' AND `user_id` ='" . $model->company_admin_id . "'");
                $command->execute();

                $branches = Branches::find()
                        ->where(['company_id' => $model->id])
                        ->all();
                if (!empty($branches)) {
                    foreach ($branches as $branch) {
                        $branch_admin = BranchManagers::findOne(['branch_id' => $branch->id]);

                        $connection->createCommand()->insert('blocked_courses', [
                                    'course_id' => $value,
                                    'user_id' => $branch_admin->user_id,
                                    'created_at' => date('Y-m-d h:i:s'),
                                    'created_by' => Yii::$app->user->identity->id
                                ])
                                ->execute();

                        $command_one = $connection->createCommand("UPDATE `courses_assigned` SET `blocked_status` = 0 WHERE `courses_assigned` = '" . $value . "' AND `user_id` ='" . $branch_admin->user_id . "'");
                        $command_one->execute();

                        $learners = User::find()
                                ->where(['created_by' => $branch_admin->user_id])
                                ->andWhere(['role_type' => 4])
                                ->all();

                        if (!empty($learners)) {
                            foreach ($learners as $learner) {
                                $connection = Yii::$app->db;
                                $connection->createCommand()->insert('blocked_courses', [
                                            'course_id' => $value,
                                            'user_id' => $learner->id,
                                            'created_at' => date('Y-m-d h:i:s'),
                                            'created_by' => Yii::$app->user->identity->id
                                        ])
                                        ->execute();

                                $command_two = $connection->createCommand("UPDATE `courses_assigned` SET `blocked_status` = 0 WHERE `courses_assigned` = '" . $value . "' AND `user_id` ='" . $learner->id . "'");
                                $command_two->execute();
                            }
                        }
                    }
                }

            }
            return $this->redirect('index');
        }

        return $this->render('blocked-courses', [
                    'model' => $model,
                    'model2' => $model2,
        ]);
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {

        try {
            $model = $this->findModel($id);
            $model->status = '0';
            $model->save(false);
            $user = User::findOne(['id' => $model->company_admin_id]);
            $user->status = '0';
            $user->save(false);
            $branches = Branches::findOne(['company_id' => $model->id]);
            if ($branches != null) {
                $branches->status = '0';
                $branches->save(false);
            }

            Yii::$app->getSession()->setFlash('success', "Company has been deleted."); // to show the confirmation message for deleting the data
            return $this->redirect(['index']);
        } catch (\yii\db\IntegrityException $e) {
            Yii::$app->getSession()->setFlash('error', 'Please delete the associate record to delete record'); // for exception handeling
            return Yii::$app->getResponse()->redirect(Yii::$app->request->referrer)->send();
        }
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Company::findOne($id)) !== null) {
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

    public function actionGetAreacode($id) {
        $countCities = Cities::find()
                ->where(['state_id' => $id])
                ->count();

        $city = Cities::find()
                ->where(['state_id' => $id])
                ->all();

        if ($countCities > 0) {
            echo $area_code = Cities::findOne(['id' => $id])->area_code;
        } else {
            echo "";
        }
    }

    public function actionGetTilesList($id) {
        $countTiles = Tiles::find()
                ->where(['course_id' => $id])
                ->count();

        $tile = Tiles::find()
                ->where(['course_id' => $id])
                ->all();

        if ($countTiles > 0) {
            echo "<option>Select Tile</option>";

            foreach ($tile as $tiles) {
                echo "<option value='" . $tiles->id . "'>" . $tiles->tile_name . "</option>";
            }
        } else {
            echo "<option>No Tiles Listed</option>";
        }
    }

    /*     * Fetch all the tiles dependent on the courses */

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
        } else {
            $list = Tiles::find()->all();
            $selected = null;
            foreach ($list as $i => $tiles) {
                $out[] = ['id' => $tiles['id'], 'name' => $tiles['tile_name']];
                if ($i == 0) {
                    $selected = $tiles['id'];
                }
            }

            echo Json::encode([$out]);
            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
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
     * @param type $phone
     */
    public function actionPhoneValidation($phone) {

        $sql = "SELECT * FROM `user` WHERE `phone` = '" . $phone . "'";

        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryOne();
        if (!empty($result)) {
            echo "1";
        } else if ($phone == 0) {
            echo "0";
        } else {
            echo "2";
        }
    }

    /**
     * validations for WebSite
     * @param type $website
     */
    public function actionWebsiteValidation($website) {

        $sql = "SELECT * FROM `company` WHERE `website` = '" . $website . "'";

        $command = Yii::$app->db->createCommand($sql);
        $result = $command->queryOne();


        if (!empty($result)) {
            echo "1";
        } else {
            echo "0";
        }
    }

}
