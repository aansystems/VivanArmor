<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\User;
use frontend\models\Subjects;
/* @var $this yii\web\View */
/* @var $model frontend\models\TestAssigned */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Test Assigneds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">VIEW USER/LEARNER </h4>

                    </div>
                    <div class="card-content">

    <?= DetailView::widget([
        'model' => $model,
                                        
        'attributes' => [
           // 'id',
//            'user_id',
            [
                                            'label'=>'User Id',
                                   'value'=>function($model,$index){
                                    return user::findOne(['id'=>$model->user_id])->email;
                                   }
                                        ],
          //  'subject_assigned',
                                                [
                                                    'label'=>'Subject Assigned',
                                                    'value'=>function($model,$index){
                                            return Subjects::findOne(['id'=>$model->subject_assigned])->subject_name;
                                                    }
                                                ],
           // 'blocked_status',
            'created_at',
           // 'created_by',
           // 'updated_at',
           // 'updated_by',
        ],
    ]) ?>


                    </div>
                    <div class="col-md-12">
                        <?= Html::a('Back', ['/test-assigned/index'], ['class' => 'btn btn-primary pull-right']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>