<!DOCTYPE html>  
<html lang="fr">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Authentification - Gestion de Bibliothèque</title>  
    <link rel="stylesheet" href="public/style.css">  
</head>  
<body>  
    <!-- Afficher le message d'erreur si défini -->
    <?php if (isset($messageErreur)) : ?>
        <p style="color: red;"><?php echo htmlspecialchars($messageErreur); ?></p>
    <?php endif; ?>
    
    <div class="auth-container">  
        <h1>GESTION DE BIBLIOTHÈQUE</h1>  
        <p>Cet espace est réservé au bibliothécaire</p>  
        <h2>Authentifiez-vous</h2>  

        <form class="auth-form" action=" index.php?action=authentifier" method="POST">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
            <label for="email">Email :</label>  
            <input type="email" name="email" placeholder="Entrez votre Email" required>  

            <label for="password">Mot de passe :</label>  
            <input type="password" name="password" placeholder="Entrez votre mot de passe" required>  

            <button type="submit" class="btn-auth">Se connecter</button>  
        </form>  
    </div>  
</body>  
</html>