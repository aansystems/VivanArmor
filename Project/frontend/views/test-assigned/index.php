<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\User;
use frontend\models\Subjects;
use frontend\models\MasterRoleTypes;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TestAssignedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Assigned';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.empty {
    text-align: center;
}
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
                        <h4 class="card-title">TEST ASSIGNED</h4>
                           <a href="<?= Yii::$app->request->baseUrl ?>/test-assigned/create">
                            <button type="button" class="btn btn-primary btn-round btn-fab btn-fab-mini pull-right ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>
                    </div>
                    <div class="card-content ">

                        <div class="material-datatables">

                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
                                                        [
                                                'label' => 'User Id',
                                                'value' => function ($model, $index) {
                                                    return User::findOne(['id' => $model->user_id])->email;
                                                }
                                            ],
                                                                                                            [
                                                'label' => 'Role',
                                                'value' => function ($model, $index) {
                                                    $role= User::findOne(['id' => $model->user_id])->role_type;
                                                         return MasterRoleTypes::findOne(['id'=>$role])->role_name;
                                                }
                                            ],
         //   'user_id',
           // 'subject_assigned',
                                                                                                            [
                                                'label' => 'Quiz Name',
                                                'value' => function ($model, $index) {
                                                    return Subjects::findOne(['id' => $model->subject_assigned])->quiz_name;
                                                }
                                            ],
           // 'blocked_status',
            'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            [                                                'class' => 'yii\grid\ActionColumn',
                                                'header' => 'Actions',
                                                'template' => '{view} {delete}',],
        ],
    ]); ?>
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
