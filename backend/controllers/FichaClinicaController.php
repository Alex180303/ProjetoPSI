<?php

namespace backend\controllers;

use common\models\Animal;
use common\models\FichaClinica;
use backend\models\FichaClinicaSearch;
use common\rbac\Rbac;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FichaClinicaController implements the CRUD actions for FichaClinica model.
 */
class FichaClinicaController extends Controller
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
                            'actions' => ['index', 'view'],
                            'permissions' => [Rbac::SAUDE_GERIR_PROPRIOS],
                        ],
                        [
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

    /**
     * Lists all FichaClinica models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FichaClinicaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if (!$this->isAdmin()) {
            $dataProvider->query
                ->joinWith('animal')
                ->andWhere(Animal::ownedByCondition((int) Yii::$app->user->id));
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FichaClinica model.
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
     * Creates a new FichaClinica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new FichaClinica();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (!$this->isAdmin() && !$this->ownsAnimal((int) $model->animal_id)) {
                    $model->addError('animal_id', 'Só pode criar fichas para animais seus.');
                } elseif ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FichaClinica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if (!$this->isAdmin() && !$this->ownsAnimal((int) $model->animal_id)) {
                $model->addError('animal_id', 'Só pode gerir fichas de animais seus.');
            } elseif ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FichaClinica model.
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
     * Finds the FichaClinica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return FichaClinica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $query = FichaClinica::find()->where(['ficha_clinica.id' => $id]);

        if (!$this->isAdmin()) {
            $query->joinWith('animal')
                ->andWhere(Animal::ownedByCondition((int) Yii::$app->user->id));
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
     * Indica se o animal pertence ao utilizador atual.
     */
    private function ownsAnimal(int $animalId): bool
    {
        return Animal::find()
            ->where(['animal.id' => $animalId])
            ->andWhere(Animal::ownedByCondition((int) Yii::$app->user->id))
            ->exists();
    }
}
