<?php

/* @var $usuario_id int */

use yii\helpers\Html;

?>
<div class="callout callout-info">
    <h4>Usuário ainda não possui avaliações físicas</h4>
    <p>
        Efetuar uma nova <?= Html::a(
            '<span class="badge bg-blue" style="cursor: pointer">
                Avaliação Física
            </span>',
            [
                'avaliacao/create',
                'usuario_id' => $usuario_id,
            ]
        ) ?>
    </p>
</div>