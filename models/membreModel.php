<?php
    require_once 'conf.php';

    class MembreModel{
        private $db;
        public function __construct()
        {
            $this->db = Database::getConnexion();
        }

        //Ajout d'un nouveau etudiant
        public function ajouterMembre($matricule,$nom,$prenom,$sexe,$email,
        $telephone,$statut){
            $sql = $this->db->prepare("INSERT INTO  `membres`(`matricule_membre`, 
            `nom_membre`, `prenom_membre`, `sexe`, `email_membre`, `tel_membre`, `statut`)
             VALUES(:mat,:nom,:prenom,:sexe,:email,:tel,:statut) ");
            $sql->bindParam(':mat',$matricule);
            $sql->bindParam(':nom',$nom);
            $sql->bindParam(':prenom',$prenom);
            $sql->bindParam(':sexe',$sexe);
            $sql->bindParam(':email',$email);
            $sql->bindParam(':tel',$telephone);
            $sql->bindParam(':statut',$statut);
            $resultat = $sql->execute();
            return $resultat;
        }

        // fonction qui retourne la liste des etudiants
        public function listeMembre(){
            $sql = $this->db->prepare("SELECT * FROM membres");
            $sql->execute();
            $resultat = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $resultat;
        }

        //Fonction qui supprime un etudiant 
        public function supprimerMembre($id) {
            try {
                $sql = $this->db->prepare('DELETE FROM membres WHERE id_membre = :id');
                $sql->bindParam(':id', $id); // Cast en entier pour éviter les injections SQL
                $resultat = $sql->execute(); // Retourne true si réussi
                return $resultat;
            } catch (PDOException $e) {
                // Vérifiez si l'erreur est liée à une contrainte d'intégrité
                if ($e->getCode() == 23000) {
                    return "Impossible de supprimer ce membre car il a des emprunts en cours.";
                } else {
                    return "Erreur lors de la suppression : " . $e->getMessage();
                }
            }
        }


        public function getMembreById($id_membre) {
    $sql = $this->db->prepare("SELECT * FROM membres WHERE id_membre = :id");
    $sql->bindParam(':id', $id_membre, PDO::PARAM_INT);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_ASSOC);
}

public function modifierMembre($id_membre, $matricule, $nom, $prenom, $sexe, $email, $telephone, $statut) {
    $sql = "UPDATE membres SET 
                matricule_membre = :matricule, 
                nom_membre = :nom, 
                prenom_membre = :prenom, 
                sexe = :sexe, 
                email_membre = :email, 
                tel_membre = :telephone, 
                statut = :statut 
            WHERE id_membre = :id_membre";
    
    $stmt = $this->db->prepare($sql);
    
    $stmt->bindParam(':id_membre', $id_membre);
    $stmt->bindParam(':matricule', $matricule);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':statut', $statut);
    
    return $stmt->execute();
}

    // RECHERCHE ------------------------------------------------------RECHERCHE
    public function rechercherMembre($terme) {
        $sql = $this->db->prepare("SELECT * FROM membres WHERE nom_membre LIKE :terme OR prenom_membre LIKE :terme OR email_membre LIKE :terme");
        $terme = "%" . $terme . "%"; // Pour rechercher dans le champ
        $sql->bindParam(':terme', $terme);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
        // MembreModel.php
public function authentifierBibliothecaire($email, $password) {
    $sql = "SELECT EXISTS(SELECT 1 FROM bibliothecaire WHERE email_biblio = :email AND password = :mdp) as bn ";
    $req= $this->db->prepare($sql);
    $req->bindParam(':email', $email, PDO::PARAM_STR);
    $req->bindParam(':mdp', $password, PDO::PARAM_STR);
    $req->execute();
    $resultat= $req->fetch(PDO::FETCH_ASSOC);

    return $resultat['bn']==1;

    // if($resultat){
    //     if($sql->rowcount() > 0){
    //         $user = $sql->fetch(PDO::FETCH_ASSOC);
    //         session_start();
    //         //header('location: index.php?action=accueil');
    //     }
    // }
}

        
        // Rechercher un utilisateur par email
    public function trouverParEmail($email) {
        $sql = $this->db->prepare('SELECT * FROM bibliothecaire WHERE email_membre = :email');
        $sql->bindParam(':email', $email);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    }