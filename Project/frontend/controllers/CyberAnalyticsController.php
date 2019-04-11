<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use \yii\filters\VerbFilter;
use frontend\models\Branches;
use frontend\models\BranchManagers;
use frontend\models\Company;
use frontend\models\MasterCsoTemplates;
use frontend\models\MasterCsoTemplatesSearch;
use frontend\models\MasterCsoPolicyOptions;
use frontend\models\MasterCsoControlOptions;
use frontend\models\MasterTechnicalControl;
use frontend\models\ProcessPolicyStatus;
use frontend\models\TechnicalControlsStatus;
use frontend\models\User;
use yii\data\Pagination;
use yii\web\UploadedFile;
use yii\db\Query;

/**
 * TemplatesController implements the CRUD actions for Templates model.
 */
class CyberAnalyticsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['site/logout', 'site/login'],
                'rules' => [
                    [
                        'actions' => ['site/login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['site/logout'],
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


    public function actionAbout() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        return $this->render('about');
    }

    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        return $this->redirect(['cyber-analytics/dashboard']);
    }

    public function actionDashboard() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $user = User::findOne(Yii::$app->user->identity->id);
        while ($user->role_type != 2 && $user->role_type != 1) {
            $user = User::findOne($user->created_by);
        }
//$user contains company admin
        if ($user->role_type == 2) {
            $branch_admins = User::find()->where(['role_type' => 3, 'created_by' => $user->id])->all();
            $branch_admin_ids = [];
            foreach ($branch_admins as $branch_admins) {
                $branch_admin_ids [] = $branch_admins->id;
            }
            $company_id = Company::find()->select(['id'])->where(['company_admin_id' => $user->id])->scalar();
        } else {
            $branch_admin_ids [] = 1;
        }

//Calculating Learning Index
        $learners = User::find()->where(['IN', 'created_by', $branch_admin_ids])->all();
        $branches = Branches::find()
                ->where(['created_by' => $user->id])
                ->all();
        $stats_array = [];
        foreach ($branches as $branch) {
            $stats_array[$branch->id] = [];
        }

//foreach learners get statistics
        /* ----- Dashboard For Learner ----- */
        foreach ($learners as $learners) {
            /* ------- Total Courses -------- */
            $query1 = "SELECT a.`course_name` FROM `courses` AS a, `courses_assigned` AS b WHERE b.`courses_assigned` = a.`id` AND b.`user_id` = " . Yii::$app->user->identity->id . "";
            $connection1 = Yii::$app->db;
            $command1 = $connection1->createCommand($query1);
            $result1 = $command1->queryAll();
            $total_courses = count($result1);

            /* ----- query for assigned courses for each user ----- */
            $query = new Query();
            $query->select(['courses.id', 'courses.course_name'])
                    ->from('courses')
                    ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned = courses.id')
                    ->where(['courses_assigned.user_id' => $learners->id, 'courses_assigned.blocked_status' => 1]);

            $command = $query->createCommand();
            $assigned_courses = $command->queryAll();
            $total_acourses = count($assigned_courses);

            /* ----- For Completed Courses, Courses in progress and Courses yet to Satrt Author : Prem ----- */

            $completed_count = 0;
            $yet_to_start = 0;

            foreach ($assigned_courses as $course1) {
                /* ----- total number sections per course ----- */
                $query6 = "SELECT COUNT(*) AS `count` FROM sections WHERE sections.lesson_id IN (SELECT id FROM lessons WHERE lessons.course_id = " . $course1['id'] . ")  ";
                $connection6 = Yii::$app->db;
                $command6 = $connection6->createCommand($query6);
                $totalNumOfSections = $command6->queryAll();


                $query3 = "select COUNT(*) AS `count` from learner_activity as lactivity, learners as lrs, lessons as lss, sections as sections, courses as course
			where lactivity.learner_id = lrs.id and
			lrs.user_id = " . $learners->id . " and
			lss.course_id =  course.id and course.id = " . $course1['id'] . " and
			lactivity.completion_status = 1 and lactivity.section_id = sections.id and
			lactivity.lesson_id = lss.id";
                $connection3 = Yii::$app->db;
                $command3 = $connection3->createCommand($query3);
                $learners_activity_sects_count = $command3->queryAll();


//        total questions based on course : Author Prem
                $connection = Yii::$app->db;
                $questionsCommand = $connection->createCommand("SELECT * FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id = " . $course1['id'] . " ))");
                $total_question = $questionsCommand->queryAll();
                $questions_count = count($total_question);


//        total quesitons learner answerd based on course : Author Prem
                $questionCommand = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE learner_id = " . $learners->id . " AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $course1['id'] . " )))");
                $total_answered_questions = $questionCommand->queryAll();
                $answered_questions_count = count($total_answered_questions);

                /* ----- Total Review Material based on course: Author Prem ----- */
                $connection4 = Yii::$app->db;
                $review_materialCommand = $connection4->createCommand("SELECT * FROM `review_material` WHERE course_id = " . $course1['id'] . " ");
                $total_reviewmaterial = $review_materialCommand->queryAll();
                $reviewmaterial_count = count($total_reviewmaterial);

                /* ----- Total user answerd review material based on course: Author Prem ----- */
                $connection5 = Yii::$app->db;
                $answered_reviewmaterialCommand = $connection5->createCommand("SELECT * FROM `review_material_scoring` WHERE learner_id = " . $learners->id . "  AND review_material_id  IN (SELECT id FROM review_material WHERE review_material.course_id= " . $course1['id'] . ")");
                $answered_reviewmaterial = $answered_reviewmaterialCommand->queryAll();
                $total_answered_count = count($answered_reviewmaterial);

                if ((!empty($learners_activity_sects_count[0]['count']) && ($learners_activity_sects_count[0]['count'] !== NULL)) || $answered_questions_count !== 0 || $total_answered_count !== 0) {
                    if ($totalNumOfSections[0]['count'] === $learners_activity_sects_count[0]['count'] && $questions_count === $answered_questions_count && $reviewmaterial_count === $total_answered_count) {
                        $completed_count++;
                    }
                } else {
                    $yet_to_start++;
                }


                /* ----- Course Progress Graph  ------- */

                if ($totalNumOfSections[0]['count'] == 0) {
                    $percentOfCourseCompleted = 0;
                } else {
                    $percentOfCourseCompleted = number_format(($learners_activity_sects_count[0]['count'] / $totalNumOfSections[0]['count']) * 100);
                }

                /* ----- Course Index Trend Graph  ------- */
                $query6 = "SELECT a.`id` FROM `questions` AS a, `sections` AS b, `lessons` AS c, `courses` AS d WHERE a.`section_id`= b.`id` AND b.`lesson_id` = c.`id` AND c.`course_id` = d.`id` AND d.`id`= " . $course1['id'] . "";
                $connection6 = Yii::$app->db;
                $command6 = $connection6->createCommand($query6);
                $result6 = $command6->queryAll();
                $total_marks = count($result6);


                $query7 = "SELECT a.`id` FROM `questions` AS a, `sections` AS b, `lessons` AS c, `courses` AS d, `learner_scoring` AS e, `user` AS f WHERE a.`section_id` = b.`id` AND b.`lesson_id` = c.`id` AND c.`course_id` = d.`id` AND d.`id` = " . $course1['id'] . " AND e.`question_id` = a.`id` AND e.`answer` = a.`answer`AND e.`learner_id` = f.`id` AND f.`id` = " . $learners->id . "";
                $connection7 = Yii::$app->db;
                $command7 = $connection7->createCommand($query7);
                $result7 = $command7->queryAll();
                $total_marks_scored = count($result7);


                if ($total_marks_scored == 0) {
                    $total_percent_course = 0;
                } else {
                    $total_percent_course = ($total_marks_scored / $total_marks) * 100;
                }

                $stats_array[BranchManagers::find()->select(['branch_id'])->where(['user_id' => $learners->created_by])->scalar()] [] = [
                    'learner' => $learners,
                    'total_courses' => $total_courses,
                    'assigned_courses' => $assigned_courses,
                    'total_acourses' => $total_acourses,
                    'completed_count' => $completed_count,
                    'yet_to_start' => $yet_to_start,
                    'learners_activity_sects_coun' => $learners_activity_sects_count,
                    'percentOfCourseCompleted' => $percentOfCourseCompleted,
                ];
            }
        }
        $sum_avg = 0.0;
        $count = 0;
        foreach ($branches as $index1 => $branch1) {
            $per = array_column($stats_array[$branch1->id], 'percentOfCourseCompleted');
            $average = count($per) ? (array_sum($per) / count($per)) : 0;
            $sum_avg = $sum_avg + $average;
            $count++;
        }
        $learning_index = number_format($sum_avg / ($count ? $count : 1), 2);

        return $this->render('dashboard', [
                    'learn_percentage' => $learning_index,
                    'process_data' => $this->actionGetProcessIndex()['array'],
                    'process_percentage' => $this->actionGetProcessIndex()['percentage'],
                    'tech_data' => $this->actionGetTechIndex()['array'],
                    'tech_percentage' => $this->actionGetTechIndex()['percentage']
        ]);
    }

    public function actionLearn() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $user = User::findOne(Yii::$app->user->identity->id);
        while ($user->role_type != 2 && $user->role_type != 1) {
            $user = User::findOne($user->created_by);
        }
