<?php

declare(strict_types=1);

/**
 * Parâmetros globais partilhados (common).
 *
 * Valores de configuração da aplicação acessíveis via `Yii::$app->params[...]`, como emails
 * de sistema e regras relacionadas com contas de utilizador (ex.: expiração de tokens, tamanho mínimo de password).
 */
return [
    // Email do administrador (ex.: destino de contactos ou notificações administrativas).
    'adminEmail' => 'admin@example.com',
    // Email de suporte, usado em fluxos como recuperação/verificação de conta.
    'supportEmail' => 'support@example.com',
    // Email remetente padrão das mensagens enviadas pela aplicação.
    'senderEmail' => 'noreply@example.com',
    // Nome apresentado como remetente.
    'senderName' => 'Example.com mailer',
    // Tempo de validade (em segundos) do token de reposição de password.
    'user.passwordResetTokenExpire' => 3600,
    // Comprimento mínimo exigido para passwords de utilizador.
    'user.passwordMinLength' => 8,
];
