<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquipamentoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipamentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipamento-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Equipamento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'descricao',
            'imagem:ntext',
            'defeito',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
