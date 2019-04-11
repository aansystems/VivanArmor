<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TestAssigned */

$this->title = 'Assign Tests';
$this->params['breadcrumbs'][] = ['label' => 'Test Assigneds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">ASSIGN TESTS </h4>
                    </div>
                    <div class="card-content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
