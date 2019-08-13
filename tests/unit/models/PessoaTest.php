<?php


namespace tests\unit\models;


use Codeception\Test\Unit;
use app\models\Pessoa;
use yii\caching\FileCache;
use yii\web\UploadedFile;

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

    /**
     * @test
     */
    public function VerificarSeEstaSalvandoAImagem()
    {
        //Criar o teste para verificar se a função upload está funcionando
        // corretamente.
//        $pessoa = $this->getMockBuilder('app\models\Pessoa')
//            ->setMethods(['validate'])
//            ->getMock();
//
//        $pessoa->expects($this->once())->method('validate')->willReturn(true);
//
//        UploadedFile::getInstanceByName()
        $this->assertEquals(true, false);
    }

}