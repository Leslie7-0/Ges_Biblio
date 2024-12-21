<?php
    require_once './models/empruntModel.php';


class EmpruntController {
    private $empruntModel;
    public function __construct(){
        $this->empruntModel = new EmpruntModel();
    }
    

    public function afficherFormulaireAjout() {
        $membres = $this->empruntModel->getAllMembres();
        $oeuvres = $this->empruntModel->getAllOeuvres();
        require_once './views/ajout_emprunt.php';
    }

    public function ajouterEmprunt() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_membre = $_POST['id_membre'];
            $id_oeuvre = $_POST['id_oeuvre'];
            $date_emprunt = $_POST['date_emprunt'];
            $date_retour = $_POST['date_retour'];
            $limit_emprunt = $_POST['limit_emprunt'];
            
            // Récupération des informations du membre
            $nom_membre = $_POST['nom_membre'] ?? ''; // Assurez-vous que ce champ existe
            $prenom_membre = $_POST['prenom_membre'] ?? ''; // Rempli automatiquement dans le formulaire
            $email_membre = $_POST['email_membre'] ?? ''; // Rempli automatiquement dans le formulaire
            $titre_oeuvre = $_POST['titre_oeuvre'] ?? ''; // Rempli automatiquement dans le formulaire
            $auteur_oeuvre = $_POST['auteur_oeuvre'] ?? ''; // Rempli automatiquement dans le formulaire
    
            // Appel de la méthode pour ajouter l'emprunt
            $resultat = $this->empruntModel->ajouterEmprunt(
                $id_membre,
                $id_oeuvre,
                $date_emprunt,
                $date_retour,
                $limit_emprunt,
                $nom_membre,
                $prenom_membre,
                $email_membre,
                $titre_oeuvre,
                $auteur_oeuvre
            );
    
            // Vérifier si l'ajout a réussi
            if ($resultat) {
                header('Location: index.php?action=lister_emprunts');
                exit();
            } else {
                echo "Une erreur s'est produite lors de l'ajout de l'emprunt.";
            }
        } else {
            $this->afficherFormulaireAjout();
        }
    }

    public function listerOeuvresEmpruntees() {
        $oeuvresEmpruntees = $this->empruntModel->getOeuvresEmpruntees();
        include './views/Oeuvre_empruntees.php'; // Chemin vers la vue
    }


    public function afficherFormulaireModification($id_emprunt) {
        $emprunt = $this->empruntModel->getEmpruntById($id_emprunt);
        if ($emprunt) {
            $membres = $this->empruntModel->getAllMembres(); // Récupérer tous les membres
            $oeuvres = $this->empruntModel->getAllOeuvres(); // Récupérer toutes les œuvres
            require_once './views/modifier_emprunt.php'; // Inclure le fichier du formulaire
        } else {
            echo "Erreur : emprunt introuvable.";
        }
    }

    public function modifierEmprunt() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération et nettoyage des données du formulaire
            $donnees = array_map('trim', $_POST);
    
            if (isset($donnees['id_emprunt'], $donnees['id_membre'], $donnees['id_oeuvre'], 
                      $donnees['date_emprunt'], $donnees['date_retour'], $donnees['limit_emprunt'],
                      $donnees['nom_membre'], $donnees['prenom_membre'], $donnees['email_membre'],
                      $donnees['titre_oeuvre'], $donnees['auteur_oeuvre'])) {
                
                $resultat = $this->empruntModel->modifierEmprunt(
                    $donnees['id_emprunt'],
                    $donnees['id_membre'],
                    $donnees['id_oeuvre'],
                    $donnees['date_emprunt'],
                    $donnees['date_retour'],
                    $donnees['limit_emprunt'],
                    $donnees['nom_membre'],
                    $donnees['prenom_membre'],
                    $donnees['email_membre'],
                    $donnees['titre_oeuvre'],
                    $donnees['auteur_oeuvre']
                );
    
                if ($resultat) {
                    header('Location: index.php?action=lister_emprunts');
                    exit();
                } else {
                    echo "Erreur lors de la modification de l'emprunt.";
                }
            } else {
                echo "Erreur : informations manquantes.";
            }
        } else {
            echo "Méthode non autorisée.";
        }
    }

    public function supprimerEmprunt($id_emprunt) {
        $this->empruntModel->supprimerEmprunt($id_emprunt);
        header('Location: index.php?action=lister_emprunts');
        exit();
    }

    public function listerEmprunts() {
        // Utiliser la méthode pour récupérer tous les emprunts
        $emprunts = $this->empruntModel->getAllEmprunts();
        // Inclure la vue pour afficher les emprunts
        require_once './views/Emprunts.php';
    }

    //Controlleur qui permet de rechercher un membre 
    public function rechercherEmprunt() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $terme = $_POST['recherche'] ?? ''; // Récupérer le terme de recherche
            $emprunts = $this->empruntModel->rechercherEmprunt($terme);
            require_once './views/Emprunts.php'; // Afficher les résultats de recherche
        } else {
            header('Location: index.php?action=lister_emprunts'); // Rediriger s'il n'y a pas de recherche
        }
    }
}
