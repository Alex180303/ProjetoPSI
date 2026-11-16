<?php

namespace backend\controllers;

use common\models\Animal;
use common\models\Perfil;
use common\rbac\Rbac;
use Yii;
use backend\models\AnimalSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AnimalController implements the CRUD actions for Animal model.
 */
class AnimalController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            'permissions' => [Rbac::ANIMAL_CONSULTAR],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create'],
                            'permissions' => [Rbac::ANIMAL_PUBLICAR],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['update', 'delete'],
                            'permissions' => [Rbac::ANIMAL_GERIR_TODOS, Rbac::ANIMAL_GERIR_PROPRIOS],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        if (Yii::$app->user->isGuest) {
                            return Yii::$app->response->redirect(['site/login']);
                        }
                        throw new \yii\web\ForbiddenHttpException('Não tens permissão.');
                    },
                ],
            ]
        );
    }

    /**
     * Lists all Animal models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AnimalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if (!$this->isAdmin()) {
            $dataProvider->query->andWhere(Animal::ownedByCondition((int) Yii::$app->user->id));
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Animal model.
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
     * Creates a new Animal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Animal();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $this->applyOwnership($model);
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
            $this->applyOwnership($model);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Animal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $this->applyOwnership($model);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Animal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Animal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Animal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $query = Animal::find()->where(['animal.id' => $id]);

        if (!$this->isAdmin()) {
            $query->andWhere(Animal::ownedByCondition((int) Yii::$app->user->id));
        }

        if (($model = $query->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Indica se o utilizador atual gere todos os animais (admin).
     */
    private function isAdmin(): bool
    {
        return Yii::$app->user->can(Rbac::ANIMAL_GERIR_TODOS);
    }

    /**
     * Impõe a propriedade do animal ao utilizador atual (não-admin).
     */
    private function applyOwnership(Animal $model): void
    {
        if ($this->isAdmin()) {
            return;
        }

        $model->utilizador_id = (int) Yii::$app->user->id;
        $model->associacao_id = Perfil::find()
            ->select('associacao_id')
            ->where(['utilizador_id' => Yii::$app->user->id])
            ->scalar() ?: null;
    }
}
