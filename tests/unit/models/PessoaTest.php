<?php


namespace tests\unit\models;


use Codeception\Test\Unit;
use app\models\Pessoa;

class PessoaTest extends Unit
{
    /**
     * @test
     */
    public function SeOMetodoScenariosRetornaUmArray()
    {
        $pessoa = new Pessoa();
        $resultado = is_array($pessoa->scenarios());
        $this->assertEquals(true, $resultado);
    }

}