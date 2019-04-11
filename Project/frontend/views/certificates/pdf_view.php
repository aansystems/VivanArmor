<style>
    @media print
    {
        * {-webkit-print-color-adjust:exact;}
    }
    h1,h2,h3,h4,p{
        padding: 0px;
        line-height: 1em;
    }
    .card .card-content{
        padding: 0px !important;
    }
    .container-fluid{
        background-image: url("../images/1.png");
        background-repeat: no-repeat;
        background-size: cover;


    }
    .card-content{
        background-image: url("../images/3.png");
        background-repeat: no-repeat;
        background-size: cover;
        height: -webkit-fill-available;
    }
    .card_text{
        background-image: url("../images/2.png");
        background-repeat: no-repeat;
        background-size: cover;
        height: -webkit-fill-available;
    }
    .top_logo{
        background-image: url("../images/5.png");
        background-repeat: no-repeat;
        background-size: cover;
        height: -webkit-fill-available;
    }

</style>


<div class="container-fluid" style="background:url(<?= Yii::$app->request->baseUrl ?>/images/1.png);background-repeat: no-repeat;background-size: cover;height:100%">



    <div class="card-content" style="background:url(<?= Yii::$app->request->baseUrl ?>/images/3.png);background-repeat: no-repeat;background-size: cover;height:100%">
        <div class="card_text" style="background:url(<?= Yii::$app->request->baseUrl ?>/images/2.png);background-repeat: no-repeat;background-size: cover;height:100%">
            <div class="top_logo" style="background:url(<?= Yii::$app->request->baseUrl ?>/images/5.png)">
                <div style="text-align: center;"><br><center style="margin-top:11%;"><h4><b>This certificate has been awarded to</b></h4><h4> <p></p></h4></center></div>
                <div style="text-align: center;"><center><h2><?= $user_name; ?></h2></center></div>
                <div style="text-align: center;"><p class="bodytext"></p><center><h3> For successfully completing the course </h3><p></p></center></div>
                <div style="text-align: center;"><br><p class="bodytext"></p><center><h2 style="color:#660033;"><?= $certificate_name; ?></h2> <p></p></center></div>
                <div style="text-align: center;"><center><h2><p class="normalred" style="color:#FF0000; margin-bottom:10px;">Award Date:<?= $issue_date; ?></p></h2></center></div>
                <div style="float:left;"><br></div>
                <div style='margin-left: 12%'><b>Training Manager  </b> 
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>Councilor</b></div>

                                            
            </div></div></div></div>