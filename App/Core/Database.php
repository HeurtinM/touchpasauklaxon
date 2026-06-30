<?php
class Database{
    private $host;
    private $dbname;
    private $user;
    private $password;

    //singleton et PDO pris d'ici: https://laconsole.dev/formations/php/design-pattern-singleton
    private static ?Database $instance = null;
    private PDO $connection;

    // Constructeur privé : empêche l'instanciation directe
    private function __construct() {
        $this->connection = new PDO("mysql:host=localhost;port=3307;dbname=touchepasauklaxon", "root", "");
    }

    // Méthode statique pour récupérer l'unique instance
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Accéder à la connexion PDO
    public function getConnection(): PDO {
        return $this->connection;
    }

}