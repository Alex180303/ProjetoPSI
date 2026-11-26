<?php

/** @var yii\web\View $this */
/** @var array|null $animais  Opcional: lista de arrays com id, nome, raca, idade, especie, sexo, foto */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Adotar um animal';

// Enquanto não existir modelo/controller que envie $animais, a página usa estes dados de exemplo.
$animais = $animais ?? [
        ['id' => 1, 'nome' => 'Max',  'raca' => 'Pastor Alemão', 'idade' => '1 ano',  'especie' => 'Cão',  'sexo' => 'Macho', 'foto' => null],
        ['id' => 2, 'nome' => 'Luna', 'raca' => 'Siamês',        'idade' => '2 anos', 'especie' => 'Gato', 'sexo' => 'Fêmea', 'foto' => null],
        ['id' => 3, 'nome' => 'Bolt', 'raca' => 'Labrador',      'idade' => '3 anos', 'especie' => 'Cão',  'sexo' => 'Macho', 'foto' => null],
        ['id' => 4, 'nome' => 'Mel',  'raca' => 'Europeu comum', 'idade' => '1 ano',  'especie' => 'Gato', 'sexo' => 'Fêmea', 'foto' => null],
];
$this->registerCssFile('@web/css/homepage.css');
?>

<!-- Hero -->
<section class="home-hero">
    <h1>Dá uma casa a quem mais precisa</h1>
    <p>Cães e gatos à espera de uma família. Encontra o teu novo melhor amigo perto de ti.</p>
    <?= Html::a('Ver animais', ['animal/index'], ['class' => 'btn-home btn-home-primary']) ?>
</section>

<!-- Pesquisa (GET para a página de resultados) -->
<?= Html::beginForm(['animal/index'], 'get', ['class' => 'home-search', 'aria-label' => 'Pesquisa']) ?>
<div class="home-search-title">Encontra e adota</div>

<label class="home-field home-field-lg">Zona
    <?= Html::textInput('zona', null, ['placeholder' => 'Ex.: Leiria']) ?>
</label>
<label class="home-field">Raça
    <?= Html::textInput('raca', null, ['placeholder' => 'Todas']) ?>
</label>
<label class="home-field">Idade
    <?= Html::textInput('idade', null, ['placeholder' => 'Qualquer']) ?>
</label>

<?= Html::submitButton('Procurar', ['class' => 'btn-home btn-home-blue']) ?>
<?= Html::endForm() ?>

<!-- Porquê / Como adotar -->
<section class="home-info">
    <div class="home-card">
        <h2>Porquê adotar</h2>
        <p>Adotar dá uma segunda oportunidade a um animal e liberta espaço nas associações para ajudar outros. Cada adoção muda duas vidas: a do animal e a tua.</p>
    </div>
    <div class="home-card">
        <h2>Como adotar</h2>
        <p>Escolhe um animal, contacta a associação responsável e combina uma visita. Depois de conheceres o teu novo companheiro, é só tratar da documentação.</p>
    </div>
</section>

<!-- Anúncios populares -->
<section class="home-popular">
    <div class="home-popular-head">
        <h2>Anúncios populares</h2>
        <?= Html::a('Ver todos', ['animal/index'], ['class' => 'home-link-orange']) ?>
    </div>

    <div class="home-grid">
        <?php foreach ($animais as $animal): ?>
            <article class="home-card home-animal">
                <div class="home-animal-photo"
                     style="<?= $animal['foto'] ? 'background-image:url(' . Html::encode(Url::to('@web/uploads/' . $animal['foto'])) . ')' : '' ?>">
                    <?= Html::a('♡', ['favorito/toggle', 'id' => $animal['id']], [
                            'class' => 'home-fav',
                            'aria-label' => 'Guardar nos favoritos',
                            'data-method' => 'post',
                    ]) ?>
                </div>
                <h3><?= Html::encode($animal['nome']) ?></h3>
                <div class="home-muted"><?= Html::encode($animal['raca']) ?> • <?= Html::encode($animal['idade']) ?></div>
                <div class="home-tags">
                    <span class="home-tag home-tag-blue"><?= Html::encode($animal['especie']) ?></span>
                    <span class="home-tag home-tag-brown"><?= Html::encode($animal['sexo']) ?></span>
                </div>
                <?= Html::a('Ver', ['animal/view', 'id' => $animal['id']], ['class' => 'btn-home btn-home-outline']) ?>
            </article>
        <?php endforeach; ?>
    </div>
</section>