<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $horario_treino string */
/* @var $treinos \yii\db\ActiveRecord[] */
/* @var $treino \app\models\Treino */
/* @var $usuario_id integer */

$this->registerCss(<<<CSS
    small#subtitle-horario {
        display: block;
        padding: 5px 0;
    }
    .small-box:hover {
        color: black;
    }
    
    a.titulo-treino-link {
        padding: 5px;
        color: #2d2f39;
        
    }
    
    a.titulo-treino-link:hover {
        color: rgba(45, 47, 57, 0.8);
    }
    
    a.add-treino-link {
        display: block;
        color: #2d2f39;
    }
    
    a.add-treino-link:hover {
        color: rgba(45, 47, 57, 0.8);
    }

CSS
);

$treino_segunda = $treino_terca = $treino_quarta = $treino_quinta = $treino_sexta = null;

foreach ($treinos as $treino) {
    switch ($treino->dia) {
        case 'segunda-feira':
            $treino_segunda = $treino;
            break;
        case 'terça-feira':
            $treino_terca = $treino;
            break;
        case 'quarta-feira':
            $treino_quarta = $treino;
            break;
        case 'quinta-feira':
            $treino_quinta = $treino;
            break;
        case 'sexta-feira':
            $treino_sexta = $treino;
            break;
    }
}

