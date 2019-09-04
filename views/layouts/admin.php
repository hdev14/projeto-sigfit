<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAdminAsset;


$app_admin_asset = AppAdminAsset::register($this);
$distPath = $app_admin_asset->baseUrl;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="skin-green sidebar-mini fixed">
<?php $this->beginBody() ?>
<div>

    <?= $this->render('admin/header.php', [ 'directoryAsset' => $distPath ]) ?>

    <?= $this->render('admin/aside.php', [ 'directoryAsset' => $distPath ]) ?>

    <?= $this->render('admin/content.php', [
        'content' => $content,
        'directoryAsset' => $distPath
    ]) ?>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

