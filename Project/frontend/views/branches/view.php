<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Branches;

/* @var $this yii\web\View */
/* @var $model frontend\models\MasterBranch */

$this->title = 'Branch Master View';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">VIEW BRANCH MASTER </h4>

                    </div>
                    <div class="card-content">
                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'id',

                                [
                                    'label' => 'Branch Name',
                                    'value' => function ($model, $index) {
                                        return Branches::findOne(['id' => $model->id])->branch_name;
                                    }
                                ],

                            ],
                        ])
                        ?>

                    </div>
                    <div class="col-md-12">
                        <?= Html::a('Back', ['/branches/index'], ['class' => 'btn btn-primary pull-right']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

