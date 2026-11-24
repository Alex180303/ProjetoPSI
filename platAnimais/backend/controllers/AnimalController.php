<?php

namespace backend\controllers;

use common\models\Animal;
use yii\web\ForbiddenHttpException;
use Yii;
use backend\models\AnimalSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Controlador CRUD de Animais no backend.
 *
 * Gere listagem, visualização, criação, edição e remoção de registos de animais.
 * O acesso é controlado por RBAC com permissões distintas por ação (consultar, publicar, gerir todos).
 */
class AnimalController extends Controller
{
    /**
     * @inheritDoc
     *
     * Define comportamentos (behaviors) do controlador:
     * - VerbFilter: restringe métodos HTTP por ação (ex.: delete apenas via POST).
     * - AccessControl: aplica regras RBAC por ação e define tratamento customizado em caso de acesso negado.
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        // Protege a eliminação contra pedidos GET acidentais/maliciosos.
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'access' => [
                        'class' => AccessControl::class,
                        'rules' => [
                            ['allow' => true, 'roles' => ['@']],
                        ],
                    ],
                ]
            ]
        );
    }

    /**
     * Lista todos os modelos Animal (com filtros/paginação via AnimalSearch).
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->can('consultarAnimal')) {
            throw new ForbiddenHttpException('Não tens permissão.');
        }
        $searchModel = new AnimalSearch();
        // Aplica parâmetros de pesquisa da query string ao data provider.
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Mostra os detalhes de um único modelo Animal.
     *
     * @param int $id ID do registo.
     * @return string
     * @throws NotFoundHttpException se o modelo não existir.
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->can('consultarAnimal')) {
            throw new ForbiddenHttpException('Não tens permissão.');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Cria um novo registo de Animal.
     *
     * Se o formulário for submetido e validado com sucesso, redireciona para a página de detalhe.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can('criarAnimal')) {
            throw new ForbiddenHttpException('Não tens permissão.');
        }
        $model = new Animal();

        if ($this->request->isPost) {
            // Carrega dados do POST e guarda na BD; em sucesso, redireciona para view.
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            // Em GET, inicializa valores por defeito definidos no modelo/tabela.
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Atualiza um registo existente de Animal.
     *
     * @param int $id ID do registo.
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException se o modelo não existir.
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can('editarQualquerAnimal')) {
            throw new ForbiddenHttpException('Não tens permissão.');
        }
        $model = $this->findModel($id);

        // Em POST com dados válidos, guarda alterações e redireciona para a view.
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Elimina um registo de Animal.
     *
     * Após apagar, redireciona para a listagem.
     *
     * @param int $id ID do registo.
     * @return \yii\web\Response
     * @throws NotFoundHttpException se o modelo não existir.
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can('eliminarQualquerAnimal')) {
            throw new ForbiddenHttpException('Não tens permissão.');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Procura o modelo Animal pelo ID (chave primária).
     *
     * Método auxiliar usado pelas ações view/update/delete para garantir que o registo existe.
     *
     * @param int $id ID do registo.
     * @return Animal Modelo carregado.
     * @throws NotFoundHttpException se não for encontrado.
     */
    protected function findModel($id)
    {
        if (($model = Animal::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}