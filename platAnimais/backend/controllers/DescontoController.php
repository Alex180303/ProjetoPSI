<?php

namespace backend\controllers;

use common\models\Desconto;
use backend\models\DescontoSearch;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Controlador CRUD de Descontos no backend.
 *
 * Gere regras/registos de descontos do sistema (configuração).
 * Acesso limitado a utilizadores com permissão de configuração do sistema.
 */
class DescontoController extends Controller
{
    /**
     * @inheritDoc
     *
     * - AccessControl: requer CONFIGURAR_SISTEMA para todas as ações.
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
                        ['allow' => true, 'roles' => ['configurarSistema']],
                    ],
                ],
            ]
        );
    }

    /**
     * Lista descontos com filtros de pesquisa.
     */
    public function actionIndex()
    {
        $searchModel = new DescontoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Mostra detalhes de um desconto.
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
     * Cria um novo desconto.
     */
    public function actionCreate()
    {
        $model = new Desconto();

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
     * Atualiza um desconto existente.
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
     * Remove um desconto.
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
     * Carrega o modelo Desconto pelo ID ou lança 404.
     *
     * @param int $id ID
     * @return Desconto
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Desconto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}