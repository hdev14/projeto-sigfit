<?php

/* @var $avaliacao app\models\Avaliacao */

use app\models\PercentualGordura;

$this->registerJs("
    const pdg_chart_context". $avaliacao->id ." = document.querySelector('#pdg-chart". $avaliacao->id ."').getContext('2d');
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
        <h3 class="box-title"></h3>
        <div class="box-tools pull-right">
            <?= $this->render('./_modal-form', [
                'label_header' => 'Nova pesagem',
                'label_button_click' => "<i class='fa fa-fw fa-plus'></i>Adicionar peso",
                'action' => 'avaliacao/create-peso',
                'model' => new PercentualGordura(),
                'avaliacao_id' => $avaliacao->id,
            ]) ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <canvas id="<?= 'pdg-chart' . $avaliacao->id ?>"></canvas>
            </div>
        </div>
    </div>
</div>

