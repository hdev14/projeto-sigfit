<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss("
    div#img-equipamento {
        margin-bottom: 20px;
    }
");
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Preencha os campos corretamente
                </h4>
            </div>
            <div class="box-body">
                <div id="img-equipamento" class="text-center">
                    <img
                            class="img-responsive img-thumbnail"
                            height="180"
                            width="180"
                            src="#"
                            alt="">
                </div>

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'imagem')->fileInput()
                    ->label('') ?>

                <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'descricao')->textarea(['maxlength'
                => true]) ?>

                <div class="form-group text-right">
                    <?= Html::submitButton('Confirmar', ['class' => 'btn bg-green btn-flat']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>