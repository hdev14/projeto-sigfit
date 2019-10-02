<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */

$this->title = 'Create Equipamento';
$this->params['breadcrumbs'][] = ['label' => 'Equipamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
