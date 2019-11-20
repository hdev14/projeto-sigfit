<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('@web/css/box-subtitle.css');
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Editar <?= $model->titulo ?></h3>
                <small class="text-muted">
                    Preencha os campos corretamente
                </small>
            </div>
            <div class="box-body">
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
                    <?= Html::submitButton('Confirmar', [
                        'class' => 'btn bg-green pull-right'
                    ]) ?>
                    <?= Html::a('Voltar', [
                        'pessoa/view' ,
                        'id' => $model->pessoa_id
                    ], [
                        'class' => 'btn bg-gray'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

