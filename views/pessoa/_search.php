<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PessoaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pessoa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'matricula') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'curso') ?>

    <?php // echo $form->field($model, 'periodo_curso') ?>

    <?php // echo $form->field($model, 'horario_treino') ?>

    <?php // echo $form->field($model, 'problema_saude') ?>

    <?php // echo $form->field($model, 'faltas') ?>

    <?php // echo $form->field($model, 'espera') ?>

    <?php // echo $form->field($model, 'telefone') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
