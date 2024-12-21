<!DOCTYPE html>  
<html lang="fr">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Ajout d'un Lecteur</title>  
    <link rel="stylesheet" href="public/style.css">  
</head>  
<body>  
    <header class="lecteur">  
        <h1>GESTION DE BIBLIOTHÈQUE</h1>  
    </header>  
    <main>  
        <h3>Ajouter un lecteur</h3>  
        <div class="button-container">  
            <a href="index.php?action=liste_lecteur" class="btn retour">Retour</a>  
        </div>  
        <form class="form-container" action="index.php?action=ajout_lecteur" method="post"> 
            <div class="form-row">  
            <div class="form-group"> 
                <?php
                function gestionMatricule(){
                    $caractere=chr(rand(65,90));
                    $chiffre = rand(1000,9999);
                    $matricule = $caractere.$chiffre;
                    return $matricule;
                }
                ?> 
                    <label for="matricule_membre">Matricule :</label>  
                    <input type="text" id="matricule_membre" name="matricule_membre" value="<?php echo gestionMatricule();?>" readonly required>  
                </div> 
                <div class="form-group">  
                    <label for="nom_membre">Nom :</label>  
                    <input type="text" id="nom_membre" name="nom_membre"  required>  
                </div> 
                  
            </div>
            <div class="form-row">  
                <div class="form-group">  
                    <label for="prenom_membre">Prénoms :</label>  
                    <input type="text" id="prenom_membre" name="prenom_membre" required>  
                </div>  
                <div class="form-group">  
                    <label for="sexe">Sexe :</label>  
                    <select id="sexe" name="sexe" required>  
                        <option value="">Sélectionner un sexe</option>  
                        <option value="M">Masculin</option>  
                        <option value="F">Féminin</option>  
                    </select>  
                </div>  
                 
            </div>     
            <div class="form-row">  
            <div class="form-group">  
                    <label for="email_membre">Email :</label>  
                    <input type="text" id="email_membre" name="email_membre" required>  
                </div>  
                    <div class="form-group">  
                        <label for="niveau">Statut du lecteur :</label>  
                        <select id="statut" name="statut" required>  
                            <option value="">Sélectionner un niveau</option>  
                            <option value="Enseignant">Enseignant</option>  
                            <option value="Etudiant">Etudiant</option>  
                            <option value="Personnel">Personnel</option>  
                        </select>  
                    </div>  
                </div> 
            </div> 
            <div class="form-row">  
                <div class="form-group">  
                    <label for="tel_membre">Téléphone :</label>  
                    <input type="tel" id="tel_membre" name="tel_membre" required>  
                </div>    
            </div>
            </div>   
            <button type="submit" class="btn enregistrer">Enregistrer</button>  
        </form>  
    </main>  
</body>  
</html>