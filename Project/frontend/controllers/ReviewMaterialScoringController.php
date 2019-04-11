<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\ReviewMaterial;
use frontend\models\ReviewMaterialScoring;
use frontend\models\MasterReviewMaterialType;
use frontend\models\ReviewMaterialScoringSearch;
use frontend\models\Course;
use frontend\models\Learners;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\User;
/**
 * ReviewMaterialScoringController implements the CRUD actions for ReviewMaterialScoring model.
 */
class ReviewMaterialScoringController extends Controller {

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
                'only' => ['index', 'create', 'update', 'view', 'review-material-score'],
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
     * Lists all ReviewMaterialScoring models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ReviewMaterialScoringSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReviewMaterialScoring model.
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
     * Creates a new ReviewMaterialScoring model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ReviewMaterialScoring();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReviewMaterialScoring model.
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

    public function actionReviewMaterialScore($id) {
        $review_material = ReviewMaterial::find()->where(['course_id' => $id])->all();
        $master_reviewmaterial = MasterReviewMaterialType::find()->all();

        $subQuery = ReviewMaterialScoring::find()->select(['review_material_id'])
                ->where(['learner_id' => Yii::$app->user->identity->id]);

        $daily = ReviewMaterial::find()
                ->where(['course_id' => $id])
                ->andWhere(['review_material_type_id' => 1])
                ->andwhere(['not in', 'id', $subQuery])
                ->all();
        $weekly = ReviewMaterial::find()
                ->where(['course_id' => $id])
                ->andWhere(['review_material_type_id' => 2])
                ->andwhere(['not in', 'id', $subQuery])
                ->all();

        $monthly = ReviewMaterial::find()->orderBy(['id' => SORT_ASC])
                ->where(['course_id' => $id])
                ->andWhere(['review_material_type_id' => 3])
                ->andwhere(['not in', 'id', $subQuery])
                ->all();

        $review_material_types = MasterReviewMaterialType::find()->all();
        
        $query = new \yii\db\Query();
        $query->select(['review_material_scoring.id',
                    'review_material_scoring.review_material_id',
                    'review_material_scoring.answer',
                    'review_material.description',
                    'review_material.description_type',
                    'review_material.options',
                    'review_material.right_answer',
                    'review_material.explanation',
                    'review_material.link',
                    'master_review_material_type.id AS `review_material_type_id`',
                    'master_review_material_type.review_material_type'])
                ->from('review_material_scoring')
                ->innerJoin('review_material', 'review_material.id = review_material_id')
                ->innerJoin('master_review_material_type', 'master_review_material_type.id = review_material.review_material_type_id')
                ->where(['learner_id' => Yii::$app->user->identity->id,
                    'course_id' => $id])
                ->all();
        $command = $query->createCommand();
        $answered_all = $command->queryAll();

//        echo '<pre>';
//        print_r($answered_all);
        
        $answered = [];
        foreach ($review_material_types as $index=>$type) {
            $res = array_filter($answered_all, function ($data) use ($type) {
                return ($data['review_material_type_id'] == $type->id);
            });
            $answered[$type->id] = $res;
        }
        
//        print_r($answered);
//        exit;

        return $this->render('review-material-score', [
                    'daily' => $daily,
                    'weekly' => $weekly,
                    'monthly' => $monthly,
                    'answered' => $answered,
                    'master_reviewmaterial' => $master_reviewmaterial
        ]);
    }

    /**
     * Fetches the Review Materials to the learners.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * Author : Pleasing Panda
     */
    public function actionCaptureQuestionSession($review_material_id, $answered_option) {
        $connection = Yii::$app->db;
        $connection->createCommand()->insert('review_material_scoring', [
                    'learner_id' => Yii::$app->user->identity->id,
                    'review_material_id' => $review_material_id,
                    'answer' => $answered_option,
                    'created_at' => date('Y-m-d h:i:s'),
                    'created_by' => Yii::$app->user->identity->id
                ])
                ->execute();

        $check_right_answer = ReviewMaterial::find()
                ->where(['id' => $review_material_id])
                ->one();
        $options = explode(",", $check_right_answer->options);
        $option_array_length = sizeof($options);
        //  echo '<pre/>';print_r($check_right_answer->description_type);die();
        if (($check_right_answer->description_type == 5 || $check_right_answer->description_type == 6) && $option_array_length == 1) {
            echo '<script>
		$(".customAlert").css("display", "none");
         $(".overlay").css("display", "none");
            </script>';
        } else {
            if ($check_right_answer->right_answer == $answered_option) {
                $explanation = ReviewMaterial::find()
                        ->where(['id' => $review_material_id])
                        ->one();

                echo '<div class="overlay"><div class="customAlert"><div class="scrollbar" id="style-1">';

                echo '<p class="message">';
                echo $explanation->explanation;
                echo '</p>';
                echo '<br>';
                echo '<input type=button class="confirmBtn " value="You Are Correct">';
                echo '</div> </div> </div>';
            } else {
                $explanation = ReviewMaterial::find()
                        ->where(['id' => $review_material_id])
                        ->one();
                echo '<div class="overlay"><div class="customAlert incorrect"><div class="scrollbar" id="style-1">';

                echo '<p class="message">';
                echo $explanation->explanation;
                echo '</p>';
                echo '<br>';
                echo '<input type=button class="confirmBtn wronganswer" value="You Are Wrong">';
                echo '</div> </div> </div>';
            }
            echo '<script>

     $(".confirmBtn").click(function(){
     $(".customAlert").css("animation", "fadeOut 0.3s linear");
    setTimeout(function(){
     $(".customAlert").css("animation", "none");
		$(".customAlert").css("display", "none");
    }, 10);
   
         $(".overlay").css("display", "none");
              
            });
            
            </script>';
        }
    }

