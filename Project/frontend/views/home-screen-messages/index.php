<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\HomeScreenMessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Home Screen Messages';
$this->params['breadcrumbs'][] = $this->title;
$role_type = Yii::$app->user->identity->role_type;
?>
<style>
     .table>thead>tr:first-child>th:first-child,.table>tbody>tr:first-child>td:first-child{
        width:5% !important;
    }

     table.dataTable>tbody>tr>td:nth-child(2){
         width: 30% !important;
        word-break: break-all !important;
    }
    th.action-column{
        width: 220px;
    }
  .table .td-actions {
    display:table-cell  !important;
    vertical-align: middle !important;
}

 .empty{
            text-align: center;
    }
    
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">HOME SCREEN MESSAGES </h4>
                        <a href="<?= Yii::$app->request->baseUrl ?>/home-screen-messages/create">
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
            'assigned_to',
            'title',
            'content:ntext',
            'attachment', 
            'start_date',
            'end_date',

              ['class' => 'yii\grid\ActionColumn',
                                                'header' => '  Actions',
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

