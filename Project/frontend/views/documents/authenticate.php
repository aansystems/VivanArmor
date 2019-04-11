<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

/* @var $this yii\web\View */
$request = Yii::$app->request;
$id = $request->get('id');
?>

<style>
    .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }
    #private-block img,  #public-block img{
        width: 150px !important;
        padding: 20px;
    }

    .cardd__expander img {
        width: 250px !important;
        padding: 20px 20px 40px 20px;
    }

    .cardd__expander p {
        font-size: 12px;
    }

    .cardd-footer h6 {
        font-weight: 500;
        color: #000000 !important;
    }

    .cardds {
        padding: 0px;
        display: flex;
        flex-flow: row wrap;
    }
    .cardd {
        margin: 15px;
        width: calc((150% / 3) - 30px);
        transition: all 0.2s ease-in-out;
        background: transparent;
        box-shadow: none;
    }

    .private-header {
        background-image: linear-gradient(-20deg, #fc6076 0%, #ff9a44 100%) !important;
        width:50%;
    }

    .private-card {
        border-top: 3px solid #ff924a;
    }

    .public-header {
        background-image: linear-gradient(120deg, #16a085 0%, #7dd838 100%) !important;
        width: 50%;
    }

    .public-card {
        border-top: 3px solid #65cb4a;
    }

    @media screen and (max-width: 991px) {
        .cardd {
            width: calc((100% / 2) - 30px);
        }
        .col-md-offset-1 {
            margin-left: 8.33333333%;
        }

        .modal-content{
            width: 125%;
            margin-left: -10%;
        }
    }

    @media screen and (min-width: 992px) and (max-width: 1150px) {
        .modal-content{
            width: 125% !important;
            margin-left: -10% !important;
        } 
    }

    @media screen and (min-width: 470px) and (max-width: 767px) {
        .cardd:nth-of-type(3n+2) .cardd__expander {
            margin-left: calc(-100% - 10px);
        }
        .cardd:nth-of-type(3n+3) .cardd__expander {
            margin-left: calc(-200% - 60px);
        }
        .cardd:nth-of-type(3n+4) {
            clear: left;
        }
        .cardd__expander {
            width: calc(193% + 30px) !important;
        }
        .cardd {
            width: 47%;
            margin:0px;
            margin-left: 10px;
        }
        .modal-content {
            width: 140%;
            margin-left: 10%;
        }
        p {
            margin: -30px 0 10px !important;
        }
        .cardd__expander h6{
            margin-top: 20% !important;
        }
        .col-md-offset-1 {
            margin-left: 1%;
        }
    }
    @media screen and (min-width: 320px) and (max-width: 469px) {
        .cardd {
            width: 100%;
            margin:0px;
            margin-top: 10px;
        }
        .modal-content {
            width: 140%;
            margin-left: 10%;
        }
        p {
            margin: -30px 0 10px !important;
        }
        .cardd__expander h6{
            margin-top: 40% !important;
        }

        .cardd__expander{
            width: 100% !important;
        }
        .modal-content .modal-body{
            padding-left: 0px !important; 
        }
        .list-group-item{
            font-size: 12px!important;
        }
        .cardd__expander h6{
            font-size: 12px !important;
        }
        .col-md-offset-1 {
            margin-left: 0%; 
        }
    }

    .cardd__inner {
        padding: 10px;
        position: relative;
        cursor: pointer;
        color: #eceef1;
        text-transform: uppercase;
        text-align: center;
        transition: all 0.2s ease-in-out;
    }
    .cardd__inner:after {
        transition: all 0.3s ease-in-out;
    }
    .cardd__inner .fa {
        width: 100%;
        margin-top: 0.25em;
    }
    .cardd__expander {
        transition: all 0.2s ease-in-out;
        background-image: linear-gradient(45deg, #8baaaa 0%, #ae8b9c 100%);
        width: 100%;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        text-transform: uppercase;
        color: #eceef1;
        font-size: 1.5em;
    }
    .cardd__expander .fa {
        font-size: 0.75em;
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }
    .cardd__expander .fa:hover {
        opacity: 0.9;
    }
    .cardd.is-collapsed .cardd__inner:after {
        content: "";
        opacity: 0;
    }

    .cardd.is-collapsed .cardd__expander {
        max-height: 0;
        min-height: 0;
        overflow: hidden;
        margin-top: 0;
        opacity: 0;
    }

    .cardd.is-expanded .cardd__inner:after {
        content: "";
        opacity: 1;
        display: block;
        height: 0;
        width: 0;
        position: absolute;
        bottom: -30px;
        left: calc(50% - 15px);
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-bottom: 15px solid #999da4;
    }

    .cardd.is-expanded .cardd__inner .fa:before {
        content: "\f115";
    }
    .cardd.is-expanded .cardd__expander {
        max-height: 150px;
        min-height: 310px;
        overflow: visible;
        margin-top: 30px;
        opacity: 1;
        z-index: 999;
    }
    .cardd.is-expanded:hover .cardd__inner {
        transform: scale(1);
    }

    .cardd.is-inactive .cardd__inner {
        pointer-events: none;
    }

    .cardd.is-inactive:hover .cardd__inner {
        transform: scale(1);
    }
    @media screen and (min-width: 992px) {
        .cardd:nth-of-type(3n+2) .cardd__expander {
            margin-left: calc(-100% - 30px);
        }
        .cardd:nth-of-type(3n+3) .cardd__expander {
            margin-left: calc(-200% - 60px);
        }
        .cardd:nth-of-type(3n+4) {
            clear: left;
        }
        .cardd__expander {
            width: calc(200% + 50px);
        }
    }
    @media screen and (min-width: 768px) and (max-width: 991px) {
        .cardd:nth-of-type(2n+2) .cardd__expander {
            margin-left: calc(-100% - 30px);
        }
        .cardd:nth-of-type(2n+3) {
            clear: left;
        }
        .cardd__expander {
            width: calc(200% + 30px);
        }
    }

    .row {
        width: 100%;
    }

    .list-group-item {
        font-size: 14px;
        border-left: 0;
        border-right: 0;
    }

    .list-group-item:first-child {
        border-top-left-radius: 0; 
        border-top-right-radius: 0; 
        border-top: 0;
    }

    .list-group-item:last-child {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .list-group li {
        background: transparent;
    }

    .cardd__expander h6 {
        font-size: 17px;
        font-weight: 300 !important;
        color: #FFFFFF;
        margin-top: 0px;
    }

    .otp-buttons button {
        border-radius: 0;
    }

    .restricted-documents{
        display:none;
    }

    .modal-header {
        background: linear-gradient(60deg, #2F80ED, #56CCF2);
        text-align: center;
        padding: 4px !important;
    }

    .help-block  {
        margin-top: 15px;
    }

    .private-docs{
        height: 150px;
        overflow-y: auto;  
    }

    .public-docs {
        height: 200px;
        overflow-y: auto;
    }

    #toast-container{
        display:none;
    }

    .btn, .navbar .navbar-nav > li > a.btn {
        border: none;
        border-radius: 3px;
        position: relative;
        padding:8px 10px 5px 10px;
        margin: 10px 1px;
        font-size: 12px;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 0;
        will-change: box-shadow, transform;
        transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .cancel-button {
        margin-left: 2px !important;
    }

    .form-group .form-control {
        margin-bottom: 7px;
        margin-left: 15px;
    }

    .resend-otp{
        display: none;
    }

    .modal .close {
        font-size: 45px;
        font-weight: 300;
    }

    .modal-content .modal-body {
        padding-top: 15px;
        padding-left: 0px;
        min-height: auto;
        padding-right: 0px;
    }

    .public-docs .documents-list {
        border: 1px solid #ECEEF1;
        width: 24%;
        margin: 0.5%;
        height: 150px;
    }
    
    .private-docs .documents-list {
        border: 1px solid #ECEEF1;
        width: 100%;
        margin-bottom: 0.5%;
        
    }

    .file-icon {
        font-size: 30px !important;
        opacity: 0.7;
    }

    .fa-2x {
        font-size: 1.8em !important;
        opacity: 0.3;
    }

    .doc-name {
        margin-top: 35%;
        font-size: 15px !important;
        font-weight: 500;
        text-transform: capitalize;
    }
    
    .public_doc {
        margin-top: 3%;
        font-size: 15px !important;
        font-weight: 500;
        text-transform: capitalize;
    }
</style>

<div class="container">
    <div class="cardds">
        <div class="cardd [ is-collapsed ]">
            <div class="cardd__inner [ js-expander ] restricted-main" id="private-block">
                <div class="card private-card">
                    <center>
                        <div class="card-header1 private-header" data-background-color="blue">
                            <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/dms/private.png">
                        </div>
                    </center>
                    <div class="card-content"> 
                        <div class="cardd-footer ">
                            <h6>Restricted & Confidential</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="restricted-documents">
                <div class="cardd__expander col-md-12 col-sm-12 col-xs-12">
                    <i class="fa fa-close close-private [ js-collapser ]"></i>
                    <div class="row">
                        <h6 class="text-uppercase text-center"><?= $doc_name ?>s List</h6><br/><br/>
                        <?php if (empty($private_doc)) { ?>
                            <div class="col-md-12">
                                <p class="text-center">No Documents Available</p>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-6 col-sm-5 col-xs-11 text-center">
                                <div class="row">
                                    <p class="text-center">Enter the OTP sent to your email</p>
                                    <div class="form-group">
                                        <?= Html::input('password', 'password', '', ['class' => 'form-control', 'maxlength' => 26, 'placeholder' => 'OTP', 'id' => "search-criteria"]) ?>
                                    </div>
                                    <p class="resend-otp pull-right"><a href="#">Resend OTP</a></p>

                                    <div class=" wrong-password" style="display:none"> 
                                        <p class="text-red"> Password Entered is Incorrect </p>
                                    </div>

                                    <div class="col-md-2 pull-left otp">
                                        <?= Html::Button('Send OTP', ['class' => 'btn btn-success ']) ?>
                                    </div>

                                    <div class="col-md-offset-2 pull-left otp-buttons">
                                        <?= Html::Button('Submit', ['class' => 'btn btn-success check-password submit-button']) ?>
                                    </div>
                                    <div class="pull-left otp-buttons">
                                        <?= Html::Button('Cancel', ['class' => 'btn btn-danger cancel-button', 'data-dismiss' => 'modal']) ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 col-sm-6 col-xs-11 col-md-offset-1 ">
                                <div class="private-docs">
                                      <div class="row">
                                    <?php
                                    foreach ($private_doc as $private_doc_name) {
                                        ?>
                                   
                                        <div class="col-md-12 documents-list">
                                            <div class="col-md-12 text-left">
                                                <i class="fa fa-file-text fa-2x" aria-hidden="true"></i> 
                                            </div>
                                            <div class="col-md-12">
                                                <p class="text-center doc-name"> <?= $private_doc_name['document_name'] ?> </p>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="cardd [ is-collapsed ] public">
            <div class="cardd__inner [ js-expander ]" id="public-block">
                <div class="card public-card">
                    <center>
                        <div class="card-header1 public-header" data-background-color="blue">
                            <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/dms/public.png">
                        </div>                            
                    </center>
                    <div class="card-content"> 
                        <div class="cardd-footer ">
                            <h6>Public & Internal Use</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cardd__expander">
                <i class="fa fa-close [ js-collapser ]"></i>

                <div class="row"><br/>
                    <h6 class="text-uppercase text-center"><?= $doc_name ?>s List</h6><br/><br/>
                    <?php if (empty($public_doc)) { ?>
                        <div class="col-md-12">
                            <p class="text-center">No Documents Available</p>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-12">
                            <div class="public-docs">
                                <div class="row">
                                    <?php
                                    foreach ($public_doc as $public_doc_name) {
                                        ?>
                                        <div class="col-md-3 documents-list">
                                            <div class="col-md-12 text-left">
                                                <i class="fa fa-file-text fa-2x" aria-hidden="true"></i> 
                                            </div>
                                            <div class="col-md-7">
                                                <p class="text-center public_doc"> <?= $public_doc_name['document_name'] ?> </p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <a href="<?= Yii::$app->request->baseUrl ?>/documents/finalised-docs?id=<?= $id ?>">
                                <h6 class="course-name text-capitalize text-right"><b>Take Me to View Documents >></b></h6>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="toast-container" class="toast-top-right" aria-live="polite" role="alert">
    <div class="toast toast-success">
        <div class="toast-message">OTP has been sent to your mail</div>  
    </div>
</div>

<script type="text/javascript">
    var $cell = $('.cardd');

    //open and close cardd when clicked on cardd
    $cell.find('.js-expander').click(function () {

        var $thisCell = $(this).closest('.cardd');

        if ($thisCell.hasClass('is-collapsed')) {
            $cell.not($thisCell).removeClass('is-expanded').addClass('is-collapsed').addClass('is-inactive');
            $thisCell.removeClass('is-collapsed').addClass('is-expanded');

            if ($cell.not($thisCell).hasClass('is-inactive')) {
                //do nothing
            } else {
                $cell.not($thisCell).addClass('is-inactive');
            }

        } else {
            $thisCell.removeClass('is-expanded').addClass('is-collapsed');
            $cell.not($thisCell).removeClass('is-inactive');
        }
    });

    $cell.find('.js-collapser').click(function () {

        var $thisCell = $(this).closest('.cardd');

        $thisCell.removeClass('is-expanded').addClass('is-collapsed');
        $cell.not($thisCell).removeClass('is-inactive');

    });
</script>




<?php
$script = <<< JS
    $('.modal-header h4').html('$doc_name').css('color','white');;
    
    $(".restricted-main").click(function () {   
        $(".restricted-documents").show();
       $(".otp-buttons").hide();  
    });
        
         $(".otp").click(function () { 
         $.get('password', {doc_id:$id}, function(name) {
        }); 
        $("#toast-container").show();
        $(".otp-buttons").show();
         $(".resend-otp").show();
        
         $(".otp").hide();
        $("#toast-container").animate({opacity: 1.0}, 3000).fadeOut("slow");
       
    });
        
         $(".close-private").click(function () {
        $(".otp").show();
         $(".otp-buttons").hide();
        
        });
        
          $(".resend-otp").click(function () { 
        $("#toast-container").show();
         $.get('password', {doc_id:$id}, function(name) {
        });
        });
   $(".check-password").click(function () {
        var password = document.getElementById('search-criteria').value;
        $.get('check-passwords', {password ,id:$id}, function(data) {
            if(data == 1) {
                $('.wrong-password').css('display','block');
            }
        });
    }); 
         
       
    let searchParams = new URLSearchParams(window.location.search);
    if(searchParams.has('page'))  $(".news-button").click();     

JS;
$this->registerJs($script);
?>
