<?php

declare(strict_types=1);

namespace backend\models;

/**
 * Formulário de autenticação do back-office.
 *
 * Reutiliza a lógica de autenticação do modelo comum, mas apresenta os
 * rótulos e as mensagens de erro em português, tal como o resto da área de
 * gestão da plataforma.
 */
final class LoginForm extends \common\models\LoginForm
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['username', 'password'], 'required', 'message' => 'Preencha este campo.'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'username' => 'Nome de utilizador',
            'password' => 'Palavra-passe',
            'rememberMe' => 'Manter sessão iniciada',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function validatePassword(string $attribute, array|null $params): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Nome de utilizador ou palavra-passe incorretos.');
            }
        }
    }
}
