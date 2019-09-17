<?php

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$f = Yii::$app->formatter;

$this->title = 'Perfil do Usuário';
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJs("
    
    $('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    let avaliacao_op = $('#avaliacao-op')[0];

    if (avaliacao_op.value === 'default') {
        let a = $('[id^=\"avaliacao-id-\"]')[0];
        $('#' + a.id).siblings().hide();
    }
    
    avaliacao_op.onchange = function(e) {
        $('#' + e.target.value).show().siblings().hide();
        
    }
    
");
?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <?= Html::a('<i class="fa fa-pencil fa-lg"></i>', ['update', 'id' => $model->id],
                        [
                            'class' => 'btn btn-box-tool',
                            'title' => 'Editar usuário'
                        ]) ?>
                    <?= Html::a('<i class="fa fa-user-times fa-lg"></i>', ['delete', 'id' =>
                        $model->id], [
                        'class' => 'btn btn-box-tool',
                        'title' => 'Excluir usuário',
                        'data' => [
                            'confirm' => 'Tem certeza de que deseja excluir este aluno?',
                            'method' => 'post',
                        ],
                    ]) ?>
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
                        <span class="badge bg-green">
                            <?= $model->horario_treino ?>
                        </span>
                        <b>Horário de Treino</b>
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
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Avaliações Físicas</h3>
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
                                    <li class="dropdown pull-left">
                                        <?= Html::a('<i class="fa fa-bars"></i>','#', [
                                            'class' => 'dropdown-toggle',
                                            'data-toggle' => 'dropdown'
                                        ]) ?>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <?= Html::a('Editar avaliação', ['avaliacao/create', 'usuario_id' => $avaliacao->id]) ?>
                                            </li>
                                            <li>
                                                <?= Html::a('Excluir avaliação', ['delete', 'id' => $avaliacao->id], [
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                    ],
                                                ]) ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pull-left header">
                                        <h4><?= $avaliacao->titulo ?></h4>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="<?= 'pdg' . $avaliacao->id ?>" class="tab-pane fade">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Desempenho</h3>
                                            </div>
                                            <div class="box-body">
                                                <canvas id="<?= 'pdg-chart' .
                                                $avaliacao->id ?>"></canvas>
                                                <?php
                                                $this->registerJs("
                                                    const pdg_chart_context". $avaliacao->id ." = document.querySelector('#pdg-chart". $avaliacao->id ."').getContext('2d');
                                                    let pdg". $avaliacao->id ." = new Chart(pdg_chart_context". $avaliacao->id .", {
                                                        type: 'line',
                                                        data: {
                                                            datasets:[{
                                                                label: 'Porcentagem (%)',
                                                                data: [{$avaliacao->pdgData}]
                                                            }]
                                                        },
                                                        options:{}
                                                    });
                                                ");
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="<?= 'peso' . $avaliacao->id ?>" class="tab-pane fade">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Desempenho</h3>
                                            </div>
                                            <div class="box-body">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores blanditiis, consequatur doloremque dolorum enim ex exercitationem, explicabo facilis itaque modi necessitatibus obcaecati perferendis quas quisquam quos sunt suscipit voluptates voluptatum?</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="<?= 'imc' . $avaliacao->id ?>"
                                         class="tab-pane fade active in">
                                        <div class="box">
                                            <div class="box-header">
                                                <h3 class="box-title">Desempenho</h3>
                                            </div>
                                            <div class="box-body">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores blanditiis, consequatur doloremque dolorum enim ex exercitationem, explicabo facilis itaque modi necessitatibus obcaecati perferendis quas quisquam quos sunt suscipit voluptates voluptatum?</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DetailView::widget([
               'model' => $model,
               'attributes' => [
                   'id',
                   'matricula',
                   'nome',
                   'email:email',
                   'curso',
                   'periodo_curso',
                   'horario_treino',
                   'problema_saude:ntext',
                   'faltas',
                   'espera',
                   'telefone',
               ],
           ]) -->
