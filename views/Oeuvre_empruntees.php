<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Emprunts</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <header class="lecteur">
        <h1>GESTION DE BIBLIOTHÈQUE</h1>
    </header>
    <main>
    <h3>Liste des oeuvres empruntees</h3>
        <div class="button-container">
            <a href="index.php?action=lister_emprunts" class="btn retour">Retour</a>
        </div>
        <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Titre Œuvre</th>
                    <th>Nom Membre</th>
                    <th>Date Emprunt</th>
                    <th>Date Retour</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($oeuvresEmpruntees as $oeuvre): ?>
                    <tr>
                        <td><?= htmlspecialchars($oeuvre['titre_oeuvre']) ?></td>
                        <td><?= htmlspecialchars($oeuvre['nom_membre']) ?></td>
                        <td><?= htmlspecialchars($oeuvre['date_emprunt']) ?></td>
                        <td><?= htmlspecialchars($oeuvre['date_retour']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </main>
</body>
</html>