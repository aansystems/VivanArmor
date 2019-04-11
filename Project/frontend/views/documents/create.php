<?php



/* @var $this yii\web\View */
/* @var $model frontend\models\Documents */

$this->title = 'Create Documents';
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
            .form-group.label-floating:not(.is-empty) label.control-label{
         top: -38px !important;   
        }   
        .btn.btn-danger{
            padding: 12px 1px 7px 1px !important;
    width: 80px !important;
    margin: 10px 0px !important;
    background: #f44336;
        }
        .btn.btn-success{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 5px !important;
    }
    li{
            padding-left: 0em;
            margin-left: 0px !important;
        }
        ul{
            margin-left: 0px !important;
        }
        .skin-blue .main-header .navbar {
   
    height: 50px;
}
    </style>
<div class="documents-create">


    <?= $this->render('_form', [
        'model' => $model,
            'model1' => $model1,
        'model2' => $model2,
    ]) ?>

</div>
