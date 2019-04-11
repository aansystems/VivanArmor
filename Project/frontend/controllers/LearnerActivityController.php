<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Courses;
use frontend\models\LearnerActivity;
use frontend\models\LearnerActivitySearch;
use frontend\models\Lessons;
use frontend\models\Sections;
use frontend\models\Learners;
use frontend\models\Ebooks;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use frontend\models\User;

/**
 * LearnerActivityController implements the CRUD actions for LearnerActivity model.
 */
class LearnerActivityController extends Controller {

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
                'only' => ['index', 'create', 'update', 'view', 'lessons', 'ebooks'],
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
     * Lists all LearnerActivity models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new LearnerActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LearnerActivity model.
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
     * Creates a new LearnerActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new LearnerActivity();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing LearnerActivity model.
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

    public function actionLessons($id) {
        $course = Courses::find()->where(['id' => $id])->one();
        $lessons = Lessons::find()->where(['course_id' => $course->id])->all();

        /* ---- taking session for course ---- Author : Prem ---- */
        Yii::$app->session['Course'] = $id;
        return $this->render('lessons', [
                    'lessons' => $lessons
        ]);
    }

    public function actionCompleteDefaultSection($course_id) {
        $connection = Yii::$app->db;
        $connection->createCommand()->insert('default_lesson_complete', [
                    'learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id,
                    'course_id' => $course_id,
                    'completion_status' => 1,
                    'created_at' => date('Y-m-d h:i:s'),
                    'created_by' => Yii::$app->user->identity->id,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'updated_by' => Yii::$app->user->identity->id,
                ])
                ->execute();

        $enable_first_lesson = Lessons::findOne(['course_id' => $course_id]);

        $enable_first_section = Sections::findOne(['lesson_id' => $enable_first_lesson->id]);

        echo Json::encode(['lesson_id' => $enable_first_lesson->id, 'section_id' => $enable_first_section->id]);
    }

