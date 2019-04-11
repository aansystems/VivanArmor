<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\User;

use frontend\models\Courses;
use frontend\models\CoursesAssigned;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LearnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Learners';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$role_type = Yii::$app->user->identity->role_type;
?>
<!--style for block icon-->
<style>
   .btn:not(.btn-just-icon):not(.btn-fab) .fa {
    font-size: 18px;
    margin-top: -2px;
    position: relative;
    top: 2px;
}

.empty {
    text-align: center;
}


</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">USERS/LEARNERS </h4>
                        <a href="<?= Yii::$app->request->baseUrl ?>/learners/create">
                            <button type="button" class="btn btn-primary btn-round btn-fab btn-fab-mini pull-right ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>

                    </div>
                    <div class="card-content ">

                        <div class="material-datatables">


                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">

                                    <?php $dataProvider->pagination->pageSize = 5;  ?>
                                       
                                    <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
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
                                                'label' => 'Mobile Number',
                                                'value' => function ($model, $index) {
                                                    return User::findOne(['id' => $model->user_id])->phone;
                                                }
                                            ],
                                            'designation',
                                            [
                                                'label' => 'Courses Assigned',
                                                'value' => function ($model, $index, $widget) {

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
                                            [
                                                'label' => 'Blocked Courses',
                                                'value' => function ($model, $index, $widget) {

                                                    $courses_assigned_list = CoursesAssigned::find()
                                                            ->where(['user_id' => $model->user_id, 'blocked_status' => 0])
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
                                            [
                                                'class' => 'yii\grid\ActionColumn',
                                                'header' => 'Actions',
                                                'template' => '{view} {update} {delete} {download}',
                                                'buttons' => [
                                                    'download' => function ($url, $model, $key) {
                                                        if (Yii::$app->user->identity->role_type !=3) {
                                                            return Html::a(
                                                                            '<span class="fa fa-ban"></span>', ['learners/blocked-courses', 'id' => $model->id], [
                                                                        'title' => 'Block',
                                                                        'data-pjax' => '0',
                                                                                'class'=>'btn btn-primary btn-simple waves-effect ',
                                                                            ]
                                                            );
                                                        }
                                                    },
                                                ],
                                            ],
                                        ],
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('div.empty').attr('id', 'empty');
            document.getElementById("empty").innerHTML = "No Records Found";
    });

</script>