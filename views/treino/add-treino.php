<?php

use yii\helpers\Html;$this->title = "Adicionar treino";
use yii\helpers\ArrayHelper;

/* @var $this \yii\web\View*/
/* @var $treinos \yii\db\ActiveRecord[] */
/* @var $usuario_id integer */
/* @var $dia string */

$this->title = '';

$this->registerCss(<<<CSS

    small#subtitle {
        display: block;
    }

CSS
);
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box box-success">
            <div class="box-header">
                <h4 class="box-title">
                    Adicionar treino
                </h4>
                <small id="subtitle" class="text-muted">
                    Selecione um treino por: nome, dia e exercícios
                </small>
            </div>
            <div class="box-body">

                <?= Html::beginForm(
                    [
                        'treino/add-treino',
                        'usuario_id' => $usuario_id
                    ],
                    'post',
                    ['id' => 'form-add-treino']
                ) ?>

                <div class="form-group">
                    <?= Html::label(
                        'Selecione um treino ou registre um novo',
                        'select-treino',
                        [ 'class' => 'control-label']
                    ) ?>
                    <?= Html::dropDownList(
                        'treino', null,
                        ArrayHelper::map($treinos, 'id', function($treino) {
                            /* @var $treino \app\models\Treino */
                            /* @var $exercicio \app\models\Exercicio */
                            $exercicios =  "";
                            foreach ($treino->exercicios as $exercicio) {
                                $exercicios .= "- $exercicio->nome ";
                            }
                            $exercicios = $exercicios === "" ? " - Treino sem exercícios" :
                                $exercicios;
                            return "$treino->titulo | $treino->dia $exercicios";
                        }),
                        [
                            'id' => 'select-treino',
                            'class' => 'form-control',
                            'required' => 'required',
                            'prompt' => 'Selecione o treino por nome, dia e exercícios.'
                        ]
                    ) ?>
                </div>

                <?= Html::endForm() ?>
            </div>
            <div class="box-footer clearfix">
                <div class="pull-right">
                    <?= Html::a(
                        'Registrar novo',
                        [
                            'treino/create',
                            'usuario_id' => $usuario_id,
                            'dia' => $dia,
                        ],
                        ['class' => 'btn bg-gray']
                    ) ?>
                    <?= Html::submitButton('Confirmar', [
                        'form' => 'form-add-treino',
                        'class' => 'btn bg-green'
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
