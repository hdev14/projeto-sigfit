<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?= $this->render('./registro-modal') ?>

<div class="box-tools pull-right">
    <?= Html::button('<i class="fa fa-user-plus fa-lg"></i> Novo Usuário', [
        'id' => 'registro-usuario',
        'class' => 'btn btn-box-tool bg-green btn-flat'
    ]) ?>
</div>
