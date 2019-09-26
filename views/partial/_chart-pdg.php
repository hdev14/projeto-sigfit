<?php

/* @var $avaliacao app\models\Avaliacao */

use app\models\PercentualGordura;
use yii\helpers\Html;

$this->registerJs("
    const pdg_chart_context". $avaliacao->id ." = 
        document.querySelector('#pdg-chart". $avaliacao->id ."').getContext('2d');
    
    let pdg". $avaliacao->id ." = new Chart(pdg_chart_context". $avaliacao->id .", {
        type: 'line',
        data: {
            labels: [{$avaliacao->pdgData['labels']}],
            datasets:[{
                label: 'Percentual de Gordura (%)',
                data: [{$avaliacao->pdgData['data']}],
                borderColor: 'rgba(243, 156, 18, .8)',
                borderWidth: 4,
                pointBackgroundColor: 'rgba(195, 125, 14, 1)',
                pointBorderColor: 'rgba(243, 156, 18, 1)',
                pointBorderWidth: 5,
                fill: false,    
            }]
        },
    });
");

?>

<div class="box ">
    <div class="box-header">
        <?= Html::a('<i class="fa fa-fw fa-pencil"></i>', [
            'avaliacao/update',
            'id' =>  $avaliacao->id
        ], [
            'class' => 'btn bg-aqua btn-xs',
            'title' => 'Editar avaliação física'
        ]) ?>

        <?= Html::a('<i class="fa fa-fw fa-trash"></i>', ['avaliacao/delete', 'id' =>
            $avaliacao->id], [
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir esta avaliação?',
                'method' => 'post',
            ],
            'class' => 'btn bg-red btn-xs',
            'title' => 'Excluir avaliação física'
        ]) ?>
        <div class="box-tools pull-right">
            <?= $this->render('_modal-form-pdg', [
                'avaliacao_id' => $avaliacao->id,
                'idade' => $avaliacao->idade,
                'sexo' => $avaliacao->pessoa->sexo,
            ]) ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <canvas id="<?= 'pdg-chart' . $avaliacao->id ?>"></canvas>
            </div>
        </div>
    </div>
</div>

