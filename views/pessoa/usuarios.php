<?php

/* @var $this yii\web\View */
/* @var $usuarios \yii\db\ActiveQuery */
/* @var $usuario \app\models\Pessoa */
/* @var $pagination \yii\data\Pagination */

use \yii\widgets\LinkPager;
use \yii\helpers\Url;

$this->title = "Usuários Instruídos";
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['pessoa/index']];
//$this->params['breadcrumbs'][] = 'Alunos';
?>

<?= $this->render('partial/btn-group') ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Todos</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th style="width: 150px">Matrícula</th>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>Horário de Treino</th>
                        <th>E-mail</th>
                        <th>Curso</th>
                        <th>Período</th>
                        <th>Telefone</th>
                        <th style="width: 100px">Opções</th>
                    </tr>
                    <?php foreach ($usuarios as $usuario) { ?>
                        <tr>
                            <td><?= $usuario->matricula ?></td>
                            <td>
                                <?= $usuario->servidor ? 'Servidor' : 'Aluno' ?>
                            </td>
                            <td><?= $usuario->nome ?></td>
                            <td><?= $usuario->horario_treino ?></td>
                            <td><?= $usuario->email ?></td>
                            <?php if (!$usuario->servidor): ?>
                                <td><?= $usuario->curso ?></td>
                                <td><?= $usuario->periodo_curso ?></td>
                            <?php else: ?>
                                <td>Sem curso</td>
                                <td>Sem período</td>
                            <?php endif; ?>
                            <td><?= $usuario->telefone ?></td>
                            <td>
                                <a href="<?= Url::to([
                                    'pessoa/view',
                                    'id' => $usuario->id
                                ]) ?> "
                                   class="btn btn-xs btn-flat btn-default"
                                   title="Visualizar usuário">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="<?= Url::to([
                                    'pessoa/update',
                                    'id' => $usuario->id
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

