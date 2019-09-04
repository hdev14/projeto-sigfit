<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

?>
<div class="login-box">
    <div class="login-logo">
        <a href="">SIG<b>FIT</b></a>
    </div>
    <div class="login-box-body">

        <p class="login-box-msg">
            Digite sua matrícula e senha do
            <a href="suap.ifrn.edu.br">
                <strong>SUAP</strong>
            </a>
        </p>

        <?php if ($error = Yii::$app->session->getFlash('autenticacao_error')) {
            echo Alert::widget([
                'options' => ['class' => 'alert-danger'],
                'body' => $error[0],
            ]);
        } ?>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'matricula') ?>

        <?= $form->field($model, 'senha')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Entrar',['class' => 'btn btn-success btn-block btn-flat']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>


<a id="freepik" href="https://br.freepik
        .com/fotos-vetores-gratis/fundo">Fundo
    foto criado por freepik - br.freepik.com</a>


