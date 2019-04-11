<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Contents;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\ContentAssign;
use frontend\models\User;
use yii\web\UploadedFile;
use frontend\models\ContentPassword;
use frontend\models\MasterContentTemplates;

/**
 * ContentsController implements the CRUD actions for Contents model.
 */
class ContentsController extends Controller {

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
                'only' => ['index', 'view', 'content-manager', 'final-view', 'create', 'authenticate'],
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
     * Lists all Contents models.
     * @return mixed
     */
    public function actionIndex() {
        $query = "SELECT * FROM contents WHERE user_id =" . Yii::$app->user->identity->id . " AND expiry_date >= CURDATE()";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $data = $command->queryAll();
        return $this->render('index', [
                    'data' => $data,
        ]);
    }

    /**
     * Displays a single Contents model.
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
     * Creates a new Contents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Contents();
        $model1 = new ContentAssign();
        $author = User::findOne(['id' => Yii::$app->user->identity->id])->email;
        if ($model->load(Yii::$app->request->post()) && $model1->load(Yii::$app->request->post())) {
            $for_views = $model1->view;
            $for_downloads = $model1->download;

            $model->user_id = Yii::$app->user->identity->id;
            $model->content_name;
            $model->content_description;
            $model->author_name = $author;
            $model->file_name = UploadedFile::getInstance($model, 'file_name');

            $file_name = $model->file_name;
            $model->file_name->saveAs('uploads/uploaded_contents/' . Yii::$app->user->identity->id . '_' . $file_name);
            $model->file_name = Yii::$app->user->identity->id . '_' . $file_name;

            $model->author_comment;
            $model->expiry_date;
            $model->created_at = date('Y-m-d h:i:s');
            $model->updated_at = date('Y-m-d h:i:s');
            $model->save(false);

            foreach ($for_views as $for_view) {
                $model_new = new ContentAssign();
                $model_new->content_id = $model->id;
                $model_new->view = $for_view;
                $model_new->security = $model1->security;
                $model_new->expiry_date = $model->expiry_date;
                $content_name = $model->content_name;
                $user = user::findOne(['id' => $for_view])->email;
                Yii::$app->mailer->compose(['html' => 'newcontent-html'], ['content_name' => $content_name])
                        ->setFrom('vivaanlms@aansystems.com')
                        ->setTo($user)
                        ->setSubject('notification from vivaan-lms')
                        ->send();
                $model_new->save(false);
            }
            foreach ($for_downloads as $for_download) {
                $model_new = new ContentAssign();
                $model_new->security = $model1->security;
                $content_name = $model->content_name;
                $user = user::findOne(['id' => $for_download])->email;
                Yii::$app->mailer->compose(['html' => 'newcontent-html'], ['content_name' => $content_name])
                        ->setFrom('vivaanlms@aansystems.com')
                        ->setTo($user)
                        ->setSubject('notification from vivaan-lms')
                        ->send();
                $model_new->content_id = $model->id;
                $model_new->download = $for_download;
                $model_new->expiry_date = $model->expiry_date;
                $model_new->save(false);
            }
            Yii::$app->session->setFlash('success', "Content Created Successfully");
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
                    'model1' => $model1,
        ]);
    }

    /**
     * Updates an existing Contents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Content Deleted Successfully");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Contents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Contents::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionContentManager() {
        $query = "SELECT `content_type` FROM `contents` LEFT JOIN content_assign ON content_assign.content_id = contents.id WHERE ((`view`=" . Yii::$app->user->identity->id . " OR `download`=" . Yii::$app->user->identity->id . " ) AND contents.expiry_date >= CURDATE())GROUP BY `content_type`";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $data = $command->queryAll();
        return $this->render('content-manager', [
                    'data' => $data,
        ]);
    }

    public function actionFinalView($id) {
        $query = "SELECT
                       *
                    FROM
             contents
                     JOIN content_assign ON                 
             contents.id = content_assign.content_id             
                WHERE ( content_assign.view = " . Yii::$app->user->identity->id . " OR content_assign.download =" . Yii::$app->user->identity->id . ") AND ((content_assign.security = 'Public' OR content_assign.security = 'Internal Use') AND (contents.content_type=" . $id . " AND content_assign.expiry_date >= CURDATE()))
                 ";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $data = $command->queryAll();
        return $this->render('final-view', [
                    'data' => $data,
        ]);
    }

    public function actionAuthenticate($id) {
        $content_type = MasterContentTemplates::findOne(['id' => $id])->template_name;
        
                 $data = "SELECT
                      content_name
                   FROM
             contents 
                     JOIN content_assign ON                 
             contents.id = content_assign.content_id            
                WHERE (( content_assign.view = " . Yii::$app->user->identity->id . " OR content_assign.download =" . Yii::$app->user->identity->id . ") AND ((content_assign.security = 'Restricted' OR content_assign.security = 'Confidential') AND ((contents.content_type= " . $id . " AND content_assign.expiry_date >= CURDATE()))))
                 ";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($data);
        $data = $command->queryAll();
         $query1 = "SELECT
                       content_name
                    FROM
             contents 
                     JOIN content_assign ON                 
             contents.id = content_assign.content_id               
                WHERE (( content_assign.view = " . Yii::$app->user->identity->id . " OR content_assign.download =" . Yii::$app->user->identity->id . ") AND ((content_assign.security = 'Public' OR content_assign.security = 'Internal Use') AND ((contents.content_type= " . $id . " AND content_assign.expiry_date >= CURDATE()))))
                 ";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($query1);
        $data1 = $command->queryAll();
        
        return $this->render('authenticate', [
                    'id' => $id,
                    'content_type' => $content_type,
                        'data' => $data,
            'data1' => $data1,
        ]);
    }

    public function actionPassword($id) {
        $model = ContentPassword::findOne(['user_id' => Yii::$app->user->identity->id, 'templates' => $id]);
        $content_name = MasterContentTemplates::findOne(['id' => $id])->template_name;
        $user = user::findOne(['id' => Yii::$app->user->identity->id])->email;
        $random_pass = substr(md5(mt_rand()), 0, 7);
        $password_hash = \Yii::$app->getSecurity()->generatePasswordHash($random_pass);
        if (!empty($model)) {
            $connection = Yii::$app->db;

            Yii::$app->mailer->compose(['html' => 'contentOTP-html'], ['content_name' => $content_name, 'random_pass' => $random_pass])
                    ->setFrom('vivaanlms@aansystems.com')
                    ->setTo($user)
                    ->setSubject('notification from vivaan-lms')
                    ->send();
            $command = $connection->createCommand('UPDATE content_password SET password ="' . $password_hash . '" WHERE (user_id = ' . Yii::$app->user->identity->id . ' && templates = ' . $id . ' )');
            $command->execute();
        } else {
            Yii::$app->mailer->compose(['html' => 'contentOTP-html'], ['content_name' => $content_name, 'random_pass' => $random_pass])
                    ->setFrom('vivaanlms@aansystems.com')
                    ->setTo($user)
                    ->setSubject('notification from vivaan-lms')
                    ->send();
            $connection = Yii::$app->db;
            $connection->createCommand()->insert('content_password', [
                        'user_id' => Yii::$app->user->identity->id,
                        'templates' => $id,
                        'password' => $password_hash,
                        'updated_at' => date('Y-m-d h:i:s')
                    ])
                    ->execute();
        }
    }

    public function actionCheckPasswords($password, $id) {

        $data = ContentPassword::find()
                ->where(['user_id' => Yii::$app->user->getId()])
                ->andWhere(['templates' => $id])
                ->one();
        $validate_password = Yii::$app->security->validatePassword($password, $data->password);
        if ($validate_password) {

            return $this->redirect('secure-view?id=' . $id);
        } else {
            return 1;
        }
    }

    public function actionSecureView($id) {
        $query = "SELECT
                       *
                    FROM
             contents
                     JOIN content_assign ON                 
             contents.id = content_assign.content_id             
                WHERE ( content_assign.view = " . Yii::$app->user->identity->id . " OR content_assign.download =" . Yii::$app->user->identity->id . ") AND ((content_assign.security = 'Confidential' OR content_assign.security = 'Restricted') AND (contents.content_type=" . $id . " AND content_assign.expiry_date >= CURDATE()))
                 ";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $data = $command->queryAll();
        return $this->render('final-view', [
                    'data' => $data,
        ]);
    }

}
