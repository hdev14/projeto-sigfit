<?php

namespace tests\unit\models;


use app\models\Pessoa;
use app\models\PessoaSearch;
use app\models\UsuarioInstrutor;
use Codeception\Test\Unit;
use yii\db\ActiveQuery;
use yii\db\Connection;
use yii\db\Transaction;

class PessoaSearchTest extends Unit
{
    private $db;

    public function setUp()
    {
        $this->db = $db = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=sigfit',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ]);

        return parent::setUp();
    }

    /**
     * @test
     * @expectedException \Exception
     * @expectedException \Throwable
     */
    public function verificar_retorno_do_metodo_searchUsuarios() {

        /* @var $transaction Transaction */
        $transaction = $this->db->beginTransaction();

        try {

            $instrutor = new Pessoa();
            $instrutor->matricula = '192837465';
            $instrutor->nome =  'instrutor de teste';
            $instrutor->email = 'instrutordeteste@email.com';
            $instrutor->save();

            $aluno = new Pessoa();
            $aluno->matricula = '5647382910';
            $aluno->nome =  'aluno de teste';
            $aluno->email = 'alunodeteste@email.com';
            $aluno->save();

            $usuario_instrutor_aluno = new UsuarioInstrutor();
            $usuario_instrutor_aluno->instrutor_id = $instrutor->id;
            $usuario_instrutor_aluno->usuario_id = $aluno->id;
            $usuario_instrutor_aluno->save();

            $servidor = new Pessoa();
            $servidor->matricula = '0912873465';
            $servidor->nome =  'servidor de teste';
            $servidor->email = 'servidordeteste@email.com';
            $servidor->servidor = true;
            $servidor->save();

            $usuario_instrutor_servidor = new UsuarioInstrutor();
            $usuario_instrutor_servidor->instrutor_id = $instrutor->id;
            $usuario_instrutor_servidor->usuario_id = $servidor->id;
            $usuario_instrutor_servidor->save();

            $transaction->commit();

        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }

        $pessoa_search = new PessoaSearch();
        $query = $pessoa_search->searchUsuarios('192837465');
        $this->assertEquals(ActiveQuery::className(), $query::className());

        $transaction->rollBack();
    }
}