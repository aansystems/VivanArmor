<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->registerCssFile("@web/css/progressbar.css");
$this->title = 'Cyber Resiliency Index';
?>
<style>
    #container_one {
        margin: -16rem 0 -5rem 0;
    }
    ul > ul > li {
        list-style-type: circle;
    }
    ol > li {
        font-weight: bolder;
    }
    ::-webkit-scrollbar {
        width: 0px;  /* remove scrollbar space */
        background: transparent;  /* optional: just make scrollbar invisible */
    }
    /* optional: show position indicator in red */
    ::-webkit-scrollbar-thumb {
        background: #FF0000;
    }
    
    .main-header .navbar{
      height:30px !important;  
    }
    @media (max-width: 767px){
    
    .container-fluid{
    
    margin-top: 40px !important;
}
    }
    
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 no-padding">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header1 card-header-text" data-background-color="blue">
                            <h4 class="card-title text-uppercase">Cyber Resiliency Index</h4>
                        </div>
                        <div class="card-content text-center">
                            <img class="about_img" src="<?= Yii::$app->request->baseUrl ?>/images/Cyber-Resiliency-Index.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>