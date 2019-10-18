<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */

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

?>
<div class="col-md-12">
    <div class="box box-success">
        <div class="box-header with-border">
            <h4 class="box-title">
                <?= $model->horario_treino ?>
                <small id="subtitle-horario" class="text-muted">
                    horário de treino
                </small>
            </h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-2 col-md-offset-1 border-right">
                    <h5 class="text-center">Segunda</h5>
                    <div class="small-box bg-gray">
                        <div class="inner">
                            <div class="clearfix">
                                <span class="label label-danger">Avançado</span>
                                <?= Html::a('<i class="fa fa-fw fa-close"></i>', null, [
                                    'class' => 'btn btn-xs bg-gray pull-right',
                                    'title' => 'Remover treino deste usuário'
                                ]) ?>
                            </div>
                            <h5>
                                <a href="#"  title="Clique para mais informações"
                                   class="titulo-treino-link">
                                    <strong> Treino 1 </strong>
                                </a>
                            </h5>
                        </div>
                        <button class="small-box-footer btn btn-flat btn-xs btn-block">
                            <b>ver exercícios</b>
                        </button>
                    </div>
                </div>
                <div class="col-md-2 border-right">
                    <h5 class="text-center">Terça</h5>
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
                </div>
                <div class="col-md-2 border-right">
                    <h5 class="text-center">Quarta</h5>
                    <div class="small-box bg-gray">
                        <div class="inner">
                            <div class="clearfix">
                                <span class="label label-success">Iniciante</span>
                                <?= Html::a('<i class="fa fa-fw fa-close"></i>', null, [
                                    'class' => 'btn btn-xs bg-gray pull-right',
                                    'title' => 'Remover treino deste usuário'
                                ]) ?>
                            </div>
                            <h5>
                                <a href="#" title="Clique para mais informações"
                                   class="titulo-treino-link">
                                    <strong> Treino 1 </strong>
                                </a>
                            </h5>
                        </div>
                        <button class="small-box-footer btn btn-flat btn-xs btn-block">
                            <b>ver exercícios</b>
                        </button>
                    </div>
                </div>
                <div class="col-md-2 border-right">
                    <h5 class="text-center">Quinta</h5>
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
                </div>
                <div class="col-md-2">
                    <h5 class="text-center">Sexta</h5>
                    <div class="small-box bg-gray">
                        <div class="inner">
                            <div class="clearfix">
                                    <span class="label label-warning">
                                        Intermediário
                                    </span>
                                <?= Html::a('<i class="fa fa-fw fa-close"></i>', null, [
                                    'class' => 'btn btn-xs bg-gray pull-right',
                                    'title' => 'Remover treino deste usuário'
                                ]) ?>
                            </div>
                            <h5>
                                <a href="#" title="Clique para mais informações"
                                   class="titulo-treino-link">
                                    <strong> Treino 1 </strong>
                                </a>
                            </h5>
                        </div>
                        <button class="small-box-footer btn btn-flat btn-xs btn-block">
                            <b>ver exercícios</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer no-border">
            <p class="text-muted text-center">Clique em um treino para ver mais informações.</p>
        </div>
    </div>
</div>
