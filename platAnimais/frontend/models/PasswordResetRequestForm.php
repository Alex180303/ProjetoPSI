<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\mail\MailerInterface;

/**
 * Formulario de pedido de reposicao de password.
 */
class PasswordResetRequestForm extends Model
{
    public string $email = '';
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::class,
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.',
            ],
        ];
    }

    /**
     * Envia um email com uma ligacao para repor a password.
     *
     * @param MailerInterface $mailer componente de envio de email.
     * @param string $supportEmail endereco de email de suporte.
     * @param string $appName nome da aplicacao.
     *
     * @return bool indica se o email foi enviado.
     */
    public function sendEmail(MailerInterface $mailer, string $supportEmail, string $appName): bool
    {
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        return $mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user],
            )
            ->setFrom([$supportEmail => $appName . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . $appName)
            ->send();
    }
}
