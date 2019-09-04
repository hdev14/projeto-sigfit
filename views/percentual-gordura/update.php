<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PercentualGordura */

$this->title = 'Update Percentual Gordura: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Percentual Gorduras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="percentual-gordura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
