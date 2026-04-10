<link rel="stylesheet" href="App/views/assets/style.css">

<div class="form-container">
    <h2>Ajouter une Nouvelle Recette</h2>

    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($data['error']) ?></div>
    <?php endif; ?>

    <form action="index.php?page=addRecette" method="POST">
        
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" 
                   placeholder="Ex: Tajine de poulet" required>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingrédients</label>
            <textarea id="ingredients" name="ingredients" rows="5" 
                      placeholder="Listez vos ingrédients ici..." required></textarea>
        </div>

        <div class="form-group">
            <label for="instructions">Instructions</label>
            <textarea id="instructions" name="instructions" rows="5" 
                      placeholder="Décrivez les étapes de préparation..." required></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="portions">Portions</label>
                <input type="number" id="portions" name="portions" min="1" value="1">
            </div>

            <div class="form-group">
                <label for="temps">Temps (min)</label>
                <input type="number" id="temps" name="temps" min="1" value="30">
            </div>
        </div>

        <div class="form-group">
            <label for="categorie_id">Catégorie</label>
            <select id="categorie_id" name="categorie_id">
                <option value="">-- Choisir une catégorie --</option>
                <?php foreach ($data['categories'] as $cat): ?>
                    <option value="<?= (int)$cat['id'] ?>">
                        <?= htmlspecialchars($cat['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Publier la recette</button>
        <a href="index.php?page=dashboard" class="btn-cancel">Annuler</a>
    </form>
</div>