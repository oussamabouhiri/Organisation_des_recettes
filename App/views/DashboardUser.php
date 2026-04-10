<link rel="stylesheet" href="App/views/assets/style.css">

<?php if (!isset($_SESSION['user_id'])): ?>
    <div class="auth-container">
        <p>Veuillez vous <a href="index.php?page=login">connecter</a>.</p>
    </div>
<?php else: ?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Mes Recettes</h2>
        <span class="welcome">Bonjour, <?= htmlspecialchars($_SESSION['username']) ?></span>
        <a href="index.php?page=logout" class="btn-logout">Déconnexion</a>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php if ($_GET['success'] === 'updated'): ?>
                Recette modifiée avec succès !
            <?php elseif ($_GET['success'] === 'deleted'): ?>
                Recette supprimée avec succès !
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            <?php if ($_GET['error'] === 'notfound'): ?>
                Recette introuvable.
            <?php elseif ($_GET['error'] === 'deletefailed'): ?>
                Erreur lors de la suppression.
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (empty($recettes)): ?>
        <p class="empty-msg">Vous n'avez pas encore de recettes.</p>
    <?php else: ?>
        <table class="recette-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Temps (min)</th>
                    <th>Portions</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recettes as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['titre']) ?></td>
                    <td><?= htmlspecialchars($r['categorie_nom'] ?? 'Non classée') ?></td>
                    <td><?= (int)$r['temps'] ?></td>
                    <td><?= (int)$r['portions'] ?></td>
                    <td><?= date('d/m/Y', strtotime($r['created_at'])) ?></td>
                    <td class="actions">
                        <a href="index.php?page=editRecette&id=<?= (int)$r['id'] ?>" class="btn-edit">Modifier</a>
                        <a href="index.php?page=deleteRecette&id=<?= (int)$r['id'] ?>" 
                           class="btn-delete" 
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">
                            Supprimer
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php endif; ?>
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