//$user contains company admin
        if ($user->role_type == 2) {
            $branch_admins = User::find()->where(['role_type' => 3, 'created_by' => $user->id])->all();
            $branch_admin_ids = [];
            foreach ($branch_admins as $branch_admins) {
                $branch_admin_ids [] = $branch_admins->id;
            }
        } else {
            $branch_admins = User::findOne(1);
            $branch_admin_ids [] = 1;
        }
        $learners = User::find()->where(['IN', 'created_by', $branch_admin_ids])->all();
        $branches = Branches::find()
                ->where(['created_by' => $user->id])
                ->all();
        $stats_array = [];
        foreach ($branches as $branch) {
            $stats_array[$branch->id] = [
             
            ];

        }
//foreach learners get statistics
        //Have retained additional data for future needs
        /* ----- Dashboard For Learner ----- */
        foreach ($learners as $learners) {
            /* ------- Total Courses -------- */
            $query1 = "SELECT a.`course_name` FROM `courses` AS a, `courses_assigned` AS b WHERE b.`courses_assigned` = a.`id` AND b.`user_id` = " . $learners->id . "";
            $connection1 = Yii::$app->db;
            $command1 = $connection1->createCommand($query1);
            $result1 = $command1->queryAll();
            $total_courses = count($result1);

            /* ----- query for assigned courses for each user ----- */
            $query = new Query();
            $query->select(['courses.id', 'courses.course_name'])
                    ->from('courses')
                    ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned = courses.id')
                    ->where(['courses_assigned.user_id' => $learners->id, 'courses_assigned.blocked_status' => 1]);

            $command = $query->createCommand();
            $assigned_courses = $command->queryAll();
            $total_acourses = count($assigned_courses);

            /* ----- For Completed Courses, Courses in progress and Courses yet to Satrt Author : Prem ----- */


            $completed_count = 0;
            $yet_to_start = 0;

            foreach ($assigned_courses as $course1) {
                /* ----- total number sections per course ----- */
                $query6 = "SELECT COUNT(*) AS `count` FROM sections WHERE sections.lesson_id IN (SELECT id FROM lessons WHERE lessons.course_id = " . $course1['id'] . ")  ";
                $connection6 = Yii::$app->db;
                $command6 = $connection6->createCommand($query6);
                $totalNumOfSections = $command6->queryAll();


                $query3 = "select COUNT(*) AS `count` from learner_activity as lactivity, learners as lrs, lessons as lss, sections as sections, courses as course
			where lactivity.learner_id = lrs.id and
			lrs.user_id = " . $learners->id . " and
			lss.course_id =  course.id and course.id = " . $course1['id'] . " and
			lactivity.completion_status = 1 and lactivity.section_id = sections.id and
			lactivity.lesson_id = lss.id";
                $connection3 = Yii::$app->db;
                $command3 = $connection3->createCommand($query3);
                $learners_activity_sects_count = $command3->queryAll();


//        total questions based on course : Author Prem
                $connection = Yii::$app->db;
                $questionsCommand = $connection->createCommand("SELECT * FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id = " . $course1['id'] . " ))");
                $total_question = $questionsCommand->queryAll();
                $questions_count = count($total_question);


//        total quesitons learner answerd based on course : Author Prem
                $questionCommand = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE learner_id = " . $learners->id . " AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $course1['id'] . " )))");
                $total_answered_questions = $questionCommand->queryAll();
                $answered_questions_count = count($total_answered_questions);

                /* ----- Total Review Material based on course: Author Prem ----- */
                $connection4 = Yii::$app->db;
                $review_materialCommand = $connection4->createCommand("SELECT * FROM `review_material` WHERE course_id = " . $course1['id'] . " ");
                $total_reviewmaterial = $review_materialCommand->queryAll();
                $reviewmaterial_count = count($total_reviewmaterial);

                /* ----- Total user answerd review material based on course: Author Prem ----- */
                $connection5 = Yii::$app->db;
                $answered_reviewmaterialCommand = $connection5->createCommand("SELECT * FROM `review_material_scoring` WHERE learner_id = " . $learners->id . "  AND review_material_id  IN (SELECT id FROM review_material WHERE review_material.course_id= " . $course1['id'] . ")");
                $answered_reviewmaterial = $answered_reviewmaterialCommand->queryAll();
                $total_answered_count = count($answered_reviewmaterial);

                if ((!empty($learners_activity_sects_count[0]['count']) && ($learners_activity_sects_count[0]['count'] !== NULL)) || $answered_questions_count !== 0 || $total_answered_count !== 0) {
                    if ($totalNumOfSections[0]['count'] === $learners_activity_sects_count[0]['count'] && $questions_count === $answered_questions_count && $reviewmaterial_count === $total_answered_count) {
                        $completed_count++;
                    }
                } else {
                    $yet_to_start++;
                }


                /* ----- Course Progress Graph  ------- */

                if ($totalNumOfSections[0]['count'] == 0) {
                    $percentOfCourseCompleted = 0;
                } else {
                    $percentOfCourseCompleted = number_format(($learners_activity_sects_count[0]['count'] / $totalNumOfSections[0]['count']) * 100);
                }

                /* ----- Course Index Trend Graph  ------- */
                $query6 = "SELECT a.`id` FROM `questions` AS a, `sections` AS b, `lessons` AS c, `courses` AS d WHERE a.`section_id`= b.`id` AND b.`lesson_id` = c.`id` AND c.`course_id` = d.`id` AND d.`id`= " . $course1['id'] . "";
                $connection6 = Yii::$app->db;
                $command6 = $connection6->createCommand($query6);
                $result6 = $command6->queryAll();
                $total_marks = count($result6);


                $query7 = "SELECT a.`id` FROM `questions` AS a, `sections` AS b, `lessons` AS c, `courses` AS d, `learner_scoring` AS e, `user` AS f WHERE a.`section_id` = b.`id` AND b.`lesson_id` = c.`id` AND c.`course_id` = d.`id` AND d.`id` = " . $course1['id'] . " AND e.`question_id` = a.`id` AND e.`answer` = a.`answer`AND e.`learner_id` = f.`id` AND f.`id` = " . $learners->id . "";
                $connection7 = Yii::$app->db;
                $command7 = $connection7->createCommand($query7);
                $result7 = $command7->queryAll();
                $total_marks_scored = count($result7);


                if ($total_marks_scored == 0) {
                    $total_percent_course = 0;
                } else {
                    $total_percent_course = ($total_marks_scored / $total_marks) * 100;
                }

                $query8 = "SELECT f.id, SUM(a.score) as sum_score
                FROM learner_scoring as a
                INNER JOIN learners as b  ON  a.learner_id= b.user_id
                INNER JOIN questions as c  ON  a.question_id= c.id
                INNER JOIN sections as d  ON  d.id= c.section_id
                INNER JOIN lessons as e  ON  e.id= d.lesson_id
                INNER JOIN courses as f  ON  f.id= e.course_id
                INNER JOIN user as g  ON  b.user_id= g.id
                WHERE g.id = " . $learners->id . "
                GROUP BY f.id";
                $command8 = $connection7->createCommand($query8);
                $result8 = $command8->queryAll();

                $branch_id = BranchManagers::find()->select(['branch_id'])->where(['user_id' => $learners->created_by])->scalar();
                $stats_array[$branch_id] [] = [
                    'learner' => $learners,
                    'total_courses' => $total_courses,
                    'assigned_courses' => $assigned_courses,
                    'total_acourses' => $total_acourses,
                    'completed_count' => $completed_count,
                    'yet_to_start' => $yet_to_start,
                    'learners_activity_sects_coun' => $learners_activity_sects_count,
                    'percentOfCourseCompleted' => $percentOfCourseCompleted,
                    'total_percent_course' => $total_percent_course
                ];
            }
        }

        return $this->render('learn', [
                    'branches' => $branches,
                    'branch_managers' => $branch_admins,
                    'stats_array' => $stats_array
        ]);
    }

    public function actionProcess() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $data = $this->actionGetProcessIndex();

        return $this->render('process', [
                    'options' => MasterCsoPolicyOptions::find()->all(),
                    'percentage' => $data['percentage'],
                    'array1' => $data['array'],
                    'array2' => $data['array']
        ]);
    }

    public function actionTech() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $data = $this->actionGetTechIndex();

        return $this->render('tech', [
                    'options' => MasterCsoControlOptions::find()->all(),
                    'percentage' => $data['percentage'],
                    'array1' => $data['array'],
                    'array2' => $data['array']
        ]);
    }

    public function actionTechControls() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

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

        $array = [];
        $technical_templates = MasterTechnicalControl::find()->where(['status' => 1])->orderBy(['template_name' => 'ASC'])->all();
        foreach ($technical_templates as $dataQuery) {
            $policy_status = TechnicalControlsStatus::find()
                    ->where(['policy_id' => $dataQuery->id, 'company_id' => $company_id])
                    ->orderBy(['id' => SORT_DESC])
                    ->all();
            $array [] = [
                'data' => $dataQuery,
                'policy_status' => $policy_status,
                'policy_option' => (!empty($policy_status)) ? $policy_status[0]->getPolicyOption()->one() : ''
            ];
        }

        return $this->render('tech-controls', [
                    'options' => MasterCsoControlOptions::find()->all(),
                    'array1' => $array,
                    'array2' => $array
        ]);
    }

    public function actionProcessDashboard() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

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

        $array = [];
        $policy_template = MasterCsoTemplates::find()->where(['status' => 1])->orderBy(['template_name' => 'ASC'])->all();
        foreach ($policy_template as $dataQuery) {
            $policy_status = ProcessPolicyStatus::find()
                    ->where(['policy_id' => $dataQuery->id, 'company_id' => $company_id])
                    ->orderBy(['id' => SORT_DESC])
                    ->all();
            $array [] = [
                'data' => $dataQuery,
                'policy_status' => $policy_status,
                'policy_option' => (!empty($policy_status)) ? $policy_status[0]->getPolicyOption()->one() : ''
            ];
        }

        return $this->render('process-dashboard', [
                    'options' => MasterCsoPolicyOptions::find()->all(),
                    'array1' => $array,
                    'array2' => $array
        ]);
    }

    public function actionProcessTemplates() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $searchModel = new MasterCsoTemplatesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = MasterCsoTemplates::find()->where(['status' => 1])->orderBy(['template_name' => 'ASC']);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 50]);
        $array = [];
