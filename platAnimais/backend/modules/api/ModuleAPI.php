<?php

namespace backend\modules\api;

/**
 * Classe de definicao do modulo da API
 */
class ModuleAPI extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // o codigo de inicializacao personalizado vai aqui
    }
}
