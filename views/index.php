<!DOCTYPE html>  
<html lang="fr">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Gestion de Bibliothèque</title>  
    <link rel="stylesheet" href="../public/style.css">  
</head>  
<body>  
    <header>  
        <div class="top-bar">  
            <a href="../index.php?action=deconnexion" class="btn-header">Deconnexion</a>  
        </div>  
        <div class="separator"></div> <!-- Ajout de la barre de séparation -->  
        <div class="title-bar">  
            <h1>GESTION DE BIBLIOTHÈQUE</h1>  
        </div>  
    </header> 

    <main>  
        <div class="grid-container">  
            <div class="card">  
                <img src="../public/images/lecteur.png" alt="Lectures" />  
                <h2>MEMBRES</h2>  
                <p>Gérer les lecteurs au sein de la bibliothèque</p>  
                <a href="../index.php?action=liste_lecteur" class="btn">Accéder</a>  
            </div>  
            <div class="card">  
                <img src="../public/images/livre.png" alt="Ouvrages" />  
                <h2>OEUVRES</h2>  
                <p>Gérer les ouvrages de la bibliothèque</p>  
                <a href="../index.php?action=liste_oeuvre" class="btn">Accéder</a>  
            </div>  
            <div class="card">  
                <img src="../public/images/emprunt.png" alt="Emprunts" />  
                <h2>EMPRUNTS</h2>  
                <p>Suivre les emprunts en cours</p>  
                <a href="../index.php?action=lister_emprunts" class="btn">Accéder</a>  
            </div>  
            <div class="card">  
                <img src="../public/images/reservation.png" alt="Réservations" />  
                <h2>RÉSERVATIONS</h2>  
                <p>Gérer les réservations</p>  
                <a href="../index.php?action=lister_reservations" class="btn">Accéder</a>  
            </div>  
            <!-- <div class="card">  
                <img src="../public/images/user.png" alt="Utilisateurs" />  
                <h2>UTILISATEURS</h2>  
                <p>Gérer les utilisateurs de la bibliothèque</p>  
                <a href="Users.php" class="btn">Accéder</a>  
            </div> -->  
            <!-- <div class="card">  
                <img src="images/sanction.png" alt="Sanctions" />  
                <h2>SANCTIONS</h2>  
                <p>Gérer les sanctions imposées</p>  
                <a href="#" class="btn">Accéder</a>  
            </div> -->  
        </div>  
    </main>  

    <footer>  
        <p>© 2024 Gestion de Bibliothèque. Tous droits réservés.</p>  
    </footer>  
</body>  
</html>