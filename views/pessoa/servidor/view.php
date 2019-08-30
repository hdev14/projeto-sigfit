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
                            'confirm' => 'Tem certeza de que deseja excluir este servidor?',
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

