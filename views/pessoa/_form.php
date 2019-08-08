<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pessoa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'periodo_curso')->textInput() ?>

    <?= $form->field($model, 'horario_treino')->dropDownList([ 'nenhum' => 'Nenhum', '7h às 8h' => '7h às 8h', '8h às 9h' => '8h às 9h', '9h às 10h' => '9h às 10h', '10h às 11h' => '10h às 11h', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'problema_saude')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'faltas')->textInput() ?>

    <?= $form->field($model, 'espera')->textInput() ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