    /**
     * Fetches all the Course Material Slides for a course > lesson > section.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $course_id, integer $lesson_id, integer $section_id, 
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionGetCourseMaterials($course_id, $lesson_id, $section_id) {
        $course_name = Courses::findOne(['id' => $course_id])->course_name;
        $lesson_name = Lessons::findOne(['id' => $lesson_id])->lesson_name;
        $folder_name = Sections::findOne(['id' => $section_id])->folder_name;
        $learner_activity = LearnerActivity::find()
                ->where([
                    'learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id,
                    'lesson_id' => $lesson_id,
                    'section_id' => $section_id,
                    'completion_status' => 1
                ])
                ->one();

        $path = Yii::$app->request->baseUrl . '/uploads/courses/' . $course_name . '/' . $lesson_name . '/' . $folder_name . '/';

        $dir_path = 'uploads/courses/' . $course_name . '/' . $lesson_name . '/' . $folder_name;



        $files = scandir($dir_path);



        $unordered_files = [];

        if (is_dir($dir_path)) {
            for ($i = 1; $i < count($files); $i++) {
                if ($files[$i] != '.' && $files[$i] != '..' && $files[$i] != '.svn') {
                    $unordered_files[$i] = $files[$i];
                }
            }

            natsort($unordered_files);

            echo '<div class="row text-right swiper-no-swiping complete-section-button" style="display:flex;width:100%">';
            echo '<div class="col-md-6 completion-progress text-left" style="width:50%"></div>';

            echo '<div class="col-md-6" style="width:50%">';
            if (empty($learner_activity)) {
                echo '<button type="submit" class="btn btn-success button-complete" id="btn-confirm" value="' . $section_id . '" disabled><i class="fa fa-check-circle" aria-hidden="true"></i> Complete This Section</button>';
            } else {
                echo '<button type="button" class="btn button-revise"><i class="fa fa-info-circle" aria-hidden="true"></i> You are revising this section</button>';
            }
            echo '</div>';
            echo '</div>';


            echo '<div class="swiper-wrapper swiper-no-swiping disableRightClick">';
            foreach ($unordered_files as $ordered_file) {
                $extension = explode(".", $ordered_file);
                echo '<div class="swiper-slide">';

                if ($extension[1] == "JPG" || $extension[1] == "png" || $extension[1] == "jpeg" || $extension[1] == "gif" || $extension[1] == "jpg" || $extension[1] == "PNG") {
                    echo '<img draggable="false" src="' . $path . $ordered_file . '">';
                } elseif ($extension[1] == "html") {
                    echo '<object width="2000" height="600" data="' . $path . $ordered_file . '"></object>';
                }
                echo '</div>';
            }
            echo '</div>';

            echo '<div class="swiper-pagination swiper-no-swiping"></div>';

            $query = "SELECT c.`id`, c.`lesson_id` FROM `courses` AS a, `lessons` AS b, `sections` AS c WHERE  a.`id` = b.`course_id` AND b.`id` = c.`lesson_id` AND c.`id` = (SELECT MIN(c.`id`) FROM `courses` AS a, `lessons` AS b, `sections` AS c WHERE a.`id` = " . $course_id . " AND a.`id` = b.`course_id` AND b.`id` = c.`lesson_id` AND c.`id` > " . $section_id . "  AND c.`lesson_id` > " . $lesson_id . ")";
            $connection = Yii::$app->db;
            $command = $connection->createCommand($query);
            $result = $command->queryOne();

            if (empty($result)) {
                $next_lesson = 0;
            } else {
                $next_lesson = $result["lesson_id"];
            }

            echo '<script>
           
                
                    $("#btn-confirm").on("click", function() {
                        krajeeDialog.confirm("Are you sure you want to proceed?", function (result) {
                            if (result) {

                                $.get("complete-section", {section_id : section_id}, function(data) {
                              
                                    
                                    $("#section-' . $section_id . ' div:nth-child(2n)").remove(".progress");
                                        
                                    $("#section-' . $section_id . ' div:nth-child(2n)").html(data);

                                    if(!$("#lesson-' . $lesson_id . ' #section-' . $section_id . '").is(":last-child")) {
                                        $("#section-' . $section_id . '").next().removeClass("disabled");
                                        
                                        lesson_id = $("#section-" + section_id).next().attr("data-index-two"); 
                                        section_id = $("#section-" + section_id).next().attr("data-index-three"); 

                                        $.get("enable-next-section", {course_id : ' . $course_id . ', lesson_id : lesson_id, section_id : section_id}, function(data) {

                                            $("#section-" + section_id).trigger("click");
                                            $("#section-" + section_id + " div:nth-child(2n)").html(data);
                                        });
                                    } else {
                                        next_lesson = ' . $next_lesson . ';
                                                
                                        if(next_lesson != 0) {
                                            next_section = $("#lesson-" + next_lesson + " ul li:first").attr("data-index-three");

                                            $("#section-" + next_section).removeClass("disabled");

                                            $.get("enable-next-section", {course_id : ' . $course_id . ', lesson_id : next_lesson, section_id : next_section}, function(data) {

                                                $("#section-" + next_section).trigger("click");
                                                $("#section-" + next_section + " div:nth-child(2n)").html(data);
                                            });

                                            $(".lesson-" + next_lesson).trigger("click");
                                        } else {                                
                                               $.get("certificate-generate", {course_id}, function(data) {                                                 
                                                   });

                                            $(".swiper-container").html("");
                                            $("<img />").attr({
                                                "src": "' . Yii::$app->request->baseUrl . '/uploads/courses/finish-slide.JPG",
                                                "alt": "default-slide",
                                                "title": "Vivaan LMS Finish Slide",
                                            }).appendTo(".swiper-container");
                                        }
                                    }
                                });
                            } else {
                            }
                        });
                    });
                </script>';
        }
    }

    public function actionCompleteSection($section_id) {
        $connection = Yii::$app->db;
        $connection->createCommand()
                ->update('learner_activity', ['completion_status' => 1], 'section_id = ' . $section_id . ' AND learner_id = ' . Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id)
                ->execute();

        echo $complete = '<i class="fa fa-check-circle" aria-hidden="true" style="float:right; color: green;"></i>';
    }

    public function actionGetSession($course_id, $lesson_id, $section_id) {
        $course_name = Courses::findOne(['id' => $course_id])->course_name;
        $lesson_name = Lessons::findOne(['id' => $lesson_id])->lesson_name;
        $folder_name = Sections::findOne(['id' => $section_id])->folder_name;

        $dir_path = 'uploads/courses/' . $course_name . '/' . $lesson_name . '/' . $folder_name;


        $files = scandir($dir_path);

        $total_slides = count($files) - 2;

        $learner_activity = LearnerActivity::find()
                ->where([
                    'learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id,
                    'lesson_id' => $lesson_id,
                    'section_id' => $section_id
                ])
                ->one();

        if (empty($learner_activity) || $learner_activity == "" || $learner_activity == NULL) {
            $current_slide_no = 1;
            $connection = Yii::$app->db;
            $connection->createCommand()->insert('learner_activity', [
                        'learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id,
                        'lesson_id' => $lesson_id,
                        'section_id' => $section_id,
                        'current_slide_no' => 1,
                        'total_slides' => $total_slides,
                        'completion_status' => 0,
                        'created_at' => date('Y-m-d h:i:s'),
                        'created_by' => Yii::$app->user->identity->id,
                        'updated_at' => date('Y-m-d h:i:s'),
                        'updated_by' => Yii::$app->user->identity->id,
                    ])
                    ->execute();
        } else {
            $current_slide_no = $learner_activity->current_slide_no;
        }
        echo $current_slide_no;
    }

    public function actionUpdateSession($lesson_id, $section_id, $current) {
        $learner_activity = LearnerActivity::find()
                ->where([
                    'learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id,
                    'lesson_id' => $lesson_id,
                    'section_id' => $section_id
                ])
                ->one();

        if ($learner_activity->current_slide_no < $current) {
            $connection = Yii::$app->db;
            $connection->createCommand()
                    ->update('learner_activity', ['current_slide_no' => $current], 'lesson_id = ' . $lesson_id . ' AND section_id = ' . $section_id . ' AND learner_id = ' . Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id)
                    ->execute();

            $update_progress = LearnerActivity::findOne(['learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id, 'lesson_id' => $lesson_id, 'section_id' => $section_id]);

            $progress_complete = round(($update_progress->current_slide_no / $learner_activity->total_slides) * 100);
        } else {
            $progress_complete = round(($learner_activity->current_slide_no / $learner_activity->total_slides) * 100);
        }

        if ($progress_complete >= 0 && $progress_complete <= 25) {
            $status = "danger";
        } elseif ($progress_complete > 25 && $progress_complete <= 50) {
            $status = "info";
        } elseif ($progress_complete > 50 && $progress_complete <= 75) {
            $status = "warning";
        } elseif ($progress_complete > 75 && $progress_complete <= 100) {
            $status = "success";
        }

        echo '<div class="progress-bar progress-bar-' . $status . '" role="progressbar" aria-valuenow="' . $progress_complete . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $progress_complete . '%">' . $progress_complete . '%</div>';
    }

    public function actionEnableNextSection($course_id, $lesson_id, $section_id) {
        $course_name = Courses::findOne(['id' => $course_id])->course_name;
        $lesson_name = Lessons::findOne(['id' => $lesson_id])->lesson_name;
        $folder_name = Sections::findOne(['id' => $section_id])->folder_name;
        $dir_path = 'uploads/courses/' . $course_name . '/' . $lesson_name . '/' . $folder_name;

        $files = scandir($dir_path);

        $total_slides = count($files) - 2;

        $connection = Yii::$app->db;
        $connection->createCommand()->insert('learner_activity', [
                    'learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id,
                    'lesson_id' => $lesson_id,
                    'section_id' => $section_id,
                    'current_slide_no' => 1,
                    'total_slides' => $total_slides,
                    'completion_status' => 0,
                    'created_at' => date('Y-m-d h:i:s'),
                    'created_by' => Yii::$app->user->identity->id,
                    'updated_at' => date('Y-m-d h:i:s'),
                    'updated_by' => Yii::$app->user->identity->id,
                ])
                ->execute();

        $progress_complete = round(( 1 / $total_slides) * 100);

        if ($progress_complete >= 0 && $progress_complete <= 25) {
            $status = "danger";
        } elseif ($progress_complete > 25 && $progress_complete <= 50) {
            $status = "info";
        } elseif ($progress_complete > 50 && $progress_complete <= 75) {
            $status = "warning";
        } elseif ($progress_complete > 75 && $progress_complete <= 100) {
            $status = "success";
        }

        echo '<div class="progress-bar progress-bar-' . $status . '" role="progressbar" aria-valuenow="' . $progress_complete . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $progress_complete . '%">' . $progress_complete . '%</div>';
    }

    public function actionCheckRevised($lesson_id, $section_id) {
        $learner_activity = LearnerActivity::find()
                ->where([
                    'learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id,
                    'lesson_id' => $lesson_id,
                    'section_id' => $section_id,
                    'completion_status' => 1
                ])
                ->one();

        if (empty($learner_activity)) {
            echo 'in progress';
        } else {
            echo 'revised';
        }
    }

    public function actionUpdateCourseName($course_id) {

        return Courses::findOne(['id' => $course_id])->course_name;
    }

    /**
     * Deletes an existing LearnerActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionFaq() {

        return $this->render('faq');
    }

    public function actionEbooks($id) {
        $courses = Courses::findOne(['id' => $id]);
        return $this->render('ebooks', [
                    'keywords' => $courses->keywords,
                    'rss_feeds' => $courses->rss_feeds
        ]);
    }

    public function actionEbookName($ebook_id, $course_id) {
        $list_of_ebooks = Ebooks::findOne(['id' => $ebook_id])->file_name;
        $course_name = Courses::findOne(['id' => $course_id])->course_name;

        echo '<div>';
        echo '<iframe src="../uploads/pdf/' . $course_name . '/ebook/' . $list_of_ebooks . '.pdf#toolbar=0" width="100%" height="520"></iframe>';
        echo '</div>';
    }

    /**
     * Finds the LearnerActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LearnerActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = LearnerActivity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCertificateGenerate($course_id) {
        $course_name = Courses::findOne(['id' => $course_id])->course_name;
        $length = 10;
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $certificate_no = '#' . $randomString;

        $expire_date = date('Y-m-d', strtotime("+6 months", strtotime(date("y-m-d"))));
        $connection = Yii::$app->db;
        $connection->createCommand()->insert('certificates', [
                    'learner_id' => Learners::findOne(['user_id' => Yii::$app->user->identity->id])->id,
                    'certificate_name' => $course_name,
                    'certifying_authority' => 'vivaan',
                    'issue_date' => date('Y-m-d'),
                    'expire_date' => $expire_date,
                    'certificate_no' => $certificate_no,
                    'status' => 0,
                ])
                ->execute();
    }

}
