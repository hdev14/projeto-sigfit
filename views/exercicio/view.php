<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Exercicio */
/* @var $equipamentos yii\db\ActiveQuery[] */

$this->title = 'Informações do Exercício';
//$this->params['breadcrumbs'][] = ['label' => 'Exercicios', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCss("
    p.desc-equipamento {
        padding: 10px 20px;
    }
    #desc-exercicio {
        resize: none;
    }
    div.callout {
        margin-top: 20px;
    }
    a#equip-info {
        margin-right: 10px;
    }
");
?>

<div class="box box-success">
    <div class="box-header with-border">
        <h4 class="box-title"></h4>
        <div class="box-tools pull-right">

            <!--MODAL EDITAR EXERCÍCIO-->
            <?php $modal = Modal::begin([
                'header' => 'Preenchar os campos corretamente',
                'footer' =>
                    Html::submitButton('Confirmar', [
                        'class' => 'btn bg-green btn-flat btn-sm',
                        'form' => 'modal-form-editar',
                    ])
                ,
                'toggleButton' => [
                    'label' => "<i class='fa fa-fw fa-pencil'></i>",
                    'class' => 'btn btn-box-tool',
                    'title' => 'Editar exercício',
                ],
            ]); ?>

            <?php $form = ActiveForm::begin([
                'action' => Url::to([
                    'exercicio/update',
                    'id' => $model->id
                ]),
                'id' => 'modal-form-editar'
            ]); ?>

            <?= $form->field($model, 'nome')->textInput([
                'maxlength' => true,
                'placeholder' => 'Digite o nome do exercício',
            ]) ?>

            <?= $form->field($model, 'equipamento_id')->dropDownList(
                ArrayHelper::map($equipamentos, 'id', 'nome'),
                ['prompt' => 'Escolha o equipamento que este exercício pertence']
            ) ?>

            <?= $form->field($model, 'tipo')->radioList([
                'aerobico' => 'Aerobico',
                'anaerobico' => 'Anaerobico'
            ]) ?>

            <?= $form->field($model, 'descricao')->textarea([
                'maxlength' => true,
                'placeholder' => 'Digite uma descrição breve sobre o exercício.',
                'id' => 'desc-exercicio'
            ]) ?>

            <?php ActiveForm::end(); ?>
            <?php Modal::end() ?>
            <!--MODAL EDITAR EXERCÍCIO-->

            <?= Html::a(
                "<i class='fa fa-fw fa-trash'></i>",
                ['exercicio/delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-box-tool',
                    'title' => 'Excluir exercício',
                    'data' => [
                        'confirm' => 'Tem certeza de que deseja excluir este aluno?',
                        'method' => 'post',
                    ],
                ]
            ) ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <h4><?= $model->nome ?></h4>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <?php if($model->tipo === 'aerobico'): ?>
                            <span class="badge bg-red">
                                Aeróbico
                            </span>
                        <?php else: ?>
                            <span class="badge bg-aqua">
                                Anaeróbico
                            </span>
                        <?php endif; ?>
                        <strong>Tipo</strong>
                    </li>
                    <li class="list-group-item">
                        <strong>Descrição</strong>
                        <p class="text-muted">
                            <?= $model->descricao ?>
                        </p>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <?php if($model->equipamento !== null): ?>
                    <h4><?= $model->equipamento->nome ?></h4>
                    <img class="img-thumbnail pull-right"
                         src="<?= $model->equipamento->imagem ?>"
                         alt="<?= $model->equipamento->nome ?>"
                         height="160" width="160">
                    <p class="desc-equipamento">
                        <?= $model->equipamento->descricao ?>
                    </p>
                    <?= Html::a('mais informações', [
                        'equipamento/view',
                        'id' => $model->equipamento->id,
                        'informações sobre o equipamento',
                    ], [
                        'id' => 'equip-info',
                        'class' => 'btn bg-gray btn-xs pull-right'
                    ]) ?>
                <?php else: ?>
                    <div class="callout callout-warning">
                        <h4>Não possui equipamento</h4>
                        <p>
                            Este exercício não necessita de equipamento ou
                            não possui um.
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="box-footer no-border"></div>
</div>

<!--<div class="exercicio-view">


        <p>
             Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])
            Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
        </p>

     DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'equipamento_id',
            'nome',
            'descricao',
            'tipo',
        ],
    ])

</div>-->
