<?php

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-3">
        <div class="box">
            <div class="box-body box-profile">
                <img src="<?= Url::to("@web".$model->foto)?>"
                     alt="<?= $model->nome ?>"
                     class="profile-user-img img-responsive img-rounded">
                <h3 class="profile-username text-center">
                    <?= $model->nome ?>
                </h3>
                <p class="text-muted text-center">
                    <?= $model->matricula ?>
                </p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <?= $model->email ?>
                    </li>
                    <li class="list-group-item">
                        <?= $model->email ?>
                    </li>
                    <li class="list-group-item">
                        <?= $model->email ?>
                    </li>
                    <li class="list-group-item">
                        <?= $model->email ?>
                    </li>
                </ul>
                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'matricula',
                    'nome',
                    'email:email',
                    'curso',
                    'periodo_curso',
                    'horario_treino',
                    'problema_saude:ntext',
                    'faltas',
                    'espera',
                    'telefone',
                ],
            ]) ?>
        </div>
    </div>
</div>
