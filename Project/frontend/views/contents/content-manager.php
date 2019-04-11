<?php

use frontend\models\MasterContentTemplates;
use yii\bootstrap\Modal;

$this->title = 'Content Library';
?>

<style>
    .template-header {
        margin: 20px 5px 20px -35px !important;
        background-image: linear-gradient(-20deg, #1bbba1 0%, #8ddad5 100%) !important;
        border-radius: 10px !important;
    }
    .templates-block .col-md-4 {
        padding-right: 0px;
    }
    .templates-block .card {
        background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
        box-shadow: 0 1px 4px 0 rgba(7, 7, 7, 0.27)
    }
    .templates-block .col-md-8 .card-content h6 {
        margin: 25px auto;
        font-weight: 400;
        margin-left: -20%;
    }
    #courses .card .card-content{
        overflow-y: hidden;
    }
    .fluid{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
    .pagination{
        margin: 0;
    }
    .card {
        margin: 10px 0 10px 0;
    }
    #courses .card {
        background-image: linear-gradient(-20deg, #e9defa 0%, #fbfcdb 100%);
    }
    .card-header {
        width: 60px;
        text-align: center;
        border-radius: 50% !important;
        font-size: 20px;
        margin: -30px auto 0 !important;
    }
    .scrollbar {
        height: 100px !important;
    }
    element.style {
        margin-top: 400px;
    }
    .card .table {
        margin-bottom: 0;
    }
    .course-name {
        font-weight: 400;
    }
    .scrollbar {
        height: 1px;
    }
    .container-fluid {
        min-height: 0 !important;
        margin-bottom: 0 !important;

    }
    .content:nth-of-type(3) {
        padding-top: 10px;
    }
    .btn {
        font-size: 15px;
        text-transform: capitalize;
    }
    .tile-3 {
        padding-left: 5px
    }
    .tile-3 img {
        box-shadow: 0 14px 26px -12px rgba(153, 153, 153, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(153, 153, 153, 0.2);
    }
    .flex {
        display: flex;
    }
    .col-md-2 {
        padding: 0;
    }
    .modal-header{
        background: linear-gradient(60deg, #2F80ED, #56CCF2);
        text-align: center;
    }
    button{
        background-color:white;
        border-width: 0px;
        border-radius: 5px;
    }
    .btn {
        border-radius: 0 !important;
        font-size: 15px;
        text-transform: capitalize;
    }
    .flex {
        display: flex;
    }
    .grid-1, .grid-1:focus, .grid-1:active {
        background: #000 url('../images/dms/dms-1.jpg');
        margin-bottom: 2px;
        margin-top: 0;
    }
    .grid-2, .grid-2:focus, .grid-2:active {
        background: #000 url('../images/dms/dms-2.jpg');
        margin-top: 2px;
    }
    .grid-3, .grid-3:focus, .grid-3:active {
        background: #000 url('../images/dms/sow.jpg');
        margin-top: 2px;
        padding: 15%;
    }
    .grid-4, .grid-4:focus, .grid-4:active {
        background: #000 url('../images/dms/msa.jpg');
        margin-top: 2px;
        padding: 15%;
    }
    .grid-5, .grid-5:focus, .grid-5:active {
        background: #000 url('../images/dms/po.jpg');
        margin-top: 2px;
        padding: 15%;
    }
    .grid-6, .grid-6:focus, .grid-6:active {
        background: #000 url('../images/dms/so.jpg');
        margin-top: 2px;
        padding: 15%;
    }
    .grid-1, .grid-1:focus, .grid-1:active, .grid-2, .grid-2:focus, .grid-2:active, .grid-3, .grid-3:focus, .grid-3:active, .grid-4, .grid-4:focus, .grid-4:active, .grid-5, .grid-5:focus, .grid-5:active, .grid-6, .grid-6:focus, .grid-6:active {
        color: #FFFFFF;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        background-size: cover;
    }
    .color-overlay-1 {
        background-image: linear-gradient(to right, #00dbde 0%, #fc00ff 100%);
    }
    .color-overlay-2 {
        background-image: linear-gradient(to right, #f9d423 0%, #ff4e50 100%);
    }
    .color-overlay-3 {
        background: #a80077;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #66ff00, #a80077);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #66ff00, #a80077); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
    .color-overlay-4 {
        background: #43C6AC;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #191654, #43C6AC);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #191654, #43C6AC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
    .color-overlay-5 {
        background-image: linear-gradient(to right, #43e97b 0%, #38f9d7 100%);
    }
    .color-overlay-6 {
        background: #544a7d;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #ffd452, #544a7d);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #ffd452, #544a7d); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }
    .color-overlay-1, .color-overlay-2, .color-overlay-3, .color-overlay-4, .color-overlay-5, .color-overlay-6 {
        height: 100%;
        opacity: .85;
        position: absolute;
    }
    h2, p {
        color: #FFFFFF;
        z-index: 1;
        display: block;
        padding-bottom: 0;
        margin-bottom: 0;
    }
    .grid-1 i, .grid-2 i {
        font-size: 80px !important;
    }
    .small-content {
        font-size: 14px;
        font-weight: 500;
    }
    .active img{
        min-height: 230px;
    }
    video {
        background-color: #000000;
    }
    .content {
        padding-top: 28px;
    }
    .block-1, .block-2, .block-3 {
        padding-left: 3px;
        padding-right: 3px;
    }
    .block-3 h2 {
        font-size: 25px;
        margin-top: 0;
        font-weight: 700;
        margin-bottom: -10%;
    }
    .see-more {
        font-size: 12px;
        font-weight: 300;
    }
    .block-3 h2 .see-more {
        line-height: 0;
    }
    .slide {
        opacity: 1;
    }
    .mycourse{
        padding-top: 0px !important;
        min-height:auto !important;
    }
    .block-2, .slide, .carousel-inner, .carousel-inner img{
        height: 260px !important;
        margin-top: 5px;
        margin-left: -1px;
        width:100% !important;
    }
    .card img {
        width: 60px !important;
        height: auto;
    }
    .item img{
        width: 100% !important;
    }
    .modal .close {
        font-size: 14px;
        font-weight: 400;
    }
    .modal-header .close {
        margin-top: 5px;
    }
    @media screen and (min-width: 992px){
        .material-datatables .card .card-content{
            padding-bottom: 30% !important;
        }
    }
    @media screen and (max-width: 1300px){
        .content h6 {
            margin-left: -27% !important;
            font-size: 12px !important;
            margin: 32px auto;
        }
    }
    @media (min-width: 1151px) and (max-width: 1200px) {
        .templates-block .col-md-8 .card-content h6 {
            margin-left: -45% !important;
            font-size: 11px !important;
            margin: 32px auto;
        }
    }
    @media (min-width: 992px) and (max-width: 1150px) {
        .col-md-3 {
            width: 33%;
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .item img{
            width: 100% !important;
        }
        .active img {
            min-height: 160px;
        }

    }
    @media (min-width: 830px) and (max-width: 991px){
        .templates-block .col-sm-8 .card-content h6 {
            margin-left: -30% !important;
            font-size: 11px !important;
            margin: 32px auto;
        }
        .col-md-3 {
            width: 33%;
        }
        .card img {
            width: 40px !important;
            height: auto;
        }
        .template-header{
            margin: 23px -4px 20px -32px !important;
        }
        .item img{
            width: 100% !important;
        }
        .col-sm-8 {
            width: 19.666667%;
        }
        .card .card-content {
            padding: 15px 8px;
        }
    }
    @media (min-width: 768px) and (max-width: 831px){
        .templates-block .col-sm-8 .card-content h6 {
            margin-left: -30% !important;
            font-size: 11px !important;
            margin: 32px auto;
        }
        .col-md-3 {
            width: 45%;
            margin-left: 25px;
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .template-header{
            margin: 23px -4px 20px -32px !important;
        }
        .item img{
            width: 100% !important;
        }
        .col-sm-8 {
            width: 19.666667%;
        }
        .card .card-content {
            padding: 15px 8px;
        }
    }
    @media (min-width: 701px) and (max-width: 767px){
        .templates-block .col-sm-8 .card-content h6 {
            margin-left: -50% !important;
            font-size: 11px !important;
            margin: 32px auto;
        }
        .col-md-3 {
            width: 33%;
        }
        .card img {
            width: 40px !important;
            height: auto;
        }
        .template-header{
            margin: 23px -4px 20px -32px !important;
        }
        .item img{
            width: 100% !important;
        }
        .col-sm-8 {
            width: 33.666667%;
        }
        .card .card-content {
            padding: 15px 8px;
        }
    }
    @media (min-width: 701px) and (max-width: 767px){
        .templates-block .col-sm-8 .card-content h6 {
            margin-left: -50% !important;
            font-size: 11px !important;
            margin: 32px auto;
        }
        .col-md-3 {
            width: 33%;
        }
        .card img {
            width: 40px !important;
            height: auto;
        }
        .template-header{
            margin: 23px -4px 20px -32px !important;
        }
        .item img{
            width: 100% !important;
        }
        .col-sm-8 {
            width: 33.666667%;
        }
        .card .card-content {
            padding: 15px 8px;
        }
    }
    @media (min-width: 570px) and (max-width: 700px){
        .templates-block .col-sm-8 .card-content h6 {
            margin-left: -50% !important;
            font-size: 12px !important;
            margin: 32px auto;
        }
        .col-md-3 {
            width: 45%;
            margin-left: 20px;
        }
        .card img {
            width: 60px !important;
            height: auto;
        }
        .template-header{
            margin: 23px -4px 20px -32px !important;
        }
        .item img{
            width: 100% !important;
        }
        .col-sm-8 {
            width: 18.666667%;
        }
        .card .card-content {
            padding: 15px 8px;
        }
    }
    @media (min-width: 470px) and (max-width: 571px){
        .templates-block .col-sm-8 .card-content h6 {
            margin-left: -5% !important;
            font-size: 10px !important;
            margin: 32px auto;
        }
        .col-md-3 {
            width: 50%;
            
        }
        .card img {
            width: 40px !important;
            height: auto;
        }
        .template-header{
            margin: 26px -3px 20px -30px !important;
        }
        .item img{
            width: 100% !important;
        }
        .col-sm-8 {
            width: 18.666667%;
        }
        .card .card-content {
            padding: 10px 8px;
        }
    }
    @media (min-width: 401px) and (max-width: 471px){
        .templates-block .col-sm-8 .card-content h6 {
            
            font-size: 13px !important;
            margin: 32px auto;
        }
        .col-md-3 {
            width: 95%;    
            margin-left: 2%
        }
        .card img {
            width: 50px !important;
            height: auto;
        }
        .template-header{
            margin: 26px -3px 20px -30px !important;
        }
        .item img{
            width: 100% !important;
        }
        .col-xs-4 {
            width: 22.333333%;
        }
        .col-sm-8 {
            width: 18.666667%;
        }
        .card .card-content {
            padding: 10px 40px;
        }
    }
    @media (min-width: 320px) and (max-width: 400px){
        .templates-block .col-sm-8 .card-content h6 {           
            font-size: 11px !important;
            margin: 32px auto;
        }
        .col-md-3 {
            width: 95%;    
            margin-left: 2%
        }
        .card img {
            width: 40px !important;
            height: auto;
        }
        .template-header{
            margin: 26px -3px 20px -30px !important;
        }
        .item img{
            width: 100% !important;
        }
        .col-xs-4 {
            width: 22.333333%;
        }
        .col-sm-8 {
            width: 18.666667%;
        }
        .card .card-content {
            padding: 10px 22px;
        }
    }
</style>
<section class="login-block vertical-center">
    <div class="content">
        <div class="container-fluid" style="
             margin-top: 1%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header1 card-header-text" data-background-color="blue">
                            <h4 class="card-title text-uppercase">Features of Content Library</h4>
                        </div>
                        <div class="card-content"> 
                            <div class="row">
                                <div class="col-md-12 tile-3">
                                    <div>
                                        <div class="item active">
                                            <img src="<?= Yii::$app->request->baseUrl ?>/images/dms/1.png" alt="">
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
    <div class="content vertical">
        <div class="container-fluid" style="
             margin-top: -1%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header1 card-header-text" data-background-color="blue">
                            <h4 class="card-title text-uppercase">Content library</h4>
                        </div>
                        <div class="card-content"> 
                            <div class="row">
                                <?php
                                foreach ($data as $value) {
                                    $content_type = MasterContentTemplates::findOne(['id' => $value['content_type']]);
                                    ?>
                                    <div class="col-md-3 col-sm-3 col-xs-3 templates-block">
                                        <div class="card">
                                            <div class="row">
                                                <a href="#" value="<?= Yii::$app->request->baseUrl ?>/contents/authenticate?id=<?= $value['content_type'] ?>" id='passwordModal<?= $value['content_type'] ?>' data-backdrop="static" data-keyboard="false">
                                                    <div class="col-md-4 col-sm-3 col-xs-4">
                                                        <div class="card-header1 card-header-text template-header" data-background-color="blue">
                                                            <center><h4 class="card-title text-uppercase"><img src="<?= Yii::$app->request->baseUrl ?>/images/my-templates/<?= $content_type->image_name ?>"></h4></center>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                                        <div class="card-content">                        
                                                            <h6 class="black-text course-name text-uppercase"><?php echo $content_type->template_name; ?></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            
                                        </div>
                                        <?php
                                        Modal::begin([
                                            'header' => '<h4 class="pull-left"></h4>',
                                            'id' => 'modal10',
                                            'clientOptions' => ['backdrop' => 'static', 'keyboard' => false],
                                            'size' => 'modal-lg',
                                        ]);
                                        echo "<div id='modalContent'></div>";
                                        Modal::end();
                                        ?>
                                        <script>
                                            $(function () {
                                                $("#passwordModal<?= $value['content_type'] ?>").click(function () {
                                                    $('#modal10').modal('show')
                                                            .find('#modalContent')
                                                            .load($(this).attr('value'));

                                                });

                                            });
                                        </script>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
