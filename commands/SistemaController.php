<?php


namespace app\commands;

use app\components\DataHora;
use app\models\Pessoa;
use Yii;
use yii\console\Controller;
use app\models\PessoaSearch;
use yii\console\ExitCode;
use yii\console\widgets\Table;

class SistemaController extends Controller
{

    public function actionVerificarFaltas()
    {
        $pessoa_search = new PessoaSearch();
        /* @var $data_hora DataHora */
        $data_hora = Yii::$app->dataHora;
        $horario_do_treino = $data_hora->getHorarioDeTreinoAtual();

        if (empty($horario_do_treino))
            return ExitCode::UNSPECIFIED_ERROR;

        $horario_do_treino_em_string = $data_hora->getHorarioEmString($horario_do_treino);

        $usuarios_sem_frequencia =  $pessoa_search->searchUsuariosFaltosos(
            $data_hora->getDiaAtual(),
            $horario_do_treino_em_string
        )->all();

        $rows = [];
        $data = date('d/m/Y');
        /* @var $usuario Pessoa*/
        foreach ($usuarios_sem_frequencia as $usuario) {
            array_push($rows, [
                $usuario->nome,
                $usuario->matricula,
                $data,
                $usuario->horario_treino
            ]);
            $usuario->faltas += 1;
            $usuario->save();
        }

        echo Table::widget([
            'headers' => ['Usuario', 'Matrícula', 'Data', 'Horário de Treino'],
            'rows' => $rows
        ]);

        return ExitCode::OK;
    }
}