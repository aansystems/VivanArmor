<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>


<div class="notifications">
    <p>Hello</p>
    
    <p> <h4><?php echo $from_user;?></h4> assigned documents for approval</p>
<p><h3>comment : </h3><?php echo $comment;?></p>
    <h4>follow the link to login:</h4>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

</div>