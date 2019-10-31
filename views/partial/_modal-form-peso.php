<?php

/* @var $avaliacao_id int */

use app\models\Peso;
use yii\bootstrap\Modal;
use yii\helpers\Html;

$peso = new Peso();
?>
<?php $modal = Modal::begin([
    'header' => '<strong>Preenchar o campo corretamente</strong>',
    'footer' =>
        Html::submitButton('Confirmar', [
            'class' => 'btn bg-green',
            'form' => 'modal-form-peso' . $avaliacao_id,
        ])
    ,
    'toggleButton' => [
        'label' => "<i class='fa fa-fw fa-plus-circle'></i>Adicionar Peso",
        'class' => 'btn bg-gray btn-xs'
    ],
]); ?>

<?= Html::beginForm(
    [
        'avaliacao/create-peso',
        'avaliacao_id' => $avaliacao_id,
    ],
    'post',
    ['id' => 'modal-form-peso' . $avaliacao_id]
); ?>

<div class="form-group">
    <?= Html::activeLabel($peso, 'valor') ?>
    <?= Html::activeInput('number', $peso, 'valor', [
        'placeholder' => 'Digite o valor do peso (Kg)',
        'class' => 'form-control',
        'required' => true,
        'min' => 0
    ]) ?>
</div>

<?= Html::endForm(); ?>

<?php Modal::end(); ?>
