<?php

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $usuarios_inativos \yii\db\ActiveRecord[] */
/* @var $ui \app\models\Pessoa */

$this->title = '';
$this->registerCss(<<<CSS
    
    .usuario-card {
        margin: 10px;
        height: 150px;
        border-radius: 5px;
        border: 1px solid rgb(244, 244, 244);
        background-color: #ffffff;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }
    
    img.img-usuario-card {
        margin-top: 20px;
        border-radius: 5px;
        background-size: cover;
        border: 1px solid rgba(0, 0, 0, 0.2);
    }
    
    img.img-usuario-card:hover {
        box-shadow: 1px 1px 5px darkgray;
    }

CSS
);
?>

<div id="usuarios-inativos" class="row">
    <?php foreach($usuarios_inativos as $ui): ?>
        <div class="col-md-3 usuario-card">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-usuario-card" src="<?= Url::to('@web' . $ui->foto) ?>"
                         alt="Perfil do Usuário" height="100" width="100">
                </div>
                <div class="col-md-6">
                    <h4><?= $ui->nome ?></h4>
                    <p><?= $ui->matricula ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>



