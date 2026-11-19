<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\models\LoginForm;
use common\rbac\Rbac;
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
                        // Ações acessíveis sem autenticação (página de login e página de erro).
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // Apenas utilizadores autenticados podem terminar sessão.
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        // Acesso ao dashboard do backoffice condicionado por permissão RBAC.
                        'actions' => ['index'],
                        'allow' => true,
                        'permissions' => [Rbac::BACKOFFICE_ACEDER],
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
            return $this->goBack();
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