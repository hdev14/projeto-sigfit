<?php

/* @var $this \yii\web\View*/
/* @var $usuario \app\models\Pessoa*/

?>

<div>
    <div class="header">
        <div class="titulo">
            <h3>Lista de Treino</h3>
            <small class="text-muted">
                <strong>
                    <?php if ($usuario->servidor): ?>
                        Servidor (a):
                    <?php else: ?>
                        Aluno (a):
                    <?php endif; ?>
                </strong>
                <?= $usuario->nome ?>
                |
                <strong>
                    Matrícula:
                </strong>
                <?= $usuario->matricula ?>
            </small>
        </div>
        <div id="dias-horario">
            <strong>
                <small class="text-muted">
                    |
                    <?php foreach ($usuario->treinos as $treino): ?>
                        <?= $treino->dia . " | "?>
                    <?php endforeach; ?>
                </small>
            </strong>
            <p id="horario"><?= $usuario->horario_treino ?></p>
        </div>
    </div>

    <hr>

    <div class="body">

        <?php foreach($usuario->treinos as $treino): ?>

            <?php switch ($treino->dia) {
                case 'segunda-feira':
                    echo $this->render('../../partial/_lista-treino', [
                        'treino' => $treino,
                    ]);
                    break;
                case 'terça-feira':
                    echo $this->render('../../partial/_lista-treino', [
                        'treino' => $treino,
                    ]);
                    break;
                case 'quarta-feira':
                    echo $this->render('../../partial/_lista-treino', [
                        'treino' => $treino,
                    ]);
                    break;
                case 'quinta-feira':
                    echo $this->render('../../partial/_lista-treino', [
                        'treino' => $treino,
                    ]);
                    break;
                case 'sexta-feira':
                    echo $this->render('../../partial/_lista-treino', [
                        'treino' => $treino,
                    ]);
                    break;
                default:
            } ?>

        <?php endforeach; ?>

    </div>
</div>
