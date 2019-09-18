<?php

/* @var $avaliacao app\models\Avaliacao */

$this->registerJs("
    const imc_chart_context". $avaliacao->id ." = document.querySelector('#imc-chart". $avaliacao->id ."').getContext('2d');
    let imc". $avaliacao->id ." = new Chart(imc_chart_context". $avaliacao->id .", {
        type: 'line',
        data: {
            labels: [{$avaliacao->pdgData}],
            datasets:[{
                label: 'Porcentagem (%)',
                data: [{$avaliacao->pdgData}],
                borderColor: 'rgba(0, 192, 239, .8)',
                borderWidth: 4,
                pointBackgroundColor: 'rgba(0, 154, 191, 1)',
                pointBorderColor: 'rgba(0, 192, 239, 1)',
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
            <div class="col-md-10 col-md-offset-1">
                <canvas id="<?= 'imc-chart' . $avaliacao->id ?>"></canvas>
            </div>
        </div>
    </div>
</div>
