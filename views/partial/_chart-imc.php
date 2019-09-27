<?php

/* @var $avaliacao app\models\Avaliacao */

use yii\helpers\Html;

$this->registerJs("
    const imc_chart_context". $avaliacao->id ." = document.querySelector('#imc-chart". $avaliacao->id ."').getContext('2d');
    let imc". $avaliacao->id ." = new Chart(imc_chart_context". $avaliacao->id .", {
        type: 'line',
        data: {
            labels: [{$avaliacao->imcData['labels']}],
            datasets:[{
                label: 'IMC (%)',
                data: [{$avaliacao->imcData['data']}],
                borderColor: 'rgba(0, 192, 239, .8)',
                borderWidth: 4,
                pointBackgroundColor: 'rgba(0, 154, 191, 1)',
                pointBorderColor: 'rgba(0, 192, 239, 1)',
                pointBorderWidth: 6,
                fill: false,    
            }]
        },
        options : {
            onClick: function() {
                
            },
            legend: {
                labels: {
                    generateLabels: function() {
                        
                    }
                }
            }
        }
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
            <?= $this->render('_modal-form-imc', [
                'avaliacao_id' => $avaliacao->id,
            ]) ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <canvas id="<?= 'imc-chart' . $avaliacao->id ?>"></canvas>
            </div>
        </div>
    </div>
</div>
