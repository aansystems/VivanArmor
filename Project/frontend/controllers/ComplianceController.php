<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use \yii\filters\VerbFilter;
use frontend\models\Company;
use frontend\models\MasterHipaaCategory;
use frontend\models\MasterHipaaControl;
use frontend\models\MasterCsoControlOptions;
use frontend\models\HipaaControlsStatus;
use yii\web\UploadedFile;
use frontend\models\User;

/**
 * TemplatesController implements the CRUD actions for Templates model.
 */
class ComplianceController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['site/login'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'hipaa',
                            'pci',
                            'gdpr',
                            'hipaa-checklist',
                            'pci-checklist',
                            'gdpr-checklist',
                            'hipaa-control-status',
                            'site/logout'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                                                'matchCallback' => function () {
                            return User::findOne(['id' => Yii::$app->user->identity->id])->two_fact === 1;
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionHipaa() {
        //Find the company admin to get the company id
        //Fetch the company ID, if its individual learner store 0 for now
        $company_id = 0;
        $user = User::findOne(Yii::$app->user->identity->id);
        while ($user->role_type != 2 && $user->role_type != 1) {
            $user = User::findOne($user->created_by);
        }
        if ($user->role_type == 2) {
            $company_id = Company::find()->select(['id'])->where(['company_admin_id' => $user->id])->scalar();
        }

        $category = MasterHipaaCategory::find()
                ->where(['status' => 1])
                ->orderBy(['category_name' => SORT_ASC])
                ->all();
        $array = [];
        foreach($category as $cat) {
            $policy_template = MasterHipaaControl::find()
                    ->where(['category_id' => $cat->id,'status' => 1])
                    ->orderBy(['template_name' => 'ASC'])
                    ->all();
            foreach ($policy_template as $dataQuery) {
                $policy_status = HipaaControlsStatus::find()
                        ->where(['policy_id' => $dataQuery->id, 'company_id' => $company_id])
                        ->orderBy(['id' => SORT_DESC])
                        ->all();
                $array [$cat->id] [] = [
                    'data' => $dataQuery,
                    'policy_status' => $policy_status,
                    'policy_option' => (!empty($policy_status)) ? $policy_status[0]->getPolicyOption()->one() : ''
                ];
            }
        }

        return $this->render('hipaa', [
                    'options' => MasterCsoControlOptions::find()->all(),
                    'array1' => $array,
                    'array2' => $array,
                    'category' => $category
        ]);
    }

    public function actionHipaaChecklist() {

        return $this->render('pci');
    }

    public function actionPci() {

        return $this->render('pci');
    }

    public function actionPciChecklist() {

        return $this->render('pci');
    }

    public function actionGdpr() {

        return $this->render('gdpr');
    }

    public function actionGdprChecklist() {

        return $this->render('gdpr');
    }

    public function actionHipaaControlStatus() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $post = Yii::$app->request->post();
//Get the doc if it exists
        $doc = UploadedFile::getInstanceByName('doc');
        //Fetch the company ID, if its individual learner store 0 for now
        $company_id = 0;
        $user = User::findOne(Yii::$app->user->identity->id);
        while ($user->role_type != 2 && $user->role_type != 1) {
            $user = User::findOne($user->created_by);
        }
        if ($user->role_type == 2) {
            $company_id = Company::find()->select(['id'])->where(['company_admin_id' => $user->id])->scalar();
        }

        //Not required to check if data exists, since we have to maintain log. But check for old policy and delete old files
        $old_policy = HipaaControlsStatus::find()
                ->where(['policy_id' => $post['policy_id'], 'company_id' => $company_id])
                ->orderBy(['created_at' => SORT_DESC])
                ->one();
        $policy = new HipaaControlsStatus();
        $policy->policy_id = $post['policy_id'];
        $policy->policy_option_id = $post['optradio'];
        $policy->company_id = $company_id;
        $policy->created_by = Yii::$app->user->identity->id;
        $policy->file = NULL;
        $policy->expiry_date = NULL;
        if ($policy->policy_option_id == 1) {
            if (!empty($doc)) {
                $ext = explode(".", $doc->name);
                $ext = $ext[count($ext) - 1];
                $filename = Yii::$app->user->identity->id . '_' . $policy->policy_id . '_' . $doc->name;
                $path = "tech-docs/" . $filename;
                if (!empty($old_policy)){
                    if ($old_policy->file != NULL){
                        unlink("tech-docs/" . $old_policy->file);
                $doc->saveAs($path);
                $policy->file = $filename;
                    }
                }
            }
            $policy->expiry_date = $post['ex_date'];
        }
        if ($policy->save(FALSE)) {
            $policy_status = HipaaControlsStatus::find()
                    ->where(['policy_id' => $post['policy_id'], 'company_id' => $company_id])
                    ->orderBy(['created_at' => SORT_DESC])
                    ->one();
            $array = [];
            $array['policy_id'] = $policy_status->policy_id;
            $array['created_at'] = $policy_status->created_at;
            $array['updated_by_name'] = $policy_status->getCreatedBy()->select(["CONCAT(first_name, ' ', last_name) AS full_name"])->scalar();
            $array['option'] = $policy_status->getPolicyOption()->select(['policy_option'])->scalar();
            $array['option_id'] = $policy_status->policy_option_id;
            print_r(json_encode($array));
        } else {
            echo 'failed';
        }
        exit;
    }
}
