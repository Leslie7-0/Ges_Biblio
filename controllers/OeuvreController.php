<?php
    require_once './models/oeuvreModel.php';
    
    session_start();
    
    

    class OeuvreController{
        private $oeuvreModel;
        public function __construct(){
            $this->oeuvreModel = new OeuvreModel();
        }

        //Controlleur qui permet de rechercher un membre 
        public function rechercherOeuvre() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $terme = $_POST['recherche'] ?? ''; // Récupérer le terme de recherche
                $membres = $this->oeuvreModel->rechercherOeuvre($terme);
                require_once './views/Ouvrages.php'; // Afficher les résultats de recherche
            } else {
                header('Location: index.php?action=liste_oeuvre'); // Rediriger s'il n'y a pas de recherche
            }
        }

        //Controlleur d'ajout d'une oeuvre
        public function addOeuvre($donnee){
            $this->oeuvreModel->ajouterOeuvre($donnee['titre'], $donnee['auteur'],$donnee['statut']); 

        //rediriger vers la liste des oeuvres
        header('Location: index.php?action=liste_oeuvre');
        }

         //Controlleur qui affiche la liste des oeuvres
         public function afficherOeuvre(){
            $oeuvres = $this->oeuvreModel->listeOeuvre();
            require_once './views/Ouvrages.php';
        }

        //controlleur qui affiche le formulaire d'ajout d'un etudiant
        public function afficherFormulaireAjout(){
            require_once './views/ajout_oeuvre.php';
        }

        //contolleur qui supprime un etudiant avec un parametre id
        public function deleteOeuvre($id_oeuvre) {
            $resultat = $this->oeuvreModel->supprimerOeuvre($id_oeuvre);
            
            if ($resultat === true) {
                // Message de succès
                $_SESSION['success'] = "L'œuvre a été supprimée avec succès.";
            } elseif (is_string($resultat)) {
                // Message d'erreur renvoyé par le modèle
                $_SESSION['error'] = $resultat;
            } else {
                // Autre type d'erreur
                $_SESSION['error'] = "Une erreur inconnue s'est produite lors de la suppression.";
            }
        
            // Redirection vers la liste des œuvres avec les messages
            header('Location: index.php?action=liste_oeuvre');
            exit();
        }
        

        //Controlleur qui affiche le formulaire de modification une oeuvre 
        public function afficherFormulaireModification($id_oeuvre) {
            $oeuvre = $this->oeuvreModel->getOeuvreById($id_oeuvre);
            if ($oeuvre) {
                require_once './views/modifier_oeuvre.php';
            } else {
                echo "Erreur : œuvre introuvable.";
            }
        }
        
        // Controlleur qui modifie une oeuvre
        public function modifierOeuvre($donnee) {
            if (isset($donnee['id_oeuvre'], $donnee['titre_oeuvre'], $donnee['auteur_oeuvre'], $donnee['statut_oeuvre'])) {
                
                $this->oeuvreModel->modifierOeuvre(
                    $donnee['id_oeuvre'],
                    $donnee['titre_oeuvre'],
                    $donnee['auteur_oeuvre'],
                    $donnee['statut_oeuvre']
                );
        
                header('Location: index.php?action=liste_oeuvre');
                exit();
            } else {
                echo "Erreur : informations manquantes.";
            }
        }
    }