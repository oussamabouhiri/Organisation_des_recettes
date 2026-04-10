<?php 
// On inclut le header depuis ton dossier layout
include 'views/layout/header.php'; 
?>

<div class="container dashboard">
    <header class="dash-header">
        <h1>Bienvenue dans votre espace Recettes</h1>
        <p>Découvrez les dernières pépites culinaires de la communauté.</p>
        <a href="index.php?action=add" class="btn-add">+ Ajouter une recette</a>
    </header>

    <section class="recipe-grid">
        <?php if (!empty($recettes)): ?>
            <?php foreach ($recettes as $r): ?>
                <article class="recipe-card">
                    <div class="card-image">
                        <img src="assets/img/default-recipe.jpg" alt="<?= htmlspecialchars($r['titre']) ?>">
                        <span class="category-badge"><?= htmlspecialchars($r['categorie_nom'] ?? 'Général') ?></span>
                    </div>
                    
                    <div class="card-content">
                        <h3><?= htmlspecialchars($r['titre']) ?></h3>
                        <div class="recipe-info">
                            <span>⏱ <?= $r['temps'] ?> min</span>
                            <span>👥 <?= $r['portions'] ?> pers.</span>
                            <span>⭐ <?= $r['rating'] ?>/5</span>
                        </div>
                        <p class="author">Par : <strong><?= htmlspecialchars($r['auteur'] ?? 'Anonyme') ?></strong></p>
                        <a href="index.php?action=details&id=<?= $r['id'] ?>" class="btn-view">Voir la préparation</a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-data">Aucune recette disponible pour le moment.</p>
        <?php endif; ?>
    </section>
</div>

<?php 
// On inclut le footer
include 'views/layout/footer.php'; 
?>