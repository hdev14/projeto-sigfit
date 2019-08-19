<?php


namespace app\components;


use yii\base\Component;
use GuzzleHttp\Client;

class Suap extends Component
{

    private $client;

    # Para autenticar -> POST autenticacao/token/
    # Para verificar a validade do token -> POST autenticacao/token/verify/

    public function __construct($config = [])
    {
        $this->client = new Client([
            'base_uri' => 'https://suap.ifrn.edu.br/api/v2/',
            'timeout' => 3.0,
        ]);
        parent::__construct($config);
    }

    public function autenticar($matricula, $senha)
    {

       $resposta = $this->client->post('autenticacao/token/', [
           'json' => [
               'username' => $matricula,
               'password' => $senha,
           ]
       ]);

       if ($resposta->getStatusCode() == 200) {
            $dados = json_decode($resposta->getBody(), true);
            return $dados['token'];
       }

       return false;

    }

    public function validarToken($token) {

        $resposta = $this->client->post('autenticacao/token/verify/', [
            'json' => [
                'token' => $token
            ]
        ]);

        if ($resposta->getStatusCode() == 200) {
            $dados = json_decode($resposta->getBody(), true);
            return $dados['token'];
        }

        return false;
    }

}
