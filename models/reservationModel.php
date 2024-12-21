<?php
    require_once 'conf.php';

    class ReservationModel {
        private $db;
        public function __construct()
        {
            $this->db = Database::getConnexion();
        }

        public function getAllMembres() {
            $sql = $this->db->query("SELECT id_membre, nom_membre, prenom_membre, email_membre FROM membres");
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getAllOeuvres() {
            $sql = $this->db->query("SELECT id_oeuvre, titre_oeuvre, auteur_oeuvre FROM oeuvres");
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function getReservationById($id_reservation) {
            $sql = $this->db->prepare("
                SELECT reservations.id_reservation, 
                       reservations.id_membre, 
                       reservations.id_oeuvre, 
                       reservations.date_reservation, 
                       membres.nom_membre, 
                       membres.prenom_membre, 
                       membres.email_membre, 
                       oeuvres.titre_oeuvre, 
                       oeuvres.auteur_oeuvre
                FROM reservations
                JOIN membres ON reservations.id_membre = membres.id_membre
                JOIN oeuvres ON reservations.id_oeuvre = oeuvres.id_oeuvre
                WHERE reservations.id_reservation = :id_reservation 
            ");
            
            // Lier le paramètre pour éviter les injections SQL
            $sql->bindParam(':id_reservation', $id_reservation, PDO::PARAM_INT);
            $sql->execute();
            
            // Récupérer un seul emprunt
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
        public function ajouterReservation($id_membre, $id_oeuvre, $date_reservation,$nom_membre, $prenom_membre, $email_membre, $titre_oeuvre, $auteur_oeuvre) {
            $sql = $this->db->prepare("
                INSERT INTO reservations (id_membre, id_oeuvre, date_reservation,nom_membre, prenom_membre, email_membre, titre_oeuvre, auteur_oeuvre) 
                VALUES (:id_membre, :id_oeuvre, :date_reservation,:nom_membre, :prenom_membre, :email_membre, :titre_oeuvre, :auteur_oeuvre)
            ");
        
            $sql->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
            $sql->bindParam(':id_oeuvre', $id_oeuvre, PDO::PARAM_INT);
            $sql->bindParam(':date_reservation', $date_reservation);
            $sql->bindParam(':nom_membre', $nom_membre);
            $sql->bindParam(':prenom_membre', $prenom_membre);
            $sql->bindParam(':email_membre', $email_membre);
            $sql->bindParam(':titre_oeuvre', $titre_oeuvre);
            $sql->bindParam(':auteur_oeuvre', $auteur_oeuvre);
        
            return $sql->execute();
        }
            
    
        public function modifierReservation($id_reservation, $id_membre, $id_oeuvre, $date_reservation,$nom_membre, $prenom_membre, $email_membre, $titre_oeuvre, $auteur_oeuvre) {
            $sql = $this->db->prepare("
                UPDATE reservations
                SET id_membre = :id_membre,
                    id_oeuvre = :id_oeuvre,
                    date_reservation = :date_reservation,
                    nom_membre = :nom_membre,
                    prenom_membre = :prenom_membre,
                    email_membre = :email_membre,
                    titre_oeuvre = :titre_oeuvre,
                    auteur_oeuvre = :auteur_oeuvre
                WHERE id_reservation = :id_reservation
            ");
            
            $sql->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
            $sql->bindParam(':id_oeuvre', $id_oeuvre, PDO::PARAM_INT);
            $sql->bindParam(':date_reservation', $date_reservation);
            $sql->bindParam(':nom_membre', $nom_membre);
            $sql->bindParam(':prenom_membre', $prenom_membre);
            $sql->bindParam(':email_membre', $email_membre);
            $sql->bindParam(':titre_oeuvre', $titre_oeuvre);
            $sql->bindParam(':auteur_oeuvre', $auteur_oeuvre);
            $sql->bindParam(':id_reservation', $id_reservation, PDO::PARAM_INT);
            
            return $sql->execute();
        }
    
        public function supprimerReservation($id_reservation) {
            $sql = $this->db->prepare("DELETE FROM reservations WHERE id_reservation = :id");
            $sql->bindParam(':id', $id_reservation, PDO::PARAM_INT);
            return $sql->execute();
        }
    
        /* public function getOeuvresEmpruntees() {
            $sql = "SELECT oeuvres.titre_oeuvre, emprunts.nom_membre, emprunts.date_emprunt, emprunts.date_retour 
                    FROM emprunts 
                    JOIN oeuvres ON emprunts.id_oeuvre = oeuvres.id_oeuvre";
        
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
 */
        public function getAllReservations() {
            $sql = $this->db->prepare("
                SELECT reservations.id_reservation, 
                       reservations.id_membre, 
                       reservations.id_oeuvre, 
                       reservations.date_reservation, 
                       membres.nom_membre, 
                       membres.prenom_membre, 
                       membres.email_membre, 
                       oeuvres.titre_oeuvre, 
                       oeuvres.auteur_oeuvre
                FROM reservations
                JOIN membres ON reservations.id_membre = membres.id_membre
                JOIN oeuvres ON reservations.id_oeuvre = oeuvres.id_oeuvre 
                ORDER BY id_reservation ASC
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    