<style>
    .modal-content .modal-header {
    border-bottom: none;
    padding-top: 13px;
    padding-right: 24px;
    }
    h3, .h3 {
    font-size: 2.55em !important;
    }
    .modal-content .modal-body {
    
    min-height: 25vh;
    }
    p {
    margin: 25px 20px 10px;
    font-size: large;
}
.btn-primary{
    margin: 30px 175px 10px;
}
body{
    background-image: url(../images/login-background.png);
        background-size: cover;
}
</style>


<div id="modal1" class="fade modal in" role="dialog" tabindex="-1" style="display: block;">
<div class="modal-dialog " style="margin-top: 190px;">
<div class="modal-content">
<div class="modal-header">
   <h3 style="margin:0px !important;color:#d50000; text-align: center;padding: 4px !important ;"> 
       <img src="<?= Yii::$app->request->baseUrl ?>/images/warning.png" width="40">   <b>License Expired</b></h3>

</div>
<div class="modal-body">
<div id="modalContent">
<p>Your License has expired please contact Admin for renewal</p>
<a href="<?= Yii::$app->request->baseUrl ?>/site/logout" data-method="GET"> 
<button style="align: center;" type="button" class="btn btn-primary pull-left">Go to Login</button></a>
</div>
</div>

</div>
</div>
</div>