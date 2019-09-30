<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Peso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Preencha o campo corretamente
                </h4>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'valor')->textInput([
                    'placeholder' => 'Digite o valor do peso (Kg)'
                ]) ?>

                <div class="form-group">
                    <?= Html::a('Voltar', [
                        'pessoa/view' ,
                        'id' => $model->avaliacao->pessoa_id
                    ], [
                        'class' => 'btn bg-gray btn-flat'
                    ]) ?>
                    <?= Html::submitButton('Confirmar', [
                        'class' => 'btn bg-green btn-flat pull-right'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
