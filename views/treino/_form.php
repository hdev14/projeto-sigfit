<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Treino */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="treino-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dia')->dropDownList([ 'segunda-feira' => 'Segunda-feira', 'terça-feira' => 'Terça-feira', 'quarta-feira' => 'Quarta-feira', 'quinta-feira' => 'Quinta-feira', 'sexta-feira' => 'Sexta-feira', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'generico')->textInput() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'genero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nivel')->dropDownList([ 'iniciante' => 'Iniciante', 'intermediario' => 'Intermediario', 'avançado' => 'Avançado', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
