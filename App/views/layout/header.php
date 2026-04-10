<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CookMaster - Partage de Recettes</title>
<link rel="stylesheet" href="http://localhost/organisation_recette/App/views/Assets/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<nav class="navbar-transparent">
    <div class="container nav-flex">
        <a href="index.php" class="logo">Marrakesh<span>Food Lovers</span></a>
        
        <ul class="nav-links">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?action=list">Recettes</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="index.php?page=dashboard" class="active">Mon Dashboard</a></li>
                <li><a href="index.php?page=logout" class="btn-logout">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="index.php?page=login">Connexion</a></li>
                <li><a href="index.php?page=register" class="btn-signup">S'inscrire</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>