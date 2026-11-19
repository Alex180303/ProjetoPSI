<?php

namespace backend\controllers;

use common\models\FichaClinica;
use backend\models\FichaClinicaSearch;
use common\rbac\Rbac;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Controlador CRUD de Fichas Clínicas no backend.
 *
 * Gere registos clínicos/saúde associados aos animais.
 * O acesso é diferenciado por ação: consulta exige SAUDE_CONSULTAR; criação/edição/remoção exigem SAUDE_GERIR_PROPRIOS.
 */
class FichaClinicaController extends Controller
{
    /**
     * @inheritDoc
     *
     * - AccessControl: regras RBAC distintas para leitura e escrita.
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
                            // Leitura: listagem e visualização de fichas clínicas.
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            'permissions' => [Rbac::SAUDE_CONSULTAR],
                        ],
                        [
                            // Escrita: criar, atualizar e eliminar fichas clínicas (contexto dos próprios registos, conforme regra de negócio/permissão).
                            'allow' => true,
                            'actions' => ['create', 'update', 'delete'],
                            'permissions' => [Rbac::SAUDE_GERIR_PROPRIOS],
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

    /** Lista fichas clínicas com pesquisa/filtros. */
    public function actionIndex()
    {
        $searchModel = new FichaClinicaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** Mostra detalhes de uma ficha clínica. @throws NotFoundHttpException */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /** Cria uma nova ficha clínica. */
    public function actionCreate()
    {
        $model = new FichaClinica();

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

    /** Atualiza uma ficha clínica existente. @throws NotFoundHttpException */
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

    /** Remove uma ficha clínica. @throws NotFoundHttpException */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /** Procura o modelo FichaClinica por ID ou lança 404. */
    protected function findModel($id)
    {
        if (($model = FichaClinica::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}