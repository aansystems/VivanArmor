<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>


<div class="notifications">
    <p>Hello</p>
    
    <p> content "<h4><?php echo $content_name;?></h4>" is ready in your content library</p>
    <h4>follow the link to login:</h4>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

</div>