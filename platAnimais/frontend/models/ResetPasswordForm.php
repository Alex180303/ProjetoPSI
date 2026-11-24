<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\User;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;

/**
 * Formulario de reposicao de password.
 */
class ResetPasswordForm extends Model
{
    public string $password = '';
    private User|null $_user = null;
    /**
     * Cria um modelo de formulario a partir de um token.
     *
     * @param string $token
     * @param array $config pares nome-valor usados para inicializar as propriedades do objeto
     * @throws InvalidArgumentException se o token estiver vazio ou for invalido
     */
    public function __construct(string $token, array $config = [])
    {
        if ($token === '') {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Repõe a password.
     *
     * @return bool indica se a password foi reposta.
     */
    public function resetPassword(): bool
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        $user->generateAuthKey();

        return $user->save(false);
    }
}
