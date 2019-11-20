<?php


namespace app\components;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use yii\base\Component;
use yii\helpers\Json;
use GuzzleHttp\Client;
use \Exception;
use yii\web\NotFoundHttpException;

class Suap extends Component
{

    private $client;

    # Para autenticar -> POST autenticacao/token/
    # Para verificar a validade do token -> POST autenticacao/token/verify/

    public function __construct($config = [])
    {
        $this->client = new Client([
            'base_uri' => 'https://suap.ifrn.edu.br/api/v2/',
            'timeout' => 10,
        ]);
        parent::__construct($config);
    }

    public function autenticar($matricula, $senha)
    {
        try {
            $resposta = $this->client->post('autenticacao/token/', [
                'json' => [
                    'username' => $matricula,
                    'password' => $senha
                ]
            ]);

            if ($resposta->getStatusCode() == 200) {
                $dados = Json::decode($resposta->getBody());
                return $dados['token'];
            }
        } catch (ClientException $e) {
            return false;
        } catch (ConnectException $e) {
            throw new NotFoundHttpException("Suap CAIU");
        }
    }

    /**
     * @param $token
     * @return bool
     */
    public function validarToken($token)
    {
        try {
            $resposta = $this->client->post('autenticacao/token/verify/', [
                'json' => [
                    'token' => $token
                ]
            ]);
            if ($resposta->getStatusCode() == 200) {
                $dados = Json::decode($resposta->getBody());
                return $dados['token'];
            }
        } catch(Exception $e) {
            return false;
        }

        return false;
    }
}
