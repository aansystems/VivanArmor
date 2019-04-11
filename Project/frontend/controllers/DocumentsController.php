<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Documents;
use frontend\models\DocumentAuthor;
use frontend\models\ApprovedDocuments;
use frontend\models\AssignedDocuments;
use frontend\models\DocumentPassword;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use frontend\models\MasterDocTemplates;
use frontend\models\User;
use yii\bootstrap\Modal;
/**
 * DocumentsController implements the CRUD actions for Documents model.
 */
class DocumentsController extends Controller {

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
                'only' => ['index', 'view', '_form', 'approve', 'assign-to', 'create', 'final-doc', 'finalised-docs', 'finalize', 'reject', 'list'],
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
     * Lists all Documents models.
     * @return mixed
     */
    public function actionIndex() {
        $query = "SELECT
                    *
                FROM
                  documents
                JOIN document_author ON documents.id = document_author.document_id
                WHERE ((documents.user_id = " . Yii::$app->user->identity->id . ") AND (documents.status = 0 OR documents.status = 1) AND (workflow_expiry_date >= CURDATE()))";


        $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $result = $command->queryAll();
        $query2 = "SELECT
                       *
                    FROM
              documents
                     JOIN document_author ON                 
             documents.id = document_author.document_id             
                WHERE ( document_author.assigned_to = " . Yii::$app->user->identity->id . " AND documents.status = 2) AND (documents.user_id != " . Yii::$app->user->identity->id . ") AND (workflow_expiry_date >= CURDATE())
                 ";
        $connection2 = Yii::$app->db;
        $command2 = $connection2->createCommand($query2);
        $result2 = $command2->queryAll();

        $query3 = "SELECT
                    *
                FROM
                  documents
                JOIN document_author ON documents.id = document_author.document_id
                WHERE ((documents.user_id = " . Yii::$app->user->identity->id . ") AND (documents.status = 2) AND (workflow_expiry_date >= CURDATE()))";


        $connection3 = Yii::$app->db;
        $command3 = $connection3->createCommand($query3);
        $result3 = $command3->queryAll();

        return $this->render('index', [
                    'result' => $result,
                    'result2' => $result2,
                    'result3' => $result3,
        ]);
    }

