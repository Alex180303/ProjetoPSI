<?php

declare(strict_types=1);

namespace frontend\controllers;

use common\models\LoginForm;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\captcha\CaptchaAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\mail\MailerInterface;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

/**
 * Controlador principal do frontend (site público e área de utilizador).
 *
 * Responsável por páginas públicas (home, about, faq, contacto), autenticação
 * (login/logout), registo, verificação de email e recuperação de password.
 *
 * Integra RBAC através de AccessControl (ex.: permissões para registar conta e consultar associações)
 * e utiliza formulários/modelos do frontend para validar e processar dados submetidos pelo utilizador.
 */
class SiteController extends Controller
{
    /**
     * Injeta o serviço de envio de email para ser usado nas ações que enviam notificações/mensagens.
     */
    public function __construct(
        $id,
        $module,
        private readonly MailerInterface $mailer,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     *
     * Define filtros de comportamento:
     * - AccessControl: regras de acesso por ação (RBAC/permissões e utilizadores autenticados).
     * - VerbFilter: restringe métodos HTTP permitidos (ex.: logout apenas via POST).
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                // Apenas estas ações são alvo das regras abaixo; as restantes ficam acessíveis por omissão.
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        // Registo: permitido a utilizadores com a permissão REGISTAR_CONTA (tipicamente visitantes).
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        // Logout: apenas utilizadores autenticados ('@').
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    // Evita logout por GET (proteção básica contra CSRF/ações acidentais).
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     *
     * Declara ações independentes fornecidas por classes do Yii:
     * - error: renderização centralizada de erros;
     * - captcha: geração/validação de captcha em formulários.
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
            'captcha' => [
                'class' => CaptchaAction::class,
                // Código fixo em ambiente de testes para facilitar automação.
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Página inicial (homepage) do frontend.
     *
     * Usa um layout específico (`main-home`) para a apresentação da landing page.
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /**
     * Autentica um utilizador com base nas credenciais submetidas.
     *
     * Se já estiver autenticado, redireciona para a home.
     * Em caso de sucesso no login, volta para a página anterior (goBack).
     */
    public function actionLogin(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        // Carrega dados do POST e tenta autenticar.
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        // Limpa a password antes de reenviar o formulário para a view (segurança/UX).
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Termina a sessão do utilizador autenticado e redireciona para a home.
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Página de contacto.
     *
     * Valida o formulário e envia email através do mailer configurado; mostra mensagens flash
     * com o resultado da operação.
     */
    public function actionContact(): string|Response
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Envia email para o administrador usando remetente definido nos parâmetros.
            $sent = $model->sendEmail(
                $this->mailer,
                Yii::$app->params['adminEmail'],
                Yii::$app->params['senderEmail'],
                Yii::$app->params['senderName'],
            );

            if ($sent) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Página "Sobre" / informações sobre associações (sujeita a permissão configurada em behaviors).
     */
    public function actionAbout(): string
    {
        return $this->render('about');
    }

    /**
     * Registo de novo utilizador.
     *
     * Em caso de sucesso, cria/regista a conta (conforme lógica do SignupForm) e envia email de verificação.
     */
    public function actionSignup(): string|Response
    {
        $model = new SignupForm();

        // Carrega e processa o registo; o modelo pode também enviar o email de verificação.
        $signed = $model->load(Yii::$app->request->post()) && $model->signup(
            $this->mailer,
            Yii::$app->params['supportEmail'],
            Yii::$app->name,
        );

        if ($signed) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Solicita envio de email para reposição de password.
     */
    public function actionRequestPasswordReset(): string|Response
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sent = $model->sendEmail(
                $this->mailer,
                Yii::$app->params['supportEmail'],
                Yii::$app->name,
            );

            if ($sent) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Define uma nova password a partir de um token de reposição válido.
     *
     * @param string $token Token recebido por email.
     * @throws BadRequestHttpException Se o token for inválido/expirado.
     */
    public function actionResetPassword(string $token): string|Response
    {
        try {
            // O modelo valida o token no construtor; token inválido gera exceção.
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verifica o email do utilizador através do token enviado no registo.
     *
     * @param string $token Token de verificação.
     * @throws BadRequestHttpException Se o token for inválido.
     */
    public function actionVerifyEmail(string $token): Response
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->verifyEmail()) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Reenvia o email de verificação para contas ainda não verificadas.
     */
    public function actionResendVerificationEmail(): string|Response
    {
        $model = new ResendVerificationEmailForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sent = $model->sendEmail(
                $this->mailer,
                Yii::$app->params['supportEmail'],
                Yii::$app->name,
            );

            if ($sent) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model,
        ]);
    }

    /**
     * Página de perguntas frequentes (FAQ).
     */
    public function actionFaq(): string
    {
        return $this->render('faq');
    }

    /**
     * Página/formulário para anunciar um animal (vista estática/formulário no frontend).
     */
    public function actionAnunciarAnimal(): string
    {
        return $this->render('anunciarAnimal');
    }
}