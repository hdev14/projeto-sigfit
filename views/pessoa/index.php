<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PessoaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários Instruídos';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
        var elt_modal = document.querySelector('#modal-registro');
        var elt_btn = document.querySelector('#registro-aluno');
        
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
            <p>Aluno ou Servidor?</p>
            <div>
                <?= Html::a('Aluno', ['create-aluno'], [
                    'class' => 'btn btn-primary btn-sm'
                ]) ?>
                <?= Html::a('Servidor', ['create-servidor'], [
                    'class' => 'btn bg-navy btn-sm'
                ]) ?>
            </div>
        </div>
    </div>
</div>
<!--    model registro usuário-->
<div class="pessoa-index">

    <!--    <h1>Html::encode($this->title)</h1>-->

    <p>
        <?= Html::button('Registrar Usuário', [
            'id' => 'registro-aluno',
            'class' => 'btn btn-success'
        ]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'matricula',
            'nome',
            'email:email',
            'curso',
            //'periodo_curso',
            //'horario_treino',
            //'problema_saude:ntext',
            //'faltas',
            //'espera',
            //'telefone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


