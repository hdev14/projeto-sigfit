<?php

use app\models\Equipamento;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\LinkPager;

/* @var $this View */
/* @var $equipamentos ActiveRecord[] */
/* @var $equipamento Equipamento */
/* @var $pagination Pagination */

$this->title = "Equipamentos";

$this->registerCss("
    
    div.header { margin-bottom: 10px; }
    
    p.equipamento-desc {
       height: 80px;
    }
    
    span.badge {
        position: relative;
        top: 10px;
        left: 10px;
    }
");

?>
<div class="header row">
    <div class="col-md-6 col-md-offset-6">
        <?= Html::a(
            '<i class="fa fa-plus"></i> Novo Equipamento',
            ['equipamento/create'],
            ['class' => 'btn bg-green btn-flat btn-sm pull-right']
        ) ?>
    </div>
</div>
<div class="row">
    <?php foreach ($equipamentos as $equipamento): ?>
        <div class="col-md-3">
            <div class="thumbnail">
                <?php if ($equipamento->defeito): ?>
                    <span class="badge bg-red">com defeito</span>
                <?php else: ?>
                    <span class="badge bg-green">sem defeito</span>
                <?php endif; ?>
                <img src="<?= Url::to('@web'.$equipamento->imagem ) ?>"
                     alt="" class="img-responsive">
                <div class="caption">
                    <h4><?= $equipamento->nome ?></h4>
                    <p class="text-muted equipamento-desc"><?=
                        $equipamento->descricao
                        ?></p>
                    <p class=" text-right">
                        <?= Html::a(
                            'mais informações',
                            ['equipamento/view', 'id' => $equipamento->id],
                            [
                                'class' => 'btn bg-gray btn-xs'
                            ]) ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="col-md-12">
        <?= LinkPager::widget([
            'pagination' => $pagination,
            'options' => [
                'class' => 'pagination pagination-sm no-margin'
            ]
        ]) ?>
    </div>
</div>
