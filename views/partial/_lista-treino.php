<?php
/* @var $treino \app\models\Treino*/


?>

<h5 class="dia-treino">
    <?= $treino->titulo ?>
</h5>
<table class="table-treino">
    <tr>
        <th style="width: 300px;">Exercício</th>
        <th>Sequência</th>
    </tr>
    <?php foreach ($treino->treinoExercicios as $treinoExercicio): ?>
        <tr>
            <td><?= $treinoExercicio->exercicio->nome ?></td>
            <td><?= $treinoExercicio->numero_repeticao ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>