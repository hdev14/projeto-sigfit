<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */

$this->title = 'Registrar novo equipamento';
//$this->params['breadcrumbs'][] = ['label' => 'Equipamentos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipamento-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
