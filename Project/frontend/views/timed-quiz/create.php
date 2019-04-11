<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TimedQuiz */

$this->title = 'Create Timed Quiz';
$this->params['breadcrumbs'][] = ['label' => 'Timed Quizzes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timed-quiz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
