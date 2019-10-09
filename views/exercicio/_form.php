<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Exercicio */
/* @var $form yii\widgets\ActiveForm */
/* @var $equipamentos yii\db\ActiveRecord[] */
/* @var $equipamento app\models\Equipamento */
/* @var $equipamento_id int */

?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Preencha os campos corretamente
                </h4>
            </div>
            <div class="box-body">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'nome')->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Digite o nome do exercício',
                ]) ?>

                <?= $form->field($model, 'equipamento_id')->dropDownList(
                    ArrayHelper::map($equipamentos, 'id', 'nome'),
                    [
                        'prompt' => 'Escolha o equipamento que este exercício pertence',
                        'value' => $equipamento_id
                    ]
                ) ?>

                <?= $form->field($model, 'tipo')->radioList([
                    'aerobico' => 'Aerobico',
                    'anaerobico' => 'Anaerobico'
                ]) ?>

                <?= $form->field($model, 'descricao')->textarea([
                    'maxlength' => true,
                    'placeholder' => 'Digite uma descrição breve sobre o exercício.',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Confirmar', [
                        'class' => 'btn bg-green btn-flat pull-right'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

