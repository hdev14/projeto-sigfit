<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $avaliacao_model app\models\Avaliacao */
/* @var $peso_model app\models\Peso */
/* @var $imc_model app\models\Imc */
/* @var $pdg_model app\models\PercentualGordura */
/* @var $form yii\widgets\ActiveForm */
/* @var $usuario_id int */

$this->registerJs("

    const form1 = document.querySelector('#form1');
    const form2 = document.querySelector('#form2');
    const form3 = document.querySelector('#form3');
    
    const btn_proximo1 = document.querySelector('#btn-proximo1');
    const btn_proximo2 = document.querySelector('#btn-proximo2');
    const btn_volta1 = document.querySelector('#btn-volta1');
    const btn_volta2 = document.querySelector('#btn-volta2');
    
    const calculo_pg = document.querySelector('#calculo-pg');
    const pdg_tres = document.querySelector('#pdg-tres');
    const pdg_quatro = document.querySelector('#pdg-quatro');
    
    btn_proximo1.onclick = function() {
        
        const avaliacao_titulo = document.querySelector('#avaliacao-titulo');
        const avaliacao_idade = document.querySelector('#avaliacao-idade');
        const avaliacao_altura = document.querySelector('#avaliacao-altura');
        const peso_valor = document.querySelector('#peso-valor');
        
        if (avaliacao_titulo.value == ''
            || avaliacao_idade.value == ''
            || avaliacao_altura.value == ''
            || peso_valor.value == '') {
            const alertar = document.querySelector('#alertar');
            alertar.innerHTML = 'Por fovar, preencha os dados.'
            alertar.style.display = 'block';
            return;
        } else {
            // TODO: MUDAR BASE DO NÚMERO
            let imc = peso_valor.value / Math.pow(avaliacao_altura.value, 2);
            console.log(imc);
        }
        
        if (form1.style.display == 'block') {    
            form1.style.display = 'none';
            form2.style.display = 'block';
        }
    }
    
    btn_volta1.onclick = function() {
        if (form2.style.display == 'block') {
            form2.style.display = 'none';
            form1.style.display = 'block';
        }   
    }
    
    btn_proximo2.onclick = function() {
        if (form2.style.display == 'block') {
            form2.style.display = 'none';
            form3.style.display = 'block';
        }
    }
    
    btn_volta2.onclick = function() {
        if (form3.style.display == 'block') {
            form3.style.display = 'none';
            form2.style.display = 'block';
        }
    }
    
    calculo_pg.onchange = function(event) {
        console.log(event.target.value);
        if (event.target.value == 'calculo3') {
            pdg_tres.style.display = 'block';
            pdg_quatro.style.display = 'none';
        } else {
            pdg_quatro.style.display = 'block';
            pdg_tres.style.display = 'none';
        }  
    }
      
");
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Preencha os campos corretamente</h3>
                <div class="box-tools pull-right">
                    <p class="text-danger" id="alertar" style="display: none;"></p>
                </div>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>

                <div class="row">
                    <div id="form1" style='display: block;' class="col-md-12">
                        <?= $form->field($avaliacao_model, 'titulo')
                            ->textInput([
                                'placeholder' => 'Digite o título da avaliação '
                            ]) ?>

                        <?= $form->field($avaliacao_model, 'idade')
                            ->textInput([
                                'placeholder' => 'Digite a idade do usuáio'
                            ]) ?>

                        <?= $form->field($avaliacao_model, 'altura')
                            ->textInput([
                                'placeholder' => 'Digite a altura do usuário'
                            ]) ?>

                        <?= $form->field($peso_model, 'valor')->textInput([
                            'placeholder' => 'Digite o peso atual do usuário'
                        ]) ?>

                        <div class="form-group">
                            <?= Html::a('Próximo','#', [
                                'id' => 'btn-proximo1',
                                'class' => 'btn btn-small btn-success btn-flat pull-right'
                            ])?>
                        </div>

                    </div>
                    <div id="form2" style='display: none;' class="col-md-12">
                        <div class="form-group">
                            <label for="calculo-pg">Escolha o tipo de
                                cálculo</label>
                            <select name="calculo-pg"
                                    id="calculo-pg"
                                    class="form-control">
                                <option value="calculo3">3 Dobras
                                    Cutâneas</option>
                                <option value="calculo4">4 Dobras
                                    Cutâneas</option>
                            </select>
                        </div>
                        <div id="pdg-tres" style="display: block;">
                            <div class="form-group">
                                <label for="abdome3">
                                    Dobra cutânea do abdome
                                </label>
                                <input id="abdome3" type="text"
                                       class="form-control"
                                       placeholder="Digite o valor em milímetro">
                            </div>
                            <div class="form-group">
                                <label for="tricep3">
                                    Dobra cutânea do triceps
                                </label>
                                <input id="tricep3" type="text"
                                       class="form-control"
                                       placeholder="Digite o valor em milímetro">
                            </div>
                            <div class="form-group">
                                <label for="suprailiaco3">
                                    Dobra cutânea do suprailíaco
                                </label>
                                <input id="suprailiaco3" type="text"
                                       class="form-control"
                                       placeholder="Digite o valor em milímetro">
                            </div>
                        </div>
                        <div id="pdg-quatro" style="display: none;">
                            <div class="form-group">
                                <label for="abdome4">
                                    Dobra cutânea do abdome
                                </label>
                                <input id="abdome4" type="text"
                                       class="form-control"
                                       placeholder="Digite o valor em milímetro">
                            </div>
                            <div class="form-group">
                                <label for="tricep4">
                                    Dobra cutânea do triceps
                                </label>
                                <input id="tricep4" type="text"
                                       class="form-control"
                                       placeholder="Digite o valor em milímetro">
                            </div>
                            <div class="form-group">
                                <label for="suprailiaco4">
                                    Dobra cutânea do suprailíaco
                                </label>
                                <input id="suprailiaco4" type="text"
                                       class="form-control"
                                       placeholder="Digite o valor em milímetro">
                            </div>
                            <div class="form-group">
                                <label for="coxa">
                                    Dobra cutânea da coxa
                                </label>
                                <input id="coxa" type="text" class="form-control"
                                       placeholder="Digite o valor em milímetro">
                            </div>
                        </div>
                        <div class="form-group">
                            <?= Html::a('Voltar', '#', [
                                'id' => 'btn-volta1',
                                'class' => 'btn btn-small btn-default btn-flat'
                            ]) ?>

                            <?= Html::a('Próximo', '#', [
                                'id' => 'btn-proximo2',
                                'class' => 'btn btn-small btn-success btn-flat pull-right'
                            ]) ?>
                        </div>
                    </div>
                    <div id='form3' style='display: none;' class="col-md-12">

                        <div class="form-group">
                            <label for="altura-final">
                                Altura
                            </label>
                            <input id="altura-final" type="text"
                                   class="form-control"
                                   disabled>
                        </div>

                        <div class="form-group">
                            <label for="peso-final">
                                Peso
                            </label>
                            <input id="peso-final" type="text"
                                   class="form-control"
                                   disabled>
                        </div>

                        <?= $form->field($imc_model, 'valor')->textInput([
                            'disabled' => 'disabled',
                        ]) ?>

                        <?= $form->field($pdg_model, 'valor')->textInput([
                            'disabled' => 'disabled',
                        ]) ?>

                        <div class="form-group">
                            <?= Html::a('Voltar', '#', [
                                'id' => 'btn-volta2',
                                'class' => 'btn btn-small btn-default btn-flat'
                            ]) ?>
                            <?= Html::submitButton('Confirmar', ['class' => 'btn btn-success btn-flat pull-right']) ?>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
