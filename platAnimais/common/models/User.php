<?php

declare(strict_types=1);

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Modelo de utilizador.
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $password password apenas de escrita
 */
class User extends ActiveRecord implements IdentityInterface
{
    public const STATUS_DELETED = 0;
    public const STATUS_INACTIVE = 9;
    public const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%user}}';
    }

    public function getPerfil()
    {
        return $this->hasOne(Perfil::class, ['utilizador_id' => 'id']);
    }
    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): User|null
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null): never
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Procura um utilizador pelo nome de utilizador.
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername(string $username): User|null
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Procura um utilizador pelo token de reposicao de password.
     *
     * @param string $token token de reposicao de password
     * @return static|null
     */
    public static function findByPasswordResetToken(string $token): User|null
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Procura um utilizador pelo token de verificacao de email.
     *
     * @param string $token token de verificacao de email
     * @return static|null
     */
    public static function findByVerificationToken(string $token): User|null
    {
        return static::findOne(
            [
                'verification_token' => $token,
                'status' => self::STATUS_INACTIVE,
            ],
        );
    }

    /**
     * Verifica se o token de reposicao de password e valido.
     *
     * @param string|null $token token de reposicao de password
     * @return bool
     */
    public static function isPasswordResetTokenValid(string|null $token): bool
    {
        if ($token === null || $token === '') {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);

        $expire = Yii::$app->params['user.passwordResetTokenExpire'];

        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Valida a password.
     *
     * @param string $password password a validar
     * @return bool indica se a password fornecida e valida para o utilizador atual
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Gera o hash da password e atribui-o ao modelo.
     *
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Gera a chave de autenticacao "remember me".
     */
    public function generateAuthKey(): void
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Gera um novo token de reposicao de password.
     */
    public function generatePasswordResetToken(): void
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Gera um novo token para verificacao de email.
     */
    public function generateEmailVerificationToken(): void
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Remove o token de reposicao de password.
     */
    public function removePasswordResetToken(): void
    {
        $this->password_reset_token = null;
    }
}
