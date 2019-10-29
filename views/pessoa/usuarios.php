<?php

use \yii\widgets\LinkPager;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $usuarios \yii\db\ActiveQuery */
/* @var $usuario \app\models\Pessoa */
/* @var $pagination \yii\data\Pagination */
/* @var $espera bool */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['pessoa/index']];
//$this->params['breadcrumbs'][] = 'Alunos';

$this->registerCssFile('@web/css/box-subtitle.css');

?>

<?= $this->render('../partial/_btn-group-usuarios', [
    'espera' => $espera,
]) ?>

<div class="row">

    <?php if (!empty($usuarios)): ?>
        <div class="col-md-12 ">
            <div class="box box-success">
                <div class="box-header no-border">

                    <?php if($espera): ?>
                        <h4 class="box-title">Fila de Espera</h4>
                        <small class="text-muted">
                            Lista de usuários registrado que estão esperando novas vagas.
                        </small>
                    <?php else: ?>
                        <h4 class="box-title">Usuários Instruídos</h4>
                        <small class="text-muted">
                            Lista de todos os usuários instruídos
                        </small>
                    <?php endif; ?>

                </div>
                <div class="box-body">
                    <table class="table table-striped table-hover">
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
                                    <?php if ($usuario->servidor): ?>
                                        <span class="label label-success">Servidor</span>
                                    <?php else: ?>
                                        <span class="label label-primary">Aluno</span>
                                    <?php endif; ?>
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
                                       class="btn btn-xs btn-flat bg-gray"
                                       title="Visualizar usuário">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="<?= Url::to([
                                        'pessoa/update',
                                        'id' => $usuario->id
                                    ]) ?> "
                                       class="btn btn-xs btn-flat bg-aqua"
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
    <?php else: ?>
        <div class="col-md-12">
            <?= $this->render('../partial/_sem-usuarios') ?>
        </div>
    <?php endif; ?>

</div>

