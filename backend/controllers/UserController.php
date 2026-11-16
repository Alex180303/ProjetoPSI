<?php

namespace backend\controllers;

use backend\models\UserForm;
use backend\models\UserSearch;
use common\models\User;
use common\rbac\Rbac;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implementa a gestão de utilizadores (CRUD + eliminação lógica).
 *
 * - Acesso restrito a quem tem a permissão Rbac::UTILIZADOR_GERIR.
 * - A "eliminação" é lógica: passa o utilizador a status = User::STATUS_DELETED (0),
 *   pelo que continua a ser visível na listagem e pode ser reativado.
 * - A atribuição de papéis (adotante, anunciante, admin) é feita via RBAC.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
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
                            'permissions' => [Rbac::UTILIZADOR_GERIR],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'restore' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lista todos os utilizadores (incluindo os eliminados).
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Mostra os dados de um único utilizador.
     *
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Cria um novo utilizador e atribui os papéis selecionados.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserForm();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Utilizador criado com sucesso.');

            return $this->redirect(['view', 'id' => $model->getUser()->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Edita um utilizador existente (palavra-passe opcional) e os seus papéis.
     *
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $model = new UserForm($user);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Utilizador atualizado com sucesso.');

            return $this->redirect(['view', 'id' => $user->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Elimina logicamente um utilizador (status = STATUS_DELETED).
     *
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = User::STATUS_DELETED;
        $model->save(false);

        Yii::$app->session->setFlash('success', 'Utilizador eliminado (eliminação lógica).');

        return $this->redirect(['index']);
    }

    /**
     * Reativa um utilizador eliminado (status = STATUS_ACTIVE).
     *
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        $model->status = User::STATUS_ACTIVE;
        $model->save(false);

        Yii::$app->session->setFlash('success', 'Utilizador reativado.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        // Procura em todos os estados para que contas eliminadas possam ser
        // consultadas, editadas e reativadas.
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('O utilizador pedido não existe.');
    }
}
