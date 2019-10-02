<?php


/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $exercicios yii\db\ActiveRecord[] */
/* @var $exercicio app\models\Exercicio */


$this->title =  "Exercícios";
?>

<div class="row">

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
                            <span class="label label-danger">
                                <?= $exercicio->tipo ?>
                            </span>
                        <?php else: ?>
                            <span class="label label-info">
                                <?= $exercicio->tipo ?>
                            </span>
                        <?php endif ?>

                        <button type="button"
                                class="btn btn-box-tool dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Editar exercício</a></li>
                            <li>
                                <?= Html::a('Remove exercício', [
                                    'exercicio/delete',
                                    'id' => $exercicio->id
                                ],[
                                   'data' => [
                                        'confirm' => 'Tem certeza de que deseja excluir esta exercício?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="<?= Url::to([
                                    'exercicio/view',
                                    'id' => $exercicio->id
                                ]) ?>">Mais informações</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box-body">
                    <p>
                        <?= $exercicio->descricao ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="row"></div>


