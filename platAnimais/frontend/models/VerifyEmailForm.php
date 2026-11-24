<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\User;
use yii\base\InvalidArgumentException;
use yii\base\Model;

class VerifyEmailForm extends Model
{
    private User|null $_user = null;
    /**
     * Cria um modelo de formulario com o token fornecido.
     *
     * @param string $token
     * @param array $config pares nome-valor usados para inicializar as propriedades do objeto
     * @throws InvalidArgumentException se o token estiver vazio ou for invalido
     */
    public function __construct(string $token, array $config = [])
    {
        if ($token === '') {
            throw new InvalidArgumentException('Verify email token cannot be blank.');
        }

        $this->_user = User::findByVerificationToken($token);

        if ($this->_user === null) {
            throw new InvalidArgumentException('Wrong verify email token.');
        }

        parent::__construct($config);
    }

    /**
     * Verifica o email.
     *
     * @return User|null o modelo guardado ou null se a gravacao falhar
     */
    public function verifyEmail(): User|null
    {
        $user = $this->_user;

        $user->status = User::STATUS_ACTIVE;

        return $user->save(false) ? $user : null;
    }
}
