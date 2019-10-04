<?php


/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

/* @var $exercicios yii\db\ActiveRecord[] */
/* @var $exercicio app\models\Exercicio */
/* @var $pagination yii\data\Pagination */


$this->title =  "Exercícios";

$this->registerCss("
    div.links {
        margin-bottom: 10px;
    }
    
    p.desc {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
   
");
?>

<div class="links row">
    <div class="col-md-6">
        <div class="btn-group btn-group-sm" role="group">
            <?= Html::a('Todos', ['exercicio/exercicios'], [
                    'class' => 'btn bg-gray'
            ]) ?>
            <?= Html::a('Aeróbicos', ['exercicio/aerobicos'], [
                    'class' => 'btn bg-gray'
            ]) ?>
            <?= Html::a('Anaeróbicos', ['exercicio/aerobicos'], [
                    'class' => 'btn bg-gray'
            ]) ?>
        </div>
    </div>
    <div class="col-md-6">
        <?= Html::a(
            '<i class="fa fa-plus"></i> Novo Exercício',
            ['exercicio/create'],
            ['class' => 'btn bg-green btn-flat btn-sm pull-right']
        ) ?>
    </div>
</div>
<div class="row">
    <?php foreach($exercicios as $exercicio): ?>
        <div class="col-md-3">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <?= $exercicio->nome ?>
                    </h4>
                    <div class="box-tools pull-right">
                        <?php if ($exercicio->tipo === 'aerobico'): ?>
                            <span class="badge bg-red">
                                aeróbico
                            </span>
                        <?php else: ?>
                            <span class="badge bg-aqua">
                                anaeróbicos
                            </span>
                        <?php endif ?>
                    </div>
                </div>
                <div class="box-body ">
                    <p class="desc">
                        <?= $exercicio->descricao ?>
                    </p>
                </div>
                <div class="box-footer no-border">
                    <?= Html::a(
                        'Mais informações',
                        ['exercicio/view', 'id' => $exercicio->id],
                        [
                            'class' => 'btn bg-gray btn-xs pull-right'
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="col-md-12">
        <?= LinkPager::widget([
            'pagination' => $pagination,
            'options' => [
                'class' => 'pagination pagination-sm no-margin pull-right'
            ]
        ]) ?>
    </div>
</div>
<div class="row"></div>


