<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Emprunt</title>
    <link rel="stylesheet" href="public/style.css">
    <script>
        function remplirInformations() {
            var membreSelect = document.getElementById('id_membre');
            var membreInfo = membreSelect.options[membreSelect.selectedIndex].dataset;

            document.getElementById('nom_membre').value = membreInfo.nom;
            document.getElementById('prenom_membre').value = membreInfo.prenom;
            document.getElementById('email_membre').value = membreInfo.email;
        }

        function remplirAuteur() {
            var oeuvreSelect = document.getElementById('id_oeuvre');
            var oeuvreInfo = oeuvreSelect.options[oeuvreSelect.selectedIndex].dataset;

            document.getElementById('titre_oeuvre').value = oeuvreInfo.titre;
            document.getElementById('auteur_oeuvre').value = oeuvreInfo.auteur;
        }
    </script>
</head>
<body>
    <header class="lecteur">
        <h1>GESTION DE BIBLIOTHÈQUE</h1>
    </header>
    <main>
        <h3>Modifier un Emprunt</h3>
        <div class="button-container">
            <a href="index.php?action=lister_emprunts" class="btn retour">Retour</a>
        </div>
        <form class="form-container" action="index.php?action=modifier_emprunt" method="post">
            <input type="hidden" name="id_emprunt" value="<?= htmlspecialchars($emprunt['id_emprunt']) ?>">

            <div class="form-group">
                <label for="id_membre">Nom Membre:</label>
                <select id="id_membre" name="id_membre" onchange="remplirInformations()" required>
                    <option value="">Sélectionner un membre</option>
                    <?php foreach ($membres as $membre): ?>
                        <option value="<?= $membre['id_membre'] ?>" 
                                data-nom="<?= htmlspecialchars($membre['nom_membre']) ?>" 
                                data-prenom="<?= htmlspecialchars($membre['prenom_membre']) ?>" 
                                data-email="<?= htmlspecialchars($membre['email_membre']) ?>"
                                <?= $membre['id_membre'] === $emprunt['id_membre'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($membre['nom_membre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="prenom_membre">Prénom Membre:</label>
                <input type="text" id="prenom_membre" name="prenom_membre" value="<?= htmlspecialchars($emprunt['prenom_membre']) ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="email_membre">Email Membre:</label>
                <input type="email" id="email_membre" name="email_membre" value="<?= htmlspecialchars($emprunt['email_membre']) ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="id_oeuvre">Titre Œuvre:</label>
                <select id="id_oeuvre" name="id_oeuvre" onchange="remplirAuteur()" required>
                    <option value="">Sélectionner une œuvre</option>
                    <?php foreach ($oeuvres as $oeuvre): ?>
                        <option value="<?= $oeuvre['id_oeuvre'] ?>" 
                                data-auteur="<?= htmlspecialchars($oeuvre['auteur_oeuvre']) ?>"
                                data-titre="<?= htmlspecialchars($oeuvre['titre_oeuvre']) ?>"
                                <?= $oeuvre['id_oeuvre'] === $emprunt['id_oeuvre'] ? 'selected' : '' ?>> 
                            <?= htmlspecialchars($oeuvre['titre_oeuvre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="auteur_oeuvre">Auteur:</label>
                <input type="text" id="auteur_oeuvre" name="auteur_oeuvre" value="<?= htmlspecialchars($emprunt['auteur_oeuvre']) ?>" required readonly>
            </div>
            <input type="hidden" id="nom_membre" name="nom_membre" required>
            <input type="hidden" id="titre_oeuvre" name="titre_oeuvre" required>

            <div class="form-group">
                <label for="date_emprunt">Date d'emprunt:</label>
                <input type="date" id="date_emprunt" name="date_emprunt" value="<?= htmlspecialchars($emprunt['date_emprunt']) ?>" required>
            </div>
            <div class="form-group">
                <label for="date_retour">Date retour:</label>
                <input type="date" id="date_retour" name="date_retour" value="<?= htmlspecialchars($emprunt['date_retour']) ?>" required>
            </div>
            <div class="form-group">
                <label for="limit_emprunt">Nombre d'emprunts:</label>
                <input type="number" id="limit_emprunt" name="limit_emprunt" value="<?= htmlspecialchars($emprunt['limit_emprunt']) ?>" required>
            </div>
            <button type="submit" class="btn enregistrer">Enregistrer</button>
        </form>
    </main>
</body>
</html>