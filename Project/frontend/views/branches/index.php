<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\Branches;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MasterBranchmanagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Branch Master';
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
                        <h4 class="card-title">BRANCH MASTER </h4>
                        <a href="<?= Yii::$app->request->baseUrl ?>/branches/create">
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
                                                    [
                                                        'label' => 'Branch Name',
                                                        'value' => function ($model, $index, $widget) {
                                                            return Branches::findOne(['id' => $model->id])->branch_name;
                                                        }
                                                    ],
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

