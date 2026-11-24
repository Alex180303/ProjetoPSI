<?php

/** @var \yii\web\View $this instancia do componente de view */
/** @var \yii\mail\MessageInterface $message mensagem que esta a ser composta */
/** @var string $content resultado da renderizacao da view principal */

?>
<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php $this->endPage();
