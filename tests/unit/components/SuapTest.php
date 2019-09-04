<?php


use Codeception\Test\Unit;
use \app\components\Suap;

class SuapTest extends Unit
{
    /**
     * @test
     */
    public function verifica_se_token_esta_sendo_validado_corretamente()
    {
        $suap = new Suap();
        $resposta = $suap->validarToken('tokenfalso');
        $this->assertEquals(false, $resposta);
    }

}