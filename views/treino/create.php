<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Treino */
/* @var $exercicios \yii\db\ActiveRecord[] */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Treinos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="treino-create">

    <?= $this->render('_form', [
        'model' => $model,
        'exercicios' => $exercicios
    ]) ?>

</div>
