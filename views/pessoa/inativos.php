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
$this->registerCss(<<<CSS

    div#usuarios-inativos {
        margin: 0 auto;
    }
    
    .minicard {
        margin: 10px;
        height: 33%;
        border-radius: 5px;
        border: 1px solid rgb(244, 244, 244);
        background-color: #ffffff;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }
    
    div.minicard-header {
        padding: 0;
    }
    
    img.minicard-img {
        border-radius: 5px 0 0 5px;
        background-size: cover;
    }
    
    img.minicard-img:hover {
        box-shadow: 1px 1px 5px darkgray;
    }
    
    div.minicard-body {
        /*border: 1px solid;*/
        text-align: center;
        height: 100px;
        padding: 10px;    
    }
    
    div.minicard-body strong {
        text-transform: uppercase;
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
            Usuários que ainda não realizaram o check-in no treino das <?= $horario_do_treino ?>
        </small>
    </div>
    <div class="box-body">
        <div id="usuarios-inativos" class="row">
            <?php foreach($usuarios_inativos as $ui): ?>
                <?php $ui = (object) $ui ?>

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




