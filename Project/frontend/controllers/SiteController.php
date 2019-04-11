<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Courses;
use frontend\models\CompanyNotifications;
use frontend\models\SuperAdminNotifications;
use yii\db\Query;
use frontend\models\Learners;
use frontend\models\Branches;
use frontend\models\Company;
use yii\helpers\Json;
use frontend\models\User;
use frontend\models\LoginAnswer;
use frontend\models\License;

/**
 * Site controller
 */

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['access-buttons', 'dashboard-branchmanager', 'dashboard-company', 'dashboard-content', 'dashboard-course', 'dashboard-learner', 'home', 'index','documents-data-log'],
                'rules' => [
                    [
                        'actions' => ['access-buttons', 'dashboard-branchmanager', 'dashboard-company', 'dashboard-content', 'dashboard-course', 'dashboard-learner', 'home', 'index','documents-data-log'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function () {
                            return User::findOne(['id' => Yii::$app->user->identity->id])->two_fact === 1;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {
            $role_type = Yii::$app->user->identity->role_type;

            if ($role_type == 1) {
                /* ----- Dashboard for Super Admin ----- */
                $company_array = [];
                $months_array = [];

                for ($i = 0; $i <= 5; $i++) {
                    $start_date = date("Y-m-01", strtotime(date('Y-m-01') . " -$i months"));
                    $end_date = date("Y-m-t", strtotime(date('Y-m-01') . " -$i months"));

                    $month = date('M', strtotime($start_date));
                    array_push($months_array, "'" . $month . "'");

                    /* ---------- Total no of Companies based on months------ */
                    $query = "SELECT DATE_FORMAT(a.`created_at`,'%Y-%m-%d') from `company` AS a, `user` AS b WHERE DATE_FORMAT(a.`created_at`,'%Y-%m-%d') BETWEEN '" . $start_date . "' AND '" . $end_date . "' AND a.`created_by` = b.`id` AND b.`id` =  " . Yii::$app->user->identity->id . " AND a.`status` = 10";
                    $connection = Yii::$app->db;
                    $command = $connection->createCommand($query);
                    $result = $command->queryAll();
                    $companies = count($result);

                    if (empty($companies)) {
                        $count_companies = 0;
                    } else {
                        $count_companies = count($result);
                    }
                    array_push($company_array, $count_companies);
                }
                $final_months_array = implode($months_array, ',');
                $final_company_array = implode($company_array, ',');


                /* ----------- Total no of Company Users And Individual Users ----------- */

                $months_array1 = [];
                $company_users = [];
                $individual_users = [];

                for ($i = 0; $i <= 5; $i++) {
                    $start_date1 = date("Y-m-01", strtotime(date('Y-m-01') . " -$i months"));
                    $end_date1 = date("Y-m-t", strtotime(date('Y-m-01') . " -$i months"));

                    $month = date('M', strtotime($start_date1));
                    array_push($months_array1, "'" . $month . "'");

                    /* ----------- No of Company Users ---------- */

            
                    $query1 = "SELECT DATE_FORMAT(d.`created_at`,'%Y-%m-%d'), d.`user_id` from `user` AS a, `company` AS b, `branch_managers` AS c, `learners` AS d  WHERE DATE_FORMAT(d.`created_at`,'%Y-%m-%d') BETWEEN '" . $start_date1 . "' AND '" . $end_date1 . "'  AND d.`created_by` = c.`user_id` AND c.`created_by` = b.`company_admin_id` AND b.`created_by` = a.`id` AND a.`id` = " . Yii::$app->user->identity->id . " AND  b.`status` =10";
                    $connection1 = Yii::$app->db;
                    $command1 = $connection1->createCommand($query1);
                    $result1 = $command1->queryAll();
                    $users1 = count($result1);

                    if (empty($users1)) {
                        $count_company_users = 0;
                    } else {
                        $count_company_users = count($result1);
                    }
                    array_push($company_users, $count_company_users);

                    /* ---------- No of Individual Users ------------- */

                    
                    $query2 = "SELECT DATE_FORMAT(a.`created_at`,'%Y-%m-%d'), `added_by`, `first_name` from `user` AS a, `learners` AS b  WHERE DATE_FORMAT(a.`created_at`,'%Y-%m-%d') BETWEEN '" . $start_date1 . "' AND '" . $end_date1 . "' AND b.`user_id` = a.`id` AND a.`added_by` = 0 AND a.`created_by` = " . Yii::$app->user->identity->id . " AND a.`status` =10";
                    $connection2 = Yii::$app->db;
                    $command2 = $connection2->createCommand($query2);
                    $result2 = $command2->queryAll();
                    $users2 = count($result2);

                    if (empty($users2)) {
                        $count_individual_users = 0;
                    } else {
                        $count_individual_users = count($result2);
                    }
                    array_push($individual_users, $count_individual_users);
                }

                $final_months_array1 = implode($months_array1, ',');
                $final_company_users = implode($company_users, ',');
                $final_individual_users = implode($individual_users, ',');

                /* ----- Corporate Learners ---- */

               
                $query_corp = "SELECT d.`user_id` from `user` AS a, `company` AS b, `branch_managers` AS c, `learners` AS d  WHERE d.`created_by` = c.`user_id` AND c.`created_by` = b.`company_admin_id` AND b.`created_by` = a.`id` AND a.`id` = " . Yii::$app->user->identity->id . " AND  b.`status` =10";
                $command_corp = $connection1->createCommand($query_corp);
                $result_corp = $command_corp->queryAll();
                $users_corp = count($result_corp);

                /* ----- Individual Learners ---- */

                
                $query_ind = "SELECT b.`first_name` FROM `learners` AS a, `user` AS b  WHERE a.`user_id` = b.`id` AND  b.`added_by` = 0 AND a.`status` = 10 AND b.`status` = 10 AND a.`created_by` = " . Yii::$app->user->identity->id . "";
                $connection2 = Yii::$app->db;
                $command_ind = $connection2->createCommand($query_ind);
                $result_ind = $command_ind->queryAll();
                $users_ind = count($result_ind);

                /* ----- Active Learners ---- */

              
                $query_active = "SELECT id FROM `user` WHERE `role_type` = 4 AND (`added_by` = 0 AND `created_by` = " . Yii::$app->user->identity->id . " OR `added_by` = 1) AND `status` = 10";
                $connection3 = Yii::$app->db;
                $command_active = $connection3->createCommand($query_active);
                $result_active = $command_active->queryAll();
                $users_active = count($result_active);

                /* ----- Non Active Learners ---- */
           
                $query_nactive = "SELECT id FROM `user` WHERE `role_type` = 4 AND (`created_by` = " . Yii::$app->user->identity->id . ") AND `status` = 0";
                $connection4 = Yii::$app->db;
                $command_nactive = $connection4->createCommand($query_nactive);
                $result_nactive = $command_nactive->queryAll();
                $users_nactive = count($result_nactive);

                /* ----- Total Learners ---- */

                $query_learners = "SELECT id FROM `user` WHERE `role_type` = 4 AND `status`= 10";
                $connection5 = Yii::$app->db;
                $command_learners = $connection5->createCommand($query_learners);
                $result_learners = $command_learners->queryAll();
                $total_learners = count($result_learners);

                /* ----- Total Courses ---- */

                $query_courses = "SELECT id FROM `courses`";
                $connection6 = Yii::$app->db;
                $command_courses = $connection6->createCommand($query_courses);
                $result_courses = $command_courses->queryAll();
                $total_coursess = count($result_courses);


                /* ----- Total Course Admins ---- */

                $query_admins = "SELECT id FROM `user` WHERE `role_type` = 6 AND `status` = 10";
                $connection8 = Yii::$app->db;
                $command_admins = $connection8->createCommand($query_admins);
                $result_admins = $command_admins->queryAll();
                $total_admins = count($result_admins);

                /* ----------- Total no of Learners Per Course ------------ */

                $months_array2 = [];

                for ($i = 0; $i <= 5; $i++) {
                    $start_date2 = date("Y-m-01", strtotime(date('Y-m-01') . " -$i months"));
                    $end_date2 = date("Y-m-t", strtotime(date('Y-m-01') . " -$i months"));

                    $months2 = date('Y-m-01', strtotime($start_date2));
                    array_push($months_array2, $months2);
                }

                return $this->render('dashboard-course', [
                            'company_array' => $company_array,
                            'months_array' => $months_array,
                            'final_months_array' => $final_months_array,
                            'final_company_array' => $final_company_array,
                            'months_array1' => $months_array1,
                            'company_users' => $company_users,
                            'individual_users' => $individual_users,
                            'count_company_users' => $count_company_users,
                            'count_individual_users' => $count_individual_users,
                            'final_months_array1' => $final_months_array1,
                            'final_company_users' => $final_company_users,
                            'final_individual_users' => $final_individual_users,
                            'users_corp' => $users_corp,
                            'users_ind' => $users_ind,
                            'users_active' => $users_active,
                            'users_nactive' => $users_nactive,
                            'total_learners' => $total_learners,
                            'total_coursess' => $total_coursess,
                            'total_admins' => $total_admins,
                            'months_array2' => $months_array2
                ]);
            } else if ($role_type == 2) {

                /* ----- DashBoard for Company Admin ----- */

                /* ------- Branch Stats Dropdown -------- */

                $company_id = Company::findOne(['company_admin_id' => Yii::$app->user->identity->id])->id;
                $branches = Branches::find()->where(['company_id' => $company_id])->all();
           

                /* ------- Course Stats Dropdown -------- */

                $query = new Query();
                $query->select(['courses.id', 'courses.course_name'])
                        ->from('courses')
                        ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned = courses.id'
                        )
                        ->where(['courses_assigned.user_id' => Yii::$app->user->identity->id, 'courses_assigned.blocked_status' => 1]);
                $command = $query->createCommand();
                $assigned_courses = $command->queryAll();

                /* ----- No.of License ------ */

                $no_of_license = Company::findOne(['id' => $company_id])->users_license;

                /* ---- Total Courses ----- */

                $total_courses = count($assigned_courses);

                /* ------- Active Users -------- */

                $query_active_users = "SELECT `email` FROM `branches` AS a, `branch_managers` AS b, `user` AS c, `company` AS d WHERE a.`company_id` = d.`id` AND d.`company_admin_id` = " . Yii::$app->user->identity->id . " AND b.`branch_id` = a.`id` AND b.`user_id` = c.`created_by` AND c.`status` = 10 AND c.`role_type` = 4 AND c.`added_by` = 1";
                $connection1 = Yii::$app->db;
                $command_active_users = $connection1->createCommand($query_active_users);
                $result_active_users = $command_active_users->queryAll();
                $active_users = count($result_active_users);

                /* ------- Non Active Users -------- */

                $non_active_users = $no_of_license - $active_users;

                /* ---------- Course Index Trend------ */

                $course_array = [];
                $months_array = [];

                for ($i = 0; $i <= 5; $i++) {
                    $start_date = date("Y-m-01", strtotime(date('Y-m-01') . " -$i months"));
                    $end_date = date("Y-m-t", strtotime(date('Y-m-01') . " -$i months"));

                    $month = date('M', strtotime($start_date));
                    array_push($months_array, "'" . $month . "'");

                    $query = new Query();
                    $query->select(['courses.id', 'courses.course_name'])
                            ->from('courses')
                            ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned = courses.id'
                            )
                            ->where(['courses_assigned.user_id' => Yii::$app->user->identity->id, 'courses_assigned.blocked_status' => 1]);
                    $command = $query->createCommand();
                    $assigned_courses = $command->queryAll();

                    foreach ($assigned_courses as $course) {
                        $query1 = "SELECT COUNT(*) as `count_courses`, d.`course_name` FROM `user` AS a, `branch_managers` AS b, `company` AS c, `courses` AS d, `courses_assigned` AS e WHERE DATE_FORMAT(a.`created_at`,'%Y-%m-%d') BETWEEN '" . $start_date . "' AND '" . $end_date . "' AND a.`created_by` = b.`user_id` AND b.`created_by` = c.`company_admin_id` AND c.`company_admin_id` = " . Yii::$app->user->identity->id . " AND a.`id` = e.`user_id` AND e.`courses_assigned` = d.`id` AND d.`id` = " . $course['id'] . " AND e.`blocked_status` = 1 AND a.`role_type` = 4 AND a.`status` = 10";
                        $connection1 = Yii::$app->db;
                        $command1 = $connection1->createCommand($query1);
                        $result = $command1->queryAll();
                        array_push($course_array, $result);

                        foreach ($result as $record) {
                            $record['course_name'] . ':' . $record['count_courses'] . ',';
                        }
                    }
                }
                $final_courses = Json::encode($course_array);
                $final_months_array = implode($months_array, ',');

                return $this->render('dashboard-company', [
                            'company_id' => $company_id,
                            'branches' => $branches,
                            'assigned_courses' => $assigned_courses,
                            'no_of_license' => $no_of_license,
                            'total_courses' => $total_courses,
                            'active_users' => $active_users,
                            'non_active_users' => $non_active_users,
                            'course_array' => $course_array,
                            'months_array' => $months_array,
                            'final_courses' => $final_courses,
                            'final_months_array' => $final_months_array
                ]);
            } else if ($role_type == 3) {

                /* ----- Dashboard for Branch Manager or Admin ----- */

                $query = new Query();
                $query->select(['branches.id', 'branches.branch_name'])
                        ->from('branches')
                        ->join('INNER JOIN', 'branch_managers', 'branch_managers.branch_id = branches.id'
                        )
                        ->where(['branch_managers.user_id' => Yii::$app->user->identity->id, 'branch_managers.status' => 10]);
                $command1 = $query->createCommand();
                $assigned_branches = $command1->queryAll();

                $query = new Query();
                $query->select(['courses.id', 'courses.course_name'])
                        ->from('courses')
                        ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned = courses.id'
                        )
                        ->where(['courses_assigned.user_id' => Yii::$app->user->identity->id, 'courses_assigned.blocked_status' => 1]);
                $command2 = $query->createCommand();
                $assigned_courses = $command2->queryAll();

                /* ----------- Total no of Learners ---------- */

                $branch_learners = [];
                $branch_courses = [];

                $query3 = "SELECT b.`email` FROM `learners` AS a, `user` AS b WHERE a.`user_id` = b.`id` AND a.`created_by` = " . Yii::$app->user->identity->id . " AND b.`status` =10";
                $connection3 = Yii::$app->db;
                $command3 = $connection3->createCommand($query3);
                $result3 = $command3->queryAll();
                $learners = count($result3);

                if (empty($learners)) {
                    $count_branch_learners = 0;
                } else {
                    $count_branch_learners = count($result3);
                }
                array_push($branch_learners, $count_branch_learners);

                /* ----------- Total no of Courses ---------- */

                $query4 = "SELECT b.`course_name` FROM  `courses_assigned` AS a, `courses` AS b, `user` AS c WHERE a.`user_id` = c.`id` AND c.`id` = " . Yii::$app->user->identity->id . " AND a.`courses_assigned` = b.`id` AND a.`blocked_status` = 1";
                $connection4 = Yii::$app->db;
                $command4 = $connection4->createCommand($query4);
                $result4 = $command4->queryAll();
                $courses = count($result4);

                if (empty($courses)) {
                    $count_branch_courses = 0;
                } else {
                    $count_branch_courses = count($result4);
                }
                array_push($branch_courses, $count_branch_courses);

                $final_branch_learners = implode($branch_learners, ',');
                $final_branch_courses = implode($branch_courses, ',');

                /* ---------- Course Index Trend------ */

                $course_array = [];
                $months_array = [];

                for ($i = 0; $i <= 5; $i++) {
                    $start_date = date("Y-m-01", strtotime(date('Y-m-01') . " -$i months"));
                    $end_date = date("Y-m-t", strtotime(date('Y-m-01') . " -$i months"));

                    $month = date('M', strtotime($start_date));
                    array_push($months_array, "'" . $month . "'");

                    $query = new Query();
                    $query->select(['courses.id', 'courses.course_name'])
                            ->from('courses')
                            ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned = courses.id'
                            )
                            ->where(['courses_assigned.user_id' => Yii::$app->user->identity->id, 'courses_assigned.blocked_status' => 1]);
                    $command = $query->createCommand();
                    $assigned_courses = $command->queryAll();

                    foreach ($assigned_courses as $course) {
                        $query1 = "SELECT COUNT(*) as `count_courses`, c.`course_name` FROM `user` AS a, `branch_managers` AS b, `courses` AS c, `courses_assigned` AS d WHERE DATE_FORMAT(a.`created_at`,'%Y-%m-%d') BETWEEN '" . $start_date . "' AND '" . $end_date . "' AND d.`user_id` = a.`id` AND d.`created_by` = b.`user_id` AND b.`user_id` = " . Yii::$app->user->identity->id . " AND a.`role_type` = 4 AND a.`status` = 10 AND d.`courses_assigned` = c.`id` AND c.`id` = " . $course['id'] . " AND d.`blocked_status` = 1";
                        $connection1 = Yii::$app->db;
                        $command1 = $connection1->createCommand($query1);
                        $result = $command1->queryAll();
                        array_push($course_array, $result);

                        foreach ($result as $record) {
                            $record['course_name'] . ':' . $record['count_courses'] . ',';
                        }
                    }
                }
                $final_courses = Json::encode($course_array);
                $final_months_array = implode($months_array, ',');

                return $this->render('dashboard-branchmanager', [
                            'assigned_branches' => $assigned_branches,
                            'assigned_courses' => $assigned_courses,
                            'branch_learners' => $branch_learners,
                            'branch_courses' => $branch_courses,
                            'learners' => $learners,
                            'courses' => $courses,
                                                'final_branch_learners' => $final_branch_learners,
                            'final_branch_courses' => $final_branch_courses,

                            'course_array' => $course_array,
                            'months_array' => $months_array,
                            'final_courses' => $final_courses,
                            'final_months_array' => $final_months_array
                ]);
            } else if ($role_type == 4) {

                $branch_manager_id = User::findOne(['id' => Yii::$app->user->identity->id]);
                if ($branch_manager_id->email == 'maheshaansystem@gmail.com') {
                    return $this->redirect('site/dashboard-learner');
                } else {
                    $company_id = User::findOne(['id' => $branch_manager_id->created_by])->created_by;
                    if ($branch_manager_id->id != 1) {
                        $message_box_query = "SELECT *
                     FROM
                         home_screen_messages
                     WHERE
                         (end_date >= CURDATE() AND created_by = $company_id )";
                    } elseif ($branch_manager_id->id == 1) {
                        $message_box_query = "SELECT *
                     FROM
                         home_screen_messages
                     WHERE
                         (end_date >= CURDATE() AND created_by = 1 )";
                    }
                    $messages = Yii::$app->db->createCommand($message_box_query)->queryAll();

                    return $this->render('home', [
                                'messages' => $messages,
                                'email' => $branch_manager_id->email,
                    ]);
                }
            } else if ($role_type == 5) {
                return $this->render('dashboard-content');
            } else if ($role_type == 7) {

                return $this->redirect('cyber-analytics/dashboard');
            }
        }
    }

    public function actionDashboardLearner() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {
            $role_type = Yii::$app->user->identity->role_type;
            $privildge = Yii::$app->user->identity->privilege;
            if ($role_type == 4 || $privildge == 1) {
                /* ----- Dashboard For Learner ----- */
                $learner = Learners::findOne(['user_id' => Yii::$app->user->identity->id]);
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
                        ->where(['courses_assigned.user_id' => Yii::$app->user->identity->id, 'courses_assigned.blocked_status' => 1]);

                $command = $query->createCommand();
                $assigned_courses = $command->queryAll();
                $total_acourses = count($assigned_courses);

                /* ----- For Completed Courses, Courses in progress and Courses yet to Satrt Author : Prem ----- */

                $completed_count = 0;
                $yet_to_start = 0;
                $percentOfCourseCompletionString = '';
                $totalCoursesString = '';
                $dataStringForCourseIndex = '';

                foreach ($assigned_courses as $course1) {
                    /* ----- total number sections per course ----- */
                    $query6 = "SELECT COUNT(*) AS `count` FROM sections WHERE sections.lesson_id IN (SELECT id FROM lessons WHERE lessons.course_id = " . $course1['id'] . ")  ";
                    $connection6 = Yii::$app->db;
                    $command6 = $connection6->createCommand($query6);
                    $totalNumOfSections = $command6->queryAll();


                    $query3 = "select COUNT(*) AS `count` from learner_activity as lactivity, learners as lrs, lessons as lss, sections as sections, courses as course
			where lactivity.learner_id = lrs.id and
			lrs.user_id = " . Yii::$app->user->identity->id . " and
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
                    $questionCommand = $connection->createCommand("SELECT * FROM `learner_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . " AND question_id in (SELECT id FROM questions WHERE questions.section_id in (SELECT id FROM `sections` WHERE lesson_id in (SELECT id FROM lessons WHERE lessons.course_id= " . $course1['id'] . " )))");
                    $total_answered_questions = $questionCommand->queryAll();
                    $answered_questions_count = count($total_answered_questions);

                    /* ----- Total Review Material based on course: Author Prem ----- */
                    $connection4 = Yii::$app->db;
                    $review_materialCommand = $connection4->createCommand("SELECT * FROM `review_material` WHERE course_id = " . $course1['id'] . " ");
                    $total_reviewmaterial = $review_materialCommand->queryAll();
                    $reviewmaterial_count = count($total_reviewmaterial);

                    /* ----- Total user answerd review material based on course: Author Prem ----- */
                    $connection5 = Yii::$app->db;
                    $answered_reviewmaterialCommand = $connection5->createCommand("SELECT * FROM `review_material_scoring` WHERE learner_id = " . Yii::$app->user->identity->id . "  AND review_material_id  IN (SELECT id FROM review_material WHERE review_material.course_id= " . $course1['id'] . ")");
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
                        $percentOfCourseCompleted = round(($learners_activity_sects_count[0]['count'] / $totalNumOfSections[0]['count']) * 100);
                    }

                    //Set color
                    $colordot = '';
                    if ($percentOfCourseCompleted < 60) {
                        $colordot = '#f94b2c';
                    } elseif ($percentOfCourseCompleted >= 60 && $percentOfCourseCompleted < 80) {
                        $colordot = '#ffa126';
                    } elseif ($percentOfCourseCompleted >= 80 && $percentOfCourseCompleted == 100) {
                        $colordot = 'green';
                    }

                    $totalCoursesString = $totalCoursesString . "{y: $percentOfCourseCompleted, color: '" . $colordot . "'}, ";

                    // Percentage course completed header

                    $percentOfCourseCompletionString = $percentOfCourseCompletionString . "{y: $percentOfCourseCompleted, color: '" . $colordot . "'},";


                    /* ----- Course Index Trend Graph  ------- */
                    $query6 = "SELECT a.`id` FROM `questions` AS a, `sections` AS b, `lessons` AS c, `courses` AS d WHERE a.`section_id`= b.`id` AND b.`lesson_id` = c.`id` AND c.`course_id` = d.`id` AND d.`id`= " . $course1['id'] . "";
                    $connection6 = Yii::$app->db;
                    $command6 = $connection6->createCommand($query6);
                    $result6 = $command6->queryAll();
                    $total_marks = count($result6);


                    $query7 = "SELECT a.`id` FROM `questions` AS a, `sections` AS b, `lessons` AS c, `courses` AS d, `learner_scoring` AS e, `user` AS f WHERE a.`section_id` = b.`id` AND b.`lesson_id` = c.`id` AND c.`course_id` = d.`id` AND d.`id` = " . $course1['id'] . " AND e.`question_id` = a.`id` AND e.`answer` = a.`answer`AND e.`learner_id` = f.`id` AND f.`id` = " . Yii::$app->user->identity->id . "";
                    $connection7 = Yii::$app->db;
                    $command7 = $connection7->createCommand($query7);
                    $result7 = $command7->queryAll();
                    $total_marks_scored = count($result7);


                    if ($total_marks_scored == 0) {
                        $total_percent_course = 0;
                    } else {
                        $total_percent_course = ($total_marks_scored / $total_marks) * 100;
                    }


                    //Set color
                    $colordot1 = '';
                    if ($total_percent_course < 60) {
                        $colordot1 = '#f94b2c';
                    } elseif ($total_percent_course >= 60 && $total_percent_course < 80) {
                        $colordot1 = '#ffa126';
                    } elseif ($total_percent_course >= 80) {
                        $colordot1 = 'green';
                    }

                    $dataStringForCourseIndex = $dataStringForCourseIndex . "{ name: '" . $course1['course_name'] . "', data: [" . $total_percent_course . "], color: '" . $colordot1 . "' },";
                }

                return $this->render('dashboard-learner', [
                            'total_courses' => $total_courses,
                            'assigned_courses' => $assigned_courses,
                            'total_acourses' => $total_acourses,
                            'completed_count' => $completed_count,
                            'yet_to_start' => $yet_to_start,
                            'learners_activity_sects_coun' => $learners_activity_sects_count,
                            'totalNumOfSections' => $totalNumOfSections,
                            'percentOfCourseCompleted' => $percentOfCourseCompleted,
                            'percentOfCourseCompletionString' => $percentOfCourseCompletionString,
                            'totalCoursesString' => $totalCoursesString,
                            'dataStringForCourseIndex' => $dataStringForCourseIndex
                ]);
            }
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (empty($_SESSION['id'])) {
            $_SESSION['id'] = rand(1, 5);
            $data = $_SESSION['id'];
        } else {
            $data = $_SESSION['id'];
        }

        

        if (!Yii::$app->user->isGuest) {
            $role_type = Yii::$app->user->identity->role_type;
               $this->actionLicense();
        } else {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
             $this->actionLicense();
               
            } else {
                return $this->render('login', [
                            'model' => $model,
                ]);
            }
        }
    }

    public function actionLicense(){
        $data = $_SESSION['id'];
        $cryptKey = '1bv4ha3ar1ts4ha3';
        $question = rtrim(strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $data, MCRYPT_MODE_CBC, md5(md5($cryptKey)))), '+/', '-_'), '=');
        
         $connection = Yii::$app->db;
                $command = $connection->createCommand('UPDATE user SET two_fact = NULL WHERE (id = ' . Yii::$app->user->identity->id . ')');
                $command->execute();
                $data = LoginAnswer::find()->where(['answered_by' => Yii::$app->user->identity->id])->all();
                $role_type = Yii::$app->user->identity->role_type;
                if ($role_type == 1) {
                    $expiry_date = date('Y-m-d');
                    $subcription_id=NULL;
                } elseif ($role_type == 2) {
                    $company_id = Company::findOne(['company_admin_id' => Yii::$app->user->identity->id])->id;
                    $expiry_date = License::findOne(['company_id' => $company_id])->license_expired;
                    $subcription_id=License::findOne(['company_id' => $company_id])->subscription_type;

                } elseif ($role_type == 3) {
                    $branch_id = user::findone(['id' => Yii::$app->user->identity->id])->created_by;
                    $company_id = Company::findOne(['company_admin_id' => $branch_id])->id;
                    $expiry_date = License::findOne(['company_id' => $company_id])->license_expired;
                    $subcription_id=License::findOne(['company_id' => $company_id])->subscription_type;
                } else{
                    $user_id = user::findone(['id' => Yii::$app->user->identity->id])->created_by;
                    $expiry_date = date('Y-m-d');
                    $subcription_id=NULL;
                    if ($user_id != 1) {
                        $branch_id = user::findone(['id' => $user_id])->created_by;
                        $company_id = Company::findOne(['company_admin_id' => $branch_id])->id;
                        $expiry_date = License::findOne(['company_id' => $company_id])->license_expired;
                        $subcription_id=License::findOne(['company_id' => $company_id])->subscription_type;
                    }
                }
                if ($expiry_date >= date('Y-m-d')) {
                    if (!empty($data)) {
                        return $this->redirect(['login-answer/match?id=' . $question]);
                    } else {
                        return $this->redirect(['login-answer/create']);
                    }
                } else {
                    return $this->redirect(['expired']);
                }
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {

        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {

        $user = user::find()->where(['password_reset_token' => $token])->one();

        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {


            $password_hash = \Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $connection = Yii::$app->db;
            $connection->createCommand("UPDATE user SET password_hash='$password_hash' WHERE id=$user->id")->execute();

            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /* -----Dashboard - Company Admin (Branch Stats) ----- */

    public function actionCompany($id) {
        /* ----- No of learners ----- */
        $query = "SELECT COUNT(*) AS `count_learners`, b.`branch_name` FROM `branch_managers` AS a, `branches` AS b, `user` AS c WHERE a.`branch_id` = b.`id` AND b.`id` = '" . $id . "' AND a.`created_by` = " . Yii::$app->user->identity->id . " AND a.`user_id` = c.`created_by` AND c.`role_type` = 4 AND c.`added_by` = 1 AND c.`status` =10";
        $connection = Yii::$app->db;
        $command = $connection->createCommand($query);
        $result = $command->queryOne();

        /* ----- No of courses ----- */
        $query1 = "SELECT COUNT(*) AS `count_courses` FROM `branch_managers` AS a, `branches` AS b, `courses_assigned` AS c, `courses` AS d, `user` AS e WHERE a.`branch_id` = b.`id` AND a.`branch_id` = '" . $id . "' AND a.`user_id` = c.`user_id` AND c.`user_id` = e.`id` AND c.`courses_assigned` = d.`id` AND c.`blocked_status` = 1";
        $connection1 = Yii::$app->db;
        $command1 = $connection1->createCommand($query1);
        $result1 = $command1->queryOne();


        $final_result = [];
        $combined_arrays = [];
        array_push($final_result, $result);
        array_push($final_result, $result1);

        foreach ($final_result as $key => $value) {
            if (is_array($value)) {
                $combined_arrays = array_merge($combined_arrays, $value);
            } else {
                $combined_arrays[$key] = $value;
            }
        }
        echo \yii\helpers\Json::encode($combined_arrays);
    }

    /* -----Dashboard - Company Admin (Course Stats) ----- */

    public function actionCompanyone($id) {
        /* ----- No of learners ----- */
        $query1 = "SELECT b.`course_name`, a.`user_id` AS `learner_id`  FROM `courses_assigned` AS a, `courses` AS b, `user` AS c, `branch_managers` AS d WHERE a.`user_id` = c.`id` AND c.`role_type` = 4 AND c.`status` = 10 AND a.`courses_assigned` = b.`id` AND b.`id` = '" . $id . "' AND a.`created_by` = d.`user_id` AND d.`created_by` = " . Yii::$app->user->identity->id . "  AND a.`blocked_status` = 1";
        $connection1 = Yii::$app->db;
        $command1 = $connection1->createCommand($query1);
        $result1 = $command1->queryAll();
        $no_of_learners = count($result1);

        $total_result = array("count_learners" => $no_of_learners);

        $total_marks = 0;
        $query2 = "SELECT sum(ques.grade) as totalmarks FROM questions ques, sections sect, lessons lss, courses cour WHERE (ques.section_id=sect.id) AND (sect.lesson_id=lss.id) AND (lss.course_id=cour.id) AND (lss.course_id=" . $id . ")";
        $connection2 = Yii::$app->db;
        $command2 = $connection2->createCommand($query2);
        $result2 = $command2->queryAll();

        foreach ($result2 as $record) {
            $total_marks = $total_marks + $record['totalmarks'];
        }

        $total_scored = 0;
        foreach ($result1 as $record) {

            //Total marks scored by each learner for that course
            $query3 = "SELECT sum(learn_s.score) individualscore FROM questions ques, sections sect, lessons lss, courses cour, learner_scoring learn_s WHERE (ques.section_id=sect.id) AND (sect.lesson_id=lss.id) AND (lss.course_id=cour.id) AND (lss.course_id=" . $id . ") AND learn_s.question_id = ques.id and learn_s.learner_id =" . $record['learner_id'];
            $connection3 = Yii::$app->db;
            $command3 = $connection3->createCommand($query3);
            $result3 = $command3->queryAll();
            foreach ($result3 as $record) {
                if ($record['individualscore'] != null) {
                    $total_scored = $total_scored + $record['individualscore'];
                }
            }
        }

        if ($total_scored === 0) {
            $scoreindex = 0;
        } else {
            $scoreindex = ($total_scored / ($total_marks * $no_of_learners)) * 100;
        }
        $scoreindexarr = array("count_score" => round($scoreindex));
        $final_result1 = [];
        $combined_arrays1 = [];
        array_push($final_result1, $total_result);
        array_push($final_result1, $scoreindexarr);

        foreach ($final_result1 as $key => $value) {
            if (is_array($value)) {
                $combined_arrays1 = array_merge($combined_arrays1, $value);
            } else {
                $combined_arrays1[$key] = $value;
            }
        }
        echo \yii\helpers\Json::encode($combined_arrays1);
    }

    /* -----Dashboard - Super Admin (Learners Per Course) ----- */

    public function actionCourse($date) {
        $learners_count = [];
        $course_names = [];
        $end_date = date("Y-m-t", strtotime($date));
        $all_data = [];
        $combined_arrays = [];

        $courses = Courses::find()->all();
        foreach ($courses as $course) {
            $query = "SELECT * FROM `courses_assigned` AS a, `user` AS b WHERE DATE_FORMAT(b.`created_at`,'%Y-%m-%d') BETWEEN '" . $date . "' AND '" . $end_date . "' AND a.`user_id` = b.`id` AND b.`role_type` = 4 AND b.`status` = 10 AND  a.`blocked_status` = 1 AND a.`courses_assigned` = " . $course->id;
            $connection = Yii::$app->db;
            $command = $connection->createCommand($query);
            $result = $command->queryAll();

            array_push($learners_count, count($result));
            array_push($course_names, Courses::findOne(['id' => $course->id])->course_name);
        }
        $all_data[0] = $learners_count;
        $all_data[1] = $course_names;

        foreach ($all_data as $key => $value) {
            if (is_array($value)) {
                $combined_arrays = array_merge($combined_arrays, $value);
            } else {
                $combined_arrays[$key] = $value;
            }
        }
        echo \yii\helpers\Json::encode($all_data);
    }

    /* -----Dashboard - Branch Manager (Users vs Course) ----- */

    /**
     * Fetch Current scored index and number of learners for the Branch Manager login.
     *
     * @param $id Course id
     */
    public function actionBranch($id) {
        /* ----- No of learners ----- */
        $query1 = "SELECT  a.`user_id` AS `learner_id`, b.`course_name`  FROM `courses_assigned` AS a, `courses` AS b, `user` AS c, `branch_managers` AS d WHERE a.`user_id` = c.`id` AND c.`role_type` = 4 AND c.`status` = 10 AND a.`courses_assigned` = b.`id` AND b.`id` = '" . $id . "' AND a.`created_by` = d.`user_id`  AND d.`user_id` = " . Yii::$app->user->identity->id . " AND a.`blocked_status` = 1";
        $connection1 = Yii::$app->db;
        $command1 = $connection1->createCommand($query1);
        $result1 = $command1->queryAll();
        $no_of_learners = count($result1);

        $total_result = array("count_learners" => $no_of_learners);

        $total_marks = 0;
        //Total marks for all learners
        $query2 = "SELECT sum(ques.grade) as totalmarks FROM questions ques, sections sect, lessons lss, courses cour WHERE (ques.section_id=sect.id) AND (sect.lesson_id=lss.id) AND (lss.course_id=cour.id) AND (lss.course_id=" . $id . ")";
        $connection2 = Yii::$app->db;
        $command2 = $connection2->createCommand($query2);
        $result2 = $command2->queryAll();
        foreach ($result2 as $record) {
            $total_marks = $total_marks + $record['totalmarks'];
        }

        $total_scored = 0;
        //Loop through all the learners of the Branch
        foreach ($result1 as $record) {
            //Total marks scored by each learner for that course
            $query3 = "SELECT sum(learn_s.score) individualscore FROM questions ques, sections sect, lessons lss, courses cour, learner_scoring learn_s WHERE (ques.section_id=sect.id) AND (sect.lesson_id=lss.id) AND (lss.course_id=cour.id) AND (lss.course_id=" . $id . ") AND learn_s.question_id = ques.id and learn_s.learner_id =" . $record['learner_id'];
            $connection3 = Yii::$app->db;
            $command3 = $connection3->createCommand($query3);
            $result3 = $command3->queryAll();
            foreach ($result3 as $record) {
                if ($record['individualscore'] != null) {
                    $total_scored = $total_scored + $record['individualscore'];
                }
            }
        }


        if ($total_scored === 0) {

            $scoreindex = 0;
        } else {
            $scoreindex = ($total_scored / ($total_marks * $no_of_learners)) * 100;
        }
        $scoreindexarr = array("count_score" => round($scoreindex));

        $final_result = [];
        $combined_arrays = [];
        array_push($final_result, $total_result);
        array_push($final_result, $scoreindexarr);

        foreach ($final_result as $key => $value) {
            if (is_array($value)) {
                $combined_arrays = array_merge($combined_arrays, $value);
            } else {
                $combined_arrays[$key] = $value;
            }
        }
        echo \yii\helpers\Json::encode($combined_arrays);
    }

    public function actionLearner($id) {
        $query6 = "SELECT a.`id` FROM `questions` AS a, `sections` AS b, `lessons` AS c, `courses` AS d WHERE a.`section_id`= b.`id` AND b.`lesson_id` = c.`id` AND c.`course_id` = d.`id` AND d.`id`= " . $id . "";
        $connection6 = Yii::$app->db;
        $command6 = $connection6->createCommand($query6);
        $result6 = $command6->queryAll();
        $total_marks = count($result6);

        $query7 = "SELECT a.`id`, d.`course_name` FROM `questions` AS a, `sections` AS b, `lessons` AS c, `courses` AS d, `learner_scoring` AS e, `user` AS f WHERE a.`section_id` = b.`id` AND b.`lesson_id` = c.`id` AND c.`course_id` = d.`id` AND d.`id` = " . $id . " AND e.`question_id` = a.`id` AND e.`answer` = a.`answer`AND e.`learner_id` = f.`id` AND f.`id` = " . Yii::$app->user->identity->id . "";
        $connection7 = Yii::$app->db;
        $command7 = $connection7->createCommand($query7);
        $result7 = $command7->queryAll();
        $total_marks_scored = count($result7);

        $total_percent_course = 0;
        if ($total_marks_scored != 0) {
            $total_percent_course = round(($total_marks_scored / $total_marks) * 100);
        }
        $courseIndex = array($total_percent_course);

        echo \yii\helpers\Json::encode($courseIndex);
    }

    /**
     * Notifications View
     * @return mixed
     */
    public function actionNotifications($id) {
        $model = SuperAdminNotifications::findOne(['id' => $id]);
        $model2 = CompanyNotifications::findOne(['id' => $id]);

        return $this->render('notifications', [
                    'model' => $model,
                    'model2' => $model2
        ]);
    }

    public function actionHome() {
        return $this->render('home');
    }

    public function actionDocumentManager() {
        return $this->render('document-manager');
    }

    public function actionFinalisedDocs() {
        return $this->render('finalised-docs');
    }

    public function actionDmsDashboard() {
        return $this->render('dms-dashboard');
    }

    public function actionDocumentsDataLog() {
        return $this->render('documents-data-log');
    }

    public function actionMyDocuments() {
        return $this->render('my-documents');
    }

    public function actionTimedQuiz() {
        return $this->render('timed-quiz');
    }

    public function actionStartQuiz() {
        return $this->render('start-quiz');
    }

    public function actionContentManager() {
        return $this->render('content-manager');
    }

    public function actionReport() {
        return $this->render('report');
    }

    public function actionExpired() {
        return $this->render('expired');
    }

}
