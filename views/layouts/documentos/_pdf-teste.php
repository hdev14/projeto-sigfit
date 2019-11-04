<?php

/* @var $this \yii\web\View */
/* @var $usuario \app\models\Pessoa */

/*$this->registerCss(<<<CSS
    div {
        text-transform: ca;
    }
CSS
);*/
?>


<h1> Carteira do Atleta </h1>
<div>
    <div id="frente">
        <h5>
            <strong>Frente</strong>
        </h5>
        <div class="carteira borda">
            <div class="carteira-header">
                <div class="foto">
                    <p> FOTO </p>
                </div>
                <div class="header">
                    <strong> CARTEIRA DO ATLETA</strong>
                    <img id="ifrn-logo"  alt="ifrn" width="200" height=""
                         src="<?= Yii::$app->basePath . '/web/imgs/ifrn-logo.jpeg' ?>">
                </div>
            </div>
            <div class="carteira-footer">
                <table>
                    <tr>
                        <th style="width: 100px;">Aluno (a):</th>
                        <td><?= $usuario->nome ?></td>
                    </tr>
                    <tr>
                        <th style="width: 100px;">Matrícula:</th>
                        <td><?= $usuario->matricula ?></td>

                        <th style="width: 100px;">Curso:</th>
                        <td><?= $usuario->curso ?></td>
                    </tr>
                </table>
                <p id="hr-aula">Horário de Aula:</p>
                <hr style="width: 95%; margin: 10px 0 5px 0; ">
            </div>
        </div>
        <span class="text-muted pdf-cut">&#9987;</span>
    </div>
    <div id="verso">
        <h5>
            <strong>Verso</strong>
        </h5>
        <div class="carteira borda">
            <div class="verso-carteira-header">
                <strong>ATIVIDADES</strong>

                <div class="verso-content">
                    <img class="caixa"  alt="ifrn" width="20" height="20"
                         src="<?= Yii::$app->basePath . '/web/imgs/box.png' ?>">
                    Musculação
                    <img class="caixa"  alt="ifrn" width="20" height="20"
                         src="<?= Yii::$app->basePath . '/web/imgs/box.png' ?>">
                    Hidroginástica
                    <img class="caixa"  alt="ifrn" width="20" height="20"
                         src="<?= Yii::$app->basePath . '/web/imgs/box.png' ?>">
                    Outros
                </div>

                <strong>DIAS</strong>

                <div class="verso-content">
                    <p>
                        <?php foreach ($usuario->treinos as $treino): ?>
                            <span class="dias"><?= " | " . $treino->dia ?></span>
                        <?php endforeach; ?>
                    </p>
                </div>

                <strong>HORÁRIO</strong>

                <div class="verso-content">
                    <p>
                        <?= $usuario->horario_treino ?>
                    </p>
                </div>
            </div>
            <div class="verso-carteira-footer">
                Ass. Aluno (a): ________________________________________<br><br>
                Ass. Direção: _________________________________________
            </div>
        </div>
        <span class="text-muted pdf-cut">&#9987;</span>
    </div>
</div>


