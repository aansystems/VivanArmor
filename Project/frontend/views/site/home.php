<?php

use frontend\models\MasterHowTo;
?>

<style>
    .modal {
        position: fixed;
        top: -50px;
        right: 0px;
        bottom: 25px;
        left: 0px;
        z-index: 1050;
        display: none;
        overflow: hidden;
        outline: 0px;
    }

    /*    .modal-open .modal {
    
           overflow-y: hidden;
        }*/


    ::-webkit-scrollbar {
        width: 5px;
    }

    Track 
    ::-webkit-scrollbar-track {
        background: #f1f1f1; 
    }

    Handle 
    ::-webkit-scrollbar-thumb {
        background: #ecf0f5; 
    }

    Handle on hover 
    ::-webkit-scrollbar-thumb:hover {
        background: #ecf0f5; 
    }
    @media (min-width: 992px) {
        .flex{
            display: flex !important;
        }
        .col-md-3 {
            width: 24.7%;
        }
        .block-1 .row{
            margin-right: -27px !important;
            margin-left: -1px !important;
        }
    }
    .block-1 a, .block-2 a {
        color: black; 
        font-size: 12px;
    }
    .block-1 a:hover, .block-2 a:hover {
        color:brown;
        font-size: 12px;
    }
    button {
        background-color:white;
        border-width: 0px;
        border-radius: 5px;

    }
    .message_attachment{
        float: right;
        margin-top: 2%; 
    }

    .content {
        padding-top: 30px; 
    }

    .btn {
        border-radius: 0 !important;
        font-size: 15px;
        text-transform: capitalize;
    }

    .grid-1, .grid-1:focus, .grid-1:active {
        background: #FF416C;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #FF4B2B, #FF416C);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #FF4B2B, #FF416C); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    .grid-2, .grid-2:focus, .grid-2:active {
        background: #8E2DE2;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #4A00E0, #8E2DE2);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #4A00E0, #8E2DE2); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        padding-bottom: 1.4% !important;
    }

    .grid-3, .grid-3:focus, .grid-3:active {
        background: #f953c6;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #b91d73, #f953c6);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #b91d73, #f953c6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .grid-4, .grid-4:focus, .grid-4:active {
        background: #00b09b;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #96c93d, #00b09b);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #96c93d, #00b09b); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        padding-bottom: 1.4% !important;
    }

    .grid-5, .grid-5:focus, .grid-5:active {
        background: #FFE000;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #799F0C, #FFE000);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #799F0C, #FFE000); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .grid-6, .grid-6:focus, .grid-6:active { 
        background: #834d9b;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to left, #d04ed6, #834d9b);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to left, #d04ed6, #834d9b); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .grid-7, .grid-7:focus, .grid-7:active {
        background: #00c6ff;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #0072ff, #00c6ff);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #0072ff, #00c6ff); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .grid-8, .grid:focus, .grid-8:active {  
        background: #e65c00;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #F9D423, #e65c00);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #F9D423, #e65c00); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    .block-1 {
        padding-left: 8px;
        padding-right: 8px;
    }

    .block-1 button {
        margin-top: 0px;
        margin-bottom: 0;
    }

    .block-1 button i {
        font-size: 70px !important;
        opacity: 0.5;
        padding-top: 5%;
        padding-bottom: 12%;
    }

    .block-3 {
        background: -webkit-linear-gradient(360deg, #211c10 10%, #b09a51 360%);   
        background: -o-linear-gradient(360deg, #211c10 10%, #b09a51 360%); 
        background: linear-gradient(360deg, #211c10 10%, #b09a51 360%);  
        margin-bottom: 25px;
    }
    .block-3 p {
        color: #FFFFFF;
        font-size: 12px;

    }

    .flex {
        display: block;
    }

    video {
        margin-top: 0.2%;
        background-color: black;
    }

    .message-content {
        padding-top: 5%;
        padding-bottom: 10%;
        border-bottom: 1px solid #EEE;
    }

    h4 {
        color: white;
    }

    .message_box_heading{
        text-align:center;
        font-size:15px !important;
        padding-top:10px;
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .sidebar-menu li>a>.pull-right-container{
            margin-right:-15px !important;
        }
        .sidebar-menu>li>a{
            padding-left: 15px !important;
        }
        .block-1 .row{
            margin-right: -33px !important;
        }
        .card .card-content {
            padding: 15px 35px;
        }
        h6{
            font-size: 0.85em;
        }
    }

    .how-to-header {
        width: 50px;
        height: 50px;
        border-radius: 50% !important;
    }

    .how-to-header, .how-to-button, .modal-content .modal-header {
        background-image: linear-gradient(-225deg, #473B7B 0%, #3584A7 51%, #30D2BE 100%) !important;
    }

    .how-to-card {
        border-radius: 0 !important;
        background-image: linear-gradient(to top, #ecf4f7 0%, #fffee8 99%, #ffffff 100%);
        box-shadow: 0 1px 4px 0 rgba(7, 7, 7, 0.27);
    }

    .how-to-card .card-content {
        padding: 7px 1px;
    }

    .how-to-header .card-title {
        margin-top: 6px;
    }

    .fa-5x {
        color: #353535;
        opacity: 0.8;
    }

    .btn-sm {
        border-radius: 4px !important;
        padding: 2% !important;
    }

    .slide {
        opacity: 1;
    }
    .modal-content .modal-header {
        padding-bottom: 24px;
    }

    .modal-header .close {
        margin-top: -5px;
    }

    .modal .modal-header .close {
        color: #FF0000;
        font-size: 45px;
    }
    .slide{
        position: relative;

    }
    .carousel-control.left, .carousel-control.right {
        background-image: none !important;
    }

    .how-to-card h6 {
        font-weight: 400;
        text-transform: capitalize;
        min-height: 50px;
        margin-bottom: 0;
    }   
    .grid-1, .grid-2, .grid-3, .grid-4, .grid-5, .grid-6, .grid-7, .grid-8 {

        flex-flow: row wrap;
        justify-content: space-around;
        width: 24.7%;
        height: 150px;

    }

    /*For first 8 tiles*/

    @media (max-width: 1130px) {
        .grid-1, .grid-2, .grid-3, .grid-4, .grid-5, .grid-6, .grid-7, .grid-8 {
            height: 150px !important;
            width: 24.6% !important;  
            flex-flow: row wrap;
            justify-content: space-around;
        }
        .block-1 button{
            font-size: 13px;
        }
        .btn:not(.btn-just-icon):not(.btn-fab) .fa{
            margin-top: 2px !important;
            font-size: 12px;
            top: 1px;
        }
        .btn.btn-sm{
            font-size: 10px;
            padding: 5px 10px !important;
        }
    }
    @media (min-width: 320px) and (max-width: 600px){
        .grid-1, .grid-2, .grid-3, .grid-4, .grid-5, .grid-6, .grid-7, .grid-8 {
            height: 150px !important;
            width: 49.7% !important;  
            flex-flow: row wrap;
            justify-content: space-around;
        }
        .col-xs-3 {
            width: 50%;
        }
        .btn.btn-sm {
            font-size: 10px;
            padding: 5px 20px !important;
        }
        .btn:not(.btn-just-icon):not(.btn-fab) .fa{
            margin-top: 2px !important;
            font-size: 12px;
            top: 0px;
        }
    }

    /*For second 8 tiles*/
    @media (min-width: 1121px) and (max-width: 1210px){
        h6{
            font-size: 0.84em;
        }
    }
    @media (min-width: 992px) and (max-width: 1120px){
        h6{
            font-size: 0.8em;
        }
    }
    @media (min-width: 768px) and (max-width: 800px){
        h6{
            font-size: 0.8em;
        }
    }
    @media (min-width: 601px) and (max-width: 710px){
        h6{
            font-size: 0.81em;
        }
    }
    @media (min-width: 320px) and (max-width: 360px){
        h6{
            font-size: 0.81em;
        }
    }
    @media (min-width: 320px) and (max-width: 650px){
        .how-to-header .card-title {
            margin-top: 10px;
        }
    }
    
    @media (max-width: 767px){
        .content {
            margin-top: 20px;
        }
        .btn{
            margin: 5px -2px;
        }
        .block-1 .row{
            margin-right: -33px !important;
        }
        .card .card-content {
            padding: 15px 35px;
        }
        .how-to-card .card-content {
            padding: 7px 1px;
        }
        .block-3{
            margin-bottom: 25px;
        }
    }

    .btn{
        margin: 5px -2px;
    }
    .card .card-content{
        padding-left: 3px !important;
    }

    @media (min-width: 2000px){
        .grid-1, .grid-2, .grid-3, .grid-4, .grid-5, .grid-6, .grid-7, .grid-8{
            height: 200px;
        }
    }
</style>

<div class="content">
    <div class="row flex">
        <div class="col-md-9 block-1">
            <div class="row">
                <a href="<?= Yii::$app->request->baseUrl ?>/courses-assigned/my-courses">
                    <button class="btn col-sm-6 col-md-3 grid-1"><i class="glyphicon glyphicon-book"></i><br/>My Courses</button>
                </a>
                <a href="<?= Yii::$app->request->baseUrl ?>/site/dashboard-learner">
                    <button class="btn col-sm-6 col-md-3 grid-2"><i class="fa fa-tasks" aria-hidden="true"></i><br/>My Progress</button>
                </a>
                <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz/">
                    <button class="btn col-sm-6 col-md-3 grid-3"><i class="fa fa-laptop" aria-hidden="true"></i><br/>My Tests</button>
                </a>
                <a href="<?= Yii::$app->request->baseUrl ?>/certificates/">
                    <button class="btn col-sm-6 col-md-3 grid-4"><i class="fa fa-certificate" aria-hidden="true"></i><br/>My Certificates</button>
                </a>
            </div>

            <div class="row">
                <a href="<?= Yii::$app->request->baseUrl ?>/documents/list">
                    <button class="btn col-sm-6 col-md-3 grid-5"><i class="fa fa-file-text" aria-hidden="true"></i><br/>My Documents</button>
                </a>
                <a href="<?= Yii::$app->request->baseUrl ?>/contents/index">
                    <button class="btn col-sm-6 col-md-3 grid-6"><i class="glyphicon glyphicon-duplicate" aria-hidden="true"></i><br/>My Content</button>
                </a>
                <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/dashboard">
                    <button class="btn col-sm-6 col-md-3 grid-7"><i class="fa fa-cubes" aria-hidden="true"></i><br/>Resiliency Index</button>
                </a>
                <a href="<?= Yii::$app->request->baseUrl ?>/">
                    <button class="btn col-sm-6 col-md-3 grid-8"><i class="fa fa-retweet" aria-hidden="true"></i><br/>Compliance Index</button>
                </a>
            </div><br/>

            <div class="card">
                <div class="card-header1 card-header-text" data-background-color="blue">
                    <h4 class="card-title text-uppercase">How To - With Vivaan</h4>
                </div><br/>
                <div class="card-content text-center">
                    <div class="row how-to-block">
                        <?php
                        $how_to_blocks = MasterHowTo::find()->all();
                        $i = 1;
                        foreach ($how_to_blocks as $blocks):
                            ?>

                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <div class="card how-to-card text-center">
                                    <center> 
                                        <div class="card-header1 how-to-header card-header-text" data-background-color="blue">
                                            <h4 class="card-title text-center">
                                                <img src="<?= Yii::$app->request->baseUrl ?>/images/v.png">
                                            </h4>
                                        </div> 
                                    </center>
                                    <div class="card-content text-center">
                                        <i class="fa fa-<?= $blocks->icon_name ?> fa-5x" aria-hidden="true"></i> <br/>
                                        <h6><?= $blocks->title ?></h6>
                                        <button class="btn btn-sm how-to-button" data-toggle="modal" data-target="#how-to-modal-<?= $i ?>">KNOW MORE  <span class="fa fa-angle-double-right"></span></button>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>

                        <?php endforeach; ?>
                        <br/>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 block-3">
            <p class="message_box_heading"><i class="fa fa-comments"></i><b> Message Board</b></p>
            <?php
            foreach ($messages as $message) {
                $destination_array = explode(',', $message['assigned_to']);
                foreach ($destination_array as $value) {
                    if ($value == $email) {
                        ?>
                        <div class="message-content"><h4><?= $message['title']; ?></h4> 
                            <p><?= $message['content']; ?> 
                                <?php if (!empty($message['attachment'])) { ?>
                                    <br/><a href="<?= Yii::$app->request->baseUrl ?>/uploads/messageBox/<?= $message['attachment']; ?>" target="_blank"><button class="message_attachment">See More <i class="fa fa-angle-double-right" style='color: black'></i></button></a>
                                <?php } ?>
                            </p> </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
/* Finding the number of folders in how-to-block */
$path = Yii::$app->request->baseUrl . '/images/how-to-slider';

$dir_path = 'images/how-to-slider/';

$files = scandir($dir_path);

$total_slides = count($files) - 2;
for ($i = 1; $i < $total_slides; $i++) :
    $folder_path = Yii::$app->request->baseUrl . '/images/how-to-slider/how-to-block-' . $i;

    $image_path = 'images/how-to-slider/how-to-block-' . $i . '/';

    $images = scandir($image_path);

    $total_images = count($images) - 2;
    $unordered_files = [];

    if (is_dir($image_path)) {
        for ($k = 1; $k < count($images); $k++) {
            if ($images[$k] != '.' || $images[$k] != '..' || $files[$i] != '.svn') {
                $unordered_files[$k] = $images[$k];
            }
        }

        natsort($unordered_files);
    }
    ?>

    <div class="modal fade" id="how-to-modal-<?= $i ?>" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="padding:1%">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><img src="../images/vivaan-armor.png" width="180"></h4>
                </div>
                <div class="modal-body carousel-inner">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php for ($j = 0; $j <= $total_images; $j++) : ?>
                                <li data-target="#myCarousel" data-slide-to="<?= $j ?>" class="active"></li>
                            <?php endfor; ?>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <?php
                                foreach ($unordered_files as $ordered_file) {
                                    echo '<img draggable="false" src="' . Yii::$app->request->baseUrl . '/' . $image_path . $ordered_file . '" alt="" style="width:100 !important">';
                                }
                                ?>
                            </div>
                        </div>

                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
endfor;





