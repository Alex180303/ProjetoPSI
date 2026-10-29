<?php

declare(strict_types=1);

namespace backend\tests\Functional;

use backend\tests\Support\FunctionalTester;
use common\fixtures\UserFixture;

final class LoginCest
{
    public function _fixtures(): array
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
        ];
    }

    public function loginUser(FunctionalTester $I): void
    {
        $I->amOnRoute('/site/login');
        $I->fillField('Nome de utilizador', 'erau');
        $I->fillField('Palavra-passe', 'password_0');
        $I->click('login-button');

        $I->seeLink('Logout (erau)');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
