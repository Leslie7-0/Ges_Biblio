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
        <h3>Liste des emprunts</h3>
        <div class="button-container">
            <div class="center-buttons">
                <a href="index.php?action=ajouter_emprunt" class="btn ajouter">Ajouter</a>
                <a href="index.php?action=lister_oeuvres_empruntees" class="btn emprunt">Œuvres Empruntées</a>
                <a href="index.php?action=accueil_index" class="btn retour">Retour</a>
            </div>
            <div class="spacer"></div> <!-- Espaceur pour pousser le formulaire à droite -->
            <div class="search-container">
                <form action="index.php?action=rechercher_emprunt" method="POST">
                    <input type="text" name="recherche" placeholder="Rechercher un emprunt...">
                    <button type="submit" class="btn rechercher">Rechercher</button>
                </form>
            </div>
        </div>
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>ID Emprunt</th>
                    <th>Nom Membre</th>
                    <th>Prénom Membre</th>
                    <th>Email Membre</th>
                    <th>Titre Œuvre</th>
                    <th>Auteur Œuvre</th>
                    <th>Date d'Emprunt</th>
                    <th>Date de Retour</th>
                    <th>Nombre d'Emprunts</th>
                    <th colspan="4">Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($emprunts as $emprunt): ?>
                <?php
                    $classe = '';
                    $dateRetour = new DateTime($emprunt['date_retour']);
                    $dateActuelle = new DateTime();

                    // Vérification si la date de retour est aujourd'hui
                    if ($dateRetour->format('Y-m-d') == $dateActuelle->format('Y-m-d')) {
                        $classe = 'emprunt-a-retour';
                    }
                ?>
                <tr class="<?= $classe ?>">
                        <td><?= htmlspecialchars($emprunt['id_emprunt']) ?></td>
                        <td><?= htmlspecialchars($emprunt['nom_membre'] ?? 'Non disponible') ?></td>
                        <td><?= htmlspecialchars($emprunt['prenom_membre'] ?? 'Non disponible') ?></td>
                        <td><?= htmlspecialchars($emprunt['email_membre'] ?? 'Non disponible') ?></td>
                        <td><?= htmlspecialchars($emprunt['titre_oeuvre'] ?? 'Non disponible') ?></td>
                        <td><?= htmlspecialchars($emprunt['auteur_oeuvre'] ?? 'Non disponible') ?></td>
                        <td><?= htmlspecialchars($emprunt['date_emprunt']) ?></td>
                        <td><?= htmlspecialchars($emprunt['date_retour']) ?></td>
                        <td><?= htmlspecialchars($emprunt['limit_emprunt'] ?? 'Non spécifié') ?></td>
                        <td>
                    <td>
                        <div class="button-container">
                            <a href="index.php?action=modifier_emprunt_form&id=<?= htmlspecialchars($emprunt['id_emprunt']) ?>" class="btn ajouter">Modifier</a>
                        </div>  
                    </td>
                    <td>
                        <div class="button-container">
                            <a href="index.php?action=supprimer_emprunt&id=<?= htmlspecialchars($emprunt['id_emprunt']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet emprunt ?');" class="btn retour">Supprimer</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

<style>
.emprunt-a-retour {
     background-color: #ffc107/*(jaune) ff9800(orange) #17a2b8(turquoise); /* Vert clair */
    }

.emprunt {
     background-color: rgb(145, 60, 199); /* Bleu pour le bouton */
        }
.button-container {
    display: flex;
    align-items: center; /* Aligne verticalement les éléments */
    margin-bottom: 20px; /* Ajoute un espace en bas */
}

.center-buttons {
    display: flex; /* Aligne les boutons en ligne */
    justify-content: right; /* Centre les boutons */
    flex: 4.7; /* Permet au conteneur de prendre l'espace requis */
}
.spacer {
    flex: 1; /* Prend l'espace restant pour pousser le formulaire à droite */
}

.search-container {
    margin-left: 20px; /* Ajoute un peu d'espace entre le bouton Retour et le champ de recherche */
    left: 40px;
}

.search-container input {
    padding: 8px;
    width: 200px; /* Ajustez la largeur selon vos préférences */
}

.search-container button {
    padding: 8px;
}
    </style>
</body>
</html>