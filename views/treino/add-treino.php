<?php

use yii\helpers\Html;$this->title = "Adicionar treino";
use yii\helpers\ArrayHelper;

/* @var $this \yii\web\View*/
/* @var $treinos \yii\db\ActiveRecord[] */
/* @var $usuario_id integer */
/* @var $dia string */

$this->title = "Adicionar treino";
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-success">
            <div class="box-header">
                <h4 class="box-title">
                    Selecione um treino
                </h4>
            </div>
            <div class="box-body">

                <?php $form = Html::beginForm(['treino/add-treino'], 'post',[
                    'id' => 'form-add-treino'
                ]); ?>

                <div class="form-group">
                    <?= Html::label(
                        'Selecione um treino ou registre um novo',
                        'select-treino',
                        [ 'class' => 'control-label']
                    ) ?>
                    <?= Html::dropDownList(
                        'treino', null,
                        ArrayHelper::map($treinos, 'id', 'titulo'),
                        [
                            'id' => 'select-treino',
                            'class' => 'form-control',
                            'multiple' => true,
                        ]
                    ) ?>
                </div>

                <?php Html::endForm(); ?>
            </div>
            <div class="box-footer clearfix">
                <div class="pull-right">
                    <?= Html::a(
                        'Registrar',
                        [
                            'treino/create',
                            'usuario_id' => $usuario_id,
                            'dia' => $dia,
                        ],
                        ['class' => 'btn btn-flat bg-gray']
                    ) ?>
                    <?= Html::submitButton('Confirmar', [
                        'form' => 'form-add-treino',
                        'class' => 'btn btn-flat bg-green'
                    ]) ?>
                </div>

            </div>
        </div>
    </div>
</div>
