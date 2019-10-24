<?php

/* @var $treino  \app\models\Treino */

?>

<?php if ($treino->nivel === 'iniciante'): ?>
    <span class="label label-success">Iniciante</span>
<?php elseif ($treino->nivel === 'intermediario'): ?>
    <span class="label label-warning">Intermediário</span>
<?php elseif ($treino->nivel === 'avançado'): ?>
    <span class="label label-danger">Avançado</span>
<?php endif; ?>