?>
<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header with-border">
            <h4 class="box-title">
                <?= $horario_treino ?>
                <small id="subtitle-horario" class="text-muted">
                    horário de treino
                </small>
            </h4>
            <div class="box-tools pull-right">
                <?php if (empty($treinos)): ?>
                     <?= Html::a(
                        '<i class=" fa fa-lg fa-file-text-o"></i>',
                        null,
                        [
                            'class' => 'btn btn-sm bg-light-blue disabled',
                            'title' => 'Adicione algum treino'
                        ]
                    ) ?>
                <?php else: ?>
                    <?= Html::a(
                        '<i class=" fa fa-lg fa-file-text-o"></i>',
                        ['pessoa/gerar-lista-treino-pdf', 'id' => $usuario_id],
                        [
                            'class' => 'btn btn-sm bg-light-blue',
                            'title' => 'Imprimir lista de treinos'
                        ]
                    ) ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-2 col-md-offset-1 border-right">
                    <h5 class="text-center">Segunda</h5>
                    <?php if ($treino_segunda !== null): ?>
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <div class="clearfix">

                                    <?= $this->render('_treino-nivel', [
                                        'treino' => $treino_segunda,
                                    ]) ?>

                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-close"></i>',
                                        [
                                            'treino/remove-treino',
                                            'treino_id' => $treino_segunda->id,
                                            'usuario_id' => $usuario_id
                                        ],
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário',
                                            'data' => [
                                                'confirm' => 'Tem certeza de que deseja remover este treino?',
                                                'method' => 'post',
                                            ],
                                        ]
                                    ) ?>
                                </div>
                                <h5>
                                    <?= Html::a(
                                        "<strong>$treino_segunda->titulo</strong>",
                                        ['treino/view', 'id' => $treino_segunda->id],
                                        [
                                            'class' => 'titulo-treino-link',
                                            'title' => 'Clique para mais detalhes',
                                        ]
                                    ) ?>
                                </h5>
                            </div>

                            <?= $this->render('_treino-exercicios', [
                                'treino' => $treino_segunda,
                            ]) ?>

                        </div>
                    <?php else: ?>
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h5 class="text-center">

                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-plus fa-2x"></i>',
                                        [
                                            'treino/add-treino',
                                            'usuario_id' => $usuario_id,
                                            'dia' => 'segunda-feira'
                                        ],
                                        [
                                            'class' => 'add-treino-link',
                                            'title' => 'Adicionar treino'
                                        ]
                                    ) ?>

                                </h5>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-2 border-right">
                    <h5 class="text-center">Terça</h5>
                    <?php if ($treino_terca !== null): ?>
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <div class="clearfix">

                                    <?= $this->render('_treino-nivel', [
                                        'treino' => $treino_terca,
                                    ]) ?>

                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-close"></i>',
                                        [
                                            'treino/remove-treino',
                                            'treino_id' => $treino_terca->id,
                                            'usuario_id' => $usuario_id
                                        ],
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário',
                                            'data' => [
                                                'confirm' => 'Tem certeza de que deseja remover este treino?',
                                                'method' => 'post',
                                            ],
                                        ]
                                    ) ?>
                                </div>
                                <h5>
                                    <?= Html::a(
                                        "<strong>$treino_terca->titulo</strong>",
                                        ['treino/view', 'id' => $treino_terca->id],
                                        [
                                            'class' => 'titulo-treino-link',
                                            'title' => 'Clique para mais detalhes',
                                        ]
                                    ) ?>
                                </h5>
                            </div>

                            <?= $this->render('_treino-exercicios', [
                                'treino' => $treino_terca,
                            ]) ?>

                        </div>
                    <?php else: ?>
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h5 class="text-center">
                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-plus fa-2x"></i>',
                                        [
                                            'treino/add-treino',
                                            'usuario_id' => $usuario_id,
                                            'dia' => 'terça-feira'
                                        ],
                                        [
                                            'class' => 'add-treino-link',
                                            'title' => 'Adicionar treino'
                                        ]
                                    ) ?>
                                </h5>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-2 border-right">
                    <h5 class="text-center">Quarta</h5>
                    <?php if ($treino_quarta !== null): ?>
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <div class="clearfix">

                                    <?= $this->render('_treino-nivel', [
                                        'treino' => $treino_quarta,
                                    ]) ?>

                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-close"></i>',
                                        [
                                            'treino/remove-treino',
                                            'treino_id' => $treino_quarta->id,
                                            'usuario_id' => $usuario_id
                                        ],
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário',
                                            'data' => [
                                                'confirm' => 'Tem certeza de que deseja remover este treino?',
                                                'method' => 'post',
                                            ],
                                        ]
                                    ) ?>
                                </div>
                                <h5>
                                    <?= Html::a(
                                        "<strong>$treino_quarta->titulo</strong>",
                                        ['treino/view', 'id' => $treino_quarta->id],
                                        [
                                            'class' => 'titulo-treino-link',
                                            'title' => 'Clique para mais detalhes',
                                        ]
                                    ) ?>
                                </h5>
                            </div>

                            <?= $this->render('_treino-exercicios', [
                                'treino' => $treino_quarta,
                            ]) ?>

                        </div>
                    <?php else: ?>
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h5 class="text-center">
                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-plus fa-2x"></i>',
                                        [
                                            'treino/add-treino',
                                            'usuario_id' => $usuario_id,
                                            'dia' => 'quarta-feira'
                                        ],
                                        [
                                            'class' => 'add-treino-link',
                                            'title' => 'Adicionar treino'
                                        ]
                                    ) ?>
                                </h5>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-2 border-right">
                    <h5 class="text-center">Quinta</h5>
                    <?php if ($treino_quinta !== null): ?>
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <div class="clearfix">

                                    <?= $this->render('_treino-nivel', [
                                        'treino' => $treino_quinta,
                                    ]) ?>

                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-close"></i>',
                                        [
                                            'treino/remove-treino',
                                            'treino_id' => $treino_quinta->id,
                                            'usuario_id' => $usuario_id
                                        ],
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário',
                                            'data' => [
                                                'confirm' => 'Tem certeza de que deseja remover este treino?',
                                                'method' => 'post',
                                            ],
                                        ]
                                    ) ?>
                                </div>
                                <h5>
                                    <?= Html::a(
                                        "<strong>$treino_quinta->titulo</strong>",
                                        ['treino/view', 'id' => $treino_quinta->id],
                                        [
                                            'class' => 'titulo-treino-link',
                                            'title' => 'Clique para mais detalhes',
                                        ]
                                    ) ?>
                                </h5>
                            </div>

                            <?= $this->render('_treino-exercicios', [
                                'treino' => $treino_quinta,
                            ]) ?>

                        </div>
                    <?php else: ?>
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h5 class="text-center">
                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-plus fa-2x"></i>',
                                        [
                                            'treino/add-treino',
                                            'usuario_id' => $usuario_id,
                                            'dia' => 'quinta-feira'
                                        ],
                                        [
                                            'class' => 'add-treino-link',
                                            'title' => 'Adicionar treino'
                                        ]
                                    ) ?>
                                </h5>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-2">
                    <h5 class="text-center">Sexta</h5>
                    <?php if ($treino_sexta !== null): ?>
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <div class="clearfix">

                                    <?= $this->render('_treino-nivel', [
                                        'treino' => $treino_sexta,
                                    ]) ?>

                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-close"></i>',
                                        [
                                            'treino/remove-treino',
                                            'treino_id' => $treino_sexta->id,
                                            'usuario_id' => $usuario_id
                                        ],
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário',
                                            'data' => [
                                                'confirm' => 'Tem certeza de que deseja remover este treino?',
                                                'method' => 'post',
                                            ],
                                        ]
                                    ) ?>
                                </div>
                                <h5>
                                    <?= Html::a(
                                        "<strong>$treino_sexta->titulo</strong>",
                                        ['treino/view', 'id' => $treino_sexta->id],
                                        [
                                            'class' => 'titulo-treino-link',
                                            'title' => 'Clique para mais detalhes',
                                        ]
                                    ) ?>
                                </h5>
                            </div>

                            <?= $this->render('_treino-exercicios', [
                                'treino' => $treino_sexta,
                            ]) ?>

                        </div>
                    <?php else: ?>
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h5 class="text-center">
                                    <?= Html::a(
                                        '<i class="fa fa-fw fa-plus fa-2x"></i>',
                                        [
                                            'treino/add-treino',
                                            'usuario_id' => $usuario_id,
                                            'dia' => 'sexta-feira'
                                        ],
                                        [
                                            'class' => 'add-treino-link',
                                            'title' => 'Adicionar treino'
                                        ]
                                    ) ?>
                                </h5>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="box-footer no-border">
            <p class="text-muted text-center">
                <?php if (empty($treinos)): ?>
                    Adicione um novo treino para este usuário
                <?php else: ?>
                    Clique em um treino para ver mais informações.
                <?php endif; ?>
            </p>
        </div>
    </div>
</div>
