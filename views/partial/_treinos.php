<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $horario_treino string */
/* @var $treinos \yii\db\ActiveRecord[] */
/* @var $treino \app\models\Treino */

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
                                        null, // TODO ação para remover treino do usuário
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário'
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
                                    <a href="#" title="Clique para mais informações"
                                       class="add-treino-link ">
                                        <i class="fa fa-fw fa-plus fa-2x"></i>
                                    </a>
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
                                        null,
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário'
                                        ]
                                    ) ?>
                                </div>
                                <h5>
                                    <a href="#"  title="Clique para mais informações"
                                       class="titulo-treino-link">
                                        <strong><?= $treino_terca->titulo ?></strong>
                                    </a>
                                </h5>
                            </div>
                            <button class="small-box-footer btn btn-flat btn-xs btn-block">
                                <b>ver exercícios</b>
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h5 class="text-center">
                                    <a href="#" title="Clique para mais informações"
                                       class="add-treino-link ">
                                        <i class="fa fa-fw fa-plus fa-2x"></i>
                                    </a>
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
                                        null,
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário'
                                        ]
                                    ) ?>
                                </div>
                                <h5>
                                    <a href="#"  title="Clique para mais informações"
                                       class="titulo-treino-link">
                                        <strong><?= $treino_quarta->titulo ?></strong>
                                    </a>
                                </h5>
                            </div>
                            <button class="small-box-footer btn btn-flat btn-xs btn-block">
                                <b>ver exercícios</b>
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h5 class="text-center">
                                    <a href="#" title="Clique para mais informações"
                                       class="add-treino-link ">
                                        <i class="fa fa-fw fa-plus fa-2x"></i>
                                    </a>
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
                                        null,
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário'
                                        ]
                                    ) ?>
                                </div>
                                <h5>
                                    <a href="#"  title="Clique para mais informações"
                                       class="titulo-treino-link">
                                        <strong><?= $treino_quinta->titulo ?></strong>
                                    </a>
                                </h5>
                            </div>
                            <button class="small-box-footer btn btn-flat btn-xs btn-block">
                                <b>ver exercícios</b>
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h5 class="text-center">
                                    <a href="#" title="Clique para mais informações"
                                       class="add-treino-link ">
                                        <i class="fa fa-fw fa-plus fa-2x"></i>
                                    </a>
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
                                        null,
                                        [
                                            'class' => 'btn btn-xs bg-gray pull-right',
                                            'title' => 'Remover treino deste usuário'
                                        ]
                                    ) ?>
                                </div>
                                <h5>
                                    <a href="#"  title="Clique para mais informações"
                                       class="titulo-treino-link">
                                        <strong><?= $treino_sexta->titulo ?></strong>
                                    </a>
                                </h5>
                            </div>
                            <button class="small-box-footer btn btn-flat btn-xs btn-block">
                                <b>ver exercícios</b>
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="small-box bg-gray-light">
                            <div class="inner">
                                <h5 class="text-center">
                                    <a href="#" title="Clique para mais informações"
                                       class="add-treino-link ">
                                        <i class="fa fa-fw fa-plus fa-2x"></i>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="box-footer no-border">
            <p class="text-muted text-center">Clique em um treino para ver mais informações.</p>
        </div>
    </div>
</div>
