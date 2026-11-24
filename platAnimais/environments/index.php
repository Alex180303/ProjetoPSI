<?php

/**
 * Manifesto de ficheiros locais para cada ambiente especifico.
 * Este ficheiro devolve uma lista de ambientes nos quais a aplicacao
 * pode ser instalada. Os dados devolvidos devem seguir o seguinte
 * formato:
 *
 * ```php
 * return [
 *     'nome do ambiente' => [
 *         'path' => 'diretorio que guarda os ficheiros locais',
 *         'skipFiles'  => [
 *             // lista de ficheiros que devem ser copiados apenas uma vez e ignorados se ja existirem
 *         ],
 *         'setWritable' => [
 *             // lista de diretorios que devem ficar com permissao de escrita
 *         ],
 *         'setExecutable' => [
 *             // lista de ficheiros que devem ficar com permissao de execucao
 *         ],
 *         'setCookieValidationKey' => [
 *             // lista de ficheiros de configuracao onde devem ser inseridas chaves de validacao de cookie geradas automaticamente
 *         ],
 *         'createSymlink' => [
 *             // lista de ligacoes simbolicas a criar. As chaves sao as ligacoes e os valores sao os destinos.
 *         ],
 *     ],
 * ];
 * ```
 */
return [
    'Development' => [
        'path' => 'dev',
        'setWritable' => [
            'backend/runtime',
            'backend/web/assets',
            'console/runtime',
            'frontend/runtime',
            'frontend/web/assets',
        ],
        'setExecutable' => [
            'yii',
            'yii_test',
        ],
        'setCookieValidationKey' => [
            'backend/config/main-local.php',
            'common/config/codeception-local.php',
            'frontend/config/main-local.php',
        ],
    ],
    'Production' => [
        'path' => 'prod',
        'setWritable' => [
            'backend/runtime',
            'backend/web/assets',
            'console/runtime',
            'frontend/runtime',
            'frontend/web/assets',
        ],
        'setExecutable' => [
            'yii',
        ],
        'setCookieValidationKey' => [
            'backend/config/main-local.php',
            'frontend/config/main-local.php',
        ],
    ],
];
