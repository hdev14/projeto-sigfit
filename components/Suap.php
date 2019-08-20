<?php


namespace app\components;


use GuzzleHttp\Exception\ClientException;
use yii\base\Component;
use GuzzleHttp\Client;
use yii\helpers\Json;

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

    /**
     * @param $matricula
     * @param $senha
     * @return bool
     */
    public function autenticar($matricula, $senha)
    {

       $resposta = $this->client->post('autenticacao/token/', [
           'json' => [
               'username' => $matricula,
               'password' => $senha,
           ]
       ]);

       try {
           if ($resposta->getStatusCode() == 200) {
                $dados = Json::decode($resposta->getBody());
                return $dados['token'];
           }
       } catch(ClientException $e) {
           return false;
       }

       return false;
    }

    /**
     * @param $token
     * @return bool
     */
    public function validarToken($token) {

        $resposta = $this->client->post('autenticacao/token/verify/', [
            'json' => [
                'token' => $token
            ]
        ]);

        try {
            if ($resposta->getStatusCode() == 200) {
                $dados = Json::decode($resposta->getBody());
                return $dados['token'];
            }
        } catch(ClientException $e) {
            return false;
        }

        return false;
    }
}
