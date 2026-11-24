<?php

declare(strict_types=1);

namespace frontend\models;

use yii\base\Model;
use yii\mail\MailerInterface;

/**
 * ContactForm e o modelo por tras do formulario de contacto.
 */
class ContactForm extends Model
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $body = '';
    public string $verifyCode = '';
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            // nome, email, assunto e mensagem sao obrigatorios
            [['name', 'email', 'subject', 'body'], 'required'],
            // o email tem de ter um formato valido
            ['email', 'email'],
            // o codigo de verificacao tem de ser introduzido corretamente
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Envia um email para o endereco indicado usando a informacao recolhida por este modelo.
     *
     * @param MailerInterface $mailer componente de envio de email.
     * @param string $email endereco de email de destino.
     * @param string $senderEmail endereco de email do remetente.
     * @param string $senderName nome do remetente.
     *
     * @return bool indica se o email foi enviado.
     */
    public function sendEmail(MailerInterface $mailer, string $email, string $senderEmail, string $senderName): bool
    {
        return $mailer->compose()
            ->setTo($email)
            ->setFrom([$senderEmail => $senderName])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
