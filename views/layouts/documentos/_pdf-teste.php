<?php

use yii\helpers\Url;
use app\assets\AppAsset;
use \kartik\mpdf\Pdf;

/* @var $this \yii\web\View */
/* @var $usuario \app\models\Pessoa */

/*$this->registerCss(<<<CSS
    div {
    font-
    }
CSS
);*/
?>


<h1> Carteira do Atleta </h1>
<div class="row">
    <div class="col-md-12">
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
    <div class="col-md-12">
        <h5>
            <strong>Verso</strong>
        </h5>
        <div class="carteira borda">
            Mussum Ipsum, cacilds vidis litro abertis. Mé faiz elementum girarzis, nisi eros vermeio. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per. Tá deprimidis, eu conheço uma cachacis que pode alegrar sua vidis. Praesent malesuada urna nisi, quis volutpat erat hendrerit non. Nam vulputate dapibus.
        </div>
        <span class="text-muted pdf-cut">&#9987;</span>
    </div>
</div>


