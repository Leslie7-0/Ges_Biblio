<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Lecteurs</title>
    <link rel="stylesheet" href="public/style.css">
    <style>
        /* Style pour le modal */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .button-container {
    display: flex;
    align-items: center; /* Aligne verticalement les éléments */
    margin-bottom: 20px; /* Ajoute un espace en bas */
}

.center-buttons {
    display: flex; /* Aligne les boutons en ligne */
    justify-content: right; /* Centre les boutons */
    flex: 2.8; /* Permet au conteneur de prendre l'espace requis */
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
</head>

<body>
    <header class="lecteur">
        <h1>GESTION DE BIBLIOTHÈQUE</h1>
    </header>
    <main>
        <h3>Liste des lecteurs</h3>
        <div class="button-container">
            <div class="center-buttons">
                <a href="index.php?action=ajout_lecteur" class="btn ajouter">Ajouter</a>
                <a href="index.php?action=accueil_index" class="btn retour">Retour</a>
            </div>
            <div class="spacer"></div>
            <div class="search-container">
                <form action="index.php?action=rechercher_membre" method="POST">
                    <input type="text" name="recherche" placeholder="Rechercher un membre...">
                    <button type="submit" class="btn rechercher">Rechercher</button>
                </form>
            </div>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Noms</th>
                        <th>Prenoms</th>
                        <th>Sexe</th>
                        <th>Emails</th>
                        <th>Telephone</th>
                        <th>Statuts</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($membres as $membre) : ?>
                    <tr>
                        <td><?= $membre['matricule_membre']?></td>
                        <td><?= $membre['nom_membre']?></td>
                        <td><?= $membre['prenom_membre']?></td>
                        <td><?= $membre['sexe']?></td>
                        <td><?= $membre['email_membre']?></td>
                        <td><?= $membre['tel_membre']?></td>
                        <td><?= $membre['statut']?></td>
                        <td>
                            <div class="button-container">
                                <a href="index.php?action=modifier_membre_form&id=<?= $membre['id_membre'] ?>" class="btn ajouter">Modifier</a>
                            </div>
                        </td>
                        <td>
                            <div class="button-container">
                                <a href="index.php?action=suppression&id=<?= $membre['id_membre']?>"
                                onclick="return confirm('Etes vous sur de vouloir supprimer ce membre?');" class="btn retour">Supprimer</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="errorMessage"></p>
        </div>
    </div>

    <script>
        // Ouvrir le modal si un message d'erreur est présent
        window.onload = function() {
            <?php if (isset($_GET['message'])): ?>
                document.getElementById('errorMessage').innerText = <?= json_encode(htmlspecialchars($_GET['message'])) ?>;
                document.getElementById('errorModal').style.display = "block";
            <?php endif; ?>

            // Fermer le modal
            document.getElementsByClassName("close")[0].onclick = function() {
                document.getElementById('errorModal').style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == document.getElementById('errorModal')) {
                    document.getElementById('errorModal').style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
