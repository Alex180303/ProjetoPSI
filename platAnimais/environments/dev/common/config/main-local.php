<?php

return [
    'container' => [
        'singletons' => [
            \yii\mail\MailerInterface::class => [
                'class' => \yii\symfonymailer\Mailer::class,
                'viewPath' => '@common/mail',
                // envia todos os emails para um ficheiro por predefinicao.
                'useFileTransport' => true,
                // Tem de definir
                //
                // 'useFileTransport' => false,
                //
                // e configurar um transporte para o mailer enviar emails reais.
                //
                // Exemplo de servidor SMTP:
                //    'transport' => [
                //        'scheme' => 'smtps',
                //        'host' => '',
                //        'username' => '',
                //        'password' => '',
                //        'port' => 465,
                //        'dsn' => 'native://default',
                //    ],
                //
                // Exemplo de DSN:
                //    'transport' => [
                //        'dsn' => 'smtp://user:pass@smtp.example.com:25',
                //    ],
                //
                // Ver: https://symfony.com/doc/current/mailer.html#using-built-in-transports
                // Ou, se usar um servico de terceiros, consulte:
                // https://symfony.com/doc/current/mailer.html#using-a-3rd-party-transport
            ],
        ],
    ],
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=platanimais',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => \yii\mail\MailerInterface::class,
    ],
];
