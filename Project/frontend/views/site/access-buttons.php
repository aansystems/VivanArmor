<?php
$request = Yii::$app->request;
$id = $request->get('id');
?>
<style>
    @media (min-width:900px) and (max-width:1072px){
        .access-buttons .access-one div:nth-of-type(2) p, .access-buttons .access-two div:nth-of-type(2) p, .access-buttons .access-three div:nth-of-type(2) p, .access-buttons .access-four div:nth-of-type(2) p{
            font-size: 8px !important;
        }
        #footer img{
            width: 30px !important;
            height: 30px !important;
        }

        .access-buttons .access-one div:first-child, .access-buttons .access-two div:first-child, .access-buttons .access-three div:first-child, .access-buttons .access-four div:first-child{
            font-size: 50px;
        }    
    }
    @media screen and (max-width:899px){
        .access-buttons .access-one div:nth-of-type(2) p, .access-buttons .access-two div:nth-of-type(2) p, .access-buttons .access-three div:nth-of-type(2) p, .access-buttons .access-four div:nth-of-type(2) p{  
            font-size: 6px !important;
        }
        .access-buttons .access-one div:first-child, .access-buttons .access-two div:first-child, .access-buttons .access-three div:first-child, .access-buttons .access-four div:first-child{
            font-size: 40px;
        }
        #footer img {
            width: 30px !important;
            height: 30px !important;
        } 

    }
    @media screen and (max-width:767px){
        .access-buttons{
            padding-left: 15%;
            /*margin-right: -15px;*/
            margin-left: -7% !important;
        }

    }
    @media screen and (min-width:501px) and (max-width:580px){
        .col-xs-2 {
            width: 20.666667%;
        }
        .col-xs-10 {
            width: 79.333333%;
        }
    }
    @media screen and (min-width:451px) and (max-width:500px){
        .col-xs-2 {
            width: 36.666667%;
        }
        .col-xs-10 {
            width: 50.333333%;
        }
    }
    @media screen and (min-width:391px) and (max-width:450px){
        .access-buttons{
            padding-left: 10%;
        }
        .col-xs-2 {
            width: 40.666667%;
        }
        .col-xs-10 {
            width: 58.333333%;
        }
    }
    @media screen and (min-width:371px) and (max-width:390px){

        .col-xs-2 {
            width: 46.666667%;
        }
        .col-xs-10 {
            width: 53.333333%;
        }
        .access-buttons{
            padding-left: 10%;
            margin-right: -13px;
        }
        .access-buttons {
            margin-right: 1% !important;
            margin-left: -2% !important;
        }
    }
    @media screen and (min-width:344px) and (max-width:370px){

        .col-xs-2 {
            width: 44.666667%;
        }
        .col-xs-10 {
            width: 54.333333%;
        }
        .access-buttons{
            padding-left: 0%;
            margin-right: -4% !important;
            margin-left: 5% !important;
        }
    }
    @media screen and (min-width:320px) and (max-width:343px){

        .col-xs-2 {
            width: 44.666667%;
        }
        .col-xs-10 {
            width: 54.333333%;
        }
        .access-buttons{
            padding-left: 0%;
            margin-right: -4% !important;
            margin-left: 5% !important;
        }
        #footer img {
            width: 30px !important;
            height: 30px !important;
        } 
        .access-buttons .access-one div:nth-of-type(2) p, .access-buttons .access-two div:nth-of-type(2) p, .access-buttons .access-three div:nth-of-type(2) p, .access-buttons .access-four div:nth-of-type(2) p{  
            font-size: 5px !important;
        }
    }
    @media screen and (max-width:320px){
        .col-xs-2 {
            width: 44.666667%;
        }
        .col-xs-10 {
            width: 60.333333%;
        }
        .access-buttons{
            padding-left: 0%;
            margin-right: -20px;
        }
        #footer img {
            width: 30px !important;
            height: 30px !important;
        } 
        .access-buttons .access-one div:nth-of-type(2) p, .access-buttons .access-two div:nth-of-type(2) p, .access-buttons .access-three div:nth-of-type(2) p, .access-buttons .access-four div:nth-of-type(2) p{  
            font-size: 5px !important;
        }
    }
    @media screen and (max-width: 560px) and (min-width: 391px){
        .access-buttons {
            margin-right: -5% !important;
            margin-left: 5% !important;
        }
    }
</style>


<div class="row access-buttons text-center">
    <div class="col-sm-2 "></div>
    <a href="<?= Yii::$app->request->baseUrl ?>/learner-activity/lessons?id=<?= $id ?>">
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="row access-one">
                <div class="col-xs-2 col-sm-2 col-md-2">
                    1 
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/main-couse.png" width="40px"/>  
                    <p class="text-center text-uppercase">Main Course</p>
                </div>
            </div>
        </div>
    </a> 

    <a href="<?= Yii::$app->request->baseUrl ?>/learner-scoring/questions?id=<?= $id ?>"> 
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="row access-two">
                <div class="col-xs-2 col-sm-2 col-md-2">
                    2 
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/course-quiz.png" width="40px"/>  
                    <p class="text-center text-uppercase"> Practice quiz</p>
                </div>
            </div>
        </div>
    </a> 

    <a href="<?= Yii::$app->request->baseUrl ?>/review-material-scoring/review-material-score?id=<?= $id ?>">
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="row access-three">
                <div class="col-xs-2 col-sm-2 col-md-2">
                    3 
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/micro-lessons.png" width="40px"/>  
                    <p class="text-center text-uppercase">Micro Lessons</p>
                </div>
            </div>
        </div>
    </a> 

    <a href="<?= Yii::$app->request->baseUrl ?>/learner-activity/ebooks?id=<?= $id ?>" id="ebook-click"> 
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="row access-four" >
                <div class="col-xs-2 col-sm-2 col-md-2">
                    4 
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10">
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/review-material.png" width="40px"/>  
                    <p class="text-center text-uppercase">Review Material</p>
                </div>
            </div>
        </div>
    </a> 
    <div class="col-xs-2 col-sm-2 col-md-2"></div>
</div>