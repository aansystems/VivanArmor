<?php

//use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
//use yii\helpers\ArrayHelper;
use frontend\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Company Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    
     .table>thead>tr:first-child>th:first-child,.table>tbody>tr:first-child>td:first-child{
        width:5% !important;
    }

     @media (min-width: 768px) {
        .card .table {
    word-break: break-all;
        }
                }
          
        table.dataTable>thead>tr>th {
            white-space: nowrap;
            }
    
            .empty {
    text-align: center;
}
.btn:not(.btn-just-icon):not(.btn-fab) .fa, 
.navbar .navbar-nav > li > a.btn:not(.btn-just-icon):not(.btn-fab) .fa {

     margin-top: 5px; 
}
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">COMPANY ADMINS</h4>
                        <a href="<?= Yii::$app->request->baseUrl ?>/company/create">
                            <button type="button" class="btn btn-primary btn-round btn-fab btn-fab-mini pull-right ">
                                <i class="fa fa-plus"></i>
                            </button>
                        </a>

                    </div>
                    <div class="card-content ">

                        <div class="material-datatables">


                            <div class="row">
                                <div class="col-md-12" style="overflow-x: auto;">
                                    <?php Pjax::begin(); ?>
                                    <?php $dataProvider->pagination->pageSize = 5; ?>

                                    <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            'company_name',
                                            'website',
                                            [
                                                'label' => 'Admin Name',
                                                'value' => function ($model, $index) {
                                                    return User::findOne(['id' => $model->company_admin_id])->first_name;
                                                }
                                            ],
                                            [
                                                'label' => 'Admin Email',
                                                'value' => function ($model, $index) {
                                                    return User::findOne(['id' => $model->company_admin_id])->email;
                                                }
                                            ],
                                            [
                                                'label' => 'Admin Mobile Number',
                                                'value' => function ($model, $index) {
                                                    return User::findOne(['id' => $model->company_admin_id])->phone;
                                                }
                                            ],
                                            [
                                                'class' => 'yii\grid\ActionColumn',
                                                'header' => 'Actions',
                                                'template' => '{view} {update} {delete} {download}',
                                                'buttons' => [
                                                    'download' => function ($url, $model, $key) {
                                                        return Html::a(
                                                                        '<span class="fa fa-ban"></span>', ['company/blocked-courses', 'id' => $model->id], [
                                                                    'title' => 'Block',
                                                                    'data-pjax' => '0',
                                                                            'class'=>'btn btn-primary btn-simple waves-effect ',
                                                                        ]
                                                        );
                                                    },
                                                ],
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
document.getElementsByClassName('form-control')[0].placeholder='Search';
document.getElementsByClassName('form-control')[1].placeholder='Search';


$(document).ready(function(){
    $('div.empty').attr('id', 'empty');
        document.getElementById("empty").innerHTML = "No Records Found";
});


</script>