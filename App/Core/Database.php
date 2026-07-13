<?php

/**
 * Classe gérant la connexion à la base de données
 * Implémente le design pattern Singleton pour garantir une instance unique
 * Singleton et PDO fait a partir de : https://laconsole.dev/formations/php/design-pattern-singleton
 */
class Database {

    /** @var string Hôte de la base de données */
    private $host;

    /** @var string Nom de la base de données */
    private $dbname;

    /** @var string Utilisateur de la base de données */
    private $user;

    /** @var string Mot de passe de la base de données */
    private $password;

    /** @var Database|null Instance unique de la classe */
    private static ?Database $instance = null;

    /** @var PDO Connexion PDO */
    private PDO $connection;

    /**
     * Constructeur privé : empêche l'instanciation directe
     * Établit la connexion PDO à la base de données
     */
    private function __construct() {
        $this->connection = new PDO("mysql:host=localhost;port=3307;dbname=touchepasauklaxon", "root", "");
    }

    /**
     * Méthode statique pour récupérer l'unique instance de la classe
     * Crée l'instance si elle n'existe pas encore
     * 
     * @return Database Instance unique de la classe
     */
    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Retourne la connexion PDO active
     * 
     * @return PDO Connexion à la base de données
     */
    public function getConnection(): PDO {
        return $this->connection;
    }
}