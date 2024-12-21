<!DOCTYPE html>  
<html lang="fr">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Ajout une oeuvre</title>  
    <link rel="stylesheet" href="public/style.css">  
</head>  
<body>  
    <header class="lecteur">  
        <h1>GESTION DE BIBLIOTHÈQUE</h1>  
    </header>  
    <main>  
        <h3>Ajouter une oeuvre</h3>  
        <div class="button-container">  
            <a href="index.php?action=liste_oeuvre" class="btn retour">Retour</a>  
        </div>  
        <form class="form-container" action="index.php?action=ajout_oeuvre" method="post">    
                <!-- <div class="form-group">  

                    <label for="nom">Cote de l'ouvrage :</label>  
                    <input type="text" id="nom" name="nom" required>  
                </div> -->  
                <div class="form-group">  
                    <label for="titre">Titre de l'oeuvre :</label>  
                    <input type="text" id="titre" name="titre" required>  
                </div>    
            <div class="form-group">  
                <label for="auteur">Nom de l'auteur :</label>  
                <input type="text" id="auteur" name="auteur" required>  
            </div>  
            <div class="form-group">  
                <label for="statut">Statut de l'oeuvre :</label>  
                <select id="statut" name="statut" required>  
                    <option value="">Sélectionner le statut</option>  
                    <option value="Emprunte">En cour</option>  
                    <option value="Disponible">Disponible</option>  
                    <option value="Rupture de stock">Rupture de stock</option>  
                </select>  
            </div>       

            <button type="submit" class="btn enregistrer">Enregistrer</button>  
        </form>  
    </main>  
</body>  
</html>