<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */
/* @var $form yii\widgets\ActiveForm */

$this->registerCss("
    div#img-equipamento {
        margin-bottom: 20px;
    }
");

$this->registerJs("

    let img_equipamento = document.querySelector('#img-equipamento');
    let upload_img = document.querySelector('#upload-img');
    
    upload_img.addEventListener('change', function (event) {
        let reader = new FileReader();
        reader.onload = function(event) {
            img_equipamento.setAttribute('src', event.target.result);
        }
        reader.readAsDataURL(event.target.files[0]);
    }, false);

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

                <?php $form = ActiveForm::begin(); ?>

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

                <div class="form-group text-right">
                    <?= Html::submitButton('Confirmar', ['class' => 'btn bg-green btn-flat']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>