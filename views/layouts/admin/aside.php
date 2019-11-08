<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!--<div class="user-panel">
            <div class="pull-left image">
                <img class="img-circle" alt="User Image" src="<?/*=
                Yii::$app->user->identity->foto */?>" style="height: 45px;">
            </div>
            <div class="pull-left info">
                <p>Username</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->
        <!-- search form -->


        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
            <?php if (Yii::$app->user->can('instrutor')): ?>
                <li class="header">CHECK-IN / CHECK-OUT</li>
                <li>
                    <?= Html::beginForm(['pessoa/checkin-checkout'], 'post', [
                        'class' => 'sidebar-form'
                    ]) ?>

                    <div class="div input-group">
                        <?= Html::input('text', 'matricula-check', null, [
                            'autofocus' => true,
                            'class' => 'form-control',
                            'placeholder' => 'Digite a matrícula',
                            'title' => 'Digite a mátricual do usuário para realizar o check-in ou check-out',
                        ]) ?>

                        <span class="input-group-btn">
                            <?= Html::submitButton('<i class="fa fa-exchange"></i>', [
                                'class' => 'btn btn-flat',
                            ]) ?>
                        </span>
                    </div>

                    <?= Html::endForm(); ?>

                </li>
            <?php endif; ?>

            <li class="header">MENU PRINCIPAL</li>
            <?php if (Yii::$app->user->can('crud-instrutor')): ?>
                <li class="">
                    <a href="<?= Url::to(['pessoa/instrutores']) ?>">
                        <i class="fa fa-user-secret"></i>
                        <span>Instrutores</span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Usuários</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="<?= Url::to(['pessoa/usuarios']) ?>">
                            <i class="fa fa-id-card"></i> Instruídos
                        </a>
                    </li>
                    <li>
                        <a href="index.html">
                            <i class="fa fa-user"></i> Ativos
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to(['pessoa/inativos']) ?>">
                            <i class="fa fa-bed"></i> Inativos
                        </a>
                    </li>
                    <li class="">
                        <a href="<?= Url::to(['pessoa/usuarios', 'espera' => true]) ?>">
                            <i class="fa fa-list "></i> Fila de Espera
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="<?= Url::to(['treino/treinos']) ?>">
                    <i class="fa fa-heartbeat"></i>
                    <span>Treinos</span>
                </a>
            </li>
            <li class="">
                <a href="<?= Url::to(['equipamento/equipamentos']) ?>">
                    <i class="fa fa-wrench"></i>
                    <span>Equipamentos</span>
                </a>
            </li>
            <li class="">
                <a href="<?= Url::to(['exercicio/exercicios']) ?>">
                    <i class="fa fa-bolt"></i>
                    <span>Exercícios</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>