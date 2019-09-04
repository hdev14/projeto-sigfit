<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PessoaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários Instruídos';
?>

<div class="pessoa-index">

    <p class="text-right">
        <?= Html::button('Registrar Usuário', [
            'id' => 'registro-aluno',
            'class' => 'btn btn-success btn-sm btn-flat'
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


