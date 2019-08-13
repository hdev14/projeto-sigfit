<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-success pessoa-form">

    <div class="boxheader with-border">
        <h3 class="box-title">Preencha os dados corretamente</h3>
    </div>
    <div class="box-body">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'foto')->fileInput() ?>

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

        <div class="form-group text-right">
            <?= Html::submitButton('Registrar', [
                'class' => 'btn btn-success btn-flat'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
