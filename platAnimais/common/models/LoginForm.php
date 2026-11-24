<?php

declare(strict_types=1);

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Formulario de login.
 */
class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';
    public bool $rememberMe = true;
    private User|null $_user = null;
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            // O email é obrigatório
            ['email', 'required', 'message' => 'O email é obrigatório.'],

            // Verifica se o valor tem um formato de email válido
            ['email', 'email', 'message' => 'Indica um endereço de email válido.'],

            // A palavra-passe é obrigatória
            ['password', 'required', 'message' => 'A palavra-passe é obrigatória.'],

            // Valida a opção de manter a sessão iniciada
            ['rememberMe', 'boolean'],

            // Confirma se a palavra-passe corresponde à conta encontrada pelo email
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Valida a password.
     * Este metodo serve como validacao inline para a password.
     *
     * @param string $attribute o atributo que esta a ser validado
     * @param array $params pares nome-valor adicionais fornecidos na regra
     */
    public function validatePassword(string $attribute, array|null $params): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Autentica um utilizador com o nome de utilizador/email e a password fornecidos.
     *
     * @return bool indica se o utilizador iniciou sessao com sucesso
     */
    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            {
                if (!Yii::$app->addError('username', 'nao tem permissao para aceder ao backend.'));
                return false;
            }
        }

        return false;
    }

    /**
     * Procura o utilizador associado ao identificador fornecido.
     *
     * @return User|null
     */
    protected function getUser(): User|null
    {
        if ($this->_user === null) {
            $this->_user = User::findOne([
                'email' => $this->email,
                'status' => User::STATUS_ACTIVE,
            ]);
        }

        return $this->_user;
    }

}
