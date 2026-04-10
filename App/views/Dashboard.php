
<?php include 'App/views/layout/header.php'; ?>

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
    </div>

    <div style="margin-bottom: 20px;">
        <a href="index.php?page=ajouter" class="btn-add">+ Ajouter une recette</a>
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
      <?php if (empty($recettes)): ?>
    <p class="empty-msg">Vous n'avez pas encore de recettes.</p>
<?php else: ?>
    <div class="recette-grid">
        <?php foreach ($recettes as $r): ?>
            <div class="recette-card">
                <div class="card-header">
                    <h3 class="recette-title">
                        <?= htmlspecialchars($r['titre']) ?>
                    </h3>
                    <span class="categorie-badge">
                        <?= htmlspecialchars($r['categorie_nom'] ?? 'Non classée') ?>
                    </span>
                </div>

                <div class="card-body">
                    <p><strong>Temps :</strong> <?= (int)$r['temps'] ?> min</p>
                    <p><strong>Portions :</strong> <?= (int)$r['portions'] ?></p>
                    <p><strong>Date :</strong> <?= date('d/m/Y', strtotime($r['created_at'])) ?></p>
                </div>

                <div class="card-actions">
                    <a href="index.php?page=editRecette&id=<?= (int)$r['id'] ?>" class="btn-edit">
                        Modifier
                    </a>
                    <a href="index.php?page=deleteRecette&id=<?= (int)$r['id'] ?>"
                       class="btn-delete"
                       onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">
                        Supprimer
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
    <?php endif; ?>
</div>

<?php endif; ?>
<?php include 'App/views/layout/footer.php'; ?>