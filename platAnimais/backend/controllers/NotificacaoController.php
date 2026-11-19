<?php

namespace backend\controllers;

use common\models\Notificacao;
use backend\models\NotificacaoSearch;
use common\rbac\Rbac;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Controlador CRUD de Notificações no backend.
 *
 * Gere notificações do sistema (criação, consulta e manutenção).
 * Acesso restrito à permissão de configuração do sistema.
 */
class NotificacaoController extends Controller
{
    /**
     * @inheritDoc
     *
     * - AccessControl: requer CONFIGURAR_SISTEMA.
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
                            'permissions' => [Rbac::CONFIGURAR_SISTEMA],
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

    /** Lista notificações com pesquisa/filtros. */
    public function actionIndex()
    {
        $searchModel = new NotificacaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** Mostra detalhes de uma notificação. @throws NotFoundHttpException */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /** Cria uma nova notificação. */
    public function actionCreate()
    {
        $model = new Notificacao();

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

    /** Atualiza uma notificação existente. @throws NotFoundHttpException */
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

    /** Remove uma notificação. @throws NotFoundHttpException */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /** Procura o modelo Notificacao por ID ou lança 404. */
    protected function findModel($id)
    {
        if (($model = Notificacao::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}