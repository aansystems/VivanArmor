<?php

use yii\helpers\Html;
?>

<div class="content">
    <div class="container-fluid">                   
        <div class="row">
            <div class=" col-md-12">
                <div class="shadow">
                    <div class="card-content">
                        <div class="col-md-12 review-bg">
                            <div class="form-group label-floating">
                                <div class="card-content ">
                                    <h2> <?= $course->course_name ?></h2>  
                                    <h4><?= $course->course_description ?></h4>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card card-learning">
                                                <a href="<?= Yii::$app->request->baseUrl ?>/learner-activity/lessons?id=<?= $id ?>" class="card--learning__image" tabindex="-1" href="/course-dashboard-redirect/?course_id=1329100">
                                                    <div class="card__image play-button-trigger">
                                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/1.png" >
                                                        <div class="play-button">
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="card__details">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card card-learning">
                                                <a href="<?= Yii::$app->request->baseUrl ?>/learner-scoring/questions?id=<?= $id ?>" class="card--learning__image" tabindex="-1">
                                                    <div class="card__image play-button-trigger">
                                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/2.png" >
                                                        <div class="play-button">
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="card__details">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card card-learning">
                                                <a href="<?= $filepath . $filename ?>" class="card--learning__image" tabindex="-1" >
                                                    <div class="card__image play-button-trigger">
                                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/3.png" >
                                                        <div class="play-button">
                                                        </div>
                                                    </div>
                                                </a>

                                                <div class="card__details">  
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card card-learning">
                                                <a href="<?= Yii::$app->request->baseUrl ?>/review-material-scoring/review-material-score?id=<?= $id ?>" class="card--learning__image" tabindex="-1">
                                                    <div class="card__image play-button-trigger">
                                                        <img src="<?= Yii::$app->request->baseUrl ?>/images/4.png" >
                                                        <div class="play-button">
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="card__details">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <?= Html::a('Back', ['/courses-assigned/my-courses'], ['class' => 'btn btn-primary pull-right']) ?>
    </div>


