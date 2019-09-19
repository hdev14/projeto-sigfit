<?php


/* @var $avaliacao_id int */
/* @var $label_header string */
/* @var $label_button_click string */
/* @var $action string */
/* @var $avaliacao_id int */

use app\models\Peso;
use yii\bootstrap\Modal;
use yii\helpers\Html;

?>
<?php $modal = Modal::begin([
    'header' => 'Nova pesagem',
    'footer' =>
        Html::submitButton('Confirmar', [
            'class' => 'btn btn-success btn-flat btn-sm',
            'form' => 'modal-form' . $avaliacao_id,
        ])
    ,
    'toggleButton' => [
        'label' => "<i class='fa fa-fw fa-plus'></i>Adicionar peso",
        'class' => 'btn btn-defautl btn-xs'
    ],
]); ?>

<?= Html::beginForm(
    [
        'avaliacao/create-peso',
        'avaliacao_id' => $avaliacao_id,
    ],
    'post',
    ['id' => 'modal-form' . $avaliacao_id]
); ?>

<div class="form-group">
    <?= Html::activeInput('text', new Peso(), 'valor', [
        'placeholder' => 'Adicionar no peso (Kg)',
        'class' => 'form-control',
        'required' => 'required'
    ]) ?>
</div>

<?= Html::endForm(); ?>

<?php Modal::end(); ?>
