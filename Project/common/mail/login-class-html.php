<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $user common\models\User */
//Yii::$app->request->baseUrl . '/big-blue-button/join-meeting?meeting_id=' .$meeting_id;
//$resetLink =Yii::$app->request->baseUrl . '/big-blue-button/attendee-join-meeting?meeting_id=' .$meeting_id;
//$link='http://52.14.195.175'.$resetLink ;
$link = Yii::$app->urlManager->createAbsoluteUrl(['/big-blue-button/attendee-join-meeting?meeting_id=' .$meeting_id]);
?>

<div class="password-reset">
    <p>Hello </p>
    <p>starting time of the class::<?php echo $datetime;?>  GMT-4</p>
    <p>your login password: <?php echo $attendee_password;?></p>
    
    <h4>follow the link to login:</h4>
    <p><?= Html::a(Html::encode($link), $link) ?></p>
    


</div>