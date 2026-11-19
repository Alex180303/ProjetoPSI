<?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\content.php
 *
 * Layout da aplicacao: define a estrutura base comum das paginas.
 * Componente de layout que organiza titulo, breadcrumbs, alertas e area de conteudo.
 * Responsabilidade: estruturar a pagina e carregar elementos comuns (assets, navegacao, scripts, etc.).
 */
/* @var $content string */

use yii\bootstrap5\Breadcrumbs;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\content.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Componente de layout que organiza título, breadcrumbs, alertas e área de conteúdo.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?php
/**
 * Ficheiro de view: platAnimais\backend\views\layouts\content.php
 *
 * Layout da aplicação: define a estrutura base comum das páginas.
 * Componente de layout que organiza título, breadcrumbs, alertas e área de conteúdo.
 * Responsabilidade: estruturar a página e carregar elementos comuns (assets, navegação, scripts, etc.).
 */
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'class' => 'breadcrumb float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>