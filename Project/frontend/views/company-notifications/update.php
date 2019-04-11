
<?php


/* @var $this yii\web\View */
/* @var $model frontend\models\CompanyNotifications */

$this->title = 'Notifications Update';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title">UPDATE NOTIFICATIONS </h4>
                    </div>
                    <div class="card-content">
                        <?=
                        $this->render('_form', [
                            'model' => $model,
                            'model2' => $model2
                        ])
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

