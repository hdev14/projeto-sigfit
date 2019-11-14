<?php


namespace app\components;


use yii\base\Component;

class DataHora extends Component
{
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function getDiaAtual()
    {
        switch (date('D')) {
            case 'Mon':
                return 'segunda-feira';
            case 'Tue':
                return 'terça-feira';
            case 'Wed':
                return 'quarta-feira';
            case 'Thu':
                return 'quinta-feira';
            case 'Fri':
                return 'sexta-feira';
        }
    }

    public function getHorarioDeTreinoAtual()
    {
        $horario_treino_atual = $this->getHorarioAtual();

        if ($horario_treino_atual >= 7.0 && $horario_treino_atual < 8.0)
            return ['07:00:00', '08:00:00'];
        else if ($horario_treino_atual >= 8.0 && $horario_treino_atual < 9.0)
            return ['08:00:00', '09:00:00'];
        else if ($horario_treino_atual >= 9.0 && $horario_treino_atual < 10.0)
            return ['09:00:00', '10:00:00'];
        else if ($horario_treino_atual >= 10.0 && $horario_treino_atual < 11.0)
            return ['10:00:00', '11:00:00'];
        else if ($horario_treino_atual >= 13.0 && $horario_treino_atual < 14.0)
            return ['13:00:00', '14:00:00'];
        else if ($horario_treino_atual >= 14.0 && $horario_treino_atual < 15.0)
            return ['14:00:00', '15:00:00'];
        else if ($horario_treino_atual >= 15.0 && $horario_treino_atual < 16.0)
            return ['15:00:00', '16:00:00'];
        else if ($horario_treino_atual >= 16.0 && $horario_treino_atual < 17.0)
            return ['16:00:00', '17:00:00'];
        else if ($horario_treino_atual >= 17.0 && $horario_treino_atual < 18.0)
            return ['17:00:00', '18:00:00'];
        else if ($horario_treino_atual >= 18.0 && $horario_treino_atual < 19.0)
            return ['18:00:00', '19:00:00'];

        return '';
    }

    public function getHorarioAtual()
    {
        $horario = explode(':', date('H:i'));
        $horario_formato_int = array_map(function ($v) {
            return intval($v);
        }, $horario);
        $horario_formato_float = floatval(implode('.', $horario_formato_int));
        return $horario_formato_float;
    }

    public function getHorarioEmString($horario_do_treino)
    {
        return $this->transformarHorarioEmString($horario_do_treino);
    }

    public function transformarHorarioEmString($horario_do_treino)
    {
        $hora_inicio_treino = $this->getHora($horario_do_treino[0]);
        $hora_fim_treino = $this->getHora($horario_do_treino[1]);
        return $hora_inicio_treino . 'h às ' . $hora_fim_treino . 'h';
    }

    protected function getHora($horario)
    {
        $horario_inicio_treino_em_array = explode(':', $horario);
        return intval($horario_inicio_treino_em_array[0]);
    }
}