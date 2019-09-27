<?php

/* @var $this yii\web\View; */
/* @var $avaliacao_id int */
/* @var $idade int */
/* @var $sexo string */

use app\models\Imc;
use app\models\PercentualGordura;
use yii\bootstrap\Modal;
use yii\helpers\Html;


$this->registerJsFile('@web/js/calculos-dobras.js');
$this->registerJs("
      
        const calculo_pdg".$avaliacao_id." = 
                document.querySelector('#calculo-pdg".$avaliacao_id."')
            , pdg_tres".$avaliacao_id." = 
                document.querySelector('#pdg-tres".$avaliacao_id ."')
            , pdg_quatro".$avaliacao_id." = 
                document.querySelector('#pdg-quatro".$avaliacao_id."')
            , btn_calculo_pdg".$avaliacao_id." = 
                document.querySelector('#btn-calculo-pdg".$avaliacao_id."');
            
        calculo_pdg".$avaliacao_id.".onchange = function(event) {
            if (event.target.value === 'calculo3') {
                pdg_tres".$avaliacao_id.".style.display = 'block';
                pdg_quatro".$avaliacao_id.".style.display = 'none';
            } else {
                pdg_quatro".$avaliacao_id.".style.display = 'block';
                pdg_tres".$avaliacao_id.".style.display = 'none';
            }
        }
        
        btn_calculo_pdg".$avaliacao_id.".onclick = () => {
       
            let pdg = 0
                , pdg_valor = document.querySelector('#percentualgordura-valor".$avaliacao_id."');
            
            if (calculo_pdg".$avaliacao_id.".value === 'calculo3') {
                let dobra_1 = parseFloat(document.querySelector('#dobra-tres-1-".$avaliacao_id."').value)
                    , dobra_2 = parseFloat(document.querySelector('#dobra-tres-1-".$avaliacao_id."').value)
                    , dobra_3 = parseFloat(document.querySelector('#dobra-tres-1-".$avaliacao_id."').value);
                
                console.log(dobra_1, dobra_2, dobra_3);    
                pdg = calcularPdgTresDobras(dobra_1, dobra_2, dobra_3, ". $idade .");
   
            } else if (calculo_pdg".$avaliacao_id.".value === 'calculo4') {
                let dobra_1 = parseFloat(document.querySelector('#dobra-quatro-1-".$avaliacao_id."').value)
                    , dobra_2 = parseFloat(document.querySelector('#dobra-quatro-2-".$avaliacao_id."').value)
                    , dobra_3 = parseFloat(document.querySelector('#dobra-quatro-3-".$avaliacao_id."').value)
                    , dobra_4 = parseFloat(document.querySelector('#dobra-quatro-4-".$avaliacao_id."').value);
                
                console.log(dobra_1, dobra_2, dobra_3, dobra_4);
                pdg = calcularPdgQuatroDobras(dobra_1, dobra_2, dobra_3, dobra_4, '". $sexo ."', ". $idade .");
                console.log(pdg.toFixed(2));
            }
            
            pdg_valor.value = pdg.toFixed(2);
        }
");

?>

<?php $modal = Modal::begin([
    'header' => 'Preenchar os campos corretamente para realizar o cálculo',
    'footer' =>
        Html::a('Calcular Percentual', '#', [
            'class' => 'btn bg-light-blue btn-flat btn-sm',
            'role' => 'button',
            'id' => 'btn-calculo-pdg'.$avaliacao_id,
        ])
        .
        Html::submitButton('Confirmar', [
            'class' => 'btn bg-green btn-flat btn-sm',
            'form' => 'modal-form-pdg'.$avaliacao_id,
        ])
    ,
    'toggleButton' => [
        'label' => "<i class='fa fa-fw fa-plus'></i>Adicionar P. de Gordura",
        'class' => 'btn bg-gray btn-xs'
    ],
]); ?>

<?= Html::beginForm(
    [
        'avaliacao/create-pg',
        'avaliacao_id' => $avaliacao_id,
    ],
    'post',
    ['id' => 'modal-form-pdg' . $avaliacao_id]
); ?>

<div class="form-group">
    <label for="<?= 'calculo-pdg'.$avaliacao_id ?>">
        Escolha o tipo de cálculo
    </label>
    <select id="<?= 'calculo-pdg'.$avaliacao_id ?>"
            class="form-control">
        <option value="calculo3">
            3 Dobras Cutâneas
        </option>
        <option value="calculo4">
            4 Dobras Cutâneas
        </option>
    </select>
</div>
<div id="<?= 'pdg-tres' . $avaliacao_id?>" style="display: block;">
    <div class="form-group">
        <label for="<?= 'dobra-tres-1-'.$avaliacao_id ?>">
            <?php if($sexo == 'masculino'): ?>
                Dobra cutânea do peitoral
            <?php elseif($sexo == 'feminino'): ?>
                Dobra cutânea do triceps
            <?php endif; ?>
        </label>
        <input id="<?= 'dobra-tres-1-'.$avaliacao_id ?>" type="text"
               class="form-control"
               placeholder="Digite o valor em milímetro">
    </div>
    <div class="form-group">
        <label for="<?= 'dobra-tres-2-'.$avaliacao_id ?>">
            <?php if($sexo == 'masculino'): ?>
                Dobra cutânea do abdóme
            <?php elseif($sexo == 'feminino'): ?>
                Dobra cutânea do suprailiaco
            <?php endif; ?>
        </label>
        <input id="<?= 'dobra-tres-2-'.$avaliacao_id ?>" type="text"
               class="form-control"
               placeholder="Digite o valor em milímetro">
    </div>
    <div class="form-group">
        <label for="<?= 'dobra-tres-3-'.$avaliacao_id ?>">
            Dobra cutânea do coxa
        </label>
        <input id="<?= 'dobra-tres-3-'.$avaliacao_id ?>" type="text"
               class="form-control"
               placeholder="Digite o valor em milímetro">
    </div>
</div>
<div id="<?= 'pdg-quatro' . $avaliacao_id ?>" style="display: none;">
    <div class="form-group">
        <label for="<?= 'dobra-quatro-1-'.$avaliacao_id ?>">
            Dobra cutânea do biceps
        </label>
        <input id="<?= 'dobra-quatro-1-'.$avaliacao_id ?>" type="text"
               class="form-control"
               placeholder="Digite o valor em milímetro">
    </div>
    <div class="form-group">
        <label for="<?= 'dobra-quatro-2-'.$avaliacao_id ?>">
            Dobra cutânea do triceps
        </label>
        <input id="<?= 'dobra-quatro-2-'.$avaliacao_id ?>" type="text"
               class="form-control"
               placeholder="Digite o valor em milímetro">
    </div>
    <div class="form-group">
        <label for="<?= 'dobra-quatro-3-'.$avaliacao_id ?>">
            Dobra cutânea do subescapular
        </label>
        <input id="<?= 'dobra-quatro-3-'.$avaliacao_id ?>" type="text"
               class="form-control"
               placeholder="Digite o valor em milímetro">
    </div>
    <div class="form-group">
        <label for="<?= 'dobra-quatro-4-'.$avaliacao_id ?>">
            Dobra cutânea da suprailíaco
        </label>
        <input id="<?= 'dobra-quatro-4-'.$avaliacao_id ?>" type="text"
               class="form-control"
               placeholder="Digite o valor em milímetro">
    </div>
</div>

<div class="form-group">
    <?= Html::activeInput('text', new PercentualGordura(), 'valor', [
        'placeholder' => '0.0',
        'class' => 'form-control',
        'readonly' => 'readonly',
        'required' => 'required',
        'id' => 'percentualgordura-valor' . $avaliacao_id,
    ]) ?>
</div>

<?= Html::endForm(); ?>

<?php Modal::end(); ?>

