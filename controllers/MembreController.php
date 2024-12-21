<?php
    require_once './models/membreModel.php';

    class MembreController{
        private $membreModel;
        public function __construct(){
            $this->membreModel = new MembreModel();
        }

        //Controlleur qui permet de rechercher un membre 
        public function rechercherMembre() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $terme = $_POST['recherche'] ?? ''; // Récupérer le terme de recherche
                $membres = $this->membreModel->rechercherMembre($terme);
                require_once './views/Lecteurs.php'; // Afficher les résultats de recherche
            } else {
                header('Location: index.php?action=lister_membres'); // Rediriger s'il n'y a pas de recherche
            }
        }

        //Controlleur d'ajout d'un etudiant
        public function addMembre() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $matricule = $_POST['matricule_membre'] ?? null; // Assurez-vous de récupérer le matricule
                $nom = $_POST['nom_membre'];
                $prenom = $_POST['prenom_membre'];
                $sexe = $_POST['sexe'];
                $email = $_POST['email_membre'];
                $telephone = $_POST['tel_membre'];
                $statut = $_POST['statut'];
        
                // Vérifiez si le matricule est défini avant d'ajouter un membre
                if (empty($matricule)) {
                    echo "Le matricule est requis.";
                    return;
                }
        
                $resultat = $this->membreModel->ajouterMembre($matricule, $nom, $prenom, $sexe, $email, $telephone, $statut);
                if ($resultat) {
                    header('Location: index.php?action=liste_lecteur');
                    exit();
                } else {
                    echo "Erreur lors de l'ajout du membre.";
                }
            } else {
                // Afficher le formulaire
                require 'views/ajouter_membre.php';
            }
        }

         //Controlleur qui affiche la liste des etudiant
         public function afficherMembre(){
            $membres = $this->membreModel->listeMembre();
            require_once './views/Lecteurs.php';
        }

        //controlleur qui affiche le formulaire d'ajout d'un etudiant
        public function afficherFormulaireAjout(){
            require_once './views/ajout_lecteur.php';
        }

        //contolleur qui supprime un etudiant avec un parametre id
        public function deleteMembre($id_membre) {
            $message = $this->membreModel->supprimerMembre($id_membre);
            if ($message === true) {
                header('location: index.php?action=liste_lecteur');
            } else {
                // Redirigez avec le message d'erreur
                header('Location: index.php?action=liste_lecteur&message=' . urlencode($message));
            }
        }

        public function afficherFormulaireModification($id_membre) {
            $membre = $this->membreModel->getMembreById($id_membre);
            if ($membre) {
                require_once './views/modifier_lecteur.php';
            } else {
                echo "Erreur : membre introuvable.";
            }
        }
        
        public function modifierMembre() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer et nettoyer les données du formulaire
                $donnee = array_map('trim', $_POST);
        
                // Vérification si toutes les données requises sont présentes
                if (isset($donnee['id_membre'], $donnee['matricule_membre'], $donnee['nom_membre'], $donnee['prenom_membre'], $donnee['sexe'], $donnee['email_membre'], $donnee['tel_membre'], $donnee['statut'])) {
                    // Appel du modèle pour modifier le membre
                    $resultat = $this->membreModel->modifierMembre(
                        $donnee['id_membre'],
                        $donnee['matricule_membre'],
                        $donnee['nom_membre'],
                        $donnee['prenom_membre'],
                        $donnee['sexe'],
                        $donnee['email_membre'],
                        $donnee['tel_membre'],
                        $donnee['statut']
                    );
        
                    if ($resultat) {
                        header('Location: index.php?action=lister_membres');
                        exit();
                    } else {
                        echo "Erreur lors de la modification du membre.";
                    }
                } else {
                    echo "Erreur : informations manquantes.";
                    var_dump($donnee); // Pour déboguer et voir les données
                }
            } else {
                echo "Erreur : méthode non autorisée.";
            }
        }

        // Affiche le formulaire de connexion
    public function afficherLogin() {
        require_once 'views/login.php'; // Vue du formulaire de connexion
    }

    // Traiter l'authentification
    public function authentifier($email, $password) {
        // Vérifier les identifiants

       if( $this->membreModel->authentifierBibliothecaire($email,$password)){
        
        header('location: index.php?action=accueil_index');
       }else {
        // Afficher un message d'erreur directement sur la page de connexion
        $messageErreur = "Adresse email ou mot de passe incorrect.";
        // Inclure la vue de la page de connexion avec le message d'erreur
        require 'views/login.php';
        }   
    }

    // Afficher l'accueil
    public function afficherAccueil() {
        header('Location:views/index.php');
            
    }

    // Déconnexion
    public function deconnexion() {
        session_start();
        session_destroy();
        header('Location: index.php?action=login');
    }
}
    