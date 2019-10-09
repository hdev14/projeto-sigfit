<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Exercicio */
/* @var $equipamentos yii\db\ActiveRecord[] */
/* @var $equipamento_id int */

$this->title = 'Registrar novo exercício';
//$this->params['breadcrumbs'][] = ['label' => 'Exercicios', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicio-create">

    <?= $this->render('_form', [
        'model' => $model,
        'equipamentos' => $equipamentos,
        'equipamento_id' => $equipamento_id
    ]) ?>

</div>
