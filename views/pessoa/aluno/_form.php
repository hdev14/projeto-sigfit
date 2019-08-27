<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success pessoa-form">
    <div class="box-header with-border">
        <h3 class="box-title">Preencha os dados corretamente</h3>
    </div>
    <div class="box-body">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-xs-6">

                <?= $form->field($model, 'matricula')->textInput([
                    'placeholder' => 'Digite a matrícula.',
                    'maxlength' => true
                ]) ?>

                <?= $form->field($model, 'nome')->textInput([
                    'placeholder' => "Digite o nome do usuário",
                    'maxlength' => true
                ]) ?>

                <?= $form->field($model, 'email')->textInput([
                    'placeholder' => 'Ex:. usuario@email.com',
                    'maxlength' => true
                ]) ?>

                <?= $form->field($model, 'curso')->textInput([
                    'placeholder' => 'Ex:. TSI ou Tecnologia em Sistema para Internet',
                    'maxlength' => true
                ]) ?>

                <?= $form->field($model, 'periodo_curso')->input('number', [
                    'max' => 9,
                    'min' => 1,
                    'value' => 1,
                    'placeholder' => '1'
                ]) ?>

            </div>

            <div class="col-xs-6">


                <?= $form->field($model, 'telefone')->textInput([
                    'pattern' => '^\(\d{2}\)\d{5}-\d{4}',
                    'placeholder' => "(99)99999-9999",
                    'maxlength' => true
                ]) ?>

                <?= $form->field($model, 'horario_treino')->dropDownList([
                    '7h às 8h' => '7h às 8h',
                    '8h às 9h' => '8h às 9h',
                    '9h às 10h' => '9h às 10h',
                    '10h às 11h' => '10h às 11h',
                ], ['prompt' => 'Selecione o horário de treino']) ?>

                <?= $form->field($model, 'problema_saude')->textarea([
                    'placeholder' => "Descrição do problema",
                    'rows' => 4
                ]) ?>

                <?= $form->field($model, 'image_file')->fileInput() ?>

            </div>
            <div class="col-xs-12 form-group text-right">
                <?= Html::submitButton('Confirmar', [
                    'class' => 'btn btn-success btn-flat'
                ]) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

