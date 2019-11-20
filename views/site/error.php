<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception \yii\web\HttpException */

$this->title = $name;
$this->registerCss(<<<CSS
    div#error-page {     
        margin-top: 30vh;
    }
CSS
);
?>
<div id="error-page" class="callout bg-gray-light">
    <h1><?= $exception->statusCode . " " . $exception->getName() ?></h1>
    <p>
        Por favor, volte para a página principal
    </p>
    <a type="button" href="<?= Url::home() ?>" class="btn bg-blue">
        <i class="fa fa-fw fa-arrow-left"></i> Voltar
    </a>
</div>





