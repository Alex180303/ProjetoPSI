<?php

namespace backend\controllers;

use common\models\Porte;
use backend\models\PorteSearch;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Controlador CRUD de Portes no backend.
 *
 * Gere o catálogo de portes/tamanhos de animais.
 * Acesso restrito por RBAC à permissão de gestão de catálogo.
 */
class PorteController extends Controller
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

    /** Lista portes com pesquisa/filtros. */
    public function actionIndex()
    {
        $searchModel = new PorteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** Mostra detalhes de um porte. @throws NotFoundHttpException */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /** Cria um novo porte. */
    public function actionCreate()
    {
        $model = new Porte();

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

    /** Atualiza um porte existente. @throws NotFoundHttpException */
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

    /** Remove um porte. @throws NotFoundHttpException */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /** Procura o modelo Porte por ID ou lança 404. */
    protected function findModel($id)
    {
        if (($model = Porte::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}