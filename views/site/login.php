<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="login-box">
    <div class="login-logo">
        <a href="">SIG<b>FIT</b></a>
    </div>
    <div class="login-box-body">

        <p class="login-box-msg">Digite sua matrícula e senha do
            <strong>SUAP</strong></p>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'matricula') ?>

        <?= $form->field($model, 'senha')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Entrar',['class' => 'btn btn-success btn-block btn-flat']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

