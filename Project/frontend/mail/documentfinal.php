<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/login']);
?>


<div class="notifications">
    <p>Hello</p>
    
    <p> Document Name "<h4><?php echo $doc_name;?></h4>"</p>
<p> Document Type "<h4><?php echo $doc_type;?></h4>"  is Added to you Library.</p>

    <h4>follow the link to login:</h4>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

</div>