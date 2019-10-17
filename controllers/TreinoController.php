<?php

namespace app\controllers;

use Yii;
use app\models\Exercicio;
use app\models\TreinoExercicio;
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
                    'update-numero-repeticao' => ['POST'],
                    'add-exercicio' => ['POST'],
                    'remove-exercicio' => ['POST'],
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
        $exercicios = Exercicio::find()->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'exercicios' => $exercicios
        ]);
    }

    public function actionTreinos($nivel = null)
    {

        $query = is_null($nivel) ?
            Treino::find()->where('generico = 1') :
            Treino::find()->where(
                ['and', 'generico = 1', 'nivel = :nivel'],
                [':nivel' => $nivel]
            );

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
        $post = Yii::$app->request->post();
        $exercicios = Yii::$app->request->post('exercicio', null);
        $session = Yii::$app->session;

        if ($model->load($post)) {
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
        $session = Yii::$app->session;
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->save())
                $session->addFlash('success', 'Treino atualizado com sucesso !');
            else
                $session->addFlash('error', 'Não foi possível atualizar o treino.');
        }

        return $this->redirect(['view', 'id' => $model->id]);
    }


    public function actionAddExercicio($treino_id = null)
    {
        if (is_null($treino_id)) throw new NotFoundHttpException();

        $post = Yii::$app->request->post();
        $session = Yii::$app->session;

        $model_treino_exercicio = new TreinoExercicio();
        $model_treino_exercicio->treino_id = $treino_id;
        $model_treino_exercicio->exercicio_id = $post['add-exercicio-id'];
        $model_treino_exercicio->numero_repeticao = $post['add-exercicio-repeticao'];

        if ($model_treino_exercicio->save())
            $session->addFlash('success', 'Exercício adicionado ao treino !');
        else
            $session->addFlash('error', 'Não possível adicionar o exercício ao treino.');

        return $this->redirect(['view', 'id' => $treino_id]);
    }

    public function actionRemoveExercicio($treino_id, $exercicio_id)
    {
        $model_treino_exercicio = TreinoExercicio::find()->where(
            ['and', 'treino_id = :treino_id', 'exercicio_id = :exercicio_id'],
            [':treino_id' => $treino_id, ':exercicio_id' => $exercicio_id]
        )->one();
        $session = Yii::$app->session;

        if (is_null($model_treino_exercicio)) throw new NotFoundHttpException();

        if ($model_treino_exercicio->delete())
            $session->addFlash('success', 'Exercício removido com sucesso !');
        else
            $session->addFlash('error', 'Não foi possível remover o exercício.');

        return $this->redirect(['view', 'id' => $treino_id]);
    }

    public function actionUpdateNumeroRepeticao($treino_id, $exercicio_id)
    {
        /* @var $model_treino_exercicio TreinoExercicio */
        $model_treino_exercicio = TreinoExercicio::find()->where(
            ['and', 'treino_id = :treino_id', 'exercicio_id = :exercicio_id'],
            [':treino_id' => $treino_id, ':exercicio_id' => $exercicio_id]
        )->one();
        $session = Yii::$app->session;
        $novo_numero_repeticao = Yii::$app->request->post('TreinoExercicio')['numero_repeticao'];

        if (is_null($model_treino_exercicio)) throw new NotFoundHttpException();

        $model_treino_exercicio->numero_repeticao = $novo_numero_repeticao;

        if ($model_treino_exercicio->save())
            $session->addFlash('success', 'Número de repetições atualizado com sucesso !');
        else
            $session->addFlash('error', 'Não foi possível atualizar o número de repetições.');

        return $this->redirect(['view', 'id' => $model_treino_exercicio->treino_id]);
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
