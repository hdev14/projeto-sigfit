<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('@web/css/box-subtitle.css');
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-success">

            <div class="box-header with-border">
                <h3 class="box-title">
                    Registrar Instrutor
                </h3>
                <small class="text-muted">
                    Preencha os dados corretamente
                </small>
            </div>
            <div class="box-body">

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'image_file')->fileInput() ?>

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
                    <?= Html::submitButton('Confirmar', [
                        'class' => 'btn bg-green'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>

