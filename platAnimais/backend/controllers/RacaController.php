<?php

namespace backend\controllers;

use common\models\Raca;
use backend\models\RacaSearch;
use common\rbac\Rbac;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Controlador CRUD de Raças no backend.
 *
 * Gere o catálogo de raças de animais.
 * Acesso restrito por RBAC à permissão de gestão de catálogo.
 */
class RacaController extends Controller
{
    /**
     * @inheritDoc
     *
     * - AccessControl: requer GERIR_CATALOGO.
     * - VerbFilter: delete apenas via POST.
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'permissions' => [Rbac::GERIR_CATALOGO],
                        ],
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

    /** Lista raças com pesquisa/filtros. */
    public function actionIndex()
    {
        $searchModel = new RacaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** Mostra detalhes de uma raça. @throws NotFoundHttpException */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /** Cria uma nova raça. */
    public function actionCreate()
    {
        $model = new Raca();

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

    /** Atualiza uma raça existente. @throws NotFoundHttpException */
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

    /** Remove uma raça. @throws NotFoundHttpException */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /** Procura o modelo Raca por ID ou lança 404. */
    protected function findModel($id)
    {
        if (($model = Raca::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}