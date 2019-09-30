<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Imc */

$this->title = 'Editar IMC';
//$this->params['breadcrumbs'][] = ['label' => 'Imcs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imc-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
