<?php

namespace frontend\controllers;

use Yii;
use frontend\models\License;
use frontend\models\LicenseSearch;
use frontend\models\Company;
use frontend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LicenseController implements the CRUD actions for License model.
 */
class LicenseController extends Controller
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
     * Lists all License models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LicenseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single License model.
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
     * Creates a new License model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
   
        $model = new License();
    
        if ($model->load(Yii::$app->request->post())) {
             
    
        $user_id= Company::findOne(['id'=>$model->company_id])->company_admin_id;
        $email= User::findOne(['id'=>$user_id])->email;
       
            $today = date('Y-m-d');
            $now = $model->license_expired;
            
            $date = strtotime($now);
            $date = strtotime("-7 day", $date);
          
            if ( $today = '$date' ) {
            //    print_r($model->license_expired);die();
                Yii::$app->mailer->compose()
                ->setFrom('vivaanlms@aansystems.com')
                ->setTo($email)
                ->setSubject('Your License Going To Expire')
                ->setTextBody('Your license will expire witin 7 days from today ,Renew before to continue the service.')
                ->send();
            }
            $model->renewal_date =  date('Y-m-d');
            $model->renewal_purpose =  "null";
            $model->created_by =Yii::$app->user->identity->id;
            $model->updated_by =Yii::$app->user->identity->id;
            $model->created_at = date('Y-m-d');
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
           
       
        ]);
    }

    /**
     * Updates an existing License model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    

        if ($model->load(Yii::$app->request->post()) ) {

            $user_id= Company::findOne(['id'=>$model->company_id])->company_admin_id;
            $email= User::findOne(['id'=>$user_id])->email;
           
                $today = date('Y-m-d');
                $now = $model->license_expired;
                
                $date = strtotime($now);
                $date = strtotime("-7 day", $date);
              
                if ( $today = '$date' ) {
                //    print_r($model->license_expired);die();
                    Yii::$app->mailer->compose()
                    ->setFrom('vivaanlms@aansystems.com')
                    ->setTo($email)
                    ->setSubject('Your License Going To Expire')
                    ->setTextBody('Your license will expire witin 7 days from today ,Renew before to continue the service.')
                    ->send();
                }
                $model->updated_by =Yii::$app->user->identity->id;
                $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }
        

        return $this->render('update', [
            'model' => $model,
           
        ]);
    }

    /**
     * Deletes an existing License model.
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
     * Finds the License model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return License the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = License::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
