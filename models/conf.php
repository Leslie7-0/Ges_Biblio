<?php
    class Database{
        private static $instance = null;
        private $conn;
        //Les parametres de connexion au serveur
        private $host = "localhost";
        private $dbName = "ges_bibliotheque";
        private $userName = "root";
        private $password = "";

        private function __construct()
        {
           try{
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbName}",
            $this->userName,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
           }catch(PDOException $e){
            die("Erreur de connexion a la base de donnee : ".$e->getMessage());
           }
        }

        public static function getConnexion(){
            if(self::$instance == null){
                self::$instance = new Database();
            }
            return self::$instance->conn;
        }
    } 