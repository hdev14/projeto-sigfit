<?php

use yii\helpers\Url;
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img class="img-circle" alt="User Image" src="<?=
                Yii::$app->user->identity->foto ?>" style="height: 45px;">
            </div>
            <div class="pull-left info">
                <p>Username</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu tree" data-widget="tree">
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
                    <li class="active">
                        <a href="<?= Url::to(['pessoa/usuarios']) ?>">
                            <i class="fa fa-id-card"></i> Instruídos
                        </a>
                    </li>
                    <li>
                        <a href="index.html">
                            <i class="fa fa-user"></i> Ativos
                        </a>
                    </li>
                    <li class="active">
                        <a href="index2.html">
                            <i class="fa fa-bed"></i> Inativos
                        </a>
                    </li>
                    <li class="active">
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