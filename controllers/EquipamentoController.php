<?php

namespace app\controllers;

use Yii;
use app\models\Equipamento;
use app\models\EquipamentoSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EquipamentoController implements the CRUD actions for Equipamento model.
 */
class EquipamentoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new EquipamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEquipamentos()
    {
        $query = Equipamento::find();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 4,
        ]);

        $equipamentos = $query->orderBy('nome')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('equipamentos', [
            'equipamentos' => $equipamentos,
            'pagination' => $pagination,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model_equipamento = new Equipamento();
        $session = Yii::$app->session;

        if ($model_equipamento->load(Yii::$app->request->post())) {

            $model_equipamento->image_file =
                UploadedFile::getInstance($model_equipamento, 'image_file');

            if ($model_equipamento->upload() && $model_equipamento->save()) {
                $session->addFlash('success', 'Equipamento registrado com sucesso !');
                return $this->redirect(['view', 'id' => $model_equipamento->id]);
            } else {
                $session->addFlash('error', 'Não foi possível registrar o equipamento.');
            }
        }

        return $this->render('create', [
            'model' => $model_equipamento,
        ]);
    }

    public function actionUpdate($id)
    {
        $model_equipamento = $this->findModel($id);
        $session = Yii::$app->session;
        $post = Yii::$app->request->post();

        if ($model_equipamento->load($post)) {

            $model_equipamento->image_file =
                UploadedFile::getInstance($model_equipamento, 'image_file');

            if ($model_equipamento->upload() && $model_equipamento->save())
                $session->addFlash('success', 'Equipamento atualizado com sucesso !');
            else
                $session->addFlash('error', 'Não foi possível atualizar o equipamento.');
        }

        return $this->redirect(['view', 'id' => $model_equipamento->id]);
    }

    public function actionDelete($id)
    {
        $model_equipamento = $this->findModel($id);
        $session = Yii::$app->session;

        foreach ($model_equipamento->exercicios as $exercicio)
            $exercicio->delete();

        if ($model_equipamento->delete())
            $session->addFlash('success', 'Equipamento excluído com sucesso !');
        else
            $session->addFlash('error', 'Não foi possível excluir o equipamento.');

        return $this->redirect(['equipamentos']);
    }

    public function actionDefeito($id)
    {
        $equipamento = $this->findModel($id);
        $equipamento->defeito = $equipamento->defeito ? false : true;
        $session = Yii::$app->session;

        if ($equipamento->save(false))
            $session->addFlash('success', 'Operação realizada com sucesso !');
        else
            $session->addFlash('error', 'Não foi possível efetuar esta operação.');

        return $this->redirect(['view', 'id' => $equipamento->id]);
    }


    protected function findModel($id)
    {
        if (($model = Equipamento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
