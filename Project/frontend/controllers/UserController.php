<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Company;
use frontend\models\Learners;
use frontend\models\User;
use frontend\models\BranchManagers;
use frontend\models\Countries;
use frontend\models\States;
use frontend\models\Cities;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Address;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    public $username;
    public $password;

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
                'only' => ['index', 'create', 'update', 'view', 'my-profile', 'edit-profile'],
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
     * for my profile 
     */
    public function actionMyProfile() {
        $model = User::findOne(['id' => Yii::$app->user->identity->id]);
        $model2 = Company::findOne(['company_admin_id' => $model->id]);
        $model3 = BranchManagers::findOne(['user_id' => $model->id]);
        $model4 = Learners::findOne(['user_id' => $model->id]);


        return $this->render('my-profile', [
                    'model' => $model,
                    'model2' => $model2,
                    'model3' => $model3,
                    'model4' => $model4,
        ]);
    }

    /**
     * for edit profile 
     */
   public function actionEditProfile($id) {
        $model = $this->findModel($id);
        if (Yii::$app->user->identity->role_type == 4) { // to check the role type
            $model2 = Learners::findOne(['user_id' => $model->id]); //to fetch the user id from learners table
            $model3 = Address::findOne(['id' => $model2->address_id]); //to fetch the address id from learns table
            $model4 = Countries::findOne(['id' => $model3->country]); //to fetch the countries from address table
            $model5 = States::findOne(['id' => $model3->state]); // to fetch the states from learners table
            $model6 = Cities::findOne(['id' => $model3->city]); // to fetch the cities from address table

            if ($model->load(Yii::$app->request->post())) {
                $model->save(false);

                if ($model3->load(Yii::$app->request->post())) {
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model3->save(false);
                }

                return $this->redirect(['user/my-profile', 'id' => $model->id]);
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->save(false);
            return $this->redirect(['user/my-profile', 'id' => $model->id]);
        }

        if (Yii::$app->user->identity->role_type == 4) {
            return $this->render('edit-profile', [
                        'model' => $model,
                        'model2' => $model2,
                        'model3' => $model3,
                        'model4' => $model4,
                        'modle5' => $model5,
                        'model6' => $model6
            ]);
        } else {
            return $this->render('edit-profile', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetStatesList($id) {
        $state = States::find()
                ->where(['country_id' => $id])
                ->all();
        $countStates = sizeof($state);
        if ($countStates > 0) {
            echo "<option>Select State</option>";

            foreach ($state as $states) {
                echo "<option value='" . $states->id . "'>" . $states->state_name . "</option>";
            }
        } else {
            echo "<option>No States Listed</option>";
        }
    }

    public function actionGetCitiesList($id) {
        $city = Cities::find()
                ->where(['state_id' => $id])
                ->all();
        $countCities = sizeof($city);
        if ($countCities > 0) {
            echo "<option>Select City</option>";

            foreach ($city as $cities) {
                echo "<option value='" . $cities->id . "'>" . $cities->city_name . "</option>";
            }
        } else {
            echo "<option>No Cities Listed</option>";
        }
    }

    //validations for fields

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
        } else if ((0000000001 << $phone << 9999999999)) {
            echo "0";
        } else {
            echo "2";
        }
    }

}
