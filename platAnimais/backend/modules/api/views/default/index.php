<?php
/**
 * Ficheiro de view: platAnimais\backend\modules\api\views\default\index.php
 *
 * View do modulo de API (backend/modules/api).
 * Pagina inicial/default do modulo ou ponto de entrada visual associado a rota.
 * Responsabilidade: apresentar conteudo/estrutura HTML associado a esta area do modulo.
 */
?>
<div class="api-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
