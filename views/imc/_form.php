<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Imc */
/* @var $form yii\widgets\ActiveForm */


$this->registerJs("
    const altura_elt = 
        document.querySelector('#altura-imc')
    , peso_elt = document.querySelector('#peso-imc')
    , btn_calcular = document.querySelector('#calcular-imc');
    
    btn_calcular.onclick = () => {
        let altura = parseFloat(altura_elt.value)
            , peso = parseFloat(peso_elt.value)
            , imc = document.querySelector('#imc-valor');
        
        imc.value = ((peso / Math.pow(altura, 2)) * 10000).toFixed(2);
    }
");
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Preencha os campos para que possa ser feito o novo cálculo
                </h4>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin(); ?>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="altura-imc">
                            Altura
                        </label>
                        <input type="text" class="form-control"
                               id="altura-imc"
                               placeholder="Digite a altura (cm)">
                    </div>
                    <div class="col-md-6">
                        <label for="peso-imc">
                            Peso
                        </label>
                        <input type="text" class="form-control"
                               id="peso-imc"
                               placeholder="Digite o peso (Kg)">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'valor')->textInput([
                            'placeholder' => '0.0',
                            'readonly' => 'readonly',
                        ]) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::a('Voltar', [
                        'pessoa/view' ,
                        'id' => $model->avaliacao->pessoa_id
                    ], [
                        'class' => 'btn bg-gray btn-flat'
                    ]) ?>
                    <div class="pull-right">
                        <?= Html::a('Calcular Peso', '#', [
                            'class' => 'btn bg-light-blue btn-flat',
                            'role' => 'button',
                            'id' => 'calcular-imc',
                        ]) ?>
                        <?= Html::submitButton('Confirmar', [
                            'class' => 'btn bg-green btn-flat'
                        ]) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


