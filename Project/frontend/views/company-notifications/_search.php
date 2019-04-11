<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompanyNotificationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-notifications-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'assigned_from') ?>

    <?= $form->field($model, 'assigned_to') ?>

    <?= $form->field($model, 'message') ?>

    <?= $form->field($model, 'start_date') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