// limit the query using the pagination and retrieve the articles
        $dataQuery = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        foreach ($dataQuery as $dataQuery) {
            $array [] = MasterCsoTemplates::find()->where(['id' => $dataQuery->id])->one();
        }

        return $this->render('process-templates', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'array' => $array,
                    'pagination' => $pagination
        ]);
    }

    public function actionProcessPolicy() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $post = Yii::$app->request->post();
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
        $old_policy = ProcessPolicyStatus::find()
                ->where(['policy_id' => $post['policy_id'], 'company_id' => $company_id])
                ->orderBy(['created_at' => SORT_DESC])
                ->one();
        //Now add the new entry
        $policy = new ProcessPolicyStatus();
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
                $path = "policy-docs/" . $filename;
                if (!empty($old_policy)){
                    if ($old_policy->file != NULL){
                        unlink("policy-docs/" . $old_policy->file);
                $doc->saveAs($path);
                $policy->file = $filename;
                    }
                }
            }
            $policy->expiry_date = $post['ex_date'];
        }
        if ($policy->save(FALSE)) {
            $policy_status = ProcessPolicyStatus::find()
                    ->where(['policy_id' => $post['policy_id'], 'company_id' => $policy->company_id])
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

    public function actionTechControlStatus() {
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
        $old_policy = TechnicalControlsStatus::find()
                ->where(['policy_id' => $post['policy_id'], 'company_id' => $company_id])
                ->orderBy(['created_at' => SORT_DESC])
                ->one();
        $policy = new TechnicalControlsStatus();
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
            $policy_status = TechnicalControlsStatus::find()
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

    public function actionGetProcessIndex() {
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
        //Calculating Process Index 
        $process_count = 0.0;
        $array = [];
        $dataQuery = MasterCsoTemplates::find()
                ->where(['status' => 1])
                ->orderBy(['template_name' => 'ASC']);
        $total_process = $dataQuery->count();
        $dataQuery = $dataQuery->all();
        foreach ($dataQuery as $dataQuery) {
            $policy_status = ProcessPolicyStatus::find()
                    ->where(['policy_id' => $dataQuery->id, 'company_id' => $company_id])
                    ->orderBy(['created_at' => 'DESC'])
                    ->one();
            if (!empty($policy_status)) {
                if ($policy_status->policy_option_id == 1 || $policy_status->policy_option_id == 3) {
                    $process_count++;
                }
            }
            $array [] = [
                'data' => $dataQuery,
                'policy_status' => $policy_status,
                'user' => (!empty($policy_status)) ? User::findOne($policy_status->created_by) : '',
                'policy_option' => (!empty($policy_status)) ? MasterCsoPolicyOptions::find()->where(['id' => $policy_status->policy_option_id])->one() : ''
            ];
        }

        $process_index = number_format(($process_count / ($total_process ? $total_process : 1)) * 100, 2);

        return ['array' => $array, 'percentage' => $process_index];
    }

    public function actionGetTechIndex() {
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
        //Calculating Process Index 
        $process_count = 0.0;
        $array = [];
        $dataQuery = MasterTechnicalControl::find()
                ->where(['status' => 1])
                ->orderBy(['template_name' => 'ASC']);
        $total_process = $dataQuery->count();
        $dataQuery = $dataQuery->all();
        foreach ($dataQuery as $dataQuery) {
            $policy_status = TechnicalControlsStatus::find()
                    ->where(['policy_id' => $dataQuery->id, 'company_id' => $company_id])
                    ->orderBy(['created_at' => 'DESC'])
                    ->one();
            if (!empty($policy_status)) {
                if ($policy_status->policy_option_id == 1 || $policy_status->policy_option_id == 3) {
                    $process_count++;
                }
            }
            $array [] = [
                'data' => $dataQuery,
                'policy_status' => $policy_status,
                'user' => (!empty($policy_status)) ? User::findOne($policy_status->created_by) : '',
                'policy_option' => (!empty($policy_status)) ? MasterCsoControlOptions::find()->where(['id' => $policy_status->policy_option_id])->one() : ''
            ];
        }

        $tech_index = number_format(($process_count / ($total_process ? $total_process : 1)) * 100, 2);

        return ['array' => $array, 'percentage' => $tech_index];
    }

}
