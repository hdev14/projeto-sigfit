<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Treino */
/* @var $exercicios \yii\db\ActiveRecord[] */


$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Treinos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJs(<<<JS
    let btns_alterar_repeticao = document.querySelectorAll('.btn-alt-rep');

    for (let btn_alt_rep of btns_alterar_repeticao) {
        btn_alt_rep.addEventListener('click', function(event) {
            let id_modal = event.target.dataset.target;
            $('#'+id_modal).modal('show');
        });
    }
JS
);

?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="box box-success">
            <div class="box-header no-border">
                <h4 class="box-title">
                    <?= $model->titulo ?>
                    <?php if ($model->generico): ?>
                        <span class="badge bg-gray">Genérico</span>
                    <?php endif; ?>
                </h4>
                <div class="box-tools pull-right">
                    <?php $modal = Modal::begin([
                        'header' => '<b>Preenchar os campos corretamente</b>',
                        'footer' =>
                            Html::submitButton('Confirmar', [
                                'class' => 'btn bg-green',
                                'form' => 'form-editar-treino',
                            ])
                        ,
                        'toggleButton' => [
                            'label' => "<i class='fa fa-fw fa-pencil fa-lg'></i>",
                            'class' => 'btn btn-box-tool',
                            'title' => 'Editar treino'
                        ],
                    ]); ?>
                    <?php $form = ActiveForm::begin([
                        'action' => ['treino/update', 'id' => $model->id],
                        'id' => 'form-editar-treino'
                    ]); ?>

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
                        ['m' => 'Masculino', 'f' => 'Feminino'],
                        ['title' => 'Escolha o gênero que este treino será destinado']
                    ) ?>

                    <?= $form->field($model, 'nivel')->dropDownList(
                        [
                            'iniciante' => 'Iniciante',
                            'intermediario' => 'Intermediario',
                            'avançado' => 'Avançado',
                        ],
                        ['prompt' => 'Escolha um nível que você considera adequado para este treino']
                    ) ?>

                    <?php ActiveForm::end(); ?>
                    <?php Modal::end(); ?>

                    <?= Html::a(
                        '<i class="fa fa-trash fa-fw fa-lg"></i>',
                        ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-box-tool',
                            'title' => 'Excluir treino',
                            'data' => [
                                'confirm' => 'Tem certeza de que deseja excluir este treino?',
                                'method' => 'post',
                            ],
                        ]
                    ) ?>
                </div>
            </div>
            <div class="box-body">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <span class="badge bg-blue">
                            <?= $model->dia ?>
                        </span>
                        <b>Dia recomendado</b>
                    </li>
                    <li class="list-group-item">

                        <?php if ($model->nivel == 'iniciante'): ?>
                            <span class="badge bg-green">Iniciante</span>
                        <?php elseif ($model->nivel == 'intermediario'): ?>
                            <span class="badge bg-yellow">Intermediário</span>
                        <?php elseif ($model->nivel == 'avançado'): ?>
                            <span class="badge bg-red">Avançado</span>
                        <?php endif; ?>

                        <b>Nível do treino</b>
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">
                            <b>Destinado</b>
                        </h6>
                        <p class="list-group-item-text text-muted">
                            Treino destinado ao sexo

                            <?php if ($model->genero == 'm'): ?>
                                <span class="label label-info">
                                    Masculino
                                </span>
                            <?php else: ?>
                                <span class="label bg-maroon">
                                    Feminino
                                </span>
                            <?php endif; ?>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="box-footer clearfix no-border">
                <div class="clearfix">
                    <h4 class="pull-left">
                        Lista de exercícios
                    </h4>

                    <!--MODAL PARA ADIÇÃO DE EXERCÍCIO-->
                    <?php $modal = Modal::begin([
                        'header' => 'Preenchar os campos corretamente',
                        'footer' =>
                            Html::submitButton('Confirmar', [
                                'class' => 'btn bg-green',
                                'form' => 'form-add-exercicio',
                            ])
                        ,
                        'toggleButton' => [
                            'label' => "<i class='fa fa-fw fa-plus'></i> Adicionar Exercício",
                            'class' => 'btn bg-green btn-sm pull-right',
                            'title' => 'Adicionar exercício ao treino'
                        ]
                    ]); ?>

                    <?= Html::beginForm(
                        [
                            'treino/add-exercicio',
                            'treino_id' => $model->id,
                        ],
                        'post',
                        ['id' => 'form-add-exercicio']
                    ) ?>

                    <div class="row">
                        <div class="form-group col-md-7">
                            <?= Html::dropDownList(
                                'add-exercicio-id',
                                null,
                                ArrayHelper::map($exercicios, 'id', 'nome'),
                                [
                                    'class' => 'form-control',
                                    'prompt' => 'Escolhar o exercício',
                                    'required' => true,
                                ]
                            ) ?>
                        </div>
                        <div class="form-group col-md-5">
                            <?= Html::dropDownList('add-exercicio-repeticao', null,
                                [
                                    '3x8' => '3x8',
                                    '3x10' => '3x10',
                                    '3x12' => '3x12',
                                ],
                                [
                                    'class' => 'form-control',
                                    'prompt' => 'Número de repetições',
                                    'required' => true,
                                ]
                            ) ?>
                        </div>
                    </div>

                    <?= Html::endForm() ?>

                    <?php Modal::end(); ?>
                    <!--MODAL PARA ADIÇÃO DE EXERCÍCIO-->

                </div>
                <?php if ($model->treinoExercicios !== []): ?>
                    <table class="table table-hover table-striped">
                        <tbody>
                        <tr>
                            <th>Nome</th>
                            <th>Nº de repetições</th>
                            <th>Tipo</th>
                            <th>Equipamento</th>
                            <th style="width: 30px"></th>
                        </tr>
                        <?php foreach ($model->treinoExercicios as $treinoExercicio): ?>
                            <!--MODAL PARA EDIÇÃO DO NÚMERO DE REPETIÇÕES-->
                            <?php $modal = Modal::begin([
                                'header' => '<b>Preenchar o campo corretamente</b>',
                                'footer' =>
                                    Html::submitButton('Confirmar', [
                                        'class' => 'btn bg-green',
                                        'form' => 'form-repeticao-exercicio' . $treinoExercicio->exercicio_id,
                                    ])
                                ,
                                'id' => 'modal-alt-num' .
                                    $treinoExercicio->exercicio_id,
                            ]); ?>

                            <?= Html::beginForm(
                                [
                                    'treino/update-numero-repeticao',
                                    'treino_id' => $treinoExercicio->treino_id,
                                    'exercicio_id' => $treinoExercicio->exercicio_id
                                ],
                                'post',
                                ['id' => 'form-repeticao-exercicio' . $treinoExercicio->exercicio_id]
                            ) ?>

                            <div class="form-group">
                                <?= Html::activeLabel($treinoExercicio, 'numero_repeticao') ?>
                                <?= Html::activeDropDownList(
                                    $treinoExercicio,
                                    'numero_repeticao',
                                    ['3x8' => '3x8', '3x10' => '3x10', '3x12' => '3x12'],
                                    [
                                        'class' => 'form-control',
                                        'placeholder' => 'Digite o número de repetições'
                                    ]
                                ) ?>
                            </div>

                            <?= Html::endForm() ?>
                            <?php Modal::end(); ?>
                            <!--MODAL PARA EDIÇÃO DO NÚMERO DE REPETIÇÕES-->

                            <tr>
                                <td><?= $treinoExercicio->exercicio->nome ?></td>
                                <td><?= $treinoExercicio->numero_repeticao ?></td>
                                <td>
                                    <?php if ($treinoExercicio->exercicio->tipo == 'aerobico'): ?>
                                        <span class="badge bg-red">Aeróbico</span>
                                    <?php else: ?>
                                        <span class="badge bg-aqua">Anaeróbico</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($treinoExercicio->exercicio->equipamento !== null): ?>
                                        <?= $treinoExercicio->exercicio->equipamento->nome ?>
                                    <?php else: ?>
                                        Sem equipamento
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <?= Html::button('<i class="fa fa-bars fa-fw"></i>', [
                                            'class' => 'btn btn-box-tool dropdown-toggle',
                                            'id' => 'dropdown-exercicio',
                                            'data-toggle' => 'dropdown',
                                            'aria-haspopup' => true,
                                            'aria-expanded' => true,
                                            'type' => 'button',
                                            'title' => 'opções'
                                        ]) ?>
                                        <ul class="dropdown-menu" aria-labelledby="dropdown-exercicio">
                                            <li>
                                                <?= Html::a('Alt. número de rep.', null,
                                                    [
                                                        'class' => 'btn-alt-rep',
                                                        'title' => 'Alterar número de repetições',
                                                        'data-target' => 'modal-alt-num' . $treinoExercicio->exercicio_id,
                                                    ]
                                                ) ?>
                                            </li>
                                            <li>
                                                <?= Html::a(
                                                    'Remover exercício',
                                                    [
                                                        'treino/remove-exercicio',
                                                        'treino_id' => $treinoExercicio->treino_id,
                                                        'exercicio_id' => $treinoExercicio->exercicio_id,
                                                    ],
                                                    [
                                                        'title' => 'Remover exercício do treino',
                                                        'data' => [
                                                            'confirm' => 'Tem certeza que deseja remover este exercício do treino ?',
                                                            'method' => 'post',
                                                        ],
                                                    ]
                                                ) ?>
                                            </li>
                                            <li role="separator" class="divider"></li>
                                            <li>
                                                <?= Html::a(
                                                    'Mais informações',
                                                    [
                                                        'exercicio/view',
                                                        'id' => $treinoExercicio->exercicio_id],
                                                    [
                                                        'title' => 'Mais informações sobre o exercício'
                                                    ]
                                                ) ?>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="callout">
                        <p>
                            Este treino ainda não possui exercícios.
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
