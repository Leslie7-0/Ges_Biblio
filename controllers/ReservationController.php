<?php
    require_once './models/reservationModel.php';


class ReservationController {
    private $reservationModel;
    public function __construct(){
        $this->reservationModel = new ReservationModel();
    }
    

    public function afficherFormulaireAjout() {
        $membres = $this->reservationModel->getAllMembres();
        $oeuvres = $this->reservationModel->getAllOeuvres();
        require_once './views/ajout_reservation.php';
    }

    public function ajouterReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_membre = $_POST['id_membre'];
            $id_oeuvre = $_POST['id_oeuvre'];
            $date_reservation = $_POST['date_reservation'] ?? null;
            
            // Récupération des informations du membre
            $nom_membre = $_POST['nom_membre'] ?? ''; // Assurez-vous que ce champ existe
            $prenom_membre = $_POST['prenom_membre'] ?? ''; // Rempli automatiquement dans le formulaire
            $email_membre = $_POST['email_membre'] ?? ''; // Rempli automatiquement dans le formulaire
            $titre_oeuvre = $_POST['titre_oeuvre'] ?? ''; // Rempli automatiquement dans le formulaire
            $auteur_oeuvre = $_POST['auteur_oeuvre'] ?? ''; // Rempli automatiquement dans le formulaire
    
            // Appel de la méthode pour ajouter l'emprunt
            $resultat = $this->reservationModel->ajouterReservation(
                $id_membre,
                $id_oeuvre,
                $date_reservation,
                $nom_membre,
                $prenom_membre,
                $email_membre,
                $titre_oeuvre,
                $auteur_oeuvre
            );
    
            // Vérifier si l'ajout a réussi
            if ($resultat) {
                header('Location: index.php?action=lister_reservations');
                exit();
            } else {
                echo "Une erreur s'est produite lors de l'ajout d'une reservation'.";
            }
        } else {
            $this->afficherFormulaireAjout();
        }
    }
/* 
    public function listerOeuvresEmpruntees() {
        $oeuvresEmpruntees = $this->empruntModel->getOeuvresEmpruntees();
        include './views/Oeuvre_empruntees.php'; // Chemin vers la vue
    } */


    public function afficherFormulaireModification($id_reservation) {
        $reservation = $this->reservationModel->getReservationById($id_reservation);
        if ($reservation) {
            $membres = $this->reservationModel->getAllMembres(); // Récupérer tous les membres
            $oeuvres = $this->reservationModel->getAllOeuvres(); // Récupérer toutes les œuvres
            require_once './views/modifier_reservation.php'; // Inclure le fichier du formulaire
        } else {
            echo "Erreur : reservation introuvable.";
        }
    }

    public function modifierReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $donnees = array_map('trim', $_POST); // Nettoyage des espaces
    
            $erreurs = [];
            
            // Vérification des champs requis
            if (empty($donnees['id_reservation'])) {
                $erreurs[] = "L'ID de la réservation est requis.";
            }
            if (empty($donnees['id_membre'])) {
                $erreurs[] = "L'ID du membre est requis.";
            }
            if (empty($donnees['id_oeuvre'])) {
                $erreurs[] = "L'ID de l'œuvre est requis.";
            }
            if (empty($donnees['date_reservation'])) {
                $erreurs[] = "La date de réservation est requise.";
            }
            // if (empty($donnees['nom_membre'])) {
            //     $erreurs[] = "Le nom du membre est requis.";
            // }
            if (empty($donnees['prenom_membre'])) {
                $erreurs[] = "Le prénom du membre est requis.";
            }
            if (empty($donnees['email_membre'])) {
                $erreurs[] = "L'email est requis.";
            }
            /* if (empty($donnees['titre_oeuvre'])) {
                $erreurs[] = "Le titre de l'œuvre est requis.";
            } */
            if (empty($donnees['auteur_oeuvre'])) {
                $erreurs[] = "L'auteur de l'œuvre est requis.";
            }
    
            // Affichage des erreurs
            if (!empty($erreurs)) {
                foreach ($erreurs as $erreur) {
                    echo htmlspecialchars($erreur) . "<br>";
                }
                return; // Arrêtez le traitement ici
            }
    
            // Mise à jour de la réservation
            $resultat = $this->reservationModel->modifierReservation(
                $donnees['id_reservation'],
                $donnees['id_membre'],
                $donnees['id_oeuvre'],
                $donnees['date_reservation'],
                $donnees['nom_membre'],
                $donnees['prenom_membre'],
                $donnees['email_membre'],
                $donnees['titre_oeuvre'],
                $donnees['auteur_oeuvre']
            );
    
            if ($resultat) {
                header('Location: index.php?action=lister_reservations');
                exit();
            } else {
                echo "Erreur lors de la modification de la réservation.";
            }
        } else {
            echo "Méthode non autorisée.";
        }
    }

    public function supprimerReservation($id_reservation) {
        $this->reservationModel->supprimerReservation($id_reservation);
        header('Location: index.php?action=lister_reservations');
        exit();
    }

    public function listerReservations() {
        // Utiliser la méthode pour récupérer tous les emprunts
        $reservations = $this->reservationModel->getAllReservations();
        // Inclure la vue pour afficher les emprunts
        require_once './views/Reservations.php';
    }
}
