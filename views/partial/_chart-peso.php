<?php

/* @var $avaliacao app\models\Avaliacao */

use yii\bootstrap\Modal;
use yii\helpers\Html;

$this->registerJs("
    const peso_chart_context". $avaliacao->id ." = document.querySelector('#peso-chart". $avaliacao->id ."').getContext('2d');
    let peso". $avaliacao->id ." = new Chart(peso_chart_context". $avaliacao->id .", {
        type: 'line',
        data: {
            labels: [{$avaliacao->pesoData['labels']}],
            datasets:[{
                label: 'Peso (Kg)',
                data: [{$avaliacao->pesoData['data']}],
                borderColor: 'rgba(221, 75, 57, .8)',
                borderWidth: 4,
                pointBackgroundColor: 'rgba(177, 60, 46, 1)',
                pointBorderColor: 'rgba(221, 75, 57, 1)',
                pointBorderWidth: 8,
                fill: false,    
            }]
        },
        options : {
            onClick: function(e, legendItem) {
                
                if (legendItem.length !== 0) {
                    let btn = document.querySelector('#valor-peso".$avaliacao->id."');
                    btn.dispatchEvent(new MouseEvent('click', {
                        'view': window,
                        'bubbles': true,
                        'cancelable': false,
                    }));
                    
                    let pontos_ativos = this.getElementsAtEventForMode(e, 'point', this.options)
                        , primeiro_ponto = pontos_ativos[0]
                        , label = this.data.labels[primeiro_ponto._index]
                        , valor = this.data.datasets[primeiro_ponto._datasetIndex].data[primeiro_ponto._index]
                        , array_label =  label.split('-')
                        , data = array_label[1].trim().split('/')
                        , dia = data[0]
                        , mes = data[1]
                        , id_valor = parseInt(array_label[0].trim().slice(1))
                        , modal_valor_titulo =
                            document.querySelector('#modal-peso-titulo".$avaliacao->id."')
                        , modal_btn_excluir =
                            document.querySelector('#modal-peso-btn-excluir".$avaliacao->id."')
                        , modal_btn_editar =
                            document.querySelector('#modal-peso-btn-editar".$avaliacao->id."')
                        , uri_delete = '?r=avaliacao/delete-peso&id=' + id_valor
                        , uri_update = '?r=avaliacao/update-peso&id=' + id_valor;
                        
                    modal_btn_excluir.setAttribute('href', uri_delete);
                    modal_btn_editar.setAttribute('href', uri_update);
                    modal_valor_titulo.innerHTML = 'Peso ' + valor + ' (Kg) - Adicionardo no dia ' + dia + ' do mês ' + mes;
                    
                }
                
            },
            title: {
                display: true,
                text: 'Clique em um ponto para mais opções'
            }
        }
    });
");

?>
<div class="box box-solid">
    <div class="box-header">
        <?= Html::a('<i class="fa fa-fw fa-pencil"></i>', [
            'avaliacao/update',
            'id' =>  $avaliacao->id
        ], [
            'class' => 'btn bg-gray btn-xs',
            'title' => 'Editar avaliação física'
        ]) ?>

        <?= Html::a('<i class="fa fa-fw fa-trash"></i>', ['avaliacao/delete', 'id' =>
            $avaliacao->id], [
            'data' => [
                'confirm' => 'Tem certeza de que deseja excluir esta avaliação?',
                'method' => 'post',
            ],
            'class' => 'btn bg-gray btn-xs',
            'title' => 'Excluir avaliação física'
        ]) ?>
        <div class="box-tools pull-right">
            <?= $this->render('_modal-form-peso', [
                'avaliacao_id' => $avaliacao->id,
            ]) ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <canvas id="<?= 'peso-chart' . $avaliacao->id ?>"></canvas>

                <?php $modal_valor_peso = Modal::begin([
                    'footer' =>
                        Html::a('Editar valor', '#', [
                            'id' => 'modal-peso-btn-editar'. $avaliacao->id,
                            'class' => 'btn bg-aqua btn-sm btn-flat',
                            'title' => 'Editar valor do peso',
                        ])
                        .
                        Html::a('Excluir valor', '#', [
                            'data' => [
                                'confirm' => 'Tem certeza de que deseja excluir este peso?',
                                'method' => 'post',
                            ],
                            'id' => 'modal-peso-btn-excluir'. $avaliacao->id,
                            'class' => 'btn bg-red btn-sm btn-flat',
                            'title' => 'Excluir valor do peso',
                        ])
                    ,
                    'toggleButton' => [
                        'id' => 'valor-peso'. $avaliacao->id,
                        'style' => 'display: none'
                    ],
                ]); ?>
                <h4 class="text-center" id="<?= 'modal-peso-titulo'.
                $avaliacao->id ?>">
                </h4>
                <?php Modal::end(); ?>
            </div>
        </div>
    </div>
</div>
