<?php

/* @var $this yii\web\View */
/* @var $alunos \yii\db\ActiveQuery */
/* @var $aluno \app\models\Pessoa */

use \yii\widgets\LinkPager;
use \yii\helpers\Url;

$this->title = "Alunos Instruídos";
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['pessoa/index']];
//$this->params['breadcrumbs'][] = 'Alunos';
?>

<?= $this->render('../../partial/_btn-group') ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Alunos</h3>
                <?= $this->render('../partial/btn-registro') ?>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
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

