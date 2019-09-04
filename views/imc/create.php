<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Imc */

$this->title = 'Create Imc';
$this->params['breadcrumbs'][] = ['label' => 'Imcs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
