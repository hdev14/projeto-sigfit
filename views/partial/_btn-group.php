<?php
/* @var $this \yii\web\View */

use yii\helpers\Url;
?>

<div class="tabs row">
    <div class="col-md-12">
        <div class="btn-group btn-group-sm" role="group" >
           <a class="btn bg-gray "
              href="<?= Url::to(['pessoa/usuarios']) ?>">
                Todos
            </a>
            <a class="btn bg-gray "
               href="<?= Url::to(['pessoa/alunos']) ?>">
                Alunos
            </a>
            <a class="btn bg-gray "
               href="<?= Url::to(['pessoa/servidores']) ?>">
                Servidores
            </a>
        </div>
        <div class="pull-right">
            <a href="<?= Url::to(['pessoa/create']) ?>"></a>
        </div>
    </div>
</div>
