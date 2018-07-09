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
        'css/site.css', 'css/modal.css',
    ];
    public $js = [
        '/js/jquery.js',
        '/js/popper.min.js',
        '/js/bootstrap.min.js',
        '/js/componente.js',
        '/js/modal.js',
        '/js/autenticacion.js',

    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
