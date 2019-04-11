<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Certificates;
use frontend\models\CertificatesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Learners;
use frontend\models\User;
use mPDF;
use frontend\models\CoursesAssigned;
use frontend\models\Courses;
use frontend\models\UploadedCertificatesSearch;
use frontend\models\UploadedCertificates;
use yii\helpers\ArrayHelper;
use frontend\models\Branches;
use frontend\models\BranchManagers;

/**
 * CertificatesController implements the CRUD actions for Certificates model.
 */
class CertificatesController extends Controller {

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
                'only' => ['index', 'view','branch-manager-certificate','company-admin-certificate','pdf_view'],
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
     * Lists all Certificates models.
     * @return mixed
     */
    public function actionIndex() {
        $id = Yii::$app->user->identity->id;
        $learner_id = Learners::find()->where(['user_id' => $id])->one();
        $data = Certificates::find()->where(['learner_id' => $learner_id->id])->all();
        $data1 = UploadedCertificates::find()->where(['learner_id' => $learner_id->id])->all();
        return $this->render('index', [
                    'data' => $data,
                    'data1' => $data1,
        ]);
    }

    /**
     * Displays a single Certificates model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $learner_id = Certificates::findOne(['id' => $id])->learner_id;
        $user_id = Learners::findOne(['id' => $learner_id])->user_id;
        $user_name = user::find()->where(['id' => $user_id])->one();
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'user_name' => $user_name,
        ]);
    }

    /**
     * Creates a new Certificates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Certificates();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Certificates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * Deletes an existing Certificates model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionBranchManagerCertificate(){
 
        $data =Certificates::find()
                    ->innerJoin('learners', 'certificates.learner_id=learners.id')
                    ->where(['learners.created_by' =>Yii::$app->user->identity->id ])
                    ->andWhere(['=','learners.status' ,10])
                    ->orderBy('certificates.expire_date')
                    ->all();
                return $this->render('branch-manager-certificate', [
                    'data' => $data,
        ]);
    }


    
    
    public function actionCompanyAdminCertificate(){
       $out4=[];
        $out3=[];
        $out5=[];
                     $data = Branches::find()
                            ->rightJoin('branch_managers', 'branches.id=branch_managers.branch_id')
                            ->where(['branches.created_by' => Yii::$app->user->identity->id])
                            ->all();
                  foreach ($data as $role) {
                           array_push($out4,"$role->branch_name");
                       $out1=[];
                       $out2=[];
                    $branch_manager_id = BranchManagers::findOne(['branch_id' => $role])->user_id;
                    $learner_id= Learners::findAll(['created_by'=>$branch_manager_id]);
                    foreach ($learner_id as $value) {       

                    $out1 = Certificates::find()->where(['learner_id' => $value->id,'status' => 1])->all(); 

                   $out2 = ArrayHelper::merge($out2, $out1);
                    }
                              
                   $out5 = ArrayHelper::merge($out3, $out2); 
                }

                return $this->render('company_admin_certificate', [
                    'out5' => $out5,
                    'out4' =>$out4,
        ]);
    }
    
    
    /**
     * Finds the Certificates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Certificates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Certificates::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSamplePdf($id, $user_name) {
        $certificate_datails = Certificates::findOne(['id' => $id]);




        $mpdf = new mPDF('', // mode - default ''
                'A4-L', // format - A4, for example, default ''
                0, // font size - default 0
                '', // default font family
                17, // margin_left
                13, // margin right
                7, // margin top
                7, // margin bottom
                9, // margin header
                9, // margin footer
                'L'    // L - landscape, P - portrait
        );

        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($this->renderPartial('pdf_view', ['user_name' => $user_name, 'certificate_name' => $certificate_datails->certificate_name, 'issue_date' => $certificate_datails->issue_date]));

        $mpdf->Output();

        exit;
    }

}

