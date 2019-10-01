<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this yii\web\View */
/** @var $model app\models\PercentualGordura */
/** @var $form yii\widgets\ActiveForm */
/** @var $sexo string */
/** @var $idade int */

$this->registerJsFile('@web/js/calculos-dobras.js');
$this->registerJs("
    
    const calculo_pdg = document.querySelector('#calculo-pdg')
        , pdg_tres = document.querySelector('#pdg-tres')
        , pdg_quatro = document.querySelector('#pdg-quatro')
        , btn_calculo_pdg = document.querySelector('#btn-calculo-pdg');
        
    calculo_pdg.onchange = function(event) {
        if (event.target.value === 'calculo3') {
            pdg_tres.style.display = 'block';
            pdg_quatro.style.display = 'none';
        } else {
            pdg_quatro.style.display = 'block';
            pdg_tres.style.display = 'none';
        }
    }
    
    btn_calculo_pdg.onclick = () => {
   
        let pdg = 0
            , pdg_valor = document.querySelector('#percentualgordura-valor');
        
        if (calculo_pdg.value === 'calculo3') {
            let dobra_1 = parseFloat(document.querySelector('#dobra-tres-1').value)
                , dobra_2 = parseFloat(document.querySelector('#dobra-tres-1').value)
                , dobra_3 = parseFloat(document.querySelector('#dobra-tres-1').value);
            
            console.log(dobra_1, dobra_2, dobra_3);    
            pdg = calcularPdgTresDobras(dobra_1, dobra_2, dobra_3, ".$idade.");

        } else if (calculo_pdg.value === 'calculo4') {
            let dobra_1 = parseFloat(document.querySelector('#dobra-quatro-1').value)
                , dobra_2 = parseFloat(document.querySelector('#dobra-quatro-2').value)
                , dobra_3 = parseFloat(document.querySelector('#dobra-quatro-3').value)
                , dobra_4 = parseFloat(document.querySelector('#dobra-quatro-4').value);
            
            console.log(dobra_1, dobra_2, dobra_3, dobra_4);
            pdg = calcularPdgQuatroDobras(dobra_1, dobra_2, dobra_3, dobra_4, '".$sexo."', ".$idade.");
            console.log(pdg.toFixed(2));
        }
        
        pdg_valor.value = pdg.toFixed(2);
    }
");
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-success">
            <div class="box-heade with-border">
                <h4 class="box-title">

                </h4>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>

                <div class="form-group">
                    <label for="calculo-pdg">
                        Escolha o tipo de cálculo
                    </label>
                    <select id="calculo-pdg"
                            class="form-control">
                        <option value="calculo3">
                            3 Dobras Cutâneas
                        </option>
                        <option value="calculo4">
                            4 Dobras Cutâneas
                        </option>
                    </select>
                </div>
                <div id="pdg-tres" style="display: block;">
                    <div class="form-group">
                        <label for="dobra-tres-1">
                            <?php if($sexo == 'masculino'): ?>
                                Dobra cutânea do peitoral
                            <?php elseif($sexo == 'feminino'): ?>
                                Dobra cutânea do triceps
                            <?php endif; ?>
                        </label>
                        <input id="dobra-tres-1" type="text"
                               class="form-control"
                               placeholder="Digite o valor em milímetro">
                    </div>
                    <div class="form-group">
                        <label for="dobra-tres-2">
                            <?php if($sexo == 'masculino'): ?>
                                Dobra cutânea do abdóme
                            <?php elseif($sexo == 'feminino'): ?>
                                Dobra cutânea do suprailiaco
                            <?php endif; ?>
                        </label>
                        <input id="dobra-tres-2" type="text"
                               class="form-control"
                               placeholder="Digite o valor em milímetro">
                    </div>
                    <div class="form-group">
                        <label for="dobra-tres-3">
                            Dobra cutânea do coxa
                        </label>
                        <input id="dobra-tres-3" type="text"
                               class="form-control"
                               placeholder="Digite o valor em milímetro">
                    </div>
                </div>

                <div id="pdg-quatro" style="display: none;">
                    <div class="form-group">
                        <label for="dobra-quatro-1">
                            Dobra cutânea do biceps
                        </label>
                        <input id="dobra-quatro-1" type="text"
                               class="form-control"
                               placeholder="Digite o valor em milímetro">
                    </div>
                    <div class="form-group">
                        <label for="dobra-quatro-2">
                            Dobra cutânea do triceps
                        </label>
                        <input id="dobra-quatro-2" type="text"
                               class="form-control"
                               placeholder="Digite o valor em milímetro">
                    </div>
                    <div class="form-group">
                        <label for="dobra-quatro-3">
                            Dobra cutânea do subescapular
                        </label>
                        <input id="dobra-quatro-3" type="text"
                               class="form-control"
                               placeholder="Digite o valor em milímetro">
                    </div>
                    <div class="form-group">
                        <label for="dobra-quatro-4">
                            Dobra cutânea da suprailíaco
                        </label>
                        <input id="dobra-quatro-4" type="text"
                               class="form-control"
                               placeholder="Digite o valor em milímetro">
                    </div>
                </div>

                <?= $form->field($model, 'valor')->textInput([
                    'placeholder' => '0.0',
                    'readonly' => 'readonly',
                ]) ?>

                <div class="form-group">
                    <?= Html::a('Voltar', [
                        'pessoa/view' ,
                        'id' => $model->avaliacao->pessoa_id
                    ], [
                        'class' => 'btn bg-gray btn-flat'
                    ]) ?>
                    <div class="pull-right">
                        <?= Html::a('Calcular Percentual', '#', [
                            'class' => 'btn bg-light-blue btn-flat',
                            'role' => 'button',
                            'id' => 'btn-calculo-pdg',
                        ]) ?>
                        <?= Html::submitButton('Confirmar', [
                            'class' => 'btn bg-green btn-flat'
                        ]) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

