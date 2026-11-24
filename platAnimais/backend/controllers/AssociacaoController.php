<?php

namespace backend\controllers;

use common\models\Associacao;
use backend\models\AssociacaoSearch;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Controlador CRUD de Associações no backend.
 *
 * Gere o catálogo de associações (instituições/parceiros) no sistema.
 * Acesso restrito por RBAC à permissão de gestão de catálogo.
 */
class AssociacaoController extends Controller
{
    /**
     * @inheritDoc
     *
     * - AccessControl: apenas utilizadores com GERIR_CATALOGO podem aceder às ações.
     * - VerbFilter: eliminações apenas via POST.
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        ['allow' => true, 'roles' => ['gerirCatalogo']],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lista associações com pesquisa e paginação.
     */
    public function actionIndex()
    {
        $searchModel = new AssociacaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Apresenta os detalhes de uma associação.
     *
     * @param int $id ID
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Cria uma nova associação.
     */
    public function actionCreate()
    {
        $model = new Associacao();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Atualiza uma associação existente.
     *
     * @param int $id ID
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Remove uma associação.
     *
     * @param int $id ID
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Obtém o modelo Associacao pelo ID ou lança 404.
     *
     * @param int $id ID
     * @return Associacao
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}