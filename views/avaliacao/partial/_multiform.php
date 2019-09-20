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
/* @var $sexo string */

$this->registerJsFile('@web/js/calculos-dobras.js');
$this->registerJsFile('@web/js/avaliacao.js');
$this->registerCssFile('@web/css/avaliacao.css');
?>

<p id="sexo" style="display: none"><?= $sexo ?></p>
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
                            <select
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
                            'readonly' => 'readonly',
                        ]) ?>

                        <?= $form->field($pdg_model, 'valor')->textInput([
                            'readonly' => 'readonly',
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

<script>

</script>
