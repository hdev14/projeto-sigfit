<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $this \yii\web\View */
/* @var $treinos \yii\db\ActiveRecord[] */
/* @var $treino \app\models\Treino */
/* @var $exercicio \app\models\Exercicio*/
/* @var $pagination \yii\data\Pagination */

$this->title = "Treinos";

$this->registerCss(<<<CSS
    h6.exercicio-titulo {
        text-transform: uppercase;
    }
    
    div.links {
        margin-bottom: 10px;
    }
CSS
);
?>
<div class="links row">
    <div class="col-md-6">
        <div class="btn-group btn-group-sm" role="group">
            <?= Html::a('Todos', ['treino/treinos'], [
                'class' => 'btn bg-gray'
            ]) ?>
            <?= Html::a('Iniciante', ['treino/treinos', 'nivel' => 'iniciante'], [
                'class' => 'btn bg-gray'
            ]) ?>
            <?= Html::a('Intermediário', ['treino/treinos', 'nivel' => 'intermediario'], [
                'class' => 'btn bg-gray'
            ]) ?>
            <?= Html::a('Avançado', ['treino/treinos', 'nivel' => 'avançado'], [
                'class' => 'btn bg-gray'
            ]) ?>
        </div>
    </div>
    <div class="col-md-6">
        <?= Html::a(
            '<i class="fa fa-plus"></i> Novo Treino',
            ['treino/create'],
            [
                'class' => 'btn btn-flat bg-green btn-sm pull-right',
                'title' => 'Novo treino'
            ]
        ) ?>
    </div>
</div>
<div class="row">
    <?php foreach ($treinos as $treino): ?>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">
                        <?= $treino->titulo ?>
                        <?php if ($treino->nivel == 'iniciante'): ?>
                            <span class="badge bg-green">
                                Iniciante
                            </span>
                        <?php elseif ($treino->nivel == 'intermediario'): ?>
                            <span class="badge bg-yellow">
                                Intermediário
                            </span>
                        <?php elseif ($treino->nivel == 'avançado'): ?>
                            <span class="badge bg-red">
                                Avançado
                            </span>
                        <?php endif; ?>
                    </h4>
                    <div class="box-tools pull-right">
                        <?= Html::a(
                            '<i class="fa fa-fw  fa-gears"></i>',
                            ['treino/view', 'id' => $treino->id],
                            [
                                'class' => 'btn btn-box-tool',
                                'title' => 'configurações'
                            ]
                        ) ?>
                        <?= Html::button('<i class="fa fa-minus"></i>', [
                            'class' => 'btn btn-box-tool',
                            'data-widget' => 'collapse',
                        ]) ?>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="list-group list-group-unbordered">
                        <?php if (!$treino->treinoExercicios): ?>
                            <div class="callout">
                                <p>Treino ainda não possui exercícios</p>
                            </div>
                        <?php else: ?>

                            <?php foreach ($treino->treinoExercicios as $treino_exercicio): ?>
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading exercicio-titulo">
                                        <?= $treino_exercicio->exercicio->nome ?>
                                    </h6>
                                    <p class="list-group-item-text text-muted">
                                        Sequência recomendada
                                        <span class="label label-info">
                                            <?= $treino_exercicio->numero_repeticao ?>
                                        </span>
                                        <?= Html::a(
                                            '<i class="fa fa-fw fa-eye"></i>',
                                            [
                                                'exercicio/view',
                                                'id' => $treino_exercicio->exercicio->id
                                            ],
                                            [
                                                'class' => 'btn btn-xs bg-gray pull-right',
                                                'title' => 'Visualizar exercício'
                                            ]
                                        ) ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="col-md-12">
        <?= LinkPager::widget([
            'pagination' => $pagination,
            'options' => ['class' => 'pagination pagination-sm no-margin']
        ]) ?>
    </div>
</div>

