<link rel="stylesheet" href="http://localhost/organisation_recette/Organisation_des_recettes/App/views/assets/style.css">

<div class="auth-container">
    <h2>Connexion</h2>
    <form action="index.php?page=login" method="POST">
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Mot de passe" required>
        </div>
        
        <button type="submit" name="login">Se connecter</button>
        
        <div class="switch-link">
            Nouveau ici ? <a href="?page=register">Créer un compte</a>
        </div>
    </form>
</div>