<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss(<<<CSS

    div#img-equipamento {
        margin-bottom: 20px;
    }
    
    .box-header small {
        display: block;
    }    

CSS
);

$this->registerJsFile('@web/js/upload-equipamento.js');
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Registrar equipamento
                </h4>
                <small class="text-muted">Preencha os campos corretamente</small>
            </div>
            <div class="box-body">
                <div  class="text-center">
                    <img
                            id="img-equipamento"
                            class="img-responsive img-thumbnail"
                            height="180"
                            width="180"
                            src="<?= Url::to('@web/uploads/equipamentos/default.png')
                            ?>"
                            alt="">
                </div>

                <?php $form = ActiveForm::begin(['id' => 'form-equipamento']); ?>

                <?= $form->field($model, 'image_file')->fileInput([
                    'id' => 'upload-img',
                ]) ?>

                <?= $form->field($model, 'nome')->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Digite o nome do equipamento'
                ]) ?>

                <?= $form->field($model, 'descricao')->textarea([
                    'maxlength' => true,
                    'placeholder' => 'Digite uma breve descrição sobre o equipamento'
                ]) ?>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="box-footer clearfix">
                <?= Html::submitButton('Confirmar', [
                    'class' => 'btn bg-green btn-flat pull-right',
                    'form' => 'form-equipamento'
                ]) ?>
            </div>
        </div>
    </div>
</div>