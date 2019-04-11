<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>


<script>
    jQuery(document).ready(function () {
        //alert();
        //jQuery('.highcharts-yaxis').remove('<path fill="none" class="highcharts-axis-line" d="M 45.5 10 L 45.5 363"></path>');
        //jQuery('.highcharts-axis-line').replaceWith('<path fill="none" class="highcharts-axis-line" stroke="green" stroke-width="1" d="M 45.5 10 L 45.5 80"></path><path fill="none" class="highcharts-axis-line" stroke="orange" stroke-width="1" d="M 45.5 80 L 45.5 150"></path><path fill="none" class="highcharts-axis-line" stroke="red" stroke-width="1" d="M 45.5 150 L 45.5 365"></path>');
        jQuery('.highcharts-yaxis').append('<path fill="none" class="highcharts-axis-line" stroke="green" stroke-width="1" d="M 45.5 10 L 45.5 80"></path><path fill="none" class="highcharts-axis-line" stroke="orange" stroke-width="1" d="M 45.5 80 L 45.5 150"></path><path fill="none" class="highcharts-axis-line" stroke="red" stroke-width="1" d="M 45.5 150 L 45.5 365"></path>');
    });
</script>