<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //Font Icon
    '/assets/css/plugin/font-awesome.min.css',
        //CSS Global
    '/assets/css/plugin/bootstrap.min.css',
    '/assets/css/plugin/bootstrap-select.min.css',
    '/assets/css/plugin/owl.carousel.css',
    '/assets/css/plugin/animate.css',
    '/assets/css/plugin/subscribe-better.css',
        //Custom CSS
    '/assets/css/theme.css',
        //User CSS
        'css/site.css',
    ];
    public $js = [
        //JS Global
    '/assets/js/plugin/jquery-2.2.4.min.js',
    '/assets/js/plugin/bootstrap.min.js',
    '/assets/js/plugin/bootstrap-select.min.js',
    '/assets/js/plugin/owl.carousel.min.js',
    '/assets/js/plugin/jquery.plugin.min.js',
    '/assets/js/plugin/jquery.countdown.js',
    '/assets/js/plugin/jquery.subscribe-better.min.js',

        //Custom JS
    '/assets/js/theme.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
