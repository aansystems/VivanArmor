<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\User;
use frontend\models\Courses;
use frontend\models\CoursesAssigned;

/* @var $this yii\web\View */
/* @var $model frontend\models\Learners */

$this->title = 'Learners View';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px;
        background: #e91e63;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">VIEW USER/LEARNER </h4>

                    </div>
                    <div class="card-content">
                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'label' => 'Learner Name',
                                    'value' => function ($model, $index) {
                                        return User::findOne(['id' => $model->user_id])->first_name;
                                    }
                                ],
                                [
                                    'label' => 'Email',
                                    'value' => function ($model, $index) {
                                        return User::findOne(['id' => $model->user_id])->email;
                                    }
                                ],
                                [
                                    'label' => 'Phone',
                                    'value' => function ($model, $index) {
                                        return User::findOne(['id' => $model->user_id])->phone;
                                    }
                                ],
                                [
                                    'label' => 'Courses Assigned',
                                    'value' => function ($model, $index) {
                                        $courses_assigned_list = CoursesAssigned::find()
                                                ->where(['user_id' => $model->user_id, 'blocked_status' => 1])
                                                ->all();
                                        $courses_array = [];
                                        foreach ($courses_assigned_list as $course) {
                                            $course_name = Courses::findOne(['id' => $course->courses_assigned])->course_name;
                                            array_push($courses_array, $course_name);
                                        }
                                        $a = implode($courses_array, ', ');
                                        return $a;
                                    }
                                ],
                            ],
                        ])
                        ?>


                    </div>
                    <div class="col-md-12">
                        <?= Html::a('Back', ['/learners/index'], ['class' => 'btn btn-primary pull-right']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

