<?php

namespace app\controllers;


use app\filters\AuthSuap;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\LoginSuapForm;
use app\models\Pessoa;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['login']);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
//    public function actionLogin()
//    {
//        $this->layout = 'login';
//
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginSuapForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        }
//
//        //$model->password = '';
//        $model->senha = '';
//        return $this->render('login', [
//            'model' => $model,
//        ]);
//    }

    public function actionLogin()
    {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return Yii::$app->user->can('crud-instrutor') ?
                $this->redirect(['pessoa/instrutores']) :
                $this->redirect(['pessoa/usuarios']);
        }

        $session = Yii::$app->session;
        $post = Yii::$app->request->post();
        $login_suap = new LoginSuapForm();

        if ($login_suap->load($post) && $login_suap->validate()) {

            $token = $login_suap->autenticarUsuario();

            if (!$token) {

                $session->addFlash(
                    'autenticacao_error',
                    'Matrícula ou senha inválida.'
                );
            } else if ($this->salvarToken($token, $login_suap->matricula)
                && $login_suap->login($token)) {
                //$session->set('token', $token);
                return Yii::$app->user->can('crud-instrutor') ?
                    $this->redirect(['pessoa/instrutores']) :
                    $this->redirect(['pessoa/usuarios']);
            }

        }

        return $this->render('login', [
            'model' => $login_suap,
        ]);
    }


    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    protected function salvarToken($token, $matricula)
    {
        $usuario = Pessoa::findByMatricula($matricula);

        if (is_null($usuario)) {
            return false;
        }

        $usuario->token = $token;
        $usuario->save();

        return $usuario;
    }

}
