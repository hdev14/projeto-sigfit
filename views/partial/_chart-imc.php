<?php

/* @var $avaliacao app\models\Avaliacao */

use yii\bootstrap\Modal;
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
                pointBorderWidth: 8,
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
                    
                    let pontos_ativos = this.getElementsAtEventForMode(e, 'point', this.options)
                        , primeiro_ponto = pontos_ativos[0]
                        , label = this.data.labels[primeiro_ponto._index]
                        , valor = this.data.datasets[primeiro_ponto._datasetIndex].data[primeiro_ponto._index]
                        , array_label = label.split('-')
                        , data = array_label[1].trim().split('/')
                        , dia = data[0]
                        , mes = data[1]
                        , id_valor = parseInt(array_label[0].trim().slice(1))
                        , modal_valor_titulo = 
                            document.querySelector('#modal-imc-titulo".$avaliacao->id."')
                        , modal_btn_excluir = 
                            document.querySelector('#modal-imc-btn-excluir".$avaliacao->id."')
                        , modal_btn_editar = 
                            document.querySelector('#modal-imc-btn-editar".$avaliacao->id."')
                        , uri_delete = '?r=avaliacao/delete-imc&id=' + id_valor
                        , uri_update = '?r=avaliacao/update-imc&id=' + id_valor; 
                  
                    modal_btn_excluir.setAttribute('href', uri_delete);
                    modal_btn_editar.setAttribute('href', uri_update);
                    modal_valor_titulo.innerHTML = 'IMC ' + valor + '%  - Adicionado no dia ' + dia + ' do mês ' + mes;
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
            <?= $this->render('_modal-form-imc', [
                'avaliacao_id' => $avaliacao->id,
            ]) ?>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">

                <canvas id="<?= 'imc-chart' . $avaliacao->id ?>"></canvas>

                <?php $modal_valor_imc = Modal::begin([
                    'footer' =>
                        Html::a('Editar valor', '#', [
                            'id' => 'modal-imc-btn-editar'. $avaliacao->id,
                            'class' => 'btn bg-aqua btn-sm btn-flat',
                            'title' => 'Editar valor do IMC',
                        ])
                        .
                        Html::a('Excluir valor', '#', [
                            'data' => [
                                'confirm' => 'Tem certeza de que deseja excluir este IMC?',
                                'method' => 'post',
                            ],
                            'id' => 'modal-imc-btn-excluir'. $avaliacao->id,
                            'class' => 'btn bg-red btn-sm btn-flat',
                            'title' => 'Excluir valor do IMC',
                        ])
                    ,
                    'toggleButton' => [
                        'id' => 'valor-imc'. $avaliacao->id,
                        'style' => 'display: none'
                    ],
                ]); ?>
                <h4 class="text-center" id="<?= 'modal-imc-titulo'.
                $avaliacao->id ?>">
                </h4>
                <?php Modal::end(); ?>
            </div>
        </div>
    </div>
</div>
