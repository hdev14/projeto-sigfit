<?php

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Perfil do Usuário';
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-success">
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
                            <?= $model->faltas ? $model->faltas : 0 ?>
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
                            <?= $model->email ?>
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
                    <?= Html::a('<b>Editar</b>', ['update', 'id' => $model->id],
                        ['class' => 'btn btn-sm btn-primary btn-flat']) ?>
                    <?= Html::a('<b>Excluir</b>', ['delete', 'id' =>
                        $model->id], [
                        'class' => 'btn btn-sm btn-danger btn-flat',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box">
            <?= DetailView::widget([
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
            ]) ?>
        </div>
    </div>
</div>
