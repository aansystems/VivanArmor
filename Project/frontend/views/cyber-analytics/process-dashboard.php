<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LearnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Process Documents Dashboard';
$this->params['breadcrumbs'][] = $this->title;

$role = Yii::$app->user->identity->role_type;
?>

<style>
    .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
        margin-bottom: 0;
    }
    .policy_div.current {
        border: 2rem solid #C1E344;
        background: none;
    }
    .radio input[type="radio"] {
        opacity: 1;
        height: auto;
        width: auto;
        overflow: hidden;
    }
    .radio {
        margin-left: -1rem;
    }
    .radio label {
        color: black;
        line-height: 2.5rem;
        width: 100%
    }
    .policy_desc {
        max-height: 24rem;
        min-height: 24rem;
        overflow-y: auto;
        font-size: initial;
    }
    ::-webkit-scrollbar {
        width: 0px;  /* remove scrollbar space */
        background: transparent;  /* optional: just make scrollbar invisible */
    }
    /* optional: show position indicator in red */
    ::-webkit-scrollbar-thumb {
        background: #FF0000;
    }
    input[type=file] {
        cursor: pointer;
        display: block; 
        height: 100%; 
        opacity: 1 !important; 
        position: relative; 
        width: 100%;
    }
    .div-policy {
        background-image: linear-gradient(-120deg, #dde49f 0%, #fbfcdb 100%);
        min-height: 26rem;
        max-height: 26rem;
        border-bottom: 0.2rem solid white;
    }
    .div-policy.policy_div {
        min-height: 48rem;
        max-height: 48rem;
    }
    .upload-doc {
        margin: 1rem 1rem 2rem 7.5rem;
    }
    input[type=file] {
        display: inline-block;
        width: 50%;
        margin-left: 1.5rem;
    }
    input[type=date] {
        margin-left: 1.5rem
    }
    .checkbox+.checkbox, .radio+.radio {
        margin-top: -10px;
    }
    .radio label, label {
        font-size: large;
    }
    .legend {
        height: 1rem;
        width: 1.5rem;
    }
    @media (min-height: 890px) {
        #policies {
            max-height: 70rem;
        }
        .div-policy.policy_div {
            min-height: 70rem;
            max-height: 70rem;
        }
    }
    @media (max-width: 767px){
        .col-sm-12 {
            width: 100%;
        }
        .col-sm-8 {
            margin-top: -10px;
        }
    }
    @media (max-width: 991px){
        .col-sm-8 {
            width: 100% !important;
        }
    }
    @media (min-width: 992px) and (max-width: 1223px){
        .div-options{
            min-height: 30rem;
            max-height: 30rem;
        }
        .div-status{
            min-height: 30rem;
            max-height: 30rem;
        }

    }
    @media (min-width: 768px) and (max-width: 1100px) {
        .div-policy{
            min-height: 28rem;
            max-height: 28rem;
        } 
    }
    @media (min-width: 1210px){
        .div-options{
            min-height: 18rem;
            max-height: 18rem;
        }
    }
    @media (max-width: 440px){
        .div-options{
            min-height: 30rem;
        }
    }
    @media (min-height: 890px) {
        .div-policy{
            min-height: 47rem;
        }
        .policy_desc{
            max-height: 38rem;
            min-height: 38rem;
        }
        .div-links{
            max-height: 43.5rem;
            min-height: 43.5rem;
        }
        .policy_div {
            max-height: 70rem;
            overflow-y: auto;
        }
    }

    #policies {
        max-height: 48rem;
        overflow-y: auto;
        margin-right: -0.01rem;
    }
    @media (min-height: 890px) {
        .div-policy{
            min-height: 47rem;
        }
        .policy_desc{
            max-height: 38rem;
            min-height: 38rem;
        }
        .div-links{
            max-height: 43.5rem;
            min-height: 43.5rem;
        }
        .policy_div {
            max-height: 70rem;
            overflow-y: auto;
        }
    }

    ::-webkit-scrollbar { 
        display: none;
    }
    /*  vertical tab */
    div.vertical-tab-container {
        z-index: 10;
        background-color: #ffffff;
        padding: 0 !important;
        border-radius: 4px;
        -moz-border-radius: 4px;
        border:1px solid #ddd;
        margin-top: 20px;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        background-clip: padding-box;
        opacity: 0.97;
        filter: alpha(opacity=97);
    }

    div.vertical-tab-menu{
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
        height: 550px;
        overflow-y: scroll;
    }

    div.vertical-tab-menu div.list-group{
        margin-bottom: 0;
    }

    div.vertical-tab-menu div.list-group>a{
        margin-bottom: 0;
        color: #000000;
        font-weight: 500 !important;
    }

    div.vertical-tab-menu div.list-group>a .glyphicon,
    div.vertical-tab-menu div.list-group>a .fa {
        color: #7B7B7B;
    }

    div.vertical-tab-menu div.list-group>a:first-child {
        border-top-right-radius: 0;
        -moz-border-top-right-radius: 0;
    }

    div.vertical-tab-menu div.list-group>a:last-child {
        border-bottom-right-radius: 0;
        -moz-border-bottom-right-radius: 0;
    }

    div.vertical-tab-menu div.list-group>a.active,
    div.vertical-tab-menu div.list-group>a.active .glyphicon,
    div.vertical-tab-menu div.list-group>a.active .fa {
        color: #ffffff;
    }

    div.vertical-tab-menu div.list-group>a.active:after {
        content: '';
        position: absolute;
        left: 95%;
        top: 50%;
        margin-top: -13px;
        border-right: 0;
        border-bottom: 13px solid transparent;
        border-top: 13px solid transparent;
        border-right: 15px solid #FFFFFF;
    }

    div.vertical-tab-content {
        background-color: #ffffff;
        padding-left: 20px;
        padding-top: 10px;
    }

    div.vertical-tab div.vertical-tab-content:not(.active) {
        display: none;
    }

    .board {
        width: 100%;
        height: auto;
        overflow-y: scroll;
        background: #fff;
    }

    .board .nav-tabs {
        position: relative;
        margin: 2rem auto;
        margin-bottom: 0;
        box-sizing: border-box;
    }

    .board > div.board-inner {
        background: #fafafa;
        background-size: 30%;
    }

    div.narrow {
        width: 100%;
        padding-left: 5%;
        padding-right: 5%;
        font-size: 16px;
        line-height: 25px;
        font-weight: 400;
    }

    .liner {
        height: 2px;
        background: #ddd;
        position: absolute;
        width: 80%;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: 50%;
        z-index: 1;
    }

    .nav-tabs {
        background: none !important;
        border: 1px solid #9A9A9A;
    }

    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
        color: #555555;
        cursor: default;
        border: 0;
        border-bottom-color: transparent;
    }

    span.round-tabs {
        width: 70px;
        height: 70px;
        line-height: 70px;
        display: inline-block;
        border-radius: 100px;
        background: white;
        z-index: 2;
        position: absolute;
        left: 0;
        text-align: center;
        font-size: 25px;
    }

    span.round-tabs.one {
        color: rgb(34, 194, 34);
        border: 2px solid rgb(34, 194, 34);
    }

    li.active span.round-tabs.one {
        background: rgb(34, 194, 34) !important;
        border: 2px solid #ddd;
        color: #FFFFFF;
    }

    span.round-tabs.two{
        color: #f1685e;
        border: 2px solid #f1685e;
    }

    li.active span.round-tabs.two{
        background: #f1685e !important;
        border: 2px solid #ddd;
        color: #FFFFFF;
    }

    span.round-tabs.three{
        color: #467ce2;
        border: 2px solid #467ce2;
    }

    li.active span.round-tabs.three{
        background: #467ce2 !important;
        border: 2px solid #ddd;
        color: #FFFFFF;
    }

    span.round-tabs.four{
        color: orange;
        border: 2px solid orange;
    }

    li.active span.round-tabs.four{
        background: orange !important;
        border: 2px solid #ddd;
        color: #FFFFFF;
    }

    span.round-tabs.five{
        color: #999999;
        border: 2px solid #999999;
    }

    li.active span.round-tabs.five{
        background: #999999 !important;
        border: 2px solid #ddd;
        color: #FFFFFF;
    }

    .nav-tabs > li.active > a span.round-tabs{
        background: #fafafa;
    }
    .nav-tabs > li {
        width: 20%;
    }

    .nav-tabs > li:after {
        content: " ";
        position: absolute;
        left: 45%;
        opacity:0;
        margin: 0 auto;
        bottom: 0px;
        border: 5px solid transparent;
        border-bottom-color: #ddd;
        transition:0.1s ease-in-out;

    }
    .nav-tabs > li.active:after {
        content: " ";
        position: absolute;
        left: 45%;
        opacity:1;
        margin: 0 auto;
        bottom: 0px;
        border: 10px solid transparent;
        border-bottom-color: #9A9A9A;

    }
    .nav-tabs > li a{
        width: 70px;
        height: 70px;
        margin: 20px auto;
        border-radius: 100%;
        padding: 0;
    }

    .nav-tabs > li a:hover{
        background: transparent;
    }

    .tab-pane{
        position: relative;
        padding-top: 20px;
    }
    .tab-content .head{
        font-weight: 300;
        font-size: 23px;
        text-transform: uppercase;
        padding-bottom: 10px;
    }
    .btn-outline-rounded {
        padding: 10px 40px;
        margin: 20px 0;
        border: 2px solid transparent;
        border-radius: 25px;
    }

    .btn.green {
        background-color:#5cb85c;
        color: #ffffff;
    }

    .question i:first-child {
        color: rgb(34, 194, 34);
    }

    .question i:nth-of-type(2) {
        color: #F16D63;
    }

    .question i:nth-of-type(3) {
        color: #467ce2;
    }

    .question i:nth-of-type(4) {
        color: orange;
    }
    i.fa.fa-square {
        margin-right: 1%;
    }

    @media( max-width : 585px){

        .board {
            width: 90%;
            height:auto !important;
        }
        span.round-tabs {
    font-size: 9px;
    width: 28px;
    height: 28px;
    line-height: 30px;
}   
        .tab-content .head{
            font-size:20px;
        }
        .nav-tabs > li a {
            width: 50px;
            height: 50px;
            line-height:50px;
        }

        .nav-tabs > li.active:after {
            content: " ";
            position: absolute;
            left: 35%;
        }

        .btn-outline-rounded {
            padding:12px 20px;
        }
    }

    .messagebox {
        border: solid 1px #cecece;
        min-height: 12rem;
        color: #4B515D;
        padding: 0;
        margin-right: 1rem;
        margin-left: 1rem;
        margin-bottom: 1rem;
    }

    .messagebox.success{
        border: solid 1px #00C851;
        border-left: solid 4px #00C851;
    }

    .messagebox.fail{
        border: solid 1px #ff4444;
        border-left: solid 4px #ff4444;
    }

    .messagebox.warning {
        border: solid 1px #ffbb33;
        border-left: solid 4px #ffbb33;
    }

    .messagebox.info {
        border: solid 1px #5BC0DE;
        border-left: solid 4px #5BC0DE;
    }
    .messagebox.not-started {
        border: solid 1px #616161;
        border-left: solid 4px #616161;
    }

    .messagebox-icon{
        padding: 1em;
    }

    .messagebox-detail-link{
        margin-left: 1em;
        margin-right: 1em;
        position: relative;
        right: 0;
    }

    .messagebox .col-md-10 i, .messagebox .col-lg-10 i, .messagebox .col-sm-10 i {
        font-size: 8px;
    }

    @media (min-width: 1200px) {
        .col-lg-4.messagebox {
            width: 30%;
        }
    }
    @media (max-width: 1200px) AND (min-width: 1000px) {
        .col-md-6.messagebox {
            width: 45%;
            min-height: 15rem;
        }
    }
    @media (max-width: 1000px) {
        .col-sm-12.messagebox {
            width: 95%;
            margin-bottom: 1rem;
        }
    }

    .title {
        font-weight: 400;
        letter-spacing: -1px;
    }

    #expanded-status{
        border: solid 1px black;
    }

    .list-group-item h6 {
        font-weight: 500;
    }

    .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
        color: #fff;
        /*border-color: white;*/
    }
    .card img {
        width: 90%;
    }
    .process-pane {
        padding-top: 0;
    }

    .color-red.active, .color-red.active:focus, .color-red.active:hover {
        background: #F16D63;  /* fallback for old browsers */
        border-color: #F16D63;  /* fallback for old browsers */
    }
    .color-red.current {
        border-color: #F16D63;  /* fallback for old browsers */
    }
    label.color-red {
        color: #F16D63;  /* fallback for old browsers */
        background: none;
        border: none;
    }
    .color-green.active, .color-green.active:focus, .color-green.active:hover {
        background: #28C328;  /* fallback for old browsers */
        border-color: #28C328;  /* fallback for old browsers */
    }
    .color-green.current {
        border-color: #28C328;  /* fallback for old browsers */
    }
    label.color-green {
        color: #28C328;  /* fallback for old browsers */
        background: none;
        border: none;
    }
    .color-blue.active, .color-blue.active:focus, .color-blue.active:hover {
        background: #4B80E2;  /* fallback for old browsers */
        border-color: #4B80E2;  /* fallback for old browsers */
    }
    .color-blue.current {
        border-color: #4B80E2;  /* fallback for old browsers */
    }
    label.color-blue {
        color: #4B80E2;  /* fallback for old browsers */
        background: none;
        border: none;
    }
    .color-orange.active, .color-orange.active:focus, .color-orange.active:hover {
        background: #FFA707;  /* fallback for old browsers */
        border-color: #FFA707;  /* fallback for old browsers */
    }
    .color-orange.current {
        border-color: #FFA707;  /* fallback for old browsers */
    }
    label.color-orange {
        color: #FFA707;  /* fallback for old browsers */
        background: none;
        border: none;
    }
    .color-grey.active, .color-grey.active:focus, .color-grey.active:hover {
        background: #616161;  /* fallback for old browsers */
        border-color: #616161;
    }
    .color-grey.current {
        border-color: #616161;
    }
    label.color-grey {
        color: #616161;  /* fallback for old browsers */
        background: none;
        border: none;
    }
    
    @media screen and (max-width: 768px){
        
     .card {
         margin: 75px 0 !important;
        height: 400px;
    }
    }
    
    @media screen and (max-width: 805px){
        
     div.vertical-tab-menu {
    
    height: 637px !important;
    }
     }
     
     @media (min-width: 360px) and (max-width: 600px) {
         .card {
         height: 328px;
    } 
     .card img {
    width: 99%;
    height: 150px;
    }
    div.vertical-tab-container {
    margin-top: -1px;
        height: 273px;
    }
    div.vertical-tab-menu {
    height: 272px !important;
   }

    .board {
    width: 90%;
       height: 190px !important;
    }
    
    .container-fluid {
    padding-right: 0px;
    padding-left: 0px;

     }
     
     .list-group-item h6 {
    font-weight: 500;
    font-size: smaller;
    word-break: break-word;
}
     
     h3, .h3 {
    font-size: 1.25em;
     }
     .col-xs-9 ,.col-lg-10, .col-md-9, .col-sm-9,.col-xs-9 {
            padding-right: 8px;
    padding-left: 8px; 
     
     }
     }
     
     @media (min-width:600px) and (max-width:767px) {
             div.vertical-tab-container {
                    height: 310px !important;
             }
             div.vertical-tab-menu {
      height: 308px !important;
          }
.card img {
    width: 96%;
}


div.vertical-tab-content {
   
    height: 276px;
}
     
     h3, .h3 {
    font-size: 1.6em;
     }
     
     section, summary {
    
    height: inherit;
    overflow-y: scroll;
}
     }
    
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase">Process Documents Dashboard</h4>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 vertical-tab-container">
                                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 vertical-tab-menu">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item hide text-center active">
                                            <i class="fa fa-low-vision fa-2x"></i><br/>
                                            <h6 class="text-capitalize">Process Dashboard</h6>
                                        </a>
                                        <?php foreach ($array1 as $array) {
                                            ?>
                                            <a href="#" id="policy_<?= $array['data']->id ?>" class="list-group-item text-center 
                                            <?php
                                            if (!empty($array['policy_option'])) {
                                                switch ($array['policy_option']->id) {
                                                    case 1: echo 'color-green';
                                                        break;
                                                    case 2: echo 'color-red';
                                                        break;
                                                    case 3: echo 'color-blue';
                                                        break;
                                                    case 4: echo 'color-orange';
                                                        break;
                                                    default:
                                                }
                                            } else {
                                                echo 'color-grey';
                                            }
                                            ?>
                                               ">
                                                <i class="fa <?= $array['data']->fa_icon ?> fa-2x"></i><br/>
                                                <h6 class="text-capitalize"><?= $array['data']->template_name ?></h6>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 vertical-tab">
                                    <div class="vertical-tab-content active">
                                        <section>
                                            <div class="row">
                                                <h3 class="title">Process Documents</h3>
                                                <div class="board">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade in active process-pane">
                                                            <img src="<?= Yii::$app->request->baseUrl ?>/images/vivaan-armor.jpg" alt="" width="100%">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <?php
                                foreach ($array2 as $array) {
                                    ?>
                                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-9 vertical-tab">
                                        <div class="vertical-tab-content">
                                            <section>
                                                <div class="row">
                                                    <h3 class="title"><?= $array['data']->template_name ?></h3>
                                                    <div class="board">
                                                        <div class="board-inner">
                                                            <ul class="nav nav-tabs" id="myTab">
                                                                <div class="liner"></div>
                                                                <li class="active">
                                                                    <a href="#description_<?= $array['data']->id ?>" data-toggle="tab" title="description">
                                                                        <span class="round-tabs one">
                                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                        </span> 
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="#question_<?= $array['data']->id ?>" data-toggle="tab" title="question">
                                                                        <span class="round-tabs two">
                                                                            <i class="fa fa-question" aria-hidden="true"></i>
                                                                        </span> 
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#status_<?= $array['data']->id ?>" id="status_click_<?= $array['data']->id ?>" data-toggle="tab" title="status">
                                                                        <span class="round-tabs three">
                                                                            <i class="fa fa-tasks" aria-hidden="true"></i>
                                                                        </span> 
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="#additional-links_<?= $array['data']->id ?>" data-toggle="tab" title="additional-links">
                                                                        <span class="round-tabs four">
                                                                            <i class="fa fa-link" aria-hidden="true"></i>
                                                                        </span> 
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="<?= Yii::$app->request->baseUrl ?>/cso-templates/index?id=<?= $array['data']->id ?>" title="download">
                                                                        <span class="round-tabs five">
                                                                            <i class="fa fa-download" aria-hidden="true"></i>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="tab-content">
                                                            <div class="tab-pane fade in active" id="description_<?= $array['data']->id ?>">
                                                                <h4 class="head text-center">About</h4>
                                                                <div class="policy_desc narrow text-left">
                                                                    <?= $array['data']->template_description ?>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="question_<?= $array['data']->id ?>">
                                                                <h3 class="head text-center">Please choose one of the options below</h3>
                                                                <form enctype="multipart/form-data" method="POST" action="process-policy">
                                                                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
                                                                    <p class="narrow text-left question">
                                                                        <?php
                                                                        //if ($role == 7) {
                                                                        for ($i = 0; $i < sizeof($options); $i++) {
                                                                            ?>
                                                                        <div class="radio">
                                                                            <label class="<?php
                                                                            switch ($options[$i]['id']) {
                                                                                case 1: echo 'color-green';
                                                                                    break;
                                                                                case 2: echo 'color-red';
                                                                                    break;
                                                                                case 3: echo 'color-blue';
                                                                                    break;
                                                                                case 4: echo 'color-orange';
                                                                                    break;
                                                                                default: echo 'color-grey';
                                                                            }
                                                                            ?>">
                                                                                <i class="fa fa-square" aria-hidden="true"></i> &nbsp;
                                                                                <input type="radio" class="options_radio" data-id="<?= $array['data']->id ?>" data-option="option_<?= $options[$i]['id'] ?>" value="<?= $options[$i]['id'] ?>" data-score="<?= $options[$i]['score'] ?>" name="optradio" <?php
                                                                                if (!empty($array['policy_option'])) {
                                                                                    echo ($array['policy_option']->id == $options[$i]['id']) ? 'checked' : '';
                                                                                }
                                                                                ?>><?= $options[$i]['policy_option'] ?>
                                                                                <input name="policy_id" type="hidden" value="<?= $array['data']->id ?>">
                                                                            </label>
                                                                            <?php if ($options[$i]['id'] == 1) { ?>
                                                                                <div id="upload_doc_<?= $array['data']->id ?>" class="upload-doc <?php
                                                                                if (!empty($array['policy_option'])) {
                                                                                    echo ($array['policy_option']->id == $options[$i]['id']) ? '' : 'hide';
                                                                                } else
                                                                                    echo 'hide';
                                                                                ?>">
                                                                                    <p>Upload the policy document: <input name="doc" type="file" class="policy_doc"></p>
                                                                                    <p>Expiry date of document: <input name="ex_date" type="date">
                                                                                </div>
                                                                            <?php }
                                                                            ?>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    //}
                                                                    ?>
                                                                    </p>

                                                                    <p class="text-center">
                                                                        <input type="submit" class="btn btn-success btn-outline-rounded green">
                                                                    </p>
                                                                </form>
                                                            </div>
                                                            <div class="tab-pane fade" id="status_<?= $array['data']->id ?>">
                                                                <h4 class="head text-center">Status</h4>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 no-padding div-status" id="status_log_<?= $array['data']->id ?>">
                                                                    <?php
                                                                    if (!empty($array['policy_status'])) {
                                                                        foreach ($array['policy_status'] as $policy_status) {
                                                                            ?>
                                                                            <div class="col-lg-4 col-md-6 col-sm-12 messagebox <?php
                                                                            switch ($policy_status->policy_option_id) {
                                                                                case 1: echo 'success';
                                                                                    break;
                                                                                case 2: echo 'fail';
                                                                                    break;
                                                                                case 3: echo 'info';
                                                                                    break;
                                                                                case 4: echo 'warning';
                                                                                    break;
                                                                                default: echo 'color-grey';
                                                                            }
                                                                            ?>">
                                                                                <div class="row">
                                                                                    <div class="col-lg-2 col-md-2 col-sm-2 messagebox-icon">
                                                                                        <i class="fa fa-2x <?php
                                                                                        switch ($policy_status->policy_option_id) {
                                                                                            case 1: echo 'fa-check-circle text-success';
                                                                                                break;
                                                                                            case 2: echo 'fa-times-circle text-danger';
                                                                                                break;
                                                                                            case 3: echo 'fa-info-circle text-info';
                                                                                                break;
                                                                                            case 4: echo 'fa-exclamation-circle text-warning';
                                                                                                break;
                                                                                            default: echo 'fa-times-circle color-grey';
                                                                                        }
                                                                                        ?>" aria-hidden="true"></i>
                                                                                    </div>
                                                                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                                                                        <div class="h5 messagebox-header">
                                                                                            <?= $policy_status->getPolicyOption()->select(['policy_option'])->scalar() ?>
                                                                                        </div>
                                                                                        <i class="fa fa-circle <?php
                                                                                        switch ($policy_status->policy_option_id) {
                                                                                            case 1: echo 'text-success';
                                                                                                break;
                                                                                            case 2: echo 'text-danger';
                                                                                                break;
                                                                                            case 3: echo 'text-info';
                                                                                                break;
                                                                                            case 4: echo 'text-warning';
                                                                                                break;
                                                                                            default: echo 'color-grey';
                                                                                        }
                                                                                        ?>" aria-hidden="true"></i> <?= $policy_status->created_at; ?> <br/>
                                                                                        <i class="fa fa-circle <?php
                                                                                        switch ($policy_status->policy_option_id) {
                                                                                            case 1: echo 'text-success';
                                                                                                break;
                                                                                            case 2: echo 'text-danger';
                                                                                                break;
                                                                                            case 3: echo 'text-info';
                                                                                                break;
                                                                                            case 4: echo 'text-warning';
                                                                                                break;
                                                                                            default: echo 'color-grey';
                                                                                        }
                                                                                        ?>" aria-hidden="true"></i> <?= $policy_status->getCreatedBy()->select(["CONCAT(first_name, ' ', last_name) AS full_name"])->scalar() ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <div class="col-lg-4 col-md-6 col-sm-12 fail messagebox not-started" id="messagebox" >
                                                                            <div class="row">
                                                                                <div class="col-md-2 messagebox-icon">
                                                                                    <i class="fa fa-times-circle fa-2x" aria-hidden="true"></i>
                                                                                </div>
                                                                                <div class="col-md-10">
                                                                                    <div class="h5 messagebox-header">Policy action required by admin</div>
                                                                                    <i class="fa fa-circle" aria-hidden="true"></i> System : Please select an option
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="additional-links_<?= $array['data']->id ?>">
                                                                <h4 class="head text-center">Additional Links</h4>
                                                                <div class="narrow text-left">
                                                                    <?php
                                                                    if (!empty($array['data']->links)) {
                                                                        $links = explode(';', $array['data']->links);
                                                                        echo '<ul>';
                                                                        foreach ($links as $link) {
                                                                            ?>
                                                                            <li><a href="<?= $link ?>" target="_blank"><?= $link ?></a></li>
                                                                            <?php
                                                                        }
                                                                        echo '</ul>';
                                                                    } else {
                                                                        echo "NA";
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("div.vertical-tab-menu>div.list-group>a").click(function (e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.vertical-tab>div.vertical-tab-content").removeClass("active");
            $("div.vertical-tab>div.vertical-tab-content").eq(index).addClass("active");
        });
    });

    $(document).ready(function () {
        $('input[type="radio"]').click(function () {
            var option = $(this).attr("data-option");
            var div = $('#policy_' + $(this).attr("data-id"));
            div.removeClass("color-blue");
            div.removeClass("color-green");
            div.removeClass("color-red");
            div.removeClass("color-orange");
            div.removeClass("color-grey");
            if (option == "option_1") {
                div.addClass("color-green");
                //Show document upload div if it is option 1
                $("#upload_doc_" + $(this).attr("data-id")).removeClass("hide");
            } else if (option == "option_2") {
                div.addClass("color-red");
                $("#upload_doc_" + $(this).attr("data-id")).addClass("hide");
            } else if (option == "option_3") {
                div.addClass("color-blue");
                $("#upload_doc_" + $(this).attr("data-id")).addClass("hide");
            } else if (option == "option_4") {
                div.addClass("color-orange");
                $("#upload_doc_" + $(this).attr("data-id")).addClass("hide");
            } else {
                div.addClass("color-grey");
                $("#upload_doc_" + $(this).attr("data-id")).addClass("hide");
            }
        });
        $("form").submit(function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = new FormData($(this)[0]);
            var url = 'process-policy';
            $.ajax({
                enctype: "multipart/form-data",
                type: "POST",
                url: url,
                data: form,
                async: false,
                cache: false,
                contentType: false,
                processData: false, // serializes the form's elements.
                success: function (data)
                {
                    console.log(data); // show response from the php script.
                    data = JSON.parse(data);
                    var class1 = '', class2 = '', class3 = '';
                    switch (data.option_id) {
                        case 1:
                            class1 = 'success';
                            class2 = 'text-success';
                            class3 = 'fa-check-circle text-success';
                            break;
                        case 2:
                            class1 = 'fail';
                            class2 = 'text-danger';
                            class3 = 'fa-times-circle text-danger';
                            break;
                        case 3:
                            class1 = 'info';
                            class2 = 'text-info';
                            class3 = 'fa-info-circle text-info';
                            break;
                        case 4:
                            class1 = 'warning';
                            class2 = 'text-warning';
                            class3 = 'fa-exclamation-circle text-warning';
                            break;
                        default:
                            class1 = class2 = 'color-grey';
                    }
                    //Check if the div has 'NA', if it has, clear it
                    if ($("#status_log_" + data.policy_id).html() == 'NA')
                        $("#status_log_" + data.policy_id).html("");
                    $("#status_log_" + data.policy_id).prepend('<div class="col-lg-4 col-md-6 col-sm-12 messagebox ' + class1 + '">'
                            + '<div class="row"><div class="col-lg-2 col-md-2 col-sm-2 messagebox-icon">'
                            + '<i class="fa fa-2x ' + class3 + '" aria-hidden="true"></i>'
                            + '</div><div class="col-lg-10 col-md-10 col-sm-10"><div class="h5 messagebox-header">'
                            + data.option + '</div><i class="fa fa-circle ' + class2 + '" aria-hidden="true"></i> '
                            + data.created_at + '<br/>'
                            + '<i class="fa fa-circle ' + class2 + '" aria-hidden="true"></i> ' + data.updated_by_name
                            + '</div></div></div>');
                    $("#status_click_" + data.policy_id).click();
                }
            });
        });
    });
</script>