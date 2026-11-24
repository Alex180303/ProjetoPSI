<?php

declare(strict_types=1);

namespace common\bootstrap;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

/**
 * Regista o componente de email da aplicacao como singleton do contentor de DI para {@see MailerInterface}.
 *
 * O Codeception substitui `components.mailer` pelo seu proprio TestMailer para capturar emails enviados.
 *
 * Como o contentor de DI e configurado antes do mock do mailer, este bootstrap garante que o singleton do DI
 * resolve para a mesma instancia de mailer usada pela aplicacao.
 */
final class MailerBootstrap implements BootstrapInterface
{
    /**
     * @param Application $app Instancia da aplicacao.
     */
    public function bootstrap($app): void
    {
        Yii::$container->setSingleton(MailerInterface::class, $app->mailer);
    }
}
