<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CertificatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certificates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'learner_id') ?>

    <?= $form->field($model, 'certificate_name') ?>

    <?= $form->field($model, 'certifying_authority') ?>

    <?= $form->field($model, 'issue_date') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
