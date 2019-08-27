<?php

/* @var $this yii\web\View */
/* @var $servidors \yii\db\ActiveQuery */
/* @var $servidor \app\models\Pessoa */

use \yii\widgets\LinkPager;
use \yii\helpers\Html;
use \yii\helpers\Url;

$this->title = "Usuários Instruídos";
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['pessoa/index']];
//$this->params['breadcrumbs'][] = 'Servidores';
?>

<?= $this->render('../partial/btn-group') ?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Servidores</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <tbody>
                    <tr>
                        <th style="width: 150px">Matrícula</th>
                        <th>Nome</th>
                        <th>Horário de Treino</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th style="width: 100px">Opções</th>
                    </tr>
                    <?php foreach ($servidores as $servidor) { ?>
                        <tr>
                            <td><?= $servidor->matricula ?></td>
                            <td><?= $servidor->nome ?></td>
                            <td><?= $servidor->horario_treino ?></td>
                            <td><?= $servidor->email ?></td>
                            <td><?= $servidor->telefone ?></td>
                            <td>
                                <a href="<?= Url::to([
                                    'pessoa/view',
                                    'id' => $servidor->id
                                ]) ?> "
                                   class="btn btn-xs btn-flat btn-default"
                                   title="Visualizar usuário">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="<?= Url::to([
                                    'pessoa/update',
                                    'id' => $servidor->id
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

