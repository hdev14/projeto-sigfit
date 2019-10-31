<?php

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

$this->title = '';
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pessoa-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

