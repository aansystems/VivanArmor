<?php

use frontend\models\User;
use frontend\models\Branches;
use frontend\models\Courses;
use frontend\models\CoursesAssigned;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MasterBranchmanager */

$this->title = 'Branch Manager View';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">VIEW BRANCH MANAGER </h4>
                    </div>
                    <div class="card-content">
                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'branch_id',
                                [
                                    'label' => 'Branch Name',
                                    'value' => function ($model, $index) {
                                        return Branches::findOne(['id' => $model->branch_id])->branch_name;
                                    }
                                ],
                                [
                                    'label' => 'Branch Manager Name',
                                    'value' => function ($model, $index) {
                                        return User::findOne(['id' => $model->user_id])->first_name;
                                    }
                                ],
                                [
                                    'label' => 'Branch Manager Email',
                                    'value' => function ($model, $index) {
                                        return User::findOne(['id' => $model->user_id])->email;
                                    }
                                ],
                                        [
                                    'label' => 'Branch Manager Mobile Number',
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
                        <?= Html::a('Back', ['/branch-managers/index'], ['class' => 'btn btn-primary pull-right']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
