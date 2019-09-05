<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/forms.css',
        'css/modal_registro.css',
        'css/usuarios.css',
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js',
    ];
    public $depends = [
        'yidas\adminlte\AdminlteAsset'
    ];
}