    /**
     * Deletes an existing ReviewMaterialScoring model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReviewMaterialScoring model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReviewMaterialScoring the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ReviewMaterialScoring::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionReviewMaterialResult($review_material_typeid) {

        $connection = Yii::$app->db;
        $courseId = Yii::$app->session['Course'];

        $command = $connection->createCommand("SELECT * FROM `review_material_scoring` AS a, `review_material` AS b WHERE b.`course_id` = " . $courseId . " AND a.`review_material_id`=b.`id` AND a.`answer`=b.`right_answer` AND a.`learner_id`= " . Yii::$app->user->identity->id . " AND b.`review_material_type_id`= " . $review_material_typeid . "");
        $correct_answer = $command->queryAll();
        $total_correct = count($correct_answer);

        $command1 = $connection->createCommand("SELECT * FROM `review_material_scoring` AS a, `review_material` AS b WHERE b.`course_id` = " . $courseId . " AND a.`review_material_id`=b.`id` AND a.`answer`!=b.`right_answer` AND a.`learner_id`= " . Yii::$app->user->identity->id . " AND b.`review_material_type_id`= " . $review_material_typeid . "");
        $wrong_answer = $command1->queryAll();
        $total_wrong = count($wrong_answer);

        $command2 = $connection->createCommand("SELECT description FROM `review_material`  WHERE `course_id` = " . $courseId . " AND  `review_material_type_id`= " . $review_material_typeid . "");
        $total_questions = $command2->queryAll();
        $all_qestions = count($total_questions);

        if ($review_material_typeid == 1) {
            echo '<table class="table">';
            echo '<tr class="tablecolor">';
            echo '<td class="tb-padding" style="color:#FFC100;"><h6>Total Score %';
            echo '</h6></td>';
            echo '<td class="tb-padding" style="color:#3498DB;"><h6>Total Questions';
            echo '</h6></td>';
            echo '</tr>';

            echo '<tr class="tablecolor">';
            echo '<td class="td2" style="color:#FFC100;"><h1>';
            echo round(($total_correct / $all_qestions) * 100);
            echo '</h1></td>';
            echo '<td class="td1" style="color:#3498DB;"><h1>';
            echo $all_qestions;
            echo '</h1></td>';
            echo '</tr>';

            echo '<tr class="tablecolor">';
            echo '<td class="tb-padding"><h6 class="correct">Total Correct ';
            echo '</h6></td>';
            echo '<td class="tb-padding"><h6 class="wrong">Total Wrong ';
            echo '</h6></td>';
            echo '</tr>';

            echo '<tr class="tablecolor">';
            echo '<td class="td1 correct"><h1>';
            echo $total_correct;
            echo '</h1></td>';
            echo '<td class="td2 wrong"><h1>';
            echo $total_wrong;
            echo '</h1></td>';
            echo '</tr>';

            echo '</table>';

            echo '<div class="row col5">';
            echo '<h6><p style="display: inline-block;font-weight: 500;margin-bottom: 0;">STATUS : </p>';
            if (round(($total_correct / $all_qestions) * 100) < 60) {
                echo '<b style="color:red;"> Poor! </b>';
            } else if (round(($total_correct / $all_qestions) * 100) > 60 && round(($total_correct / $all_qestions) * 100) < 80) {
                echo '<b style="color:green;"> Good! </b>';
            } else {
                echo '<b style="color:blue;"> Excellent! </b>';
            }
            echo '</h6>';
            echo '</div>';
        } elseif ($review_material_typeid == 2) {
            echo '<table class="table">';
            echo '<tr class="tablecolor">';
            echo '<td class="tb-padding" style="color:#FFC100;"><h6>Total Score %';
            echo '</h6></td>';
            echo '<td class="tb-padding" style="color:#3498DB;"><h6>Total Questions';
            echo '</h6></td>';
            echo '</tr>';

            echo '<tr class="tablecolor">';
            echo '<td class="td2" style="color:#FFC100;"><h1>';
            echo round(($total_correct / $all_qestions) * 100);
            echo '</h1></td>';
            echo '<td class="td1" style="color:#3498DB;"><h1>';
            echo $all_qestions;
            echo '</h1></td>';
            echo '</tr>';

            echo '<tr class="tablecolor">';
            echo '<td class="tb-padding"><h6 class="correct">Total Correct ';
            echo '</h6></td>';
            echo '<td class="tb-padding"><h6 class="wrong">Total Wrong ';
            echo '</h6></td>';
            echo '</tr>';

            echo '<tr class="tablecolor">';
            echo '<td class="td1 correct"><h1>';
            echo $total_correct;
            echo '</h1></td>';
            echo '<td class="td2 wrong"><h1>';
            echo $total_wrong;
            echo '</h1></td>';
            echo '</tr>';

            echo '</table>';

            echo '<div class="row col5">';
            echo '<h6><p style="display: inline-block;font-weight: 500;margin-bottom: 0;">STATUS : </p>';
            if (round(($total_correct / $all_qestions) * 100) < 60) {
                echo '<b style="color:red;"> Poor! </b>';
            } else if (round(($total_correct / $all_qestions) * 100) > 60 && round(($total_correct / $all_qestions) * 100) < 80) {
                echo '<b style="color:green;"> Good! </b>';
            } else {
                echo '<b style="color:blue;"> Excellent! </b>';
            }
            echo '</h6>';
            echo '</div>';
        } elseif ($review_material_typeid == 3) {
            echo '<table class="table">';
            echo '<tr class="tablecolor">';
            echo '<td class="tb-padding" style="color:#FFC100;"><h6>Total Score %';
            echo '</h6></td>';
            echo '<td class="tb-padding" style="color:#3498DB;"><h6>Total Questions';
            echo '</h6></td>';
            echo '</tr>';

            echo '<tr class="tablecolor">';
            echo '<td class="td2" style="color:#FFC100;"><h1>';
            echo round(($total_correct / $all_qestions) * 100);
            echo '</h1></td>';
            echo '<td class="td1" style="color:#3498DB;"><h1>';
            echo $all_qestions;
            echo '</h1></td>';
            echo '</tr>';

            echo '<tr class="tablecolor">';
            echo '<td class="tb-padding"><h6 class="correct">Total Correct ';
            echo '</h6></td>';
            echo '<td class="tb-padding"><h6 class="wrong">Total Wrong ';
            echo '</h6></td>';
            echo '</tr>';

            echo '<tr class="tablecolor">';
            echo '<td class="td1 correct"><h1>';
            echo $total_correct;
            echo '</h1></td>';
            echo '<td class="td2 wrong"><h1>';
            echo $total_wrong;
            echo '</h1></td>';
            echo '</tr>';

            echo '</table>';

            echo '<div class="row col5">';
            echo '<h6><p style="display: inline-block;font-weight: 500;margin-bottom: 0;">STATUS : </p>';
            if (round(($total_correct / $all_qestions) * 100) < 60) {
                echo '<b style="color:red;"> Poor! </b>';
            } else if (round(($total_correct / $all_qestions) * 100) > 60 && round(($total_correct / $all_qestions) * 100) < 80) {
                echo '<b style="color:green;"> Good! </b>';
            } else {
                echo '<b style="color:blue;"> Excellent! </b>';
            }
            echo '</h6>';
            echo '</div>';
        }
        echo '<style>
          .td1 {
            border-right: 1px solid #808080;
            text-align: center;
            line-height: 0;
            padding: 0;
            font-weight: 500;
            border-top: none !important;
            width:50%;
        }
        .td2 {
            border: none !important;
            text-align: center;
            line-height: 0;
            padding: 0;
            font-weight: 500;
            border-right: 1px solid #808080 !important;
            width:50%;
        }
        table {
             border: 1px solid #808080;
             margin-bottom: 0 !important;
        }
        .tb-padding {
             padding: 5px 15px !important;
             text-align: center;
             border-right: 1px solid #808080;
             border-top: 1px solid #808080;
        }
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
             border-top: 1px solid #808080;
        }
        h6 {
            font-size: 1.1em;
         }
        </style>';
    }

}
