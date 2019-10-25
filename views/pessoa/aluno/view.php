<?php

use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

$f = Yii::$app->formatter;

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCssFile('@web/css/box-subtitle.css');

$this->registerJs("
    $('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
");

$this->registerJs("
    let avaliacao_op = $('#avaliacao-op')[0];
    
    if (avaliacao_op.value === 'default') {
        let a = $('[id^=\"avaliacao-id-\"]')[0];
        $('#' + a.id).siblings().hide();
    }
    
    avaliacao_op.onchange = function(e) {
        $('#' + e.target.value).show().siblings().hide();
    }
", View::POS_LOAD);

?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <?= Html::a('<i class="fa fa-fw fa-pencil fa-lg"></i>', ['update', 'id' =>
                        $model->id],
                        [
                            'class' => 'btn btn-box-tool',
                            'title' => 'Editar usuário'
                        ]) ?>
                    <?= Html::a(
                        '<i class="fa fa-fw fa-user-times fa-lg"></i>',
                        ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-box-tool',
                            'title' => 'Excluir usuário',
                            'data' => [
                                'confirm' => 'Tem certeza de que deseja excluir este exercício?',
                                'method' => 'post',
                            ],
                        ]
                    ) ?>
                </div>
            </div>
            <div class="box-body box-profile">
                <img src="<?= Url::to("@web" . $model->foto)?>"
                     alt="<?= $model->nome ?>"
                     class="profile-user-img img-responsive img-circle"
                     style="height: 90px; width: 90px;">
                <h3 class="profile-username text-center">
                    <?= $model->nome ?>
                </h3>
                <p class="text-muted text-center">
                    <?= $model->servidor ? 'Servidor' : 'Aluno' ?>
                </p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <span class="badge bg-red">
                            <?= $model->faltas ?>
                        </span>
                        <b>Faltas</b>
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">
                            <b>Matrícula</b>
                        </h6>
                        <p class="list-group-item-text text-muted">
                            <?= $model->matricula ?>
                        </p>
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">
                            <b>Curso</b>
                        </h6>
                        <p class="list-group-item-text text-muted">
                            <?= $model->curso ?>
                            <small class="label pull-right bg-blue">
                                <?= $model->periodo_curso . 'º Período' ?>
                            </small>
                        </p>
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">
                            <b>E-mail</b>
                        </h6>
                        <p class="list-group-item-text text-muted">
                            <?= $f->asEmail($model->email) ?>
                        </p>
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">
                            <b>Telefone</b>
                        </h6>
                        <p class="list-group-item-text text-muted">
                            <?= $model->telefone ?>
                        </p>
                    </li>
                    <li class="list-group-item">
                        <h6 class="list-group-item-heading">
                            <b>Problema de Saúde</b>
                        </h6>
                        <p class="list-group-item-text text-muted">
                            <?= $model->problema_saude ?>
                        </p>
                    </li>
                </ul>
                <p class="text-right">

                </p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">

            <div class="col-md-12">
                <?php if ($model->avaliacaos): ?>
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">Avaliações Físicas</h3>
                            <small>
                                Gráficos dos dados coletados nas avaliações físicas
                            </small>
                            <div class="box-tools pull-right">
                                <div class="input-group input-group-sm hidden-xs">
                                    <select id="avaliacao-op"
                                            class="form-control"
                                            style="width: 200px;">
                                        <option value="default">
                                            Outras avaliações
                                        </option>
                                        <?php foreach ($model->avaliacaos as $avaliacao): ?>
                                            <option value="<?= 'avaliacao-id-' .
                                            $avaliacao->id ?>">
                                                <?= $avaliacao->titulo ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= Html::a('<i class="fa fa-fw fa-plus"></i> Nova Avaliação',
                                        [
                                            'avaliacao/create',
                                            'usuario_id' => $model->id
                                        ], [
                                            'class' => 'btn bg-green btn-sm',
                                            'style' => 'margin-left: 5px',
                                            'title' => 'Nova avaliação física'
                                        ]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row col-md-12">
                                <?php foreach($model->avaliacaos as $avaliacao): ?>
                                    <div id="<?= 'avaliacao-id-' . $avaliacao->id ?>">
                                        <div class="nav-tabs-custom">
                                            <ul id="tabs" class="nav nav-tabs pull-right">
                                                <li>
                                                    <a href="<?= '#pdg' . $avaliacao->id ?>"
                                                       data-toggle="tab">
                                                        Percentual de Gordura
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?= '#peso' . $avaliacao->id ?>"
                                                       data-toggle="tab">
                                                        Peso
                                                    </a>
                                                </li>
                                                <li class="active">
                                                    <a href="<?= '#imc' . $avaliacao->id ?>"
                                                       data-toggle="tab">
                                                        Índice de Massa Corporal (IMC)
                                                    </a>
                                                </li>
                                                <li class="pull-left header">
                                                    <h5><b><?= $avaliacao->titulo ?></b></h5>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="<?= 'pdg' . $avaliacao->id ?>" class="tab-pane fade">
                                                    <?= $this->render('../../partial/_chart-pdg', [
                                                        'avaliacao' =>
                                                            $avaliacao,
                                                    ]) ?>
                                                </div>
                                                <div id="<?= 'peso' . $avaliacao->id ?>" class="tab-pane fade">
                                                    <?= $this->render('../../partial/_chart-peso', [
                                                        'avaliacao' =>
                                                            $avaliacao,
                                                    ]) ?>
                                                </div>
                                                <div id="<?= 'imc' . $avaliacao->id ?>"
                                                     class="tab-pane fade active in">
                                                    <?= $this->render('../../partial/_chart-imc', [
                                                        'avaliacao' =>
                                                            $avaliacao,
                                                    ]) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?= $this->render('../../partial/_sem-avaliacao', [
                        'usuario_id' => $model->id,
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
    <?= $this->render('../../partial/_treinos', [
        'horario_treino' => $model->horario_treino,
        'treinos' => $model->treinos,
        'usuario_id' => $model->id,
    ]) ?>
</div>
