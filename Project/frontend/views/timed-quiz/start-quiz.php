<style>
    #msform {
        width: 100%;
        margin: 50px auto;
        text-align: center;
        position: relative;
    }
    #msform fieldset {
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 20px 30px;
        box-sizing: border-box;
        width: 100%;
        /*stacking fieldsets above each other*/
        position: relative;
    }
    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
        display: none;
    }
    /*inputs*/
    #msform input, #msform textarea {
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        font-size: 13px;
    }
    /*buttons*/
    #msform .action-button {
        width: 100px;
        background: #27AE60;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 1px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }
    #msform .action-button:hover, #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
    }
    /*headings*/
    .fs-title {
        font-size: 15px;
        text-transform: uppercase;
        color: #2C3E50;
        margin-bottom: 10px;
    }
    .fs-subtitle {
        font-weight: normal;
        font-size: 13px;
        color: #666;
        margin-bottom: 20px;
    }
    /*progressbar*/
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        /*CSS counters to number the steps*/
        counter-reset: step;
    }
    #progressbar li {
        list-style-type: none;
        color: #000000;
        text-transform: uppercase;
        font-size: 14px;
        width: 33.33%;
        float: left;
        position: relative;
    }
    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 25px;
        line-height: 20px;
        display: block;
        font-size: 12px;
        color: #000;
        background: #EEE;
        margin: 0 auto 5px auto;
    }
    /*progressbar connectors*/
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: #000000;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: -1; /*put it behind the numbers*/
    }
    #progressbar li:first-child:after {
        /*connector not needed before the first step*/
        content: none; 
    }
    /*marking active/completed steps green*/
    /*The number of the step and the connector before it = green*/
    #progressbar li.active:before,  #progressbar li.active:after{
        background: #27AE60;
        color: white;
    }

    .card {
        min-height: 500px;
    }
    @media (max-width: 1050px) and (min-width: 811px){
        #msform fieldset h1{
            font-size: 2.8em;
        }
    }
    @media (max-width: 810px) and (min-width: 768px){
        #msform fieldset h1{
            font-size: 2.0em;
        }
    }
    @media (max-width: 767px) and (min-width: 661px){
        #msform fieldset h1{
            font-size: 2.8em;
        }
        #progressbar li{
            width: 27.33%;
        }
        .container-fluid {
            margin-top: 6%;
        }
    }
    @media (max-width: 660px) and (min-width: 501px){
        #msform fieldset h1{
            font-size: 2.0em;
        }
        #progressbar li{
            width: 27.33%;
        }
        .container-fluid {
            margin-top: 8%;
        }
    }
    @media (max-width: 500px) and (min-width: 320px){
        #msform fieldset h1{
            font-size: 1.5em;
        }
        #progressbar li{
            font-size: 11px;
            width: 28.33%;
        }
        #progressbar{
            margin-left: -15% !important;
        }
        #msform .action-button{
            width: 90px;
            padding: 5px 5px;
        }
        .container-fluid {
            margin-top: 11%;
        }
    }
    @media (max-width: 910px) and (min-width: 768px){
        #progressbar{
            margin-bottom: 30px !important;
        }
    }
</style>

<div class="content" id="questions-module">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header1 card-header-text" data-background-color="blue">
                        <h4 class="card-title text-uppercase"><i class="material-icons">library_books</i> Cyber Security</h4>
                    </div>
                    <div class="card-content">
                        <div id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active">About</li>
                                <li>Purpose</li>
                                <li>Start</li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <h1>Adaptive Testing to validate your learning comprehension</h1>
                                <button type="button" class="next action-button">Next >> </button>
                            </fieldset>
                            <fieldset>
                                <h1>Test your skills</h1>
                                <button type="button" class="previous action-button"><< Previous </button>
                                <button type="button" class="next action-button">Next >> </button>
                            </fieldset>
                            <fieldset>
                                <h1>Take me to Quiz now</h1>
                                <button type="button" class="previous action-button"><< Previous </button>
                                <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz/intermediate-quiz?id=<?= $subject_id ?>">
                                    <button type="button" class="submit action-button"> Start Quiz !</button>
                                </a>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    

<script type="text/javascript">

//jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function () {
        if (animating)
            return false;
        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".previous").click(function () {
        if (animating)
            return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });
</script>