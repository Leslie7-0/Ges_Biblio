<?php
    require_once 'conf.php';

    class OeuvreModel{
        private $db;
        public function __construct()
        {
            $this->db = Database::getConnexion();
        }

        //Ajout d'un nouveau etudiant
        public function ajouterOeuvre($titre,$auteur,$statut){
            $sql = $this->db->prepare("INSERT INTO  `oeuvres`(`titre_oeuvre`, 
            `auteur_oeuvre`, `statut_oeuvre`)
             VALUES(:titre,:auteur,:statut) ");
            $sql->bindParam(':titre',$titre);
            $sql->bindParam(':auteur',$auteur);
            $sql->bindParam(':statut',$statut);
            $resultat = $sql->execute();
            return $resultat;
        }

        // fonction qui retourne la liste des etudiants
        public function listeOeuvre(){
            $sql = $this->db->prepare("SELECT * FROM oeuvres");
            //$oeuvres = $sql->execute();
            $sql->execute();
            $oeuvres = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $oeuvres;
        }

        //Fonction qui supprime un etudiant 
        public function supprimerOeuvre($id){
            try{
            $sql = $this->db->prepare('DELETE FROM oeuvres WHERE id_oeuvre = :id');
            $sql->bindParam(':id', $id); // Cast en entier pour éviter les injections SQL
            $resultat =$sql->execute(); // Retourne true si réussi
            return $resultat;
        } catch (PDOException $e) {
            // Vérifiez si c'est une erreur liée à la contrainte d'intégrité
            if ($e->getCode() == 23000) {
                return "Impossible de supprimer cette œuvre car elle est associée à un ou plusieurs emprunts.";
            } else {
                throw $e; // Laissez l'erreur remonter si elle n'est pas liée à l'intégrité
            }
        }  
        }


        public function getOeuvreById($id_oeuvre) {
            $sql = $this->db->prepare("SELECT * FROM oeuvres WHERE id_oeuvre = :id_oeuvre");
            $sql->bindParam(':id_oeuvre', $id_oeuvre, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        }

        //Fonction qui modifie une oeuvre 
        public function modifierOeuvre($id_oeuvre, $titre_oeuvre, $auteur_oeuvre, $statut_oeuvre) {
            $sql = $this->db->prepare("
                UPDATE oeuvres 
                SET 
                    titre_oeuvre = :titre_oeuvre,
                    auteur_oeuvre = :auteur_oeuvre,
                    statut_oeuvre = :statut_oeuvre
                WHERE id_oeuvre = :id_oeuvre
            ");
            $sql->bindParam(':id_oeuvre', $id_oeuvre, PDO::PARAM_INT);
            $sql->bindParam(':titre_oeuvre', $titre_oeuvre);
            $sql->bindParam(':auteur_oeuvre', $auteur_oeuvre);
            $sql->bindParam(':statut_oeuvre', $statut_oeuvre);
            return $sql->execute();
        }

         // RECHERCHE ------------------------------------------------------RECHERCHE
    public function rechercherOeuvre($terme) {
        $sql = $this->db->prepare("SELECT * FROM oeuvres WHERE titre_oeuvre LIKE :terme OR auteur_oeuvre LIKE :terme");
        $terme = "%" . $terme . "%"; // Pour rechercher dans le champ
        $sql->bindParam(':terme', $terme);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    }