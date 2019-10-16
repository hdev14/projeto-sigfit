<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Treino */

$this->title = "Informações do Treino";
//$this->params['breadcrumbs'][] = ['label' => 'Treinos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCss(<<<CSS
    .dropdown-menu > li > button.btn-alt-rep {
        display: block;
        padding: 3px 20px;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333333;
        white-space: nowrap;
        border: none;
    }
CSS
);

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
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">
                    <?= $model->titulo ?>
                    <?php if ($model->generico): ?>
                        <span class="badge bg-gray">Genérico</span>
                    <?php endif; ?>
                </h4>
                <div class="box-tools pull-right">
                    <?php $modal = Modal::begin([
                        'header' => 'Preenchar os campos corretamente',
                        'footer' =>
                            Html::submitButton('Confirmar', [
                                'class' => 'btn bg-green btn-flat btn-sm',
                                'form' => 'form-editar-treino',
                            ])
                        ,
                        'toggleButton' => [
                            'label' => "<i class='fa fa-fw fa-pencil'></i>",
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

                    <?php ActiveForm::end(); ?>

                    <?php Modal::end(); ?>

                    <?= Html::a(
                        '<i class="fa fa-trash fa-lg"></i>',
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
                <h4>Exercicios</h4>
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th>Nome</th>
                        <th>Número de repetições</th>
                        <th>Tipo</th>
                        <th>Equipamento</th>
                        <th style="width: 50px"></th>
                    </tr>
                    <?php foreach ($model->treinoExercicios as $treinoExercicio): ?>
                        <!--MODAL PARA EDIÇÃO DE REPETIÇÕES-->
                        <?php $modal = Modal::begin([
                            'header' => 'Preenchar o campo corretamente',
                            'footer' =>
                                Html::submitButton('Confirmar', [
                                    'class' => 'btn bg-green btn-flat btn-sm',
                                    'form' => 'form-repeticao-exercicio',
                                ])
                            ,
                            'id' => 'modal-alt-num' .
                                $treinoExercicio->exercicio_id,
                        ]); ?>

                        <?= Html::beginForm(
                            ['treino/update-numero-repeticao'],
                            'post',
                            ['id' => 'form-repeticao-exercicio']
                        ) ?>

                        <div class="form-group">
                            <?= Html::activeLabel($treinoExercicio, 'numero_repeticao') ?>
                            <?= Html::activeInput('text',$treinoExercicio,'numero_repeticao',[
                                'class' => 'form-control',
                                'placeholder' => 'Digite o número de repetições'
                            ]) ?>
                        </div>

                        <?= Html::endForm() ?>

                        <?php Modal::end(); ?>
                        <!--MODAL PARA EDIÇÃO DE REPETIÇÕES-->

                        <tr>
                            <td><?= $treinoExercicio->exercicio->nome ?></td>
                            <td><?= $treinoExercicio->numero_repeticao ?></td>
                            <td><?= $treinoExercicio->exercicio->tipo ?></td>
                            <td><?= $treinoExercicio->exercicio->equipamento->nome ?></td>
                            <td>
                                <div class="dropdown">
                                    <?= Html::button('<i class="fa fa-bars fa-fw"></i>', [
                                        'class' => 'btn btn-box-tool dropdown-toggle',
                                        'id' => 'dropdown-exercicio',
                                        'data-toggle' => 'dropdown',
                                        'aria-haspopup' => true,
                                        'aria-expanded' => true,
                                        'type' => 'button',
                                    ]) ?>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown-exercicio">
                                        <li>
                                            <!-- TODO Modal para alterar o número de repetições
                                             OBS: O modal está dentro do dropdown, quando o
                                             dropdown não está aberto o modal não aparece e buga
                                             tudo.
                                             -->
                                            <?= Html::button('Alt. número de rep.', [
                                                'class' => 'btn-alt-rep',
                                                'title' => 'Alterar número de repetições',
                                                'data-toggle' => 'modal',
                                                'data-target' => 'modal-alt-num' .
                                                    $treinoExercicio->exercicio_id,
                                                'type' => 'button'
                                            ]) ?>
                                        </li>
                                        <li>
                                            <?= Html::a(
                                                'Remover exercício',
                                                ['delete', 'id' => $treinoExercicio->exercicio->id],
                                                [
                                                    'title' => 'Excluir exercício',
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
                                                    'id' => $treinoExercicio->exercicio->id],
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
            </div>
        </div>
    </div>
</div>
<!--<div class="treino-view">

    <h1> Html::encode($this->title) </h1>

    <p>
         Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])
         Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
    </p>

     DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dia',
            'generico',
            'titulo',
            'genero',
            'nivel',
        ],
    ])

</div>-->
