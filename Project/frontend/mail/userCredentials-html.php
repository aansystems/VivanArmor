<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>

<div class="password-reset">
    <p>Hello <?= Html::encode($user->first_name) ?></p>
    <p>your login id: <?php echo $user->email;?></p>
    <p>your login password: <?php echo $password;?></p>
    
    <h4>follow the link to login:</h4>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
    


</div>
