<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peso */

$this->title = 'Create Peso';
$this->params['breadcrumbs'][] = ['label' => 'Pesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
