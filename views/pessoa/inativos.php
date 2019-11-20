<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this \yii\web\View */
/* @var $usuarios_inativos \yii\db\ActiveRecord[] */
/* @var $ui \app\models\Pessoa */
/* @var $pagination \yii\data\Pagination */
/* @var $horario_do_treino string */

$this->title = '';
$this->registerCssFile('@web/css/box-subtitle.css');
$this->registerCssFile('@web/css/minicard.css');
$this->registerCss(<<<CSS

    div#usuarios-inativos {
        margin: 0 auto;
    }

CSS
);
?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h4 class="box-title">
            Usuários Inativos
        </h4>
        <small class="text-muted">
            Usuários que ainda não realizaram o check-in no treino das <strong><?=
                $horario_do_treino ?></strong>
        </small>
    </div>
    <div class="box-body">
        <div id="usuarios-inativos" class="row">
            <?php if (!empty($usuarios_inativos)): ?>
                <?php foreach($usuarios_inativos as $ui): ?>
                    <div class="col-md-2 col-sm-4 col-xs-12 minicard">
                        <div class="row">
                            <div class="col-xl-5 col-md-5 col-sm-5 col-xs-5 minicard-header">
                                <a href="<?= Url::to(['pessoa/view', 'id' => $ui->id]) ?>">
                                    <img class="minicard-img" src="<?= Url::to('@web' . $ui->foto) ?>"
                                         alt="Perfil do Usuário" height="100" width="100%">
                                </a>
                            </div>
                            <div class="col-xl-7 col-md-7 col-sm-7 col-xs-7 minicard-body">
                                <strong><?= $ui->nome ?></strong><br>
                                <small class="text-muted"><?= $ui->matricula ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="callout callout-info">
                    <h4>Sem usuários inativos</h4>
                    <p>Todos os usuários deste horário de treino realizaram check-in.</p>
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




