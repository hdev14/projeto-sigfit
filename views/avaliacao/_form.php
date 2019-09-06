<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="avaliacao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pessoa_id')->textInput() ?>

    <?= $form->field($model, 'altura')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
