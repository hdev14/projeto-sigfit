<?php

use \yii\widgets\LinkPager;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $alunos \yii\db\ActiveQuery */
/* @var $aluno \app\models\Pessoa */
/* @var $espera bool */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['pessoa/index']];
//$this->params['breadcrumbs'][] = 'Alunos';

$this->registerCssFile('@web/css/box-subtitle.css');
?>

<?= $this->render('../../partial/_btn-group-usuarios', [
    'espera' => $espera
]) ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header no-border">

                <?php if($espera): ?>
                    <h4 class="box-title">Fila de Espera - Alunos</h4>
                    <small class="text-muted">
                        Lista de alunos registrado que estão esperando novas vagas.
                    </small>
                <?php else: ?>
                    <h4 class="box-title">Alunos Instruídos</h4>
                    <small class="text-muted">
                        Lista de todos os alunos instruídos
                    </small>
                <?php endif; ?>

            </div>
            <div class="box-body">
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr>
                        <th style="width: 150px">Matrícula</th>
                        <th>Nome</th>
                        <th>Horário de Treino</th>
                        <th>E-mail</th>
                        <th>Curso</th>
                        <th>Período</th>
                        <th>Telefone</th>
                        <th style="width: 100px">Opções</th>
                    </tr>
                    <?php foreach ($alunos as $aluno) { ?>
                        <tr>
                            <td><?= $aluno->matricula ?></td>
                            <td><?= $aluno->nome ?></td>
                            <td><?= $aluno->horario_treino ?></td>
                            <td><?= $aluno->email ?></td>
                            <td><?= $aluno->curso ?></td>
                            <td><?= $aluno->periodo_curso ?></td>
                            <td><?= $aluno->telefone ?></td>
                            <td>
                                <a href="<?= Url::to([
                                    'pessoa/view',
                                    'id' => $aluno->id
                                ]) ?> "
                                   class="btn btn-xs btn-flat btn-default"
                                   title="Visualizar usuário">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="<?= Url::to([
                                    'pessoa/update',
                                    'id' => $aluno->id
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

