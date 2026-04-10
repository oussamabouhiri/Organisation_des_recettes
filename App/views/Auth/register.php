<link rel="stylesheet" href="http://localhost/organisation_recette/Organisation_des_recettes/App/views/assets/style.css">

<div class="auth-container">
    <h2>Créer un compte</h2>
    <form action="index.php?page=register" method="POST">
        <div class="form-group">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Mot de passe" required>
        </div>
        
        <button type="submit" name="register">S'inscrire</button>
        
        <div class="switch-link">
            Déjà inscrit ? <a href="?page=login">Connectez-vous</a>
        </div>
    </form>
</div>