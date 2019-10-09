<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */
/* @var $exercicio app\models\Exercicio */

$this->title = 'Informações do Equipamento';
//$this->params['breadcrumbs'][] = ['label' => 'Equipamentos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsFile('@web/js/upload-equipamento.js');
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
                    <?= Html::a(
                        ($model->defeito) ? 'Desmarca defeito' : 'Marcar defeito',
                        ['equipamento/defeito', 'id' => $model->id],
                        [
                            'class' => 'btn btn-box-tool bg-gray',
                            'title' => 'Marcar equipamento com defeito',
                        ]) ?>

                    <!-- MODAL FORM EDITAR EQUIPAMENTO-->
                    <?php $modal = Modal::begin([
                        'header' => 'Preenchar os campos corretamente',
                        'footer' =>
                            Html::submitButton('Confirmar', [
                                'class' => 'btn bg-green btn-flat btn-sm',
                                'form' => 'form-upload-equip',
                            ])
                        ,
                        'toggleButton' => [
                            'label' => "<i class='fa fa-fw fa-pencil'></i>",
                            'class' => 'btn btn-box-tool bg-aqua'
                        ],
                    ]); ?>
                    <div  class="text-center">
                        <img
                                id="img-equipamento"
                                class="img-responsive img-thumbnail"
                                height="180"
                                width="180"
                                src="<?= Url::to('@web'.$model->imagem) ?>"
                                alt="">
                    </div>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <?php $form = ActiveForm::begin([
                                'method' => 'post',
                                'action' => ['equipamento/update', 'id' => $model->id],
                                'id' => 'form-upload-equip'
                            ]); ?>

                            <?= $form->field($model, 'image_file')->fileInput([
                                'id' => 'upload-img',
                            ]) ?>

                            <?= $form->field($model, 'nome')->textInput([
                                'maxlength' => true,
                                'placeholder' => 'Digite o nome do equipamento'
                            ]) ?>

                            <?= $form->field($model, 'descricao')->textarea([
                                'maxlength' => true,
                                'placeholder' => 'Digite uma breve descrição sobre o equipamento'
                            ]) ?>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <?php Modal::end(); ?>
                    <!-- MODAL FORM EDITAR EQUIPAMENTO-->
                    <?= Html::a(
                        '<i class="fa fa-fw fa-close"></i>',
                        ['equipamento/delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-box-tool bg-red',
                            'title' => 'Excluir equipamento',
                            'data' => [
                                'confirm' => 'Tem certeza de que deseja excluir este equipamento?',
                                'method' => 'post',
                            ],
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
                    <?= Html::a(
                        'Adicionar exercício',
                        [
                            'exercicio/create',
                            'equipamento_id' => $model->id,
                        ],
                        [
                            'class' => "btn btn-box-tool bg-green btn-flat"
                        ]
                    ) ?>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th style="width: 300px">Nome</th>
                        <th>Tipo</th>
                        <th style="width: 50px"></th>
                    </tr>
                    <?php foreach($model->exercicios as $exercicio): ?>
                        <tr>
                            <td><?= $exercicio->nome ?></td>
                            <td>
                                <?php if ($exercicio->tipo == 'aerobico'): ?>
                                    <span class="badge bg-red">
                                        Aeróbico
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-aqua">
                                        Anaeróbico
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= Html::a(
                                    '<i class="fa fa-fw fa-eye"></i>',
                                    [
                                        'exercicio/view', 'id' => $exercicio->id
                                    ],
                                    [
                                        'class' => 'btn btn-flat btn-xs bg-gray',
                                        'title' => 'Mais informações',
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