    /**
     * Displays a single Documents model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $data = DocumentAuthor::findOne(['document_id' => $id]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'data' => $data
        ]);
    }

    /**
     * Creates a new Documents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Documents();
        $model1 = new DocumentAuthor();
        $model2 = new ApprovedDocuments();

        if ($model->load(Yii::$app->request->post()) && $model1->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
            if ($model2->assigned_for_view != NULL) {

                $for_views = $model2->assigned_for_view;
                $for_downloads = $model2->assigned_for_download;

                $model->user_id = Yii::$app->user->identity->id;
                $model->file_name = UploadedFile::getInstance($model, 'file');

                $file_name = $model->file_name;


                $assigned_to_list = explode('.', $file_name);
                $extension = (end($assigned_to_list));
                $file_name_new = $assigned_to_list[0] . '.' . $extension;



                $model->file_name->saveAs('uploads/uploaded_Documents/' . Yii::$app->user->identity->id . '_' . $file_name_new);

                $model->file_name = Yii::$app->user->identity->id . '_' . $file_name;
                $model->folder_name = "uploaded_Documents";
                $model->author_comment = $model->author_comment;
                $model->status = 3;
                $model->created_at = date('Y-m-d h:i:s');
                $model->updated_at = date('Y-m-d h:i:s');
                $model->save(false);



                foreach ($for_views as $for_view) {
                    $model_new = new ApprovedDocuments();
                    $model_new->document_id = $model->id;
                    $model_new->assigned_for_view = $for_view;

                    $model_new->security = $model2->security;
                    $model_new->created_at = date('Y-m-d h:i:s');
                    $model_new->updated_at = date('Y-m-d h:i:s');
                    $model_new->expiry_date = $model2->expiry_date;
                    $model_new->save(false);
                    $created_at = date('Y-m-d h:i:s');
                    $updated_at = date('Y-m-d h:i:s');

                    $connection = \Yii::$app->db;

                    $connection->createCommand()->insert('documents_log', [
                                'assigned_to' => $for_view,
                                'document_id' => $model->id,
                                'document_type' => $model->document_type,
                                'user_id' => Yii::$app->user->identity->id,
                                'actions' => 'Finalized only for View',
                                'created_at' => $created_at,
                                'updated_at' => $updated_at,
                            ])
                            ->execute();
                }
                foreach ($for_downloads as $for_download) {
                    $model_new = new ApprovedDocuments();
                    $doc_name = $model->document_name;
                    $doc_type = MasterDocTemplates::findOne(['id' => $model->document_type])->template_name;


                    $user = user::findOne(['id' => $for_download])->email;
                    Yii::$app->mailer->compose(['html' => 'documentfinal'], ['doc_name' => $doc_name, 'doc_type' => $doc_type])
                            ->setFrom('vivaanlms@aansystems.com')
                            ->setTo($user)
                            ->setSubject('notification from vivaan-lms')
                            ->send();

                    $model_new->document_id = $model->id;
                    $model_new->assigned_for_download = $for_download;
                    $model_new->security = $model2->security;
                    $model_new->created_at = date('Y-m-d h:i:s');
                    $model_new->updated_at = date('Y-m-d h:i:s');
                    $model_new->expiry_date = $model2->expiry_date;


                    $model_new->save(false);
                    $created_at = date('Y-m-d h:i:s');
                    $updated_at = date('Y-m-d h:i:s');
                    $connection = \Yii::$app->db;

                    $connection->createCommand()->insert('documents_log', [
                                'assigned_to' => $for_download,
                                'document_type' => $model->document_type,
                                'document_id' => $model->id,
                                'user_id' => Yii::$app->user->identity->id,
                                'actions' => 'Finalized for View and Download',
                                'created_at' => $created_at,
                                'updated_at' => $updated_at,
                            ])
                            ->execute();
                }

                Yii::$app->session->setFlash('success', "Documents Created and Finalized Successfully");
            } else {

                $model->user_id = Yii::$app->user->identity->id;
                $model->file_name = UploadedFile::getInstance($model, 'file');
                $file_name = $model->file_name;
                $assigned_to_list = explode('.', $file_name);
                $extension = (end($assigned_to_list));

                $file_name_new = $assigned_to_list[0] . '.' . $extension;
                $model->file_name->saveAs('uploads/uploaded_Documents/' . Yii::$app->user->identity->id . '_' . $file_name_new);
                $model->file_name = Yii::$app->user->identity->id . '_' . $file_name_new;

                $model->folder_name = "uploaded_Documents";
                $model->author_comment = $model->author_comment;
                $comment = $model->author_comment;
                $model->status = 2;
                $model->created_at = date('Y-m-d h:i:s');
                $model->updated_at = date('Y-m-d h:i:s');
                $model->save(false);

                $model1->assigned_to = $model1->assigned_to;
                $model1->document_id = $model->id;
                $model1->created_at = date('Y-m-d h:i:s');
                $model1->updated_at = date('Y-m-d h:i:s');
                $user = user::findOne(['id' => $model1->assigned_to])->email;
                $from_user = user::findOne(['id' => Yii::$app->user->identity->id])->email;
                Yii::$app->mailer->compose(['html' => 'documents-html'], ['from_user' => $from_user, 'comment' => $comment])
                        ->setFrom('vivaanlms@aansystems.com')
                        ->setTo($user)
                        ->setSubject('notification from vivaan-lms')
                        ->send();
                $model1->save(false);
                $created_at = date('Y-m-d h:i:s');
                $updated_at = date('Y-m-d h:i:s');

                $connection = \Yii::$app->db;

                $connection->createCommand()->insert('documents_log', [
                            'assigned_to' => $model1->assigned_to,
                            'document_type' => $model->document_type,
                            'document_id' => $model->id,
                            'user_id' => Yii::$app->user->identity->id,
                            'actions' => 'Assigned for Review',
                            'created_at' => $created_at,
                            'updated_at' => $updated_at,
                        ])
                        ->execute();


                Yii::$app->session->setFlash('success', "Document Created and Assigned Successfully");
            }
            return $this->redirect(['index', 'id' => $model->id]);
        }
        return $this->render('create', [
                    'model' => $model,
                    'model1' => $model1,
                    'model2' => $model2,
        ]);
    }

    /**
     * Updates an existing Documents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model1 = DocumentAuthor::findOne(['document_id' => $id]);
        if ($model->load(Yii::$app->request->post()) && $model1->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->identity->id;
            $model->file_name = UploadedFile::getInstance($model, 'file_name');
            $file_name = $model->file_name;
            $assigned_to_list = explode('.', $file_name);
            $extension = (strtoupper(end($assigned_to_list)));
            $file_name_new = $assigned_to_list[0] . '.' . $extension;
            $model->file_name->saveAs('uploads/uploaded_Documents/' . Yii::$app->user->identity->id . '_' . $file_name_new);
            $model->file_name = Yii::$app->user->identity->id . '_' . $file_name_new;
            $model->folder_name = "uploaded_Documents";
            $model1->document_id;
            $model1->author_name;
            $model1->assigned_to;
            $model1->autor_comment;

            $model->save(false);
            $model1->save(false);
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
                    'model1' => $model1,
        ]);
    }

    /**
     * Deletes an existing Documents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        DocumentAuthor::findOne(['document_id' => $id])->delete();
        $this->findModel($id)->delete();
        
        Yii::$app->session->setFlash('success', "Document deleted Successfully");
        return $this->redirect(['index']);
    }

    public function actionDeletetwo($id) {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Document Deleted Successfully1");
        return $this->redirect(['list']);
    }

    public function actionFinalDoc() {
        $query = "SELECT `document_type` FROM `documents` LEFT JOIN approved_documents ON approved_documents.document_id = documents.id WHERE `assigned_for_view`=" . Yii::$app->user->identity->id . " OR `assigned_for_download`=" . Yii::$app->user->identity->id . " GROUP BY `document_type`";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $data = $command->queryAll();
        return $this->render('final-doc', [
                    'data' => $data,
        ]);
    }

    public function actionAssignTo($id) {

        $model1 = $this->findModel($id);
        $model = DocumentAuthor::findOne(['document_id' => $id]);
        $doc_type = Documents::findOne(['id' => $id])->document_type;


        if ($model->load(Yii::$app->request->post())) {

            $model->assigned_to;
            $connection = Yii::$app->db;
            $status = 2;
            $model->created_at = date('Y-m-d h:i:s');
            $model->updated_at = date('Y-m-d h:i:s');
            $command = $connection->createCommand('UPDATE documents SET status =' . $status . ' WHERE (id = ' . $id . ')');
            $command->execute();
            $user = user::findOne(['id' => $model->assigned_to])->email;
            $from_user = user::findOne(['id' => Yii::$app->user->identity->id])->email;
            $comment = Documents::findOne(['id' => $id])->author_comment;
            Yii::$app->mailer->compose(['html' => 'documents-html'], ['from_user' => $from_user, 'comment' => $comment])
                    ->setFrom('vivaanlms@aansystems.com')
                    ->setTo($user)
                    ->setSubject('notification from vivaan-lms')
                    ->send();
            $model->save(false);
            $created_at = date('Y-m-d h:i:s');
            $updated_at = date('Y-m-d h:i:s');
            $connection = \Yii::$app->db;

            $connection->createCommand()->insert('documents_log', [
                        'assigned_to' => $model->assigned_to,
                        'document_type' => $doc_type,
                        'document_id' => $id,
                        'user_id' => Yii::$app->user->identity->id,
                        'actions' => 'Assigned for Review',
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ])
                    ->execute();
            Yii::$app->session->setFlash('success', "Document Assigned Successfully");
            return $this->redirect(['index', 'id' => $model1->id]);
        }


        return $this->render('assign-to', [
                    'model' => $model,
        ]);
    }

    public function actionApprove($id) {

        $model = new AssignedDocuments();
        $doc_type = Documents::findOne(['id' => $id])->document_type;

        if ($model->load(Yii::$app->request->post())) {
            $assigned_to = DocumentAuthor::findone(['document_id' => $id])->assigned_to;
            $model->document_id = $id;
            $model->comment;
            $model->assigned_to = $assigned_to;
            $model->status = 1;
            $model->created_at = date('Y-m-d h:i:s');
            $model->updated_at = date('Y-m-d h:i:s');

            $connection = Yii::$app->db;
            $status = 1;
            $command = $connection->createCommand('UPDATE documents SET status =' . $status . ' WHERE (id = ' . $id . ')');
            $command->execute();
            $comment = Documents::findOne(['id' => $id]);
            $from_user = user::findOne(['id' => Yii::$app->user->identity->id])->email;
            $user = user::findOne(['id' => $comment->user_id])->email;
            Yii::$app->mailer->compose(['html' => 'doc-approved-html'], ['from_user' => $from_user, 'comment' => $model->comment])
                    ->setFrom('vivaanlms@aansystems.com')
                    ->setTo($user)
                    ->setSubject('notification from vivaan-lms')
                    ->send();
            $model->save(false);
            $created_at = date('Y-m-d h:i:s');
            $updated_at = date('Y-m-d h:i:s');
            $connection = \Yii::$app->db;

            $connection->createCommand()->insert('documents_log', [
                        'assigned_to' => $assigned_to,
                        'document_type' => $doc_type,
                        'document_id' => $id,
                        'user_id' => Yii::$app->user->identity->id,
                        'actions' => 'Approved',
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ])
                    ->execute();
            Yii::$app->session->setFlash('success', "Document Approved Successfully");
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('approve', [
                    'model' => $model,
        ]);
    }

    public function actionReject($id) {

        $model = new AssignedDocuments();
        $doc_type = Documents::findOne(['id' => $id])->document_type;
        if ($model->load(Yii::$app->request->post())) {
            $assigned_to = DocumentAuthor::findone(['document_id' => $id])->assigned_to;
            $model->document_id = $id;
            $model->comment;
            $model->assigned_to = $assigned_to;
            $model->status = 0;
            $model->created_at = date('Y-m-d h:i:s');
            $model->updated_at = date('Y-m-d h:i:s');

            $connection = Yii::$app->db;
            $status = 0;
            $command = $connection->createCommand('UPDATE documents SET status =' . $status . ' WHERE (id = ' . $id . ')');
            $command->execute();
            $comment = Documents::findOne(['id' => $id]);
            $from_user = user::findOne(['id' => Yii::$app->user->identity->id])->email;
            $user = user::findOne(['id' => $comment->user_id])->email;
            Yii::$app->mailer->compose(['html' => 'doc-rejected-html'], ['from_user' => $from_user, 'comment' => $model->comment])
                    ->setFrom('vivaanlms@aansystems.com')
                    ->setTo($user)
                    ->setSubject('notification from vivaan-lms')
                    ->send();

            $model->save(false);
            $created_at = date('Y-m-d h:i:s');
            $updated_at = date('Y-m-d h:i:s');

            $connection = \Yii::$app->db;

            $connection->createCommand()->insert('documents_log', [
                        'assigned_to' => $assigned_to,
                        'document_type' => $doc_type,
                        'document_id' => $id,
                        'user_id' => Yii::$app->user->identity->id,
                        'actions' => 'Rejected',
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ])
                    ->execute();
            Yii::$app->session->setFlash('success', "Document Rejected Successfully");
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('reject', [
                    'model' => $model,
        ]);
    }

    public function actionFinalize($id) {

        $model = $this->findModel($id);
        $model2 = new ApprovedDocuments();
        $doc_type = Documents::findOne(['id' => $id])->document_type;
        if ($model2->load(Yii::$app->request->post())) {
            $connection = Yii::$app->db;
            $status = 3;
            $command = $connection->createCommand('UPDATE documents SET status =' . $status . ' WHERE (id = ' . $id . ')');
            $command->execute();
            $for_views = $model2->assigned_for_view;
            $for_downloads = $model2->assigned_for_download;
            foreach ($for_views as $for_view) {
                $model_new = new ApprovedDocuments();
                $doc_name = $model->document_name;
                $user = user::findOne(['id' => $for_view])->email;
                Yii::$app->mailer->compose(['html' => 'documentfinal'], ['doc_name' => $doc_name, 'doc_type' => $doc_type])
                        ->setFrom('vivaanlms@aansystems.com')
                        ->setTo($user)
                        ->setSubject('notification from vivaan-lms')
                        ->send();
                $model_new->document_id = $id;
                $model_new->assigned_for_view = $for_view;
                $model_new->security = $model2->security;
                $model_new->created_at = date('Y-m-d h:i:s');
                $model_new->updated_at = date('Y-m-d h:i:s');
                $model_new->expiry_date = $model2->expiry_date;
                $model_new->save(false);
                $created_at = date('Y-m-d h:i:s');
                $updated_at = date('Y-m-d h:i:s');
                $connection = \Yii::$app->db;

                $connection->createCommand()->insert('documents_log', [
                            'assigned_to' => $for_view,
                            'document_type' => $model->document_type,
                            'document_id' => $id,
                            'user_id' => Yii::$app->user->identity->id,
                            'actions' => 'Finalized only for View',
                            'created_at' => $created_at,
                            'updated_at' => $updated_at,
                        ])
                        ->execute();
            }
            foreach ($for_downloads as $for_download) {
                $model_new = new ApprovedDocuments();
                $model_new1 = new Documents();
                $model_new->document_id = $id;

                $doc_name = $model->document_name;
                $user = user::findOne(['id' => $for_download])->email;
                Yii::$app->mailer->compose(['html' => 'documentfinal'], ['doc_name' => $doc_name, 'doc_type' => $doc_type])
                        ->setFrom('vivaanlms@aansystems.com')
                        ->setTo($user)
                        ->setSubject('notification from vivaan-lms')
                        ->send();
                $model_new->assigned_for_download = $for_download;
                $model_new->security = $model2->security;
                $model_new->created_at = date('Y-m-d h:i:s');
                $model_new->updated_at = date('Y-m-d h:i:s');
                $model_new->expiry_date = $model2->expiry_date;
                $model_new->save(false);
                $created_at = date('Y-m-d h:i:s');
                $updated_at = date('Y-m-d h:i:s');
                $connection = \Yii::$app->db;

                $connection->createCommand()->insert('documents_log', [
                            'assigned_to' => $for_download,
                            'document_type' => $model->document_type, 
                            'document_id' => $id,
                            'user_id' => Yii::$app->user->identity->id,
                            'actions' => 'Finalized for View and Download',
                            'created_at' => $created_at,
                            'updated_at' => $updated_at,
                        ])
                        ->execute();
            }
            Yii::$app->session->setFlash('success', "Document Finalized Successfully");
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('finalize', [
                    'model2' => $model2,
        ]);
    }

    /**
     * Finds the Documents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Documents::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFinalisedDocs($id) {
        $query = "SELECT
                       *
                    FROM
             documents 
                     JOIN approved_documents ON                 
             documents.id = approved_documents.document_id             
                WHERE (( approved_documents.assigned_for_view = " . Yii::$app->user->identity->id . " OR approved_documents.assigned_for_download =" . Yii::$app->user->identity->id . ") AND ((approved_documents.security = 'Public' OR approved_documents.security = 'Internal Use') AND ((documents.status = 3 AND documents.document_type= " . $id . "))))
                 ";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $data = $command->queryAll();
        return $this->render('finalised-docs', [
                    'data' => $data,
        ]);
    }

    public function actionAuthenticate($id) {
        $model = ApprovedDocuments::findOne(['id' => $id]);
        $doc_name = MasterDocTemplates::findOne(['id' => $id])->template_name;

        $private_docs = "SELECT
                      document_name
                   FROM
             documents 
                     JOIN approved_documents ON                 
             documents.id = approved_documents.document_id            
                WHERE (( approved_documents.assigned_for_view = " . Yii::$app->user->identity->id . " OR approved_documents.assigned_for_download =" . Yii::$app->user->identity->id . ") AND ((approved_documents.security = 'Restricted' OR approved_documents.security = 'Confidential') AND ((documents.status = 3 AND documents.document_type= " . $id . "))))
                 ";
        $connections = Yii::$app->db;
        $commands = $connections->createCommand($private_docs);
        $private_doc = $commands->queryAll();

        $public_docs = "SELECT
                      document_name
                    FROM
             documents 
                     JOIN approved_documents ON                 
             documents.id = approved_documents.document_id             
                WHERE (( approved_documents.assigned_for_view = " . Yii::$app->user->identity->id . " OR approved_documents.assigned_for_download =" . Yii::$app->user->identity->id . ") AND ((approved_documents.security = 'Public' OR approved_documents.security = 'Internal Use') AND ((documents.status = 3 AND documents.document_type= " . $id . "))))
                 ";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($public_docs);
        $public_doc = $command->queryAll();

        return $this->render('authenticate', [
                    'model' => $model,
                    'doc_name' => $doc_name,
                    'private_doc' => $private_doc,
                    'public_doc' => $public_doc,
        ]);
    }

    public function actionPassword($doc_id) {
        $model = DocumentPassword::findOne(['user_id' => Yii::$app->user->identity->id, 'document_id' => $doc_id]);
        $doc_name = MasterDocTemplates::findOne(['id' => $doc_id])->template_name;
        $random_pass = substr(md5(mt_rand()), 0, 7);
        $password_hash = \Yii::$app->getSecurity()->generatePasswordHash($random_pass);
        $user = user::findOne(['id' => Yii::$app->user->identity->id])->email;

        if (!empty($model)) {

            Yii::$app->mailer->compose(['html' => 'documentsDownload-html'], ['doc_name' => $doc_name, 'random_pass' => $random_pass])
                    ->setFrom('vivaanlms@aansystems.com')
                    ->setTo($user)
                    ->setSubject('notification from vivaan-lms')
                    ->send();

            $connection = Yii::$app->db;
            $command = $connection->createCommand('UPDATE document_password SET password ="' . $password_hash . '" WHERE (user_id = ' . Yii::$app->user->identity->id . ' && document_id = ' . $doc_id . ' )');
            $command->execute();
        } else {

            Yii::$app->mailer->compose(['html' => 'documentsDownload-html'], ['doc_name' => $doc_name, 'random_pass' => $random_pass])
                    ->setFrom('vivaanlms@aansystems.com')
                    ->setTo($user)
                    ->setSubject('notification from vivaan-lms')
                    ->send();


            $connection = Yii::$app->db;
            $connection->createCommand()->insert('document_password', [
                        'user_id' => Yii::$app->user->identity->id,
                        'document_id' => $doc_id,
                        'password' => $password_hash,
                        'updated_at' => date('Y-m-d h:i:s')
                    ])
                    ->execute();
        }
    }

    public function actionCheckPasswords($password, $id) {


        $data = DocumentPassword::find()
                ->where(['user_id' => Yii::$app->user->getId()])
                ->andWhere(['document_id' => $id])
                ->one();
        $validate_password = Yii::$app->security->validatePassword($password, $data->password);
        if ($validate_password) {
            return $this->redirect('final-result?id=' . $id);
        } else {
            return 1;
        }
    }
public function actionTemplates($dropdown_value) {
        $query = Documents::find()
                ->where([
                    'user_id' => Yii::$app->user->id,
                    'document_type' => $dropdown_value
                ])
                ->all();
        if (!empty($query)) {
            $i = 1;
            foreach ($query as $data) {
                $doc_type = MasterDocTemplates::findOne(['id' => $data['document_type']])->template_name;
                echo '<tr id = "document_list">';
                echo '<td style="width:10%">' . $i . '</td>';
                echo '<td class="docname status_type">' . $data['document_name'] . '</td>';
                echo '<td >' . $doc_type . '</td>';
                if ($data['status'] == 1) {
                    echo '<td class="text-green"> Approved </td>';
                } elseif ($data['status'] == 0) {
                    echo '<td class="text-red"> Rejected </td>';
                } elseif ($data['status'] == "3") {
                    echo '<td  class="text-blue"> Finalized</td>';
                } else {
                    echo '<td class="text-orange"> Action Pending</td>';
                }
                echo '<td style="vertical-align:middle;margin:2px;">';
                echo '<a style="margin-left:12px;" href="' . Yii::$app->request->baseUrl . '/uploads/uploaded_Documents/' . $data['file_name'] . '" target="_blank"><button class="btn btn-info my-btn btn-padding" style="width: 80px; margin-bottom: 10px;">View</button></a>';
                echo '<a id="deleteModal' . $data['id'] . '" data-toggle="modal_1" data-target="#deleteModal' . $data['id'] . '"><button class="btn btn-margin btn-info my-btn btn-padding" style="background-color:#e91e63;;width:80px;margin-bottom: 10px;">Delete</button></a>';
                Modal::begin([
                    'header' => '<h3 style="margin:0px !important;color:#fff;">Confirmation</h3>',
                    'id' => 'modal_1',
                    'size' => '',
                ]);
                echo "<div id='modalContent'></div>"
                . "<p>Are you sure you want to delete?</p>";
                echo "<div class='modal-footer'>";
                echo "<a href='#' data-dismiss='modal'>";
                echo "<button type='button' class='btn btn-danger' style='padding: 10px 6px 6px 6px !important;'>Close"
                . "</button>";
                echo "</a>";
                echo "<a href=" . Yii::$app->request->baseUrl . "/documents/deletetwo?id=" . $data['id'] . " data-method='post'>"
                . "<button type='button' class='btn btn-success' style='padding: 10px 6px 6px 6px !important;'>Delete</button>"
                . "</a>"
                . "</div>";
                Modal::end();
                echo '<script>
                    $(function () {
                        $("#deleteModal' . $data["id"] . '").click(function () {
                            $("#modal_1").modal("show")
                                    .find("#modalContent")
                                    .load($(this).attr("value"));
                        });
                    });
                </script>';
                echo '</td>';
                echo '</tr>';
                echo '' . $i++ . '';
            }
            return;
        } 
        else {
            echo '<tr>';
            echo '<td style="vertical-align: middle; margin:2px; text-align:center" colspan="5" class="text-center">No Records Found</td>';
            echo '</tr>';
        }
    }

    public function actionFinalResult($id) {

        $data = "SELECT
                       *
                   FROM
             documents 
                     JOIN approved_documents ON                 
             documents.id = approved_documents.document_id            
                WHERE (( approved_documents.assigned_for_view = " . Yii::$app->user->identity->id . " OR approved_documents.assigned_for_download =" . Yii::$app->user->identity->id . ") AND ((approved_documents.security = 'Restricted' OR approved_documents.security = 'Confidential') AND ((documents.status = 3 AND documents.document_type= " . $id . "))))
                 ";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($data);
        $data = $command->queryAll();

        return $this->render('finalised-docs', [
                    'data' => $data,
        ]);
    }

    public function actionViewDatalog($doc_id) {
        $created_at = date('Y-m-d h:i:s');
        $updated_at = date('Y-m-d h:i:s');
        $doc_type = Documents::findOne(['id' => $doc_id])->document_type;
            $connection = \Yii::$app->db;

            $connection->createCommand()->insert('documents_log', [
                        'assigned_to' => Yii::$app->user->identity->id,
                        'document_type' => $doc_type,
                        'document_id' => $doc_id,
                        'user_id' => Yii::$app->user->identity->id,
                        'actions' => 'viewed',
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ])
                    ->execute();
    }

    public function actionDownloadData($doc_id) {
        $created_at = date('Y-m-d h:i:s');
        $updated_at = date('Y-m-d h:i:s');
        $doc_type = Documents::findOne(['id' => $doc_id])->document_type;

            $connection = \Yii::$app->db;

            $connection->createCommand()->insert('documents_log', [
                        'assigned_to' => Yii::$app->user->identity->id,
                        'document_type' => $doc_type,
                        'document_id' => $doc_id,
                        'user_id' => Yii::$app->user->identity->id,
                        'actions' => 'Downloaded',
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ])
                    ->execute();
    }

    public function actionDocName($doc_id, $master_template_id) {

        $list_of_doc = Documents::findOne(['id' => $doc_id]);


        echo '<div>';

        echo '<iframe src="../uploads/uploaded_Documents/' . $list_of_doc->file_name . '.pdf#toolbar=0" width="100%" height="650px"></iframe>';
        echo '</div>';
    }

    public function actionList() {

        $query = "SELECT
                    *
                FROM
                  documents
                  WHERE (documents.user_id = " . Yii::$app->user->identity->id . ")";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $result = $command->queryAll();
        return $this->render('list', [
                    'result' => $result,
        ]);
    }

}
