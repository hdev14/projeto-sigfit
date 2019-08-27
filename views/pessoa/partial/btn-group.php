<?php
/* @var $this \yii\web\View */

use yii\helpers\Url;
?>

<div class="tabs row">
    <div class="col-md-12 text-right">
        <div class="btn-group btn-group-sm" role="group"
             aria-label="
        ...">
           <a class="btn btn-success btn-flat"
              href="<?= Url::to(['pessoa/usuarios']) ?>">
                Todos
            </a>
            <a class="btn btn-success btn-flat"
               href="<?= Url::to(['pessoa/alunos']) ?>">
                Alunos
            </a>
            <a class="btn btn-success btn-flat"
               href="<?= Url::to(['pessoa/servidores']) ?>">
                Servidores
            </a>
        </div>
    </div>
</div>
