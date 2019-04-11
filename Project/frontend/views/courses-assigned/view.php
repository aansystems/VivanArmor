<?php

use frontend\models\Courses;
use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\models\CoursesAvailable */

$this->title = 'View Course';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover{
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
                        <h4 class="card-title">VIEW COURSES </h4>
                    </div>
                    <div class="card-content">

                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                
                                [
                                    'label' => 'User Name',
                                    'value' => function ($model, $index) {
                                        $course_name = User::findOne(['id' => $model->user_id])->first_name;
                                        return $course_name;
                                    }
                                ],
                                [
                                    'label' => 'Course Name',
                                    'value' => function ($model, $index) {
                                        $course_name = Courses::findOne(['id' => $model->courses_assigned])->course_name;
                                        return $course_name;
                                    }
                                ],
                                [
                                    'label' => 'Course Description',
                                    'value' => function ($model, $index) {
                                        return Courses::findOne(['id' => $model->courses_assigned])->course_description;
                                    }
                                ],
                            ],
                        ])
                        ?>
                        <div class="form-group">
                            <?= Html::a('Back', ['/courses-assigned/index'], ['class' => 'btn btn-primary pull-right']) ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

