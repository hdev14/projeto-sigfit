<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $avaliacao_model app\models\Avaliacao */
/* @var $peso_model app\models\Peso */
/* @var $imc_model app\models\Imc */
/* @var $pdg_model app\models\PercentualGordura */
/* @var $usuario_id int */

$this->title = 'Avaliação';
//$this->params['breadcrumbs'][] = ['label' => 'Avaliacaos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacao-create">
    <?= $this->render('./partial/_multiform', [
        'avaliacao_model' => $avaliacao_model,
        'peso_model' => $peso_model,
        'imc_model' => $imc_model,
        'pdg_model' => $pdg_model,
    ]) ?>

</div>
