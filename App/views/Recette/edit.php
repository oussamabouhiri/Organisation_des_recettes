<link rel="stylesheet" href="App/views/assets/style.css">

<div class="form-container">
    <h2>Modifier la Recette</h2>

    <?php if (!empty($data['error'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($data['error']) ?></div>
    <?php endif; ?>

    <form action="index.php?page=editRecette&id=<?= (int)$data['recette']['id'] ?>" method="POST">
        <input type="hidden" name="id" value="<?= (int)$data['recette']['id'] ?>">

        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" 
                   value="<?= htmlspecialchars($data['recette']['titre']) ?>" required>
        </div>

        <div class="form-group">
            <label for="ingredients">Ingrédients</label>
            <textarea id="ingredients" name="ingredients" rows="5" required><?= htmlspecialchars($data['recette']['ingredients']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="instructions">Instructions</label>
            <textarea id="instructions" name="instructions" rows="5" required><?= htmlspecialchars($data['recette']['instructions']) ?></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="portions">Portions</label>
                <input type="number" id="portions" name="portions" min="1" 
                       value="<?= (int)$data['recette']['portions'] ?>">
            </div>

            <div class="form-group">
                <label for="temps">Temps (min)</label>
                <input type="number" id="temps" name="temps" min="1" 
                       value="<?= (int)$data['recette']['temps'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="categorie_id">Catégorie</label>
            <select id="categorie_id" name="categorie_id">
                <option value="">-- Aucune --</option>
                <?php foreach ($data['categories'] as $cat): ?>
                    <option value="<?= (int)$cat['id'] ?>" 
                        <?= ($data['recette']['categorie_id'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Enregistrer les modifications</button>
        <a href="index.php?page=dashboard" class="btn-cancel">Annuler</a>
    </form>
</div>
