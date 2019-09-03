<?php


/* @var $this yii\web\View */
/* @var $instrutores yii\db\ActiveQuery */
/* @var $instrutor app\models\Pessoa */
/* @var $pagination yii\data\Pagination */

use yii\helpers\Html;
use \yii\widgets\LinkPager;
use \yii\helpers\Url;

$this->title = "Instrutores";
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['pessoa/index']];
//$this->params['breadcrumbs'][] = 'Alunos';
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <div class="box-tools pull-right">
                        <?= Html::a('<i class="fa fa-user-plus fa-lg"></i> Novo Instrutor',
                            ['pessoa/create-instrutor'],
                            [
                                'class' => 'btn btn-box-tool bg-green'
                            ]
                        ) ?>
                    </div>
                </div>
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


