<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PercentualGordura */
/* @var $sexo string */
/* @var $idade int */

$this->title = 'Editar percentual de gordura'
//$this->params['breadcrumbs'][] = ['label' => 'Percentual Gorduras', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="percentual-gordura-update">

    <?= $this->render('_form', [
        'model' => $model,
        'sexo' => $sexo,
        'idade' => $idade
    ]) ?>

</div>
