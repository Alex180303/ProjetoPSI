<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\User;
use common\rbac\Rbac;
use Yii;
use yii\base\Model;
use yii\mail\MailerInterface;

/**
 * Formulario de registo.
 */
class SignupForm extends Model
{
    public string $username = '';
    public string $email = '';
    public string $password = '';
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Regista um novo utilizador.
     *
     * @param MailerInterface $mailer componente de envio de email.
     * @param string $supportEmail endereco de email de suporte.
     * @param string $appName nome da aplicacao.
     *
     * @return bool|null indica se a criacao da conta teve sucesso e se o email foi enviado.
     */
    public function signup(MailerInterface $mailer, string $supportEmail, string $appName): bool|null
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();

        $user->username = $this->username;
        $user->email = $this->email;

        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        if (!$user->save()) {
            return false;
        }

        // Todo o novo registo começa como adotante. Um administrador pode
        // depois atribuir o papel de anunciante/associação com
        // `yii rbac/assign <username> anunciante`.
        $auth = Yii::$app->authManager;
        $adotante = $auth->getRole('adotante');
        if ($adotante !== null) {
            $auth->assign($adotante, $user->getId());
        }
        return true;

//        return $this->sendEmail($mailer, $user, $supportEmail, $appName);
    }

    /**
     * Envia o email de confirmacao ao utilizador.
     *
     * @param MailerInterface $mailer componente de envio de email.
     * @param User $user modelo do utilizador para quem o email deve ser enviado.
     * @param string $supportEmail endereco de email de suporte.
     * @param string $appName nome da aplicacao.
     *
     * @return bool indica se o email foi enviado.
     */
    protected function sendEmail(MailerInterface $mailer, User $user, string $supportEmail, string $appName): bool
    {
        return $mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user],
            )
            ->setFrom([$supportEmail => $appName . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . $appName)
            ->send();
    }
}
