<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?= $this->render('./registro-modal') ?>

<div class="box-tools pull-right">
    <p class="text-right">
        <?= Html::button('<i class="fa fa-user-plus fa-lg pull-left"></i> Novo Usuário', [
            'id' => 'registro-aluno',
            'class' => 'btn btn-box-tool bg-green btn-flat'
        ]) ?>
    </p>
</div>
