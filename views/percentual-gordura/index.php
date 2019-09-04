<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PercentualGorduraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Percentual Gorduras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="percentual-gordura-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Percentual Gordura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'avaliacao_id',
            'valor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
