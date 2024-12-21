<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Reservations</title>
    <link rel="stylesheet" href="public/style.css">
    <!-- <style>
        .emprunt-a-retour {
            background-color: #ffc107/*(jaune) ff9800(orange) #17a2b8(turquoise); /* Vert clair */
        }

        .emprunt {
            background-color: rgb(145, 60, 199); /* Bleu pour le bouton */
        }
    </style> -->
</head>
<body>
    <header class="lecteur">
        <h1>GESTION DE BIBLIOTHÈQUE</h1>
    </header>

    <main>
        <h3>Liste des reservations</h3>
        <div class="button-container">
            <a href="index.php?action=ajouter_reservation" class="btn ajouter">Ajouter</a>
            <!-- <a href="index.php?action=lister_oeuvres_empruntees" class="btn emprunt">Œuvres Empruntées</a> -->
            <a href="index.php?action=accueil_index" class="btn retour">Retour</a>
        </div>
        <div class="table-container">
            <table>
                <thead>
                <tr>
                    <th>ID reservation</th>
                    <th>Nom Membre</th>
                    <th>Prénom Membre</th>
                    <th>Email Membre</th>
                    <th>Titre Œuvre</th>
                    <th>Auteur Œuvre</th>
                    <th>Date de reservation</th>
                    <th colspan="4">Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php  foreach ($reservations as $reservation): ?>
                <?php
                    /* $classe = '';
                    $dateRetour = new DateTime($emprunt['date_retour']);
                    $dateActuelle = new DateTime();

                    // Vérification si la date de retour est aujourd'hui
                    if ($dateRetour->format('Y-m-d') == $dateActuelle->format('Y-m-d')) {
                        $classe = 'emprunt-a-retour';
                    } */
                ?>
                <tr class="<?= $classe ?>">
                    <td><?= htmlspecialchars($reservation['id_reservation']) ?></td>
                    <td><?= htmlspecialchars($reservation['nom_membre']) ?></td>
                    <td><?= htmlspecialchars($reservation['prenom_membre']) ?></td>
                    <td><?= htmlspecialchars($reservation['email_membre']) ?></td>
                    <td><?= htmlspecialchars($reservation['titre_oeuvre']) ?></td>
                    <td><?= htmlspecialchars($reservation['auteur_oeuvre']) ?></td>
                    <td><?= htmlspecialchars($reservation['date_reservation']) ?></td>
                    <td>
                        <div class="button-container">
                            <a href="index.php?action=modifier_reservation_form&id=<?= htmlspecialchars($reservation['id_reservation']) ?>" class="btn ajouter">Modifier</a>
                        </div>  
                    </td>
                    <td>
                        <div class="button-container">
                            <a href="index.php?action=supprimer_reservation&id=<?= htmlspecialchars($reservation['id_reservation']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette reservation ?');" class="btn retour">Annuler</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>