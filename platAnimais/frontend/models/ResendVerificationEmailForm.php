<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\mail\MailerInterface;

class ResendVerificationEmailForm extends Model
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
                'filter' => ['status' => User::STATUS_INACTIVE],
                'message' => 'There is no user with this email address.',
            ],
        ];
    }

    /**
     * Envia o email de confirmacao ao utilizador.
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
            'email' => $this->email,
            'status' => User::STATUS_INACTIVE,
        ]);

        if ($user === null) {
            return false;
        }

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
