<style>
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
    }

    .grid-4, .grid-4:focus, .grid-4:active {
        background: #000 url('../images/dms/msa.jpg');
        margin-top: 2px;
    }

    .grid-5, .grid-5:focus, .grid-5:active {
        background: #000 url('../images/dms/po.jpg');
        margin-top: 2px;
    }

    .grid-6, .grid-6:focus, .grid-6:active {
        background: #000 url('../images/dms/so.jpg');
        margin-top: 2px;
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

    @media (min-width: 320px) and (max-width: 420px) {
        .flex {
            display: block !important;
        }

    }

    @media (min-width: 421px) and (max-width: 766px) {
        .flex {
            display: block !important;
        }
    }

    @media (min-width: 767px) and (max-width: 999px) {
        .flex {
            display: block !important;
        }

        .grid-1, .grid-2 {
            width: 100%;
            margin-top: 0.5%;
            margin-bottom: 0.5%;
        }
    }
    @media (min-width: 999px) and (max-width: 1024px) {

    }

    video {
        background-color: #000000;
    }

    .content {
        padding-top: 28px;
    }

    .block-2, .slide, .carousel-inner, .carousel-inner img {
        height: 394px !important
    }

    .block-1, .block-2, .block-3 {
        padding-left: 3px;
        padding-right: 3px;
    }

    .block-3 h2 {
        font-size: 60px;
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
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row flex">
            <div class="col-sm-12 col-md-3 text-center block-1">
                <a href="<?= Yii::$app->request->baseUrl ?>/site/dms-dashboard">
                    <div class="btn col-sm-12 col-md-12 grid-1">
                        <h2><i class="fa fa-tachometer" aria-hidden="true"></i><br/>
                            <span class="small-content text-uppercase">My Dashboard</span>
                        </h2>
                        <div class="color-overlay-1 col-sm-12 col-md-12"></div>
                    </div>
                </a>
                <a href="<?= Yii::$app->request->baseUrl ?>/site/my-documents">
                    <div class="btn col-sm-12 col-md-12 grid-2">
                        <h2><i class="fa fa-folder-open" aria-hidden="true"></i><br/>
                            <span class="small-content text-uppercase">My Documents</span>
                        </h2>
                        <div class="color-overlay-2 col-sm-12 col-md-12"></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-9 text-center block-2">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/dms/1.jpg" alt="">
                        </div>

                        <div class="item">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/dms/2.jpg" alt="">
                        </div>

                        <div class="item">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/dms/3.jpg" alt="">
                        </div>
                    </div>

                    <!-- Left and right controls -->
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
        <div class="row flex">
            <div class="col-sm-12 col-md-3 text-center block-3">
                <a href="#">
                    <div class="btn col-sm-12 col-md-12 grid-3">
                        <h2>SOW<br/>
                            <span class="see-more text-uppercase">See More >></span>
                        </h2>
                        <div class="color-overlay-3 col-sm-12 col-md-12"></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-3 text-center block-3">
                <a href="#">
                    <div class="btn col-sm-12 col-md-12 grid-4">
                        <h2>MSA<br/>
                            <span class="see-more text-uppercase">See More >></span>
                        </h2>
                        <div class="color-overlay-4 col-sm-12 col-md-12"></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-3 text-center block-3">
                <a href="#">
                    <div class="btn col-sm-12 col-md-12 grid-5">
                        <h2>PO<br/>
                            <span class="see-more text-uppercase">See More >></span>
                        </h2>
                        <div class="color-overlay-5 col-sm-12 col-md-12"></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-12 col-md-3 text-center block-3">
                <a href="#">
                    <div class="btn col-sm-12 col-md-12 grid-6">
                        <h2>SO<br/>
                            <span class="see-more text-uppercase">See More >></span>
                        </h2>
                        <div class="color-overlay-6 col-sm-12 col-md-12"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
