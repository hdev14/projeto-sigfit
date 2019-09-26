<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaliacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput([
        'placeholder' => 'Digite o título da avaliação'
    ]) ?>

    <?= $form->field($model, 'altura')->textInput([
        'placeholder' => 'Digite a idade do usuário'
    ]) ?>

    <?= $form->field($model, 'idade')->textInput([
        'placeholder' => 'Digite o peso atual do usuário'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
