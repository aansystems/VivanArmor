<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

/* @var $this yii\web\View */
$request = Yii::$app->request;
$id = $request->get('id');

?>

<style>

    .container {
        width: 800px;
    }
    .cardd-block img {
        width: 130px !important;
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
        color: #FFFFFF !important;
    }

    .cardds {
        padding: 15px;
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

    @media screen and (max-width: 991px) {
        .cardd {
            width: calc((100% / 2) - 30px);
        }
    }
    @media screen and (max-width: 767px) {
        .cardd {
            width: 100%;
        }
    }
    .cardd:hover .cardd__inner {
        background-color: #1abc9c;
        transform: scale(1.05);
    }
    .cardd__inner {
        padding: 10px;
        position: relative;
        cursor: pointer;
        background-color: #949fb0;
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
        background-color: #333a45;
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
    .cardd.is-expanded .cardd__inner {
        background-color: #1abc9c;
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
        border-bottom: 15px solid #333a45;
    }
    .cardd.is-expanded .cardd__inner .fa:before {
        content: "\f115";
    }
    .cardd.is-expanded .cardd__expander {
        max-height: 150px;
        min-height: 300px;
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
        background-color: #949fb0;
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

    #private-block {
        background: #FF512F;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #DD2476, #FF512F);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #DD2476, #FF512F); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    #public-block {
        background-image: linear-gradient(to right, #09203f 0%, #537895 100%);
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
        font-size: 18px;
        font-weight: 500 !important;
        color: #FFFFFF;
        margin-top: 0px;
    }

    .otp-buttons button {
        border-radius: 0;
    }

    .restricted{

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

        height: 150px;

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

    .can {
        margin-left: 15px !important;
    }
    .form-group .form-control {
        margin-bottom: 7px;
        margin-left: 15px;
    }
    .resend{
        display: none;
    }
    
    .modal-header .close {
    margin-top: 1px;
}
.modal .close {
    font-size: 40px;
    font-weight: inherit;
}
</style>

<div class="container">
    <div class="cardds">
        <div class="cardd [ is-collapsed ]">
            <div class="cardd__inner [ js-expander ] restrict" id="private-block">
                <div class="cardd-block">
                    <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/dms/private.png">
                </div>
                <div class="cardd-footer  ">
                    <h6>Restriced & Confidential</h6>
                </div>
            </div>
            <div class="restricted">
                <div class="cardd__expander col-md-12">
                    <i class="fa fa-close close-private [ js-collapser ]"></i>
                    <div class="row">
                        <h6 class="text-uppercase text-center"><?= $content_type ?>s List</h6><br/><br/>
                         <?php if (empty($data)) { ?>
                            <div class="col-md-offset-4 col-md-8">
                                <p>No Documents Available</p>
                            </div>
                        <?php } else { ?>
                       <div class="col-md-6  text-center">
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
                        <div class="col-md-5 col-md-offset-1 ">
                            <div class="private-docs">
                                <?php
                                foreach ($data as $value) {
                                    ?>
                                    <?php if (($value['content_name'] != NULL)) { ?>
                                        <ul class="list-group list-group-flush">
                                            <center> <li class="list-group-item"><?= $value['content_name'] ?></li></center>
                                        </ul>
                                    <?php } else { ?>
                                        <P> No documents present </p>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                         <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="cardd [ is-collapsed ] public">
            <div class="cardd__inner [ js-expander ]" id="public-block">
                <div class="cardd-block">
                    <img draggable="false" src="<?= Yii::$app->request->baseUrl ?>/images/dms/public.png">
                </div>
                <div class="cardd-footer">
                    <h6>Public & Internal Use</h6>
                </div>
            </div>
            <div class="cardd__expander">
                <i class="fa fa-close [ js-collapser ]"></i>
                <div class="row ">
                    <h6 class="text-uppercase text-center"><?= $content_type ?>s List</h6><br/><br/>
                    <?php if (empty($data1)) { ?>
                        <div class="col-md-offset-4 col-md-8">
                            <p>No Documents Available</p>
                        </div>
                    <?php } else { ?>
                    <div class="col-md-6 ">
                        <div class="public-docs">
                            <?php
                            foreach ($data1 as $value1) {
                                ?>
                                <ul class="list-group list-group-flush ">
                                    <center><li class="list-group-item"><?= $value1['content_name'] ?></li></center>
                                </ul>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= Yii::$app->request->baseUrl ?>/contents/final-view?id=<?= $id ?>">
                            <div class="cardd-content text-center scrollbar">
                                <h6 class="course-name text-capitalize">Take Me to View Documents</h6>
                            </div>
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
    
    
        $('.modal-header h4').html('$content_type').css('color','white');
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
    $('.modal-header h4').html('$content_type').css('color','white');;
    
    $(".restrict").click(function () {   
        $(".restricted").show();
       $(".otp-buttons").hide();  
    });
        
         $(".otp").click(function () { 
        $("#toast-container").show();
        $(".otp-buttons").show();
         $(".resend").show();
        
         $(".otp").hide();
        $("#toast-container").animate({opacity: 1.0}, 3000).fadeOut("slow");
        $.get('password', {id:$id}, function(name) {
        }); 
    });
        
         $(".close-private").click(function () {
        $(".otp").show();
         $(".otp-buttons").hide();
        
        });
        
          $(".resend").click(function () { 
        $("#toast-container").show();
         $.get('password', {id:$id}, function(name) {
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
