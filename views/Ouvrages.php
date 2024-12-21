<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des œuvres</title>
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
    </style>
</head>
<body>

<header class="lecteur">  
    <h1>GESTION DE OEUVRES</h1>  
</header>  
<main>  
    <h3>Liste des oeuvres</h3>  
    <div class="button-container">    
        <a href="index.php?action=ajout_oeuvre" class="btn ajouter">Ajouter</a>  
        <a href="index.php?action=accueil_index" class="btn retour">Retour</a>  
    </div>
      
    <div class="table-container">  
        <table>  
            <thead>  
                <tr>  
                    <th>ID</th>  
                    <th>TITRE</th>  
                    <th>AUTEUR</th>  
                    <th>STATUT</th>    
                    <th>ACTIONS</th>    
                </tr>  
            </thead>  
            <tbody>  
                <?php foreach ($oeuvres as $oeuvre) : ?>
                <tr>
                    <td><?= htmlspecialchars($oeuvre['id_oeuvre']) ?></td>
                    <td><?= htmlspecialchars($oeuvre['titre_oeuvre']) ?></td>
                    <td><?= htmlspecialchars($oeuvre['auteur_oeuvre']) ?></td>
                    <td><?= htmlspecialchars($oeuvre['statut_oeuvre']) ?></td>
                    <td>
                        <div class="button-container">  
                            <a href="index.php?action=modifier_oeuvre_form&id=<?= $oeuvre['id_oeuvre'] ?>" class="btn ajouter">Modifier</a>
                            <a href="index.php?action=suppression_oeuvre&id=<?= $oeuvre['id_oeuvre'] ?>" 
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette œuvre ?');" 
                               class="btn retour">Supprimer</a> 
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>  
        </table>  
    </div>  
</main>

<!-- Modal pour les messages d'erreur -->
<div id="errorModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="errorMessage"></p>
    </div>
</div>

<script>
    window.onload = function() {
        <?php if (isset($_SESSION['error'])): ?>
            document.getElementById('errorMessage').innerText = <?= json_encode(htmlspecialchars($_SESSION['error'])) ?>;
            document.getElementById('errorModal').style.display = "block";
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        // Gestion de la fermeture du modal
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