<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('@web/css/box-subtitle.css');

$this->registerCss("
    div.img-preview {
        margin-top: 25px; 
        margin-bottom: 25px; 
    }
");

$this->registerJsFile('@web/js/upload-usuario.js');

?>

<div class="box box-success pessoa-form">

    <div class="box-header with-border">
        <h3 class="box-title">Editar usuário <?= $model->nome ?> </h3>
        <small class="text-muted">
            Preencha os campos corretamente
        </small>
    </div>
    <div class="box-body">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-xs-6">
                <div class="row img-preview">
                    <div class="col-md-4">
                        <img id="img-usuario"
                             src="<?= Url::to(
                                 ($model->foto) ?
                                 '@web' . $model->foto :
                                 '@web/uploads/equipamentos/default.png'
                             ) ?>" alt=""
                             class="img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <?= $form->field($model, 'image_file')->fileInput([
                            'id' => 'upload-img',
                        ]) ?>
                    </div>
                </div>

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

            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'telefone')->textInput([
                    'placeholder' => "(99)99999-9999",
                    'maxlength' => true
                ])->label('Telefone (opcional)') ?>

                <?= $form->field($model, 'sexo')->dropDownList([
                    'masculino' => 'Masculino',
                    'feminino' => 'Feminino',
                ], ['prompt' => 'Selecione seu sexo']) ?>

                <?= $form->field($model, 'horario_treino')->dropDownList([
                    '7h às 8h' => '7h às 8h',
                    '8h às 9h' => '8h às 9h',
                    '9h às 10h' => '9h às 10h',
                    '10h às 11h' => '10h às 11h',
                ], ['prompt' => 'Selecione o horário de treino']) ?>

                <?= $form->field($model, 'problema_saude')->textarea([
                    'placeholder' => "Descrição do Problema",
                    'rows' => 4
                ])->label('Problema de Saúde (opcional)') ?>
            </div>

            <div class="col-xs-12 form-group text-right">
                <?= Html::submitButton('Confirmar', [
                    'class' => 'btn bg-green'
                ]) ?>
            </div>
        </div>



        <?php ActiveForm::end(); ?>
    </div>

</div>
