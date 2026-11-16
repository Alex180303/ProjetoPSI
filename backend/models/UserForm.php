<?php

namespace backend\models;

use common\models\User;
use common\rbac\Rbac;
use Yii;
use yii\base\Model;

/**
 * Formulário de criação/edição de utilizadores do back-office.
 *
 * Centraliza a validação (nome de utilizador, email e palavra-passe) e a
 * atribuição de papéis (RBAC), reutilizando `common\models\User` sem o alterar.
 * É usado tanto no `create` como no `update`: no `create` a palavra-passe é
 * obrigatória; no `update` é opcional (em branco mantém a atual).
 */
class UserForm extends Model
{
    /** @var string */
    public $username = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var int */
    public $status = User::STATUS_ACTIVE;

    /** @var string[] papéis (RBAC) atribuídos ao utilizador */
    public $roles = [];

    /** @var User */
    private $user;

    /**
     * @param User|null $user utilizador a editar; `null` cria um novo.
     * @param array $config
     */
    public function __construct(?User $user = null, $config = [])
    {
        $this->user = $user ?? new User();

        if (!$this->user->isNewRecord) {
            $this->username = (string) $this->user->username;
            $this->email = (string) $this->user->email;
            $this->status = (int) $this->user->status;
            $this->roles = array_keys(Yii::$app->authManager->getRolesByUser($this->user->id));
        }

        parent::__construct($config);
    }

    /**
     * Papéis que podem ser atribuídos a um utilizador no back-office.
     *
     * O papel `visitante` é reservado a visitantes não autenticados e por isso
     * não é atribuível manualmente.
     *
     * @return array<string, string>
     */
    public static function availableRoles()
    {
        return [
            Rbac::ROLE_ADOTANTE => 'Adotante',
            Rbac::ROLE_ANUNCIANTE => 'Anunciante',
            Rbac::ROLE_ADMIN => 'Administrador',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $uniqueFilter = $this->user->isNewRecord ? null : ['<>', 'id', $this->user->id];

        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Preencha este campo.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [
                'username', 'unique',
                'targetClass' => User::class,
                'targetAttribute' => 'username',
                'filter' => $uniqueFilter,
                'message' => 'Este nome de utilizador já está a ser usado.',
            ],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Preencha este campo.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email', 'unique',
                'targetClass' => User::class,
                'targetAttribute' => 'email',
                'filter' => $uniqueFilter,
                'message' => 'Este email já está a ser usado.',
            ],

            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['password', 'required', 'when' => function () {
                return $this->user->isNewRecord;
            }, 'message' => 'Preencha este campo.'],

            ['status', 'in', 'range' => array_keys(UserSearch::statusLabels())],

            ['roles', 'each', 'rule' => ['in', 'range' => array_keys(self::availableRoles())]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Nome de utilizador',
            'email' => 'Email',
            'password' => 'Palavra-passe',
            'status' => 'Estado',
            'roles' => 'Papéis',
        ];
    }

    /**
     * Utilizador (ActiveRecord) associado a este formulário.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Valida e persiste o utilizador, sincronizando depois os papéis no RBAC.
     *
     * @return bool
     */
    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = $this->user;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = (int) $this->status;

        if ($this->password !== '') {
            $user->setPassword($this->password);
        }
        if (empty($user->auth_key)) {
            $user->generateAuthKey();
        }

        if (!$user->save()) {
            return false;
        }

        $auth = Yii::$app->authManager;
        $auth->revokeAll($user->id);
        foreach ($this->roles as $roleName) {
            $role = $auth->getRole($roleName);
            if ($role !== null) {
                $auth->assign($role, $user->id);
            }
        }

        return true;
    }
}
