<?php

namespace backend\controllers;

use common\models\Adocao;
use backend\models\AdocaoSearch;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Controlador CRUD de Adoções no backend.
 *
 * Permite gerir pedidos/registos de adoção (listar, ver, criar, editar, remover).
 * Acesso protegido por RBAC: requer a permissão para avaliar candidaturas.
 */
class AdocaoController extends Controller
{
    /**
     * @inheritDoc
     *
     * Behaviors:
     * - AccessControl: restringe todas as ações deste controlador a utilizadores com CANDIDATURA_AVALIAR.
     * - VerbFilter: obriga a que a eliminação seja feita via POST.
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        ['allow' => true, 'roles' => ['@']],
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
     * Lista todos os modelos Adocao com suporte a pesquisa/filtros.
     */
    public function actionIndex()
    {
        $searchModel = new AdocaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Mostra os detalhes de um registo de adoção.
     *
     * @param int $id ID
     * @throws NotFoundHttpException se o modelo não existir.
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Cria um novo registo de adoção.
     * Em caso de sucesso, redireciona para a view do registo criado.
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('avaliarCandidatura')) {
            throw new ForbiddenHttpException('Não tens permissão.');
        }
        $model = new Adocao();

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
     * Atualiza um registo de adoção existente.
     *
     * @param int $id ID
     * @throws NotFoundHttpException se o modelo não existir.
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can('avaliarCandidatura')) {
            throw new ForbiddenHttpException('Não tens permissão.');
        }
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Remove um registo de adoção e redireciona para a listagem.
     *
     * @param int $id ID
     * @throws NotFoundHttpException se o modelo não existir.
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('avaliarCandidatura')) {
            throw new ForbiddenHttpException('Não tens permissão.');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Localiza o modelo Adocao pelo ID; lança 404 se não encontrado.
     *
     * @param int $id ID
     * @return Adocao
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Adocao::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}