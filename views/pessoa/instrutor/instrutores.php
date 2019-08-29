<?php


/* @var $this yii\web\View */
/* @var $instrutores yii\db\ActiveQuery */
/* @var $instrutor app\models\Pessoa */
/* @var $pagination yii\data\Pagination */

use \yii\widgets\LinkPager;
use \yii\helpers\Url;

$this->title = "Usuários Instruídos";
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['pessoa/index']];
//$this->params['breadcrumbs'][] = 'Alunos';
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Instrutores</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
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


