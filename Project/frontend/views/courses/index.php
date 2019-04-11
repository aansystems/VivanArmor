<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\MasterCourseTypes;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CoursesAvailableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Course Manager';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .table>thead>tr:first-child>th:first-child, .table>tbody>tr:first-child>td:first-child {
    width: 5% !important;
}
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">COURSE MANAGER </h4>
                        <a href="<?= Yii::$app->request->baseUrl ?>/courses/create">
                            <button type="button" class="btn btn-primary btn-round btn-fab btn-fab-mini pull-right ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>

                    </div>
                    <div class="card-content ">

                        <div class="material-datatables">

                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">
                                    <?php Pjax::begin(['id' => 'coursesavailable']); ?>
                                    <?php $dataProvider->pagination->pageSize = 5; ?>
                                    <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            [
                                                'label' => 'Course Type',
                                                'value' => function ($model, $index, $widget) {
                                                    return MasterCourseTypes::findOne(['id' => $model->course_type_id])->course_type_name;
                                                },
                                                'filter' => Html::activeDropDownList($searchModel, 'course_type_id', ArrayHelper::map(MasterCourseTypes::find()->all(), 'id', 'course_type_name'), ['class' => 'form-control', 'prompt' => 'Select Course Type']),
                                            ],
                                            'course_name',
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

