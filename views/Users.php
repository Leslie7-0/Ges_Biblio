<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Bibliothécaires</title>
    <link rel="stylesheet" href="public/style.css">
    <style>
        .connecte {
            color: green; /* Couleur pour le bibliothécaire connecté */
        }
    </style>
</head>
<body>

<header class="lecteur">  
    <h1>Liste des Bibliothécaires</h1>  
</header>  
<main>  
    <div class="table-container">  
        <table>  
            <thead>  
                <tr>  
                    <th>ID</th>  
                    <th>NOM</th>  
                    <th>PRÉNOM</th>  
                    <th>EMAIL</th>  
                    <th>TÉLÉPHONE</th>  
                    <th>STATUT</th>    
                </tr>  
            </thead>  
            <tbody>  
                <?php if (!empty($bibliothecaires)): ?>
                    <?php foreach ($bibliothecaires as $bibliothecaire): ?>
                    <tr>
                        <td><?= htmlspecialchars($bibliothecaire['id_biblio']) ?></td>
                        <td class="<?= ($_SESSION['user_id'] == $bibliothecaire['id_biblio'] && $bibliothecaire['is_connected'] == 1) ? 'connecte' : '' ?>">
                            <?= htmlspecialchars($bibliothecaire['nom_biblio']) ?>
                        </td>
                        <td><?= htmlspecialchars($bibliothecaire['prenom_biblio']) ?></td>
                        <td><?= htmlspecialchars($bibliothecaire['email_biblio']) ?></td>
                        <td><?= htmlspecialchars($bibliothecaire['tel_biblio']) ?></td>
                        <td><?= $bibliothecaire['is_connected'] ? 'Connecté' : 'Déconnecté' ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Aucun bibliothécaire enregistré.</td>
                    </tr>
                <?php endif; ?>
            </tbody>  
        </table>  
    </div>  
</main>

</body>  
</html>