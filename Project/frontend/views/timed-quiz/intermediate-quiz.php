<?php
$request = Yii::$app->request;

$get = $request->get();
$id = $request->get('id');
?>

<style>
    .image-header {
        background-image: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%) !important;
        width: 50%;
    }

    .image-header img {
        width: auto;
        padding: 3%;
    }

    .intermediate-card {
        box-shadow: 0 1px 4px 0 rgba(7, 7, 7, 0.27);
    }

    .intermediate-card h3 {
        font-weight: 900;
    }

    .col-md-offset-3 {
        margin-left: 24%;
    }

    .col-md-offset-3 {
        margin-left: 24%;
    }
    .container-fluid{
        margin-top: 3%;
    }
    .intermediate-card{
        margin-top: -2%;
    }
    .btn.btn-primary{
        padding: 12px 1px 7px 1px !important;
        width: 130px !important;
        margin: 10px 1px;
    }
    .btn.btn-default{
        padding: 12px 1px 7px 1px !important;
        width: 130px !important;
        margin: 10px 1px;
    }
    @media (max-width: 1100px) and (min-width: 980px){
        .col-md-6{
            width: 80% !important;
        }
        .col-md-offset-3 {
            margin-left: 10%;
        }
    }
    @media (max-width: 979px) and (min-width: 768px){
        .col-md-6{
            width: 80% !important;
        }
        .col-md-offset-3 {
            margin-left: 10%;
        }
    }
    @media (max-width: 767px) and (min-width: 601px){
        .col-xs-6{
            width: 80% !important;
        }
        .col-md-offset-3 {
            margin-left: 10%;
            margin-right: 10%;
        }
        .image-header img{
            width:70% !important;
        }
        .container-fluid{
            margin-top: 8% !important;
        }
    }
    @media (max-width: 600px) and (min-width: 401px){
        .container-fluid{
            margin-top: 11% !important;
        }
        .col-xs-6{
            width: 90% !important;
        }
        .col-md-offset-3 {
            margin-left: 5%;
            margin-right: 5%;
        }
        .image-header img{
            width:100% !important;
        }
        h3{
            font-size: 1.2em;
            margin: -10px 0 10px;
        }
        .btn.btn-default {
            padding: 12px 1px 7px 1px !important;
            width: 110px !important;
            margin: 10px 1px;
            font-size: 10px;
        }
        .btn.btn-primary{
            padding: 12px 1px 7px 1px !important;
            width: 110px !important;
            margin: 10px 1px;
            font-size: 10px;
        }
        .card .card-footer{
            margin: 0 -5px 10px;
        }

    }
    @media (max-width: 400px) and (min-width: 320px){
        .container-fluid{
            margin-top: 13% !important;
        }
        .col-xs-6{
            width: 100% !important;
        }
        .col-md-offset-3 {
            margin-left: 5%;
            margin-right: 5%;
        }
        .image-header img{
            width:100% !important;
        }
        h3{
            font-size: 1.0em;
            margin: -10px 0 10px;
        }
        .btn.btn-default {
            padding: 9px 1px 5px 1px !important;
            width: 90px !important;
            margin: -5px 1px;
            font-size: 8px;
        }
        .btn.btn-primary{
            padding: 9px 1px 5px 1px !important;
            width: 90px !important;
            margin: 10px 1px;
            font-size: 8px;
        }
        .card .card-footer{
            margin: 0 -5px 10px;
        }

    }
</style>

<div class="container-fluid">
    <div class="card">
        <div class="card-header1 card-header-text" data-background-color="blue">
            <h4 class="card-title text-uppercase">Quiz Confirm</h4>
        </div>
        <div class="card-content"><br/><br/><br/><br/>
            <center>
                <div class="col-md-6 col-md-offset-3">
                    <div class="card intermediate-card">
                        <div class="card-header1 card-header-text image-header" data-background-color="blue">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/quiz-on-computer.png">
                        </div>
                        <div class="card-content"><br/><br/>
                            <h3>Are you sure you want to take this quiz? You cannot cancel once you confirm! </h3>

                            <div class="card-footer text-center test-buttons">
                                <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz">
                                    <button type="button" class="btn btn-default"> << &nbsp;No, later !</button>
                                </a>
                                <?php
                                $cryptKey = '1bv4ha3ar1ts4ha3';
                                $question = rtrim(strtr(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $random_questions, MCRYPT_MODE_CBC, md5(md5($cryptKey)))), '+/', '-_'), '=');
                                ?>
                                <a href="#">
                                    <button type="button" onclick="openWin()" class="btn btn-primary">Yes, Proceed ! &nbsp;>></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </center><br/><br/><br/><br/>
        </div>
    </div>
</div>
<?php $test_link = Yii::$app->request->baseUrl . '/timed-quiz/timed-quiz?id=' . $id . '&& random_questions=' . $question; ?>
<script>
    var test = '<?php echo $test_link; ?>';//get the current data-id you the row
    var width = screen.availWidth;
    var height = screen.availHeight;
    var myWindow;
    var existingWin = window.open('', 'popup');
    console.log(existingWin);
    function openWin() {
        if (existingWin === null) {
            myWindow = window.open(test, 'popup', 'width=' + width + ',height=' + height + ', left=0,top=0');
        } else {
            alert("please complete the opened exam! or pls close the opened window");
        }
        $('.test-buttons').remove();
    }
</script>