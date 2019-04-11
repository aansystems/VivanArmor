<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use frontend\models\Company;
use frontend\models\User;
use frontend\models\Courses;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Blocked Courses';

?>

<?php
$blocked_ids = [];
$blocked_course_names = [];

$connection = Yii::$app->db;

$query_one = "SELECT a.`course_id` FROM `blocked_courses` AS a, `courses_assigned` AS b WHERE a.`course_id` = b.`courses_assigned` AND a.`user_id` = b.`user_id` AND a.`user_id` ='" . $model->company_admin_id . "'";
$command_one = $connection->createCommand($query_one);
$courses_blocked = $command_one->queryAll();

foreach ($courses_blocked as $blocked) {
    array_push($blocked_ids, $blocked['course_id']);

    $course_name = Courses::findOne(['id' => $blocked['course_id']])->course_name;
    array_push($blocked_course_names, $course_name);
}

$final_blocked_ids = implode(',', $blocked_ids);
$final_course_names = implode(',', $blocked_course_names);

if ($final_blocked_ids != "") {
    $query_two = "SELECT b.`id`, b.`course_name` FROM `courses_assigned` AS a, `courses` AS b WHERE a.`courses_assigned`=b.`id` AND a.`courses_assigned` NOT IN(" . $final_blocked_ids . ")";
    $command_two = $connection->createCommand($query_two);
    $available_courses = $command_two->queryAll();
} else {
    $query = new Query();
    $query->select(['courses.id', 'courses.course_name'])
            ->from('courses')
            ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned =courses.id'
            )
            ->where(['courses_assigned.user_id' => $model->company_admin_id]);
    $command = $query->createCommand();
    $filtered_courses = $command->queryAll();
}
?>
<style>
.btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px !important;
        background: #f44336;
    }
    .btn.btn-success{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px !important;
    }
    </style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">BLOCKED COURSES</h4>
                    </div>
                    <div class="card-content">
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?php
                                $company = Company::findOne(['id' => $model->company_admin_id]);
                                ?>
                                <?php
                                $user = User::findOne(['id' => $model->company_admin_id]);
                                ?>
                                <h4 class="card-title">COMPANY DETAILS</h4>
                                <table  class="table table-striped table-bordered detail-view">
                                    <tbody>
                                        <tr><th>COMPANY NAME</th><td><?php echo $model->company_name ?></td></tr>
                                        <tr><th>COMPANY ADMIN</th><td><?php echo $user->first_name ?></td></tr>
                                        <tr><th>COURSES BLOCKED</th><td><?php echo $final_course_names ?></td></tr>

                                    </tbody>
                                </table>
                                <?php
                                if ($final_blocked_ids != "") {

                                    $query = new Query();
                                    $query->select(['courses.id', 'courses.course_name'])
                                            ->from('courses')
                                            ->join('INNER JOIN', 'courses_assigned', 'courses_assigned.courses_assigned =courses.id'
                                            )
                                            ->where(['courses_assigned.user_id' => $model->company_admin_id, 'courses_assigned.blocked_status' => 1]);
                                    $command = $query->createCommand();
                                    $filtered_course = $command->queryAll();
                                    ?>
                                    <?=
                                    
                                    $form->field($model2, 'course_id')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map($filtered_course, 'id', 'course_name'),
                                        'options' => [
                                            'placeholder' => 'Select Courses To Block...'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'multiple' => 'multiple'
                                        ]
                                    ])->label(false)
                                    ?>
                                <?php } else { ?>
                                    <?=
                                    $form->field($model2, 'course_id')->widget(Select2::classname(), [
                                        'data' => ArrayHelper::map($filtered_courses, 'id', 'course_name'),
                                        'options' => [
                                            'placeholder' => 'Select Courses To Block...'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                            'multiple' => 'multiple'
                                        ]
                                    ])->label(false)
                                    ?>
                                <?php } ?>
                            </div> 
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
                            <?= Html::a('Cancel', ['/company/index'], ['class' => 'btn btn-primary pull-right']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
