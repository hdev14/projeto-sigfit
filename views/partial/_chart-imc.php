<?php

/* @var $avaliacao app\models\Avaliacao */

use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->registerJs("
    
    const imc_chart_context". $avaliacao->id ." = document.querySelector('#imc-chart". $avaliacao->id ."').getContext('2d');
    RECUPERA POR AQUI
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
            }],
        },
        options : {
            onClick: function(e, legendItem) {
                 
                if (legendItem.length !== 0) {
                    let btn = document.querySelector('#valor-imc".$avaliacao->id."'); 
                    btn.dispatchEvent(new MouseEvent('click', {
                         'view': window,
                         'bubbles': true,
                         'cancelable': false,
                     }));
                    
                    let item = legendItem[0]
                        , index = legendItem[0]._index
                        , x_scale = legendItem[0]._xScale
                        , x_scale_ticks = legendItem[0]._xScale.ticks
                        , y_scale = legendItem[0]._yScale
                        , y_scale_ticks = legendItem[0]._yScale.ticks
                        , chart = document.querySelector('#imc-chart".
                        $avaliacao->id. "');
                    
                    chart.dispatchEvent(new MouseEvent('click', {
                         'view': window,
                         'bubbles': true,
                         'cancelable': false,
                     }));

                    
                                        
                    console.log('ITEM ', item);
                    console.log('INDEX ', index);
                    console.log('XSCALE ', x_scale);
                    console.log('XSCALE TICKS ', x_scale_ticks);
                    console.log('XSCALE TICKS VALOR ', x_scale_ticks[index]);
                    console.log('YSCALE ', y_scale);
                    console.log('YSCALE TICKS ', y_scale_ticks);
                    console.log('YSCALE TICKS VALOR ', y_scale_ticks[y_scale_ticks.length - (index + 1)]);
                }
            },
            title: {
                display: true,
                text: 'Clique nos circulos para excluír um valor de IMC'
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

                <?php $modal_valor_imc = Modal::begin([
                    'footer' =>
                        Html::a('Excluir', '#', [
                            'data' => [
                                'confirm' => 'Tem certeza de que deseja excluir este IMC?',
                                'method' => 'post',
                            ],
                            'class' => 'btn bg-red btn-xs',
                            'title' => 'Excluir valor de IMC'
                        ])
                    ,
                    'toggleButton' => [
                        'id' => 'valor-imc'. $avaliacao->id,
                        'style' => 'display: none'
                    ],
                ]); ?>
                    <h4 id="<?= 'modal-valor-titulo'. $avaliacao->id ?>">
                        ASDSAD
                    </h4>
                    <p id="<?= 'valor-imc'. $avaliacao->id ?>">
                        asdasdas
                    </p>
                <?php Modal::end(); ?>
            </div>
        </div>
    </div>
</div>
