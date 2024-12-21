<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'un Lecteur</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <header class="lecteur">
        <h1>GESTION DE BIBLIOTHÈQUE</h1>
    </header>
    <main>
        <h3>Modifier un lecteur</h3>
        <div class="button-container">
            <a href="index.php?action=liste_lecteur" class="btn retour">Retour</a>
        </div>
        <form class="form-container" action="index.php?action=modifier_membre" method="post">
    <input type="hidden" name="id_membre" value="<?= htmlspecialchars($membre['id_membre']) ?>">

    <div class="form-group">
        <label for="matricule_membre">Matricule :</label>
        <input type="text" id="matricule_membre" name="matricule_membre" value="<?= htmlspecialchars($membre['matricule_membre']) ?>" readonly required>
    </div>
    
    <div class="form-row">
        <div class="form-group">
            <label for="nom_membre">Nom :</label>
            <input type="text" id="nom_membre" name="nom_membre" value="<?= htmlspecialchars($membre['nom_membre']) ?>" required>
        </div>
        <div class="form-group">
            <label for="prenom_membre">Prénom :</label>
            <input type="text" id="prenom_membre" name="prenom_membre" value="<?= htmlspecialchars($membre['prenom_membre']) ?>" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="sexe">Sexe :</label>
            <select id="sexe" name="sexe" required>
                <option value="M" <?= $membre['sexe'] === 'M' ? 'selected' : '' ?>>Masculin</option>
                <option value="F" <?= $membre['sexe'] === 'F' ? 'selected' : '' ?>>Féminin</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email_membre">Email :</label>
            <input type="email" id="email_membre" name="email_membre" value="<?= htmlspecialchars($membre['email_membre']) ?>" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label for="tel_membre">Téléphone :</label>
            <input type="tel" id="tel_membre" name="tel_membre" value="<?= htmlspecialchars($membre['tel_membre']) ?>" required>
        </div>
        <div class="form-group">
            <label for="statut">Statut :</label>
            <select id="statut" name="statut" required>
                <option value="Enseignant" <?= $membre['statut'] === 'Enseignant' ? 'selected' : '' ?>>Enseignant</option>
                <option value="Etudiant" <?= $membre['statut'] === 'Etudiant' ? 'selected' : '' ?>>Étudiant</option>
                <option value="Personnel" <?= $membre['statut'] === 'Personnel' ? 'selected' : '' ?>>Personnel</option>
            </select>
        </div>
    </div>
    
    <button type="submit" class="btn enregistrer">Enregistrer les modifications</button>
</form>
    </main>
</body>
</html>