<?php

use yii\helpers\Html;
use frontend\models\User;

$base_url = Yii::$app->request->baseUrl;
$roll = Yii::$app->user->identity->role_type;
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-content">
                        <?php if ($roll == 1) { ?>
                            <div class="form-group">                              
                                <p class="notification"> message:&nbsp; &nbsp;&nbsp;<?php echo $messsage = $model->message; ?></p><hr>
                                <p class="notification"> expire date:&nbsp; &nbsp;&nbsp;<?php echo $messsage = $model->end_date; ?></p>
                            </div> 
                        <?php } elseif ($roll == 2) { ?>
                            <div class="form-group">
                                <p class="notification"> message:&nbsp; &nbsp;&nbsp;<?php echo $messsage = $model->message; ?> </p><hr> 
                                <p class="notification">  expire date:&nbsp; &nbsp;&nbsp;<?php echo $messsage = $model->end_date; ?></p>
                            </div> 
                        <?php } elseif ($roll == 3) { ?>
                            <div class="form-group">
                                <p class="notification"> message:&nbsp; &nbsp;&nbsp; <?php echo $messsage = $model2->message; ?> </p><hr> 
                                <p class="notification"> expire date:&nbsp; &nbsp;&nbsp; <?php echo $messsage = $model2->end_date; ?></p>
                            </div>   
                        <?php } elseif ($roll == 4) { ?>
                            <!--     query to fetch the created_by based on loged in user -->
                            <?php
                            $user = User::findOne(['id' => Yii::$app->user->identity->id]);
                            $created_by = $user->created_by;
                            ?>
                            <?php if ($created_by == 1) { ?>
                                <div class="form-group">                                  
                                    <p class="notification">message:&nbsp; &nbsp;&nbsp;<?php echo $messsage = $model->message; ?></p><hr>                                                    
                                    <p class="notification">expire date:&nbsp; &nbsp;&nbsp;<?php echo $messsage = $model->end_date; ?></p>
                                </div> 
                            <?php } else { ?>
                                <div class="form-group">                                   
                                    <p class="notification"> message:&nbsp; &nbsp;&nbsp;<?php echo $messsage = $model2->message; ?></p><hr>                                 
                                    <p class="notification"> expire date:&nbsp; &nbsp;&nbsp;<?php echo $messsage = $model2->end_date; ?></p>
                                </div> 
                            <?php } ?>
                        <?php } ?> 
                        <div class="form-group">
                            <?= Html::a('Back', ['site/index'], ['class' => 'btn btn-primary pull-right']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>