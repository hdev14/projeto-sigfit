<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $treino  \app\models\Treino */
/* @var $treinoExercicio \app\models\TreinoExercicio */

?>

<?php $modal = Modal::begin([
    'header' => "<h4>$treino->titulo - Exercícios</h4>",
    'toggleButton' => [
        'label' => "ver exercícios",
        'class' => 'small-box-footer btn btn-flat btn-xs btn-block'
    ],
]); ?>

<ul class="list-group list-group-unbordered">
    <?php foreach ($treino->treinoExercicios as $treinoExercicio): ?>
        <li class="list-group-item">
            <?= $treinoExercicio->exercicio->nome ?>
            <span class="label label-default">
                <?= $treinoExercicio->numero_repeticao ?>
            </span>
            <?= Html::a(
                '<i class="fa fa-fw fa-eye"></i>',
                ['exercicio/view', 'id' => $treinoExercicio->exercicio_id],
                ['btn btn-sm bg-gray btn-flat']
            ) ?>
        </li>
    <?php endforeach; ?>
</ul>

<?php Modal::end(); ?>
