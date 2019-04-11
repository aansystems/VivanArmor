<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\Branches;
use frontend\models\User;
use frontend\models\Courses;
use frontend\models\CoursesAssigned;
use frontend\models\Tiles;
use frontend\models\TilesAssigned;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MasterBranchmanagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Branch Manager';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
       .table>thead>tr:first-child>th:first-child,.table>tbody>tr:first-child>td:first-child{
        width:5% !important;
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
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">BRANCH MANAGER </h4>
                        <a href="<?= Yii::$app->request->baseUrl ?>/branch-managers/create">
                            <button type="button" class="btn btn-primary btn-round btn-fab btn-fab-mini pull-right ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>

                    </div>
                    <div class="card-content ">

                        <div class="material-datatables">
                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php Pjax::begin(); ?>
                                            <?php $dataProvider->pagination->pageSize = 5; ?>

                                            <?=
                                            GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
                                                'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                    //'id',
                                                    //'branch_id',
                                                    [
                                                        'label' => 'Branch Name',
                                                        'value' => function ($model, $index, $widget) {
                                                            return Branches::findOne(['id' => $model->branch_id])->branch_name;
                                                        }
                                                    ],
                                                    [
                                                        'label' => 'Branch Manager Name',
                                                        'value' => function ($model, $index, $widget) {
                                                            return User::findOne(['id' => $model->user_id])->first_name;
                                                        }
                                                    ],
                                                    [
                                                        'label' => 'Branch Manager Email',
                                                        'value' => function ($model, $index, $widget) {
                                                            return User::findOne(['id' => $model->user_id])->email;
                                                        }
                                                    ],
                                                    [
                                                        'label' => 'Branch Manager Mobile Number',
                                                        'value' => function ($model, $index, $widget) {
                                                            return User::findOne(['id' => $model->user_id])->phone;
                                                        }
                                                    ],
                                                    /* [
                                                      'label'=>'Courses',
                                                      'value'=>function ($model, $index, $widget) {
                                                      return Courses::findOne(['user_id' => $model->id])->course_name;
                                                      }
                                                      ], */
                                                    [
                                                        'label' => 'Courses Assigned',
                                                        'value' => function ($model, $index, $widget) {
                                                            // echo $model->user_id;
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
                                                            // echo $model->user_id;
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
//                                                    [
//                                                        'label' => 'Key Materials Assigned',
//                                                        'value' => function ($model, $index, $widget) {
//                                                            // echo $model->user_id;
//                                                            $tiles_assigned_list = TilesAssigned::find()
//                                                                    ->where(['user_id' => $model->user_id, 'blocked_status' => 1])
//                                                                    ->all();
//                                                            $tiles_array = [];
//                                                            foreach ($tiles_assigned_list as $tile) {
//                                                                $tile_name = Tiles::findOne(['id' => $tile->tiles_assigned])->tile_name;
//                                                                array_push($tiles_array, $tile_name);
//                                                            }
//                                                            $a = implode($tiles_array, ', ');
//                                                            return $a;
//                                                        }
//                                                    ],
//                                                    [
//                                                        'label' => 'Blocked Key Materials',
//                                                        'value' => function ($model, $index, $widget) {
//                                                            // echo $model->user_id;
//                                                            $tiles_assigned_list = TilesAssigned::find()
//                                                                    ->where(['user_id' => $model->user_id, 'blocked_status' => 0])
//                                                                    ->all();
//                                                            $tiles_array = [];
//                                                            foreach ($tiles_assigned_list as $tile) {
//                                                                $tile_name = Tiles::findOne(['id' => $tile->tiles_assigned])->tile_name;
//                                                                array_push($tiles_array, $tile_name);
//                                                            }
//                                                            $a = implode($tiles_array, ', ');
//                                                            return $a;
//                                                        }
//                                                    ],
                                                    /* [
                                                      'label'=>'Tiles Assigned',
                                                      'value'=>function ($model, $index, $widget) {
                                                      return Tiles::findOne(['id' => $model->id])->tile_name;
                                                      }
                                                      ], */
                                                    //'branch_manager_name',
                                                    //'branch_manager_email:email',
                                                    //'user_id',
                                                    //'status',
                                                    //'created_by',
                                                    //'created_at',
                                                    //'updated_by',
                                                    //'updated_at',
                                                    ['class' => 'yii\grid\ActionColumn',
                                                        'header' => 'Actions',
                                                    ],
                                                ],
                                            ]);
                                            ?>
                                            <?php Pjax::end(); ?>
                                        </div>
                                    </div>
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

