<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Treino */
/* @var $form yii\widgets\ActiveForm */
/* @var $exercicios \yii\db\ActiveRecord[] */
/* @var $exercicio \app\models\Exercicio */

$this->registerCss(<<<CSS
    #add-exercicio {
        margin-bottom: 10px;
    }
CSS
);

$this->registerJs(<<<JS
    
    const add_exercicio = document.querySelector('#add-exercicio')
        , exercicios = document.querySelector('#exercicios')
        , inputs_exercicio = document.querySelector("#inputs-exercicio")
        , select_exercicio = inputs_exercicio.firstElementChild.firstElementChild
        , select_repeticao = inputs_exercicio.lastElementChild.firstElementChild;
    
    add_exercicio.addEventListener('click', function() {
        let clone_inputs_exercicio = inputs_exercicio.cloneNode(true)
            , clone_select_exercicio = clone_inputs_exercicio
                                .firstElementChild.firstElementChild
            , clone_select_repeticao = clone_inputs_exercicio
                                .lastElementChild.firstElementChild;
  
        clone_select_exercicio.addEventListener('change', (event) => {
            let id_exercicio = event.target.value;
            clone_select_repeticao.setAttribute('name', 'exercicio['+id_exercicio+']');
            select_repeticao.setAttribute('required', 'required');
        }, false);
        
        exercicios.appendChild(clone_inputs_exercicio);
    });
    
    /*
    * Não foi possível reutilizar esta função pois a lógica é que cada select
     tenha seu input. */
    select_exercicio.addEventListener('change', (event) => {
        let id_exercicio = event.target.value;
        select_repeticao.setAttribute('name', 'exercicio['+id_exercicio+']');
        select_repeticao.setAttribute('required', 'required');
    }, false);
    
    
JS
);
?>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-success">
            <div class="box-header"></div>
            <div class="box-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'form-treino'
                ]); ?>
                <div class="row">
                    <div class="col-md-6">

                        <?= $form->field($model, 'titulo')->textInput([
                            'maxlength' => true,
                            'placeholder' => "Digite um título para o treino"
                        ]) ?>

                        <?= $form->field($model, 'dia')->dropDownList(
                            [
                                'segunda-feira' => 'Segunda-feira',
                                'terça-feira' => 'Terça-feira',
                                'quarta-feira' => 'Quarta-feira',
                                'quinta-feira' => 'Quinta-feira',
                                'sexta-feira' => 'Sexta-feira',
                            ],
                            [
                                'prompt' => 'Escolha um dia que você considera adequado para este treino'
                            ]
                        ) ?>

                        <?= $form->field($model, 'genero')->radioList(
                            [
                                'm' => 'Masculino',
                                'f' => 'Feminino'
                            ],
                            [
                                'title' => 'Escolha o gênero que este treino será destinado'
                            ]
                        ) ?>

                        <?= $form->field($model, 'nivel')->dropDownList(
                            [
                                'iniciante' => 'Iniciante',
                                'intermediario' => 'Intermediario',
                                'avançado' => 'Avançado',
                            ],
                            [
                                'prompt' => 'Escolha um nível que você considera adequado para este treino'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6">
                        <div class="clearfix">
                            <strong>Adicionar exercício para o treino (opcional)</strong>
                            <?= Html::a('<i class="fa fa-fw fa-plus"></i>', '#', [
                                'id' => 'add-exercicio',
                                'class' => 'btn bg-green btn-sm pull-right'
                            ]) ?>
                        </div>
                        <div id="exercicios">
                            <div id="inputs-exercicio" class="row">
                                <div class="form-group col-md-7">
                                    <?= Html::dropDownList('',null,
                                        ArrayHelper::map($exercicios, 'id', 'nome'),
                                        [
                                            'class' => 'form-control',
                                            'prompt' => 'Escolha o exercício',
                                        ]
                                    ) ?>
                                </div>
                                <div class="form-group col-md-5">
                                    <?= Html::dropDownList('',null, [
                                        '3x8' => '3x8',
                                        '3x10' => '3x10',
                                        '3x12' => '3x12',
                                    ],
                                        [
                                            'class' => 'form-control',
                                            'prompt' => 'Número de repetições',
                                        ]
                                    ) ?>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted">
                            <b>OBS:</b> Adicione quantos exercícios forem necessários. Porém
                            exercícios repetidos não serão considerados.
                        </p>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="box-footer clearfix no-border">
                <?= Html::submitButton('Confirmar', [
                    'form' => 'form-treino',
                    'class' => 'btn bg-green btn-flat pull-right'
                ]) ?>
            </div>
        </div>
    </div>
</div>
