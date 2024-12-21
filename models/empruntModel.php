<?php
    require_once 'conf.php';

    class EmpruntModel {
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
    
        public function getEmpruntById($id_emprunt) {
            $sql = $this->db->prepare("
                SELECT emprunts.id_emprunt, 
                       emprunts.id_membre, 
                       emprunts.id_oeuvre, 
                       emprunts.date_emprunt, 
                       emprunts.date_retour,
                       emprunts.limit_emprunt, 
                       membres.nom_membre, 
                       membres.prenom_membre, 
                       membres.email_membre, 
                       oeuvres.titre_oeuvre, 
                       oeuvres.auteur_oeuvre
                FROM emprunts
                JOIN membres ON emprunts.id_membre = membres.id_membre
                JOIN oeuvres ON emprunts.id_oeuvre = oeuvres.id_oeuvre
                WHERE emprunts.id_emprunt = :id_emprunt 
            ");
            
            // Lier le paramètre pour éviter les injections SQL
            $sql->bindParam(':id_emprunt', $id_emprunt, PDO::PARAM_INT);
            $sql->execute();
            
            // Récupérer un seul emprunt
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
        public function ajouterEmprunt($id_membre, $id_oeuvre, $date_emprunt, $date_retour, $limit_emprunt, $nom_membre, $prenom_membre, $email_membre, $titre_oeuvre, $auteur_oeuvre) {
            $sql = $this->db->prepare("
                INSERT INTO emprunts (id_membre, id_oeuvre, date_emprunt, date_retour, limit_emprunt, nom_membre, prenom_membre, email_membre, titre_oeuvre, auteur_oeuvre) 
                VALUES (:id_membre, :id_oeuvre, :date_emprunt, :date_retour, :limit_emprunt, :nom_membre, :prenom_membre, :email_membre, :titre_oeuvre, :auteur_oeuvre)
            ");
        
            $sql->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
            $sql->bindParam(':id_oeuvre', $id_oeuvre, PDO::PARAM_INT);
            $sql->bindParam(':date_emprunt', $date_emprunt);
            $sql->bindParam(':date_retour', $date_retour);
            $sql->bindParam(':limit_emprunt', $limit_emprunt, PDO::PARAM_INT);
            $sql->bindParam(':nom_membre', $nom_membre);
            $sql->bindParam(':prenom_membre', $prenom_membre);
            $sql->bindParam(':email_membre', $email_membre);
            $sql->bindParam(':titre_oeuvre', $titre_oeuvre);
            $sql->bindParam(':auteur_oeuvre', $auteur_oeuvre);
        
            return $sql->execute();
        }
            
    
        public function modifierEmprunt($id_emprunt, $id_membre, $id_oeuvre, $date_emprunt, $date_retour, $limit_emprunt,$nom_membre, $prenom_membre, $email_membre, $titre_oeuvre, $auteur_oeuvre) {
            $sql = $this->db->prepare("
                UPDATE emprunts
                SET id_membre = :id_membre,
                    id_oeuvre = :id_oeuvre,
                    date_emprunt = :date_emprunt,
                    date_retour = :date_retour,
                    limit_emprunt = :limit_emprunt,
                    nom_membre = :nom_membre,
                    prenom_membre = :prenom_membre,
                    email_membre = :email_membre,
                    titre_oeuvre = :titre_oeuvre,
                    auteur_oeuvre = :auteur_oeuvre
                WHERE id_emprunt = :id_emprunt
            ");
            
            $sql->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
            $sql->bindParam(':id_oeuvre', $id_oeuvre, PDO::PARAM_INT);
            $sql->bindParam(':date_emprunt', $date_emprunt);
            $sql->bindParam(':date_retour', $date_retour);
            $sql->bindParam(':limit_emprunt', $limit_emprunt, PDO::PARAM_INT);
            $sql->bindParam(':nom_membre', $nom_membre);
            $sql->bindParam(':prenom_membre', $prenom_membre);
            $sql->bindParam(':email_membre', $email_membre);
            $sql->bindParam(':titre_oeuvre', $titre_oeuvre);
            $sql->bindParam(':auteur_oeuvre', $auteur_oeuvre);
            $sql->bindParam(':id_emprunt', $id_emprunt, PDO::PARAM_INT);
            
            return $sql->execute();
        }
    
        public function supprimerEmprunt($id_emprunt) {
            $sql = $this->db->prepare("DELETE FROM emprunts WHERE id_emprunt = :id");
            $sql->bindParam(':id', $id_emprunt, PDO::PARAM_INT);
            return $sql->execute();
        }
    
        public function getOeuvresEmpruntees() {
            $sql = "SELECT oeuvres.titre_oeuvre, emprunts.nom_membre, emprunts.date_emprunt, emprunts.date_retour 
                    FROM emprunts 
                    JOIN oeuvres ON emprunts.id_oeuvre = oeuvres.id_oeuvre";
        
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllEmprunts() {
            $sql = $this->db->prepare("
                SELECT emprunts.id_emprunt, 
                       emprunts.id_membre, 
                       emprunts.id_oeuvre, 
                       emprunts.date_emprunt, 
                       emprunts.date_retour,
                       emprunts.limit_emprunt, 
                       membres.nom_membre, 
                       membres.prenom_membre, 
                       membres.email_membre, 
                       oeuvres.titre_oeuvre, 
                       oeuvres.auteur_oeuvre
                FROM emprunts
                JOIN membres ON emprunts.id_membre = membres.id_membre
                JOIN oeuvres ON emprunts.id_oeuvre = oeuvres.id_oeuvre
                ORDER BY id_emprunt ASC
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        // RECHERCHE ------------------------------------------------------RECHERCHE
        public function rechercherEmprunt($terme) {
            $sql = $this->db->prepare("
                SELECT emprunts.id_emprunt, 
                       emprunts.id_membre, 
                       emprunts.id_oeuvre, 
                       emprunts.date_emprunt, 
                       emprunts.date_retour,
                       membres.nom_membre, 
                       membres.prenom_membre, 
                       oeuvres.titre_oeuvre
                FROM emprunts
                JOIN membres ON emprunts.id_membre = membres.id_membre
                JOIN oeuvres ON emprunts.id_oeuvre = oeuvres.id_oeuvre
                WHERE membres.nom_membre LIKE :terme 
                   OR membres.prenom_membre LIKE :terme 
                   OR emprunts.date_emprunt LIKE :terme
            ");
            
            $terme = "%" . $terme . "%"; // Pour rechercher dans le champ
            $sql->bindParam(':terme', $terme);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    