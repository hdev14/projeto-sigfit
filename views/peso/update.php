<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peso */

$this->title = 'Editar Peso'
//$this->params['breadcrumbs'][] = ['label' => 'Pesos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peso-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
