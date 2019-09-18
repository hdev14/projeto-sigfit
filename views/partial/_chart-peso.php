<?php

/* @var $avaliacao app\models\Avaliacao */

$this->registerJs("
    const peso_chart_context". $avaliacao->id ." = document.querySelector('#peso-chart". $avaliacao->id ."').getContext('2d');
    let peso". $avaliacao->id ." = new Chart(peso_chart_context". $avaliacao->id .", {
        type: 'line',
        data: {
            labels: [{$avaliacao->pesoData}],
            datasets:[{
                label: 'Peso (Kg)',
                data: [{$avaliacao->pesoData}],
                borderColor: 'rgba(221, 75, 57, .8)',
                borderWidth: 4,
                pointBackgroundColor: 'rgba(177, 60, 46, 1)',
                pointBorderColor: 'rgba(221, 75, 57, 1)',
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
                <canvas id="<?= 'peso-chart' . $avaliacao->id ?>"></canvas>
            </div>
        </div>
    </div>
</div>
