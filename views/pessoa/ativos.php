<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this \yii\web\View */
/* @var $usuarios_ativos \yii\db\ActiveRecord[] */
/* @var $ui \app\models\Pessoa */
/* @var $pagination \yii\data\Pagination */
/* @var $horario_do_treino string */

$this->title = '';
$this->registerCssFile('@web/css/box-subtitle.css');
$this->registerCssFile('@web/css/minicard.css');
$this->registerCss(<<<CSS

    div#usuarios-ativos {
        margin: 0 auto;
    }

CSS
);
?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h4 class="box-title">
            Usuários Ativos
        </h4>
        <small class="text-muted">
            Usuários que realizaram o check-in no treino das <strong><?=
                $horario_do_treino ?></strong>
        </small>
    </div>
    <div class="box-body">
        <div id="usuarios-ativos" class="row">
            <?php if (!empty($usuarios_ativos)): ?>
                <?php foreach($usuarios_ativos as $ua): ?>
                    <div class="col-md-2 col-sm-4 col-xs-12 minicard">
                        <div class="row">
                            <div class="col-xl-5 col-md-5 col-sm-5 col-xs-5 minicard-header">
                                <a href="<?= Url::to(['pessoa/view', 'id' => $ua->id]) ?>">
                                    <img class="minicard-img" src="<?= Url::to('@web' . $ua->foto) ?>"
                                         alt="Perfil do Usuário" height="100" width="100%">
                                </a>
                            </div>
                            <div class="col-xl-7 col-md-7 col-sm-7 col-xs-7 minicard-body">
                                <strong><?= $ua->nome ?></strong><br>
                                <small class="text-muted"><?= $ua->matricula ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="callout callout-info">
                    <h4>Sem usuários ativos</h4>
                    <p>Nenhum usuário fez check-in até o momento.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="box-footer clearfix no-border">
        <?= LinkPager::widget([
            'pagination' => $pagination,
            'options' => [
                'class' => 'pagination pagination-sm no-margin'
            ]
        ]) ?>

        <small class="text-muted pull-right">
            Clique na imagem para ver o perfil
        </small>
    </div>
</div>
