<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>


<div class="notifications">
    <p>Hello</p>
    
    <p> OTP to access Restricted & Confidential contents of "<h4><?php echo $content_name;?></h4>"</p>
<P> <strong>OTP: <?php echo $random_pass;?></strong>  </p>
    <h4>follow the link to login:</h4>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

</div>