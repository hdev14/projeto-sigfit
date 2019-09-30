<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

?>

<header class="main-header">

    <!-- Logo -->
    <a href="<? Url::to(['site/index']) ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">SIG<b>FIT</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->user->identity->foto ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs">Username</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= Yii::$app->user->identity->foto ?>"
                                 class="img-circle"
                                 alt="">

                            <p>
                                Username
                                <small>username@email.com</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                            </div>
                            <?=
                            Html::beginForm(['/site/logout'], 'post', ['class'=>'pull-right'])
                            . Html::submitButton(
                                'Sair',
                                ['class' => 'btn btn-default btn-flat']
                            )
                            . Html::endForm() ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>