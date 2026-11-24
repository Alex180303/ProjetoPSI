<?php

declare(strict_types=1);

namespace common\widgets;

use Yii;
use yii\bootstrap5\Alert as BootstrapAlert;

/**
 * O widget Alert apresenta uma mensagem proveniente da flash da sessao. Todas as mensagens flash sao apresentadas
 * na ordem em que foram atribuidas com setFlash. Pode definir uma mensagem da seguinte forma:
 *
 * ```php
 * Yii::$app->session->setFlash('error', 'Esta e a mensagem');
 * Yii::$app->session->setFlash('success', 'Esta e a mensagem');
 * Yii::$app->session->setFlash('info', 'Esta e a mensagem');
 * ```
 *
 * Tambem e possivel definir varias mensagens da seguinte forma:
 *
 * ```php
 * Yii::$app->session->setFlash('error', ['Erro 1', 'Erro 2']);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class Alert extends \yii\bootstrap5\Widget
{
    /**
     * @var array configuracao dos tipos de alerta para as mensagens flash.
     * Este array e definido como $key => $value, onde:
     * - key: o nome da variavel flash da sessao
     * - value: o tipo de alerta Bootstrap (ex.: danger, success, info, warning)
     */
    public array $alertTypes = [
        'error'   => 'alert-danger',
        'danger'  => 'alert-danger',
        'success' => 'alert-success',
        'info'    => 'alert-info',
        'warning' => 'alert-warning'
    ];
    /**
     * @var array opcoes para renderizar a tag do botao de fechar.
     * O array sera passado para [[\yii\bootstrap5\Alert::closeButton]].
     */
    public array $closeButton = [];
    /**
     * {@inheritdoc}
     */
    public function run(): void
    {
        $session = Yii::$app->session;

        if (!$session->getIsActive() && !$session->getHasSessionId()) {
            return;
        }

        $appendClass = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        $flashes = $session->getAllFlashes(true);

        foreach ($flashes as $type => $flash) {
            if (!isset($this->alertTypes[$type])) {
                continue;
            }

            foreach ((array) $flash as $i => $message) {
                echo BootstrapAlert::widget(
                    [
                        'body' => $message,
                        'closeButton' => $this->closeButton,
                        'options' => [
                            ...$this->options,
                            'id' => $this->getId() . '-' . $type . '-' . $i,
                            'class' => $this->alertTypes[$type] . $appendClass,
                        ],
                    ],
                );
            }
        }
    }
}
