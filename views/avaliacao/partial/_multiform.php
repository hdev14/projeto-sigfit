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

?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3>Preencha os campos corretamente</h3>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($avaliacao_model, 'nome')->textInput() ?>

                <?= $form->field($avaliacao_model, 'idade')->textInput() ?>

                <?= $form->field($avaliacao_model, 'altura')->textInput() ?>

                <?= $form->field($peso_model, 'valor')->textInput() ?>

                <?= $form->field($imc_model, 'valor')->textInput() ?>

                <?= $form->field($pdg_model, 'valor')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
