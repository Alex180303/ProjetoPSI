<?php

namespace backend\controllers;

use common\models\Especie;
use backend\models\EspecieSearch;
use common\rbac\Rbac;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Controlador CRUD de Espécies no backend.
 *
 * Gere o catálogo de espécies de animais.
 * Acesso restrito por RBAC à permissão de gestão de catálogo.
 */
class EspecieController extends Controller
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

    /** Lista espécies com pesquisa/filtros. */
    public function actionIndex()
    {
        $searchModel = new EspecieSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** Mostra detalhes de uma espécie. @throws NotFoundHttpException */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /** Cria uma nova espécie. */
    public function actionCreate()
    {
        $model = new Especie();

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

    /** Atualiza uma espécie existente. @throws NotFoundHttpException */
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

    /** Remove uma espécie. @throws NotFoundHttpException */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /** Procura o modelo Especie por ID ou lança 404. */
    protected function findModel($id)
    {
        if (($model = Especie::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}