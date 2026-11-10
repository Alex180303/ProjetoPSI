<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\bootstrap5\Html;

$this->title = 'Anunciar animal';
$this->params['meta_description'] = 'Anunciar um animal para adoção na plataforma.';
$this->params['meta_keywords'] = 'anunciar, animal, adoção, cão, gato';

?>
<div class="anunciar-page">

    <p><?= Html::a('‹ Início', ['site/index']) ?></p>

    <h1>Anunciar animal</h1>
    <p>Preencha os dados do animal para o publicar na plataforma de adoção.</p>

    <?= Html::beginForm(['site/anunciar-animal'], 'post', [
        'id' => 'form-anunciar-animal',
        'enctype' => 'multipart/form-data',
    ]) ?>

    <section>
        <h2>Fotografias</h2>

        <div>
            <label for="foto-principal">Fotografia principal</label>
            <input type="file" id="foto-principal" name="foto_principal" accept="image/jpeg,image/png">
        </div>

        <div>
            <label for="fotos-extra">Fotografias adicionais</label>
            <input type="file" id="fotos-extra" name="fotos_extra[]" accept="image/jpeg,image/png" multiple>
            <p>Pode adicionar até 5 fotografias no total (JPG ou PNG).</p>
        </div>
    </section>

    <section>
        <h2>Dados do animal</h2>

        <div>
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Ex.: Max" required>
        </div>

        <div>
            <label for="raca">Raça</label>
            <input type="text" id="raca" name="raca" placeholder="Ex.: Pastor Alemão">
        </div>

        <div>
            <label for="idade">Idade</label>
            <input type="text" id="idade" name="idade" placeholder="Ex.: 2 anos">
        </div>

        <div>
            <label for="zona">Zona</label>
            <input type="text" id="zona" name="zona" placeholder="Ex.: Leiria" required>
        </div>

        <fieldset>
            <legend>Espécie</legend>
            <label><input type="radio" name="especie" value="cao" checked> Cão</label>
            <label><input type="radio" name="especie" value="gato"> Gato</label>
            <label><input type="radio" name="especie" value="outro"> Outro</label>
        </fieldset>

        <fieldset>
            <legend>Sexo</legend>
            <label><input type="radio" name="sexo" value="macho" checked> Macho</label>
            <label><input type="radio" name="sexo" value="femea"> Fêmea</label>
        </fieldset>
    </section>

    <section>
        <h2>Sobre o animal</h2>

        <div>
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" rows="6"
                      placeholder="Fale sobre o temperamento, hábitos e cuidados necessários."></textarea>
        </div>

        <div>
            <label><input type="checkbox" name="vacinado" value="1"> Vacinado</label>
            <label><input type="checkbox" name="esterilizado" value="1"> Esterilizado</label>
            <label><input type="checkbox" name="microchip" value="1"> Com microchip</label>
        </div>
    </section>

    <div>
        <?= Html::a('Cancelar', ['site/index']) ?>
        <?= Html::submitButton('Publicar anúncio', ['name' => 'anunciar-button']) ?>
    </div>

    <?= Html::endForm() ?>

</div>
