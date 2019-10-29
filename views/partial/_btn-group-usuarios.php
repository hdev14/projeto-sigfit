<?php
/* @var $this \yii\web\View */
/* @var $espera bool */

use yii\helpers\Url;

$this->registerCssFile('@web/css/btns.css');
?>

<div id="btns" class="row">
    <div class="col-md-6">
        <div class="btn-group btn-group-sm" role="group" >
           <a class="btn bg-gray "
              href="<?= Url::to(['pessoa/usuarios', 'espera' => $espera]) ?>">
                Todos
            </a>
            <a class="btn bg-gray "
               href="<?= Url::to(['pessoa/alunos', 'espera' => $espera]) ?>">
                Alunos
            </a>
            <a class="btn bg-gray "
               href="<?= Url::to(['pessoa/servidores', 'espera' => $espera]) ?>">
                Servidores
            </a>
        </div>
        <div class="pull-right">
            <a href="<?= Url::to(['pessoa/create']) ?>"></a>
        </div>
    </div>
    <div class="col-md-6">
        <?= $this->render('../partial/_btn-registro') ?>
    </div>
</div>
