<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\LoginAnswer */


$this->params['breadcrumbs'][] = ['label' => 'Login Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row design">   
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
       
       
    ]) ?>   
    </div>
        
