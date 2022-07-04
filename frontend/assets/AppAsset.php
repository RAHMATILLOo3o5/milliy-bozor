<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/fontawesome-free/css/all.css',
        'plugins/bootstrap/dist/css/bootstrap.css',
        'css/style.css',
        'css/main.css',
        'css/site.css'
    ];
    public $js = [
        'plugins/popper.js/dist/popper.js',
        'plugins/fontawesome-free/js/all.js',
        'plugins/bootstrap/dist/js/bootstrap.js',
        'js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
