<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ExercicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exercicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Exercicio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'equipamento_id',
            'nome',
            'descricao',
            'tipo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
