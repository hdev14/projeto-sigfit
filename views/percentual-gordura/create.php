<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PercentualGordura */

$this->title = 'Create Percentual Gordura';
$this->params['breadcrumbs'][] = ['label' => 'Percentual Gorduras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="percentual-gordura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
