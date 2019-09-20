<?php

/* @var $this yii\web\View; */
/* @var $avaliacao_id int */

use app\models\Imc;
use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->registerJs("

        const altura_elt = document.querySelector('#altura-imc" .
    $avaliacao_id .
    "');
        const peso_elt = document.querySelector('#peso-imc" . $avaliacao_id .
    "');
        const btn_calcular = document.querySelector('#calcular-imc');
        
        btn_calcular.onclick = () => {
            let altura = parseFloat(altura_elt.value);
            let peso = parseFloat(peso_elt.value);
            let imc = document.querySelector('#imc-valor');
            console.log(altura, peso);
            imc.value = ((peso / Math.pow(altura, 2)) * 10000).toFixed(2);
        }
");
?>
<?php $modal = Modal::begin([
    'header' => 'Preenchar os campos corretamente',
    'footer' =>
        Html::a('Calcular', '#', [
            'class' => 'btn btn-primary btn-flat btn-sm',
            'role' => 'button',
            'id' => 'calcular-imc',
        ])
        .
        Html::submitButton('Confirmar', [
            'class' => 'btn btn-success btn-flat btn-sm',
            'form' => 'modal-form-imc' . $avaliacao_id,
        ])
    ,
    'toggleButton' => [
        'label' => "<i class='fa fa-fw fa-plus'></i>Adicionar imc",
        'class' => 'btn btn-defautl btn-xs'
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
        <label for="<?= 'altura-imc' . $avaliacao_id ?>">
            Altura
        </label>
        <input type="text" class="form-control"
               id="<?= 'altura-imc' . $avaliacao_id ?>"
               placeholder="Digite a altura (cm)">
    </div>
    <div class="col-md-6">
        <label for="<?= 'peso-imc' . $avaliacao_id ?>">
            Peso
        </label>
        <input type="text" class="form-control"
               id="<?= 'peso-imc' . $avaliacao_id ?>"
               placeholder="Digite o peso (Kg)">
    </div>
</div>
<div class="form-group row">
    <div class="col-md-12">
        <?= Html::activeInput('text', new Imc(), 'valor', [
            'placeholder' => '0.0',
            'class' => 'form-control',
            'readonly' => 'readonly',
            'required' => 'required'
        ]) ?>
    </div>
</div>

<?= Html::endForm(); ?>

<?php Modal::end(); ?>
