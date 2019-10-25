<?php
use yii\helpers\Html;
?>

<?= $this->render('./_registro-modal') ?>

<?= Html::button('<i class="fa fa-user-plus fa-lg"></i> Novo Usuário', [
    'id' => 'registro-usuario',
    'class' => 'btn btn-sm bg-green pull-right'
]) ?>

