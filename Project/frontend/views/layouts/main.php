<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
AppAsset::register($this);

$roll = '';
if (isset(\Yii::$app->user->identity->role_type)) {
    $roll = \Yii::$app->user->identity->role_type;
}
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?= Yii::$app->request->baseUrl ?>/images/Favicon.png">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>        
    </head>
    
    <body class="hold-transition skin-blue sidebar-mini">        
        <?php $this->beginBody() ?>
        <?php if ($roll != "" && $base != "site/reset-password" && $base != "site/error" && $base != "documents/assign-to" &&  $base != "documents/approve" && $base != "documents/reject" && $base != "documents/doc-view" && $base != "documents/finalize" && $base != "documents/doc-password" && $base != "documents/authenticate" && $base != "contents/authenticate" && $base != "login-answer/create" && $base != "login-answer/match" && $base != "site/expired" && $base != "timed-quiz/timed-quiz" &&  $base != "timed-quiz/quiz-completion" &&  $base != "timed-quiz/error") { ?>
            <div class="wrapper">

                <?= $this->render('side-bar.php') ?>
                <?= $this->render('nav-bar.php') ?>
                <div class="content-wrapper">
                    <section class="content"> 
                        <?= $content ?>
                    </section>
                </div>

                <div class="row" id="footer">
                    <?php if ($base == "learner-activity/lessons" || $base == "learner-activity/ebooks" || $base == "learner-scoring/questions" || $base == "review-material-scoring/review-material-score") : ?> 
                        <div class="col-md-2"></div>
                        <div class="col-md-10 col-sm-offset-2 text-center">
                         <?= $this->render('//site/access-buttons.php') ?> 
                        </div>
                    <?php endif; ?>


                </div>
            </div>
        <?php } else { ?>
            <?= $content ?>        
        <?php } ?>

        <?= \lavrentiev\widgets\toastr\NotificationFlash::widget() ?>
        <?php $this->endBody() ?> 
    </body>

</html>

<?php $this->endPage() ?>
