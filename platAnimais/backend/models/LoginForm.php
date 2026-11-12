<?php

declare(strict_types=1);

namespace backend\models;

use common\models\User;
use common\rbac\Rbac;
use Yii;

/**
 * Formulário de autenticação do back-office.
 *
 * Reutiliza a lógica de autenticação do modelo comum, mas autentica pelo
 * nome de utilizador (o modelo comum, usado no frontend, autentica por email)
 * e apresenta os rótulos e as mensagens de erro em português.
 */
final class LoginForm extends \common\models\LoginForm
{
    public string $username = '';

    private User|null $_backendUser = null;

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
                return;
            }

            // Utilizadores só de front-office (ex.: adotantes) não entram no back-office
            if (!Yii::$app->authManager->checkAccess($user->getId(), Rbac::BACKOFFICE_ACEDER)) {
                $this->addError($attribute, 'Não tem permissão para aceder ao back-office.');
            }
        }
    }

    /**
     * Procura o utilizador ativo pelo nome de utilizador.
     * O login() do modelo comum usa este método.
     */
    protected function getUser(): User|null
    {
        if ($this->_backendUser === null) {
            $this->_backendUser = User::findByUsername($this->username);
        }

        return $this->_backendUser;
    }
}