<?php

use app\models\Imc;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View; */
/* @var $avaliacao_id int */

$this->registerJs("
    const altura_elt".$avaliacao_id." = 
            document.querySelector('#altura-imc". $avaliacao_id ."')
        , peso_elt".$avaliacao_id." = document.querySelector('#peso-imc" . $avaliacao_id ."')
        , btn_calcular".$avaliacao_id." = document.querySelector('#calcular-imc".$avaliacao_id."');
    
    btn_calcular". $avaliacao_id .".onclick = () => {
        let altura = parseFloat(altura_elt".$avaliacao_id.".value)
            , peso = parseFloat(peso_elt".$avaliacao_id.".value)
            , imc = document.querySelector('#imc-valor".$avaliacao_id."');
        
        imc.value = ((peso / Math.pow(altura, 2)) * 10000).toFixed(2);
    }
");
?>
<?php $modal = Modal::begin([
    'header' => '<strong>Preencha os campos corretamente</strong>',
    'footer' =>
        Html::a('Calcular Peso', '#', [
            'class' => 'btn bg-light-blue ',
            'role' => 'button',
            'id' => 'calcular-imc'.$avaliacao_id,
        ])
        .
        Html::submitButton('Confirmar', [
            'class' => 'btn bg-green',
            'form' => 'modal-form-imc' . $avaliacao_id,
        ])
    ,
    'toggleButton' => [
        'label' => "<i class='fa fa-fw fa-plus-circle'></i> Adicionar IMC",
        'class' => 'btn bg-gray btn-xs'
    ],
]); ?>

<?= Html::beginForm(
    [
        'avaliacao/create-imc',
        'avaliacao_id' => $avaliacao_id,
    ],
    'post',
    ['id' => 'modal-form-imc' . $avaliacao_id]
); ?>

<div class="form-group row">
    <div class="col-md-6">

        <?= Html::label('Altura', 'altura-imc' . $avaliacao_id) ?>
        <?= Html::input('number', null, null, [
            'class' => 'form-control',
            'id' => 'altura-imc' . $avaliacao_id,
            'placeholder' => 'Digite a altura (cm)',
            'required' => true,
            'min' => 0,
        ]) ?>

    </div>
    <div class="col-md-6">

        <?= Html::label('Peso', 'peso-imc' . $avaliacao_id) ?>
        <?= Html::input('number', null, null, [
            'class' => 'form-control',
            'id' => 'peso-imc' . $avaliacao_id,
            'placeholder' => 'Digite o peso (Kg)',
            'required' => true,
            'min' => 0
        ]) ?>

    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <?= Html::activeInput('text', new Imc(), 'valor', [
            'placeholder' => '0.0',
            'class' => 'form-control',
            'readonly' => 'readonly',
            'required' => 'required',
            'id' => 'imc-valor'.$avaliacao_id,
        ]) ?>
    </div>
</div>

<?= Html::endForm(); ?>

<?php Modal::end(); ?>
