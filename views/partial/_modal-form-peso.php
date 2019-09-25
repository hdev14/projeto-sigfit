<?php

/* @var $avaliacao_id int */

use app\models\Peso;
use yii\bootstrap\Modal;
use yii\helpers\Html;

$peso = new Peso();
?>
<?php $modal = Modal::begin([
    'header' => 'Preenchar o campo corretamente',
    'footer' =>
        Html::submitButton('Confirmar', [
            'class' => 'btn btn-success btn-flat btn-sm',
            'form' => 'modal-form-peso' . $avaliacao_id,
        ])
    ,
    'toggleButton' => [
        'label' => "<i class='fa fa-fw fa-plus'></i>Adicionar Peso",
        'class' => 'btn btn-defautl btn-xs'
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
    <?= Html::activeInput('text', $peso, 'valor', [
        'placeholder' => 'Digite o valor do peso (Kg)',
        'class' => 'form-control',
        'required' => 'required'
    ]) ?>
</div>

<?= Html::endForm(); ?>

<?php Modal::end(); ?>
