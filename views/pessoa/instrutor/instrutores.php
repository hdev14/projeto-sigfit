<?php

use yii\helpers\Html;
use \yii\widgets\LinkPager;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $instrutores yii\db\ActiveQuery */
/* @var $instrutor app\models\Pessoa */
/* @var $pagination yii\data\Pagination */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['pessoa/index']];
//$this->params['breadcrumbs'][] = 'Alunos';
$this->registerCss(<<<CSS
    div#novo-instrutor {
        margin-bottom: 10px;
    }
    div.box-header small {
        display: block;
    }

CSS
);
?>
<div class="row">
    <div id="novo-instrutor" class="col-md-6 col-md-offset-6">
        <?= Html::a('<i class="fa fa-user-plus fa-lg"></i> Novo Instrutor',
            ['pessoa/create-instrutor'],
            ['class' => 'btn btn-box-tool bg-green pull-right']
        ) ?>
    </div>
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header no-border">
                <h4 class="box-title">
                    Instrutores
                </h4>
                <small class="text-muted">
                    Lista com todos os instrutores cadastrados
                </small>
            </div>
            <div class="box-body">
                <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <th style="width: 150px">Matrícula</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th style="width: 100px">Opções</th>
                    </tr>
                    <?php foreach ($instrutores as $instrutor) { ?>
                        <tr>
                            <td><?= $instrutor->matricula ?></td>
                            <td><?= $instrutor->nome ?></td>
                            <td><?= $instrutor->email ?></td>
                            <td>
                                <a href="<?= Url::to([
                                    'pessoa/view-instrutor',
                                    'id' => $instrutor->id
                                ]) ?> "
                                   class="btn btn-xs btn-flat btn-default"
                                   title="Visualizar usuário">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="<?= Url::to([
                                    'pessoa/update-instrutor',
                                    'id' => $instrutor->id
                                ]) ?> "
                                   class="btn btn-xs btn-flat btn-info"
                                   title="Editar usuário">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <?= LinkPager::widget([
                    'pagination' => $pagination,
                    'options' => ['class' => 'pagination pagination-sm no-margin pull-right']
                ]) ?>
            </div>
        </div>
    </div>
</div>


