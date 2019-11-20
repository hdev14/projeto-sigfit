<?php

/* @var $this \yii\web\View*/
/* @var $content string*/

use yii\bootstrap\Alert;
use yii\widgets\Breadcrumbs;
use yii\helpers\Inflector;

?>
<div class="content-wrapper">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])): ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php else: ?>
            <h1>
                <?php if ($this->title !== null): ?>
                    <?= $this->title ?>
                <?php else: ?>
                    <?= Inflector::camel2words(Inflector::id2camel($this->context->module->id)) ?>
                    <?= ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '' ?>
                <?php endif; ?>
            </h1>
        <?php endif; ?>
        <?= Breadcrumbs::widget(
            [
                'tag' => 'ol',
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?= Alert::widget([
                    'options' => [
                        'id' => 'alert-checkout',
                        'class' => 'alert-warning alert-dismissible',
                        'style' => 'display: none'
                    ],
                    'body' => 'Existem usuários que não realizaram check-out, por favor verifique os usuários ativos neste momento.',
                ]) ?>
                <?= $this->render('../../partial/_alert') ?>
            </div>
        </div>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <small>
        Desenvolvido <i class="fa fa-code"></i> com &#x1F49A; por
        <a class="text-muted" style="font-weight: bold" href="https://github.com/HermersonDev"
           target="_blank">@hdev_</a>
        <strong>&#169; <?=date("Y")?></strong>
    </small>
</footer>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>