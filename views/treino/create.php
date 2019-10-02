<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Treino */

$this->title = 'Create Treino';
$this->params['breadcrumbs'][] = ['label' => 'Treinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treino-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
