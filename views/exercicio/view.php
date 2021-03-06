<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Exercicio */
/* @var $equipamentos yii\db\ActiveQuery[] */

$this->title = '';

//$this->params['breadcrumbs'][] = ['label' => 'Exercicios', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCssFile('@web/css/box-subtitle.css');

$this->registerCss(<<<CSS
    p.desc-equipamento {
        padding: 10px 0;
    }
    
    #desc-exercicio {
        resize: none;
    }
    
    div.callout {
        margin-top: 20px;
    }
    
    a#equip-info {
        margin-right: 10px;
        color: #1e282c;
    }
    
    a#equip-info:hover {
        color: rgba(30, 40, 44, 0.8);
    }
CSS
);
?>
<div class="row">
    <div class="col-md-7">
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <?= $model->nome ?>
                </h4>
                <div class="box-tools pull-right">

                    <!--MODAL EDITAR EXERCÍCIO-->
                    <?php $modal = Modal::begin([
                        'header' => '<b>Preenchar os campos corretamente</b>',
                        'footer' =>
                            Html::submitButton('Confirmar', [
                                'class' => 'btn bg-green',
                                'form' => 'modal-form-editar',
                            ])
                        ,
                        'toggleButton' => [
                            'label' => "<i class='fa fa-pencil fa-lg'></i>",
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
                        "<i class='fa fa-trash fa-lg'></i>",
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
            <div class="box-footer no-border"></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Equipamento
                </h4>
                <small>
                    Equipamento que este exercício pertence
                </small>
            </div>
            <div class="box-body">
                <?php if($model->equipamento !== null): ?>

                    <img class="img-thumbnail pull-right"
                         src="<?= $model->equipamento->imagem ?>"
                         alt="<?= $model->equipamento->nome ?>"
                         height="160" width="160">
                    <div>
                        <?= Html::a('<strong>' . $model->equipamento->nome . '</strong>', [
                            'equipamento/view',
                            'id' => $model->equipamento->id,
                            'informações sobre o equipamento',
                        ], [
                            'id' => 'equip-info',
                            'class' => ''
                        ]) ?>
                        <p class="text-muted desc-equipamento">
                            <?= $model->equipamento->descricao ?>
                        </p>
                    </div>

                <?php else: ?>
                    <div class="callout callout-default">
                        <p>
                            Este exercício não necessita de equipamento ou
                            não possui um.
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
