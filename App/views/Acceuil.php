<?php include 'App/views/layout/header.php'; ?>

<link rel="stylesheet" href="http://localhost/organisation_recette/App/views/Assets/acceuil.css">

<main class="home-wrapper">
    <section class="hero-home">
        <div class="container">
            <h1>Découvrez le plaisir de cuisiner</h1>
            <p>Explorez les meilleures recettes partagées par notre communauté.</p>
            <div class="search-bar">
                <input type="text" placeholder="Rechercher une recette (ex: Tagine, Pâtes...)">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="section-header">
            <h2>Toutes nos Recettes</h2>
            <span class="recipe-count"><?= count($recettes) ?> pépites culinaires</span>
        </div>

        <div class="recipe-grid">
            <?php if (!empty($recettes)): ?>
                <?php foreach ($recettes as $r): ?>
                    <article class="recipe-card">
                        <div class="card-image">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=500" alt="<?= htmlspecialchars($r['titre']) ?>">
                            <span class="category-tag"><?= htmlspecialchars($r['categorie_nom'] ?? 'Cuisine') ?></span>
                        </div>
                        
                        <div class="card-content">
                            <h3><?= htmlspecialchars($r['titre']) ?></h3>
                            <p class="author">Par <strong><?= htmlspecialchars($r['auteur'] ?? 'Anonyme') ?></strong></p>
                            
                            <div class="recipe-details">
                                <span><i class="far fa-clock"></i> <?= $r['temps'] ?> min</span>
                                <span><i class="fas fa-user-friends"></i> <?= $r['portions'] ?> pers.</span>
                            </div>

                            <div class="card-footer">
                                <div class="stars">
                                    <?php for($i=0; $i<5; $i++): ?>
                                        <i class="fa<?= ($i < $r['rating']) ? 's' : 'r' ?> fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                                <a href="index.php?action=details&id=<?= $r['id'] ?>" class="btn-discover">Découvrir</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-recipes">
                    <i class="fas fa-utensils"></i>
                    <p>Aucune recette n'a encore été partagée. Soyez le premier !</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'App/views/layout/footer.php'; ?>