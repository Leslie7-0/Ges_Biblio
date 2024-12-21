<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Œuvre</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <header class="lecteur">
        <h1>GESTION DE BIBLIOTHÈQUE</h1>
    </header>
    <main>
        <h3>Modifier une Œuvre</h3>
        <div class="button-container">
            <a href="index.php?action=liste_oeuvre" class="btn retour">Retour</a>
        </div>
        <form class="form-container" action="index.php?action=modifier_oeuvre" method="post">
            <input type="hidden" name="id_oeuvre" value="<?= htmlspecialchars($oeuvre['id_oeuvre']) ?>">

            <div class="form-group">
                <label for="titre_oeuvre">Titre :</label>
                <input type="text" id="titre_oeuvre" name="titre_oeuvre" value="<?= htmlspecialchars($oeuvre['titre_oeuvre']) ?>" required>
            </div>

            <div class="form-group">
                <label for="auteur_oeuvre">Auteur :</label>
                <input type="text" id="auteur_oeuvre" name="auteur_oeuvre" value="<?= htmlspecialchars($oeuvre['auteur_oeuvre']) ?>" required>
            </div>

            <div class="form-group">
                <label for="statut_oeuvre">Statut :</label>
                <select id="statut_oeuvre" name="statut_oeuvre" required>
                    <option value="Disponible" <?= $oeuvre['statut_oeuvre'] === 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                    <option value="Emprunté" <?= $oeuvre['statut_oeuvre'] === 'Emprunté' ? 'selected' : '' ?>>Emprunté</option>
                    <option value="Réservé" <?= $oeuvre['statut_oeuvre'] === 'Réservé' ? 'selected' : '' ?>>Réservé</option>
                </select>
            </div>

            <button type="submit" class="btn enregistrer">Enregistrer les modifications</button>
        </form>
    </main>
</body>
</html>