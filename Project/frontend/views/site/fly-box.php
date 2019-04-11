<?php
$base_url = Yii::$app->request->baseUrl;
$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
?>
<style>
    .box-1, .box-1:focus {
        background: #FF8008;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #FFC837, #FF8008);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #FFC837, #FF8008); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        margin-bottom: 3px;
        margin-top: 0;
    }

    .box-2, .box-2:focus {
        background-image: linear-gradient(to right, #0ba360 0%, #3cba92 100%);
        margin-top: 3px;
        margin-bottom: 0;
    }

    .box-3, .box-3:focus {
        background: #FF416C;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #FF4B2B, #FF416C); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .box-1, .box-2, .box-3 {    
        padding: 10% 10% 10% 10%;
        border-radius: 0;
        margin-bottom: 3px;
    }

    .icon-bar {
        position: fixed;
        top: 80%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        float:right;
        right: 0;
        z-index: 999;
    }

    .icon-bar a {
        display: block;
        text-align: center;
        padding: 16px;
        transition: all 0.3s ease;
        color: white;
        font-size: 20px;
    }

    .icon-bar a:hover {
        background-color: #000;
    } 
    @media screen and (min-width:771px) and (max-width:1000px){
        .icon-bar a {  
            padding: 13px;
        }
    }
    @media screen and (max-width:770px){
         .icon-bar a {  
            padding: 10px;
        }
     }
     @media screen and (max-width:455px){
         .icon-bar a {  
            padding: 8px;
        }
     }
</style>
<div class="icon-bar">
    <abbr title="My Progress"><a href="<?= Yii::$app->request->baseUrl ?>/site/dashboard-learner" class="box-1"><i class="fa fa-tasks"></i></a></abbr>
    <abbr title="My Certificates"><a href="<?= Yii::$app->request->baseUrl ?>/certificates/" class="box-2"><i class="fa fa-certificate"></i></a></abbr>

        <?php if ($base != 'courses-assigned/my-courses') { ?>
        <abbr title="My Courses"><a href="<?= Yii::$app->request->baseUrl ?>/courses-assigned/my-courses" class="box-3"><i class="glyphicon glyphicon-book"></i></a></abbr>
                <?php } ?>
</div>