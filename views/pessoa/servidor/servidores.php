<?php

use \yii\widgets\LinkPager;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $servidores \yii\db\ActiveQuery */
/* @var $servidor \app\models\Pessoa */
/* @var $espera bool */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['pessoa/index']];
//$this->params['breadcrumbs'][] = 'Servidores';

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
                    <h4 class="box-title">Fila de Espera - Servidores</h4>
                    <small class="text-muted">
                        Lista de servidores registrado que estão esperando novas vagas.
                    </small>
                <?php else: ?>
                    <h4 class="box-title">Servidores Instruídos</h4>
                    <small class="text-muted">
                        Lista de todos os servidores instruídos
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

