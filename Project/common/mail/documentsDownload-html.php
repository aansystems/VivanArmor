<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>


<div class="notifications">
    <p>Hello</p>
    
    <p> document "<h4><?php echo $doc_name;?></h4>" is ready to download</p>
<p><h3>password : </h3><?php echo $random_pass;?></p>
    <h4>follow the link to login:</h4>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

</div>