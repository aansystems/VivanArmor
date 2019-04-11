<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TimedQuiz */

$this->title = 'Update Timed Quiz: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Timed Quizzes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="timed-quiz-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
