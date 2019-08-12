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
    ];
    public $js = [
    ];
    public $depends = [
        'yidas\adminlte\AdminlteAsset'
    ];
}
