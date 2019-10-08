<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */
/* @var $exercicio app\models\Exercicio */

$this->title = 'Informações do Equipamento';
//$this->params['breadcrumbs'][] = ['label' => 'Equipamentos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCss("
    #equipamento-info {
        
    }
");
?>

<div class="row">
    <div class="col-md-7">
        <div class="box box-success">
            <div class="box-header no-border">
                <h4 class="box-title">
                    <?php if ($model->defeito): ?>
                        <small class="label label-danger">com defeito</small>
                    <?php endif; ?>
                </h4>
                <div class="box-tools pull-right">
                    <?= Html::a('<i class="fa fa-fw fa-pencil"></i>', '#', [
                        'class' => 'btn btn-box-tool bg-aqua',
                        'title' => 'Editar equipamento',
                    ]) ?>
                    <?= Html::a('<i class="fa fa-fw fa-close"></i>', '#', [
                        'class' => 'btn btn-box-tool bg-red',
                        'title' => 'Excluir equipamento',
                        'data' => [
                            'confirm' => 'Tem certeza de que deseja excluir este equipamento?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a(
                        ($model->defeito) ? 'Desmarca defeito' : 'Marcar defeito',
                        ['equipamento/defeito', 'id' => $model->id],
                        [
                            'class' => 'btn btn-box-tool bg-gray',
                            'title' => 'Marcar equipamento com defeito',
                        ]) ?>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <div class="">
                            <img src="<?= Url::to('@web'. $model->imagem) ?>"
                                 alt="" class="img-responsive img-thumbnail">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div id="equipamento-info">
                            <h4><?= $model->nome ?></h4>
                            <p><?= $model->descricao ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="box">
            <div class="box-header no-border">
                <h4 class="box-title">
                    Exercícios Relacionados
                </h4>
                <div class="box-tools">
                    <!-- TODO imp. modal para adição de novos exercício
                    relacionados com equipamento. -->
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th style="width: 50px"></th>
                    </tr>
                    <?php foreach($model->exercicios as $exercicio): ?>
                        <tr>
                            <td><?= $exercicio->nome ?></td>
                            <td><?= $exercicio->tipo ?></td>
                            <td>
                                <?= Html::a(
                                    '<i class="fa fa-fw fa-eye"></i>',
                                    [
                                        'exercicio/view', 'id' => $exercicio->id
                                    ],
                                    [
                                        'class' => 'btn btn-flat btn-xs bg-gray',
                                        'title' => 'Marcar equipamento com defeito',
                                    ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="equipamento-view">




    <!--    <p>
             Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])
             Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',

            ])
        </p>

         DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'nome',
                'descricao',
                'imagem:ntext',
                'defeito',
            ],
        ]) -->

</div>
