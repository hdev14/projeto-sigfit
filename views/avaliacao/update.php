<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */

$this->title = 'Atualizar ' . $model->titulo;
//$this->params['breadcrumbs'][] = ['label' => 'Avaliacaos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="avaliacao-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
