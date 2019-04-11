<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/TimeCircles.css',
        'css/skins.min.css',
        'css/sidemenu.min.css',
        'css/bootstrap.min.css',
        'css/site.css',
        'css/material.css',
        'css/color.css',
        'css/style.css',
        'css/font-awesome/font-awesome.min.css',
        'css/swiper/swiper.css',
        'css/swiper/swiper.min.css',
        'css/hexagons.min.css',
        'https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons',
        'https://fonts.googleapis.com/css?family=Josefin+Sans:100,100i,300,300i,400,400i,600,600i,700,700i'
    ];
    public $js = [
        'js/app.min.js',
        'js/bootstrap.min.js',
        'js/highcharts.js',
        'js/exporting.js',
        'js/swiper/swiper.js',
        'js/swiper/swiper.min.js',
        'js/highcharts-more.js',
        'js/solid-gauge.js',
        'js/gamification/googbase_min.js',
        'js/gamification/gwd_webcomponents_min.js',
        'js/gamification/gwdtaparea_min.js',
        'js/gamification/gwd-events-support.1.0.js',
        'js/home.js',
        'js/TimeCircles.js',
        'js/hexagons.min.js',
	'js/jquery.easing.min.js',
        'js/create.js'
    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
