<?php

use frontend\models\Courses;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LearnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blocked Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .empty{
            text-align: center;
    }
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">BLOCKED COURSES </h4>
                    </div>
                    <div class="card-content ">

                        <div class="material-datatables">


                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">

                                    <?php $dataProvider->pagination->pageSize = 5; ?>
                                    <?php Pjax::begin(); ?>
                                    <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            //'id',
                                            //'user_id',
                                            //'course_id',
                                            //'created_at',
                                            //'created_by',
                                            [
                                                'label' => 'Course Name',
                                                'value' => function ($model, $index, $widget) {
                                                    $course_name = Courses::findOne(['id' => $model->course_id])->course_name;
                                                    return $course_name;
                                                }
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
<script>
    $(document).ready(function(){
        $('div.empty').attr('id', 'empty');
            document.getElementById("empty").innerHTML = "No Records Found";
    });

</script>

