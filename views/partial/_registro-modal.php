<?php

use yii\helpers\Html;
use yii\web\View;

$this->registerJs("
        const elt_modal = document.querySelector('#modal-registro');
        const elt_btn = document.querySelector('#registro-usuario');
        
        elt_btn.onclick = function() {
            elt_modal.style.display = 'block';
        }
        
        window.onclick = function(e) {
            if (e.target === elt_modal)
                elt_modal.style.display = 'none';
        }
    ",
    View::POS_READY
);

?>

<!--    model registro usuário-->
<div id="modal-registro" class="modal-registro">
    <div class="modal-conteudo panel panel-default">
        <div class="panel-body">
            <p>Aluno ou Servidor ?</p>
            <div>
                <?= Html::a('Aluno', ['pessoa/create-aluno'], [
                    'class' => 'btn bg-gray btn-sm'
                ]) ?>
                <?= Html::a('Servidor', ['pessoa/create-servidor'], [
                    'class' => 'btn bg-light-blue btn-sm'
                ]) ?>
            </div>
        </div>
    </div>
</div>
<!--    model registro usuário-->
