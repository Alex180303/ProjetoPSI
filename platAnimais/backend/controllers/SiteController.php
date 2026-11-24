<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\models\LoginForm;
use yii\web\ForbiddenHttpException;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

/**
 * Controlador principal do backend (backoffice).
 *
 * Gere o acesso à área administrativa:
 * - página de erro;
 * - login/logout;
 * - dashboard inicial (index), protegido por permissão RBAC.
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     *
     * Configura filtros de acesso e métodos HTTP:
     * - `login` e `error` são públicos;
     * - `logout` requer utilizador autenticado e deve ser feito por POST;
     * - `index` requer a permissão BACKOFFICE_ACEDER.
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['acederBackoffice'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    // Logout apenas via POST para reduzir risco de chamadas acidentais/maliciosas por GET.
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     *
     * Usa a ação padrão de erro do Yii para renderizar falhas/exceções HTTP na interface.
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * Apresenta a página inicial (dashboard) do backoffice.
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Processa o login no backend.
     *
     * - Se o utilizador já estiver autenticado, redireciona para a home do backend.
     * - Usa o layout simplificado `main-login`.
     * - Em caso de sucesso, redireciona para a página previamente solicitada (goBack).
     */
    public function actionLogin(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // Layout próprio para ecrãs de autenticação.
        $this->layout = 'main-login';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // Credenciais certas: confirma agora se o papel tem acesso ao backoffice.
            if (Yii::$app->user->can('acederBackoffice')) {
                return $this->goBack();
            }

            // Sem permissão: termina a sessão que acabou de ser criada.
            Yii::$app->user->logout();
            $model->addError('username', 'Não tens permissão para aceder ao backoffice.');
        }

        // Não reenviar a password para a view.
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Termina a sessão do utilizador no backend.
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}