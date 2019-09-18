<?php

/* @var $avaliacao app\models\Avaliacao */

$this->registerJs("
    const pdg_chart_context". $avaliacao->id ." = document.querySelector('#pdg-chart". $avaliacao->id ."').getContext('2d');
    let pdg". $avaliacao->id ." = new Chart(pdg_chart_context". $avaliacao->id .", {
        type: 'line',
        data: {
            labels: [{$avaliacao->pdgData}],
            datasets:[{
                label: 'Percentual de Gordura (%)',
                data: [{$avaliacao->pdgData}],
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

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Desempenho</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <canvas id="<?= 'pdg-chart' . $avaliacao->id ?>"></canvas>
            </div>
        </div>
    </div>
</div>

