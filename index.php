<?php
require_once 'controllers/MembreController.php';
require_once 'controllers/OeuvreController.php';
require_once 'controllers/EmpruntController.php';
require_once 'controllers/ReservationController.php';



// Créer une instance de MembreController
$controller = new MembreController();
$controller2 = new OeuvreController();
$controller3 = new EmpruntController();
$controller4 = new ReservationController();
//$controller5 = new UserController($db);


// Récupérer l'action depuis l'URL ou définir une action par défaut
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {


    // case 'login': // Afficher le formulaire de connexion
    //     $controller->afficherLogin();
    //     break;

// GESTION DE LA CONNEXION 
    case 'authentifier': // Traiter les données de connexion
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = isset($_POST['email']) ? $_POST['email'] :null;
        $password = isset($_POST['password']) ? $_POST['password'] :null;
        if($email && $password){
            $controller->authentifier($email, $password);
        }
       }
        break;

    case 'deconnexion': // Déconnexion de l'utilisateur
        $controller->deconnexion();
        break;

    case 'accueil_index':
        $controller->afficherAccueil();
        break;

        //GESTION DES MEMBRES 
    case 'ajout_lecteur': // Ajouter un membre
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller->addMembre();
        } else {
            $controller->afficherFormulaireAjout();
        }
        break;

    case 'liste_lecteur': // Afficher la liste des membres
        $controller->afficherMembre();
        break;

    case 'suppression': // Supprimer un membre
        $id = isset($_GET['id']) ? intval($_GET['id']) : null; // Assurer que $id est un entier
        if ($id) {
            $controller->deleteMembre($id); // Appel du contrôleur pour supprimer
        } else {
            echo "ID invalide ou non défini.";
        }
        break;

        // GESTION DES OEUVRES----------------------------------------------------------GESTION DES OEUVRES 

        case 'ajout_oeuvre': // Ajouter un membre
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $controller2->addOeuvre($_POST);
            } else {
                $controller2->afficherFormulaireAjout();
            }
            break;
    
        case 'liste_oeuvre': // Afficher la liste des membres
            $controller2->afficherOeuvre();
            break;
    
        case 'suppression_oeuvre': // Supprimer un membre
            $id = isset($_GET['id']) ? intval($_GET['id']) : null; // Assurer que $id est un entier
            if ($id) {
                $controller2->deleteOeuvre($id); // Appel du contrôleur pour supprimer
            } else {
                echo "ID invalide ou non défini.";
            }
            break;
        
            case 'modifier_membre_form':
                $controller->afficherFormulaireModification($_GET['id']);
                break;
            case 'modifier_membre':
                $controller->modifierMembre(); // Pas besoin de passer $_POST ici, car cela se fait dans la méthode
                break;

                case 'modifier_oeuvre_form':
                    $controller2->afficherFormulaireModification($_GET['id']);
                    break;
                case 'modifier_oeuvre':
                    $controller2->modifierOeuvre($_POST);
                    break;


                //GESTION EMPRUNTS -----------------------------------------------------------------------------GESTION EMPRUNTS


                case 'ajouter_emprunt':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $controller3->ajouterEmprunt();
                    } else {
                        $controller3->afficherFormulaireAjout();
                    }
                    break;
                
                case 'modifier_emprunt_form':
                    $id = $_GET['id'] ?? null;
                    if ($id) {
                        $controller3->afficherFormulaireModification($id);
                    } else {
                        echo "Erreur : ID de l'emprunt manquant.";
                    }
                    break;
                
                case 'modifier_emprunt':
                    if ($_POST) {
                        $controller3->modifierEmprunt();
                    }
                    break;
                
                case 'supprimer_emprunt':
                    $id = $_GET['id'] ?? null;
                    if ($id) {
                        $controller3->supprimerEmprunt($id);
                    } else {
                        echo "Erreur : ID de l'emprunt manquant.";
                    }
                    break;
                
                case 'lister_emprunts':
                    $controller3->listerEmprunts();
                    break;

                    case 'lister_oeuvres_empruntees':
                        $controller3->listerOeuvresEmpruntees(); // Nouvelle méthode pour lister les œuvres empruntées
                        break;
                

                        // GESTION DES RESERVATIONS 

                //GESTION EMPRUNTS -----------------------------------------------------------------------------GESTION EMPRUNTS


                case 'ajouter_reservation':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $controller4->ajouterReservation();
                    } else {
                        $controller4->afficherFormulaireAjout();
                    }
                    break;
                
                case 'modifier_reservation_form':
                    $id = $_GET['id'] ?? null;
                    if ($id) {
                        $controller4->afficherFormulaireModification($id);
                    } else {
                        echo "Erreur : ID de la reservation est  manquant.";
                    }
                    break;
                
                case 'modifier_reservation':
                    if ($_POST) {
                        $controller4->modifierReservation();
                    }
                    break;
                
                case 'supprimer_reservation':
                    $id = $_GET['id'] ?? null;
                    if ($id) {
                        $controller4->supprimerReservation($id);
                    } else {
                        echo "Erreur : ID de la reservation est manquant.";
                    }
                    break;
                
                case 'lister_reservations':
                    $controller4->listerReservations();
                    break;

                   /*  case 'lister_oeuvres_empruntees':
                        $controller4->listerOeuvresEmpruntees(); // Nouvelle méthode pour lister les œuvres empruntées
                        break;
                 */

                 //RECHERCHE---------------------------------------------------RECHERCHE------------------------------------------RECHERCHE
                 case 'rechercher_membre': // Rechercher un membre
                    $controller->rechercherMembre();
                    break;

                    case 'rechercher_oeuvre': // Rechercher un membre
                        $controller2->rechercherOeuvre();
                        break;

                        case 'rechercher_emprunt': // Rechercher un membre
                            $controller3->rechercherEmprunt();
                            break;


                    
                            // GESTION DES PROFILS --------------------------- GESTION DES PROFILS 

                            case 'profile':
                                $controller5->afficherProfilEtListe();
                                break;
                        
                            case 'logout':
                                $controller5->deconnecter();
                                break;

    default: // Rediriger par défaut vers la page de connexion
        //header('Location: views/login.php');
        //header('Location: views/login.php');
       $controller->afficherLogin();
       /* // Afficher la liste des membres si aucune action n'est spécifiée
       $controller->afficherMembre(); */
      //$controller2->afficherOeuvre();
        break;
        


}
