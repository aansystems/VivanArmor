<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\User;
use frontend\models\MasterRoleTypes;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notifications';
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
                        <h4 class="card-title">NOTIFICATIONS</h4>
                        <a href="<?= Yii::$app->request->baseUrl ?>/super-admin-notifications/create">
                            <button type="button" class="btn btn-primary btn-round btn-fab btn-fab-mini pull-right ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>
                    </div>
                    <div class="card-content ">
                        <div class="material-datatables">
                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">
                                    <?php $dataProvider->pagination->pageSize = 5; ?>
                                    <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            //'id',
                                            [
                                                'label' => 'Assigned From',
                                                'value' => function ($model, $index) {
                                                    return User::findOne(['id' => $model->assigned_from])->first_name;
                                                }
                                            ],
                                            [
                                                'label' => 'Assigned To',
                                                'value' => function ($model, $index) {
                                                    return User::findOne(['id' => $model->assigned_to])->email;
                                                }
                                            ],
                                            [
                                                'label' => 'Role Type',
                                                'value' => function ($model, $index) {
                                                    $role_type = User::findOne(['id' => $model->assigned_to])->role_type;
                                                    return MasterRoleTypes::findOne(['id' => $role_type])->role_name;
                                                }
                                            ],
                                            'message:ntext',
                                            'start_date',
                                            'end_date',
                                            ['class' => 'yii\grid\ActionColumn',
                                                'header' => 'Actions',
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
