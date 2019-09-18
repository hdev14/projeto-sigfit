<?php
/* @var $model app\models\Pessoa */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<tr>
    <td><?= $model->matricula ?></td>
    <td><?= $model->nome ?></td>
    <td><?= $model->email ?></td>
    <td><?= $model->horario_treino ?></td>
    <td><?= $model->faltas ?></td>
    <td>
        <?php if ($model->servidor): ?>
            <span class="label label-success">Servidor</span>
        <?php else: ?>
            <span class="label label-primary">Aluno</span>
        <?php endif; ?>
    </td>
    <td>
        <a href="<?= Url::to([
            'pessoa/view',
            'id' => $model->id
        ]) ?> "
           class="btn btn-xs btn-flat btn-default"
           title="Visualizar usuário">
            <i class="fa fa-eye"></i>
        </a>
    </td>
</tr>

