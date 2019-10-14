<?php

namespace app\controllers;

use app\models\Exercicio;
use app\models\TreinoExercicio;
use Yii;
use app\models\Treino;
use app\models\TreinoSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TreinoController implements the CRUD actions for Treino model.
 */
class TreinoController extends Controller
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

    /**
     * Lists all Treino models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TreinoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionTreinos()
    {
        $query = Treino::find();

        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 6,
        ]);

        $treinos = $query->orderBy('titulo')
                        ->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->all();

        return $this->render('treinos', [
            'treinos' => $treinos,
            'pagination' => $pagination
        ]);
    }

    public function actionCreate()
    {
        $model = new Treino();
        $post =  Yii::$app->request->post();
        $exercicios = Yii::$app->request->post('exercicio', null);
        $session = Yii::$app->session;

        if ($model->load($post)) {
            $model->generico = true;
            if ($model->save()) {
                $session->addFlash('success', 'Treino registrado com sucesso !');

                if ($exercicios !== null)
                    $this->relacionarTreinoExercicio($model, $exercicios);

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $session->addFlash('error', "Não foi possível registra o treino.");
            }
        }

        return $this->render('create', [
            'model' => $model,
            'exercicios' => Exercicio::find()->all(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        // TODO excluir relacionamento com exercícios.
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Treino::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function relacionarTreinoExercicio(Treino $model, array $exercicios) {

        $treino_exercicio = new TreinoExercicio();

        array_walk($exercicios, function ($item, $key) use (
            $model, $treino_exercicio
        ) {
            if (($exercicio_model = Exercicio::findOne($key))) {
                // Clona o objeto para não precisar instanciar um novo.
                $clone_treino_exercicio = clone $treino_exercicio;
                $clone_treino_exercicio->treino_id = $model->id;
                $clone_treino_exercicio->exercicio_id = $exercicio_model->id;
                $clone_treino_exercicio->numero_repeticao = $item;
                return $clone_treino_exercicio->save();
            }
        });
    }
}
