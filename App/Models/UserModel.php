<?php

/**
 * Modèle gérant les opérations en base de données pour les utilisateurs
 */
class UserModel {

    /**
     * Récupère tous les utilisateurs de la base de données
     * 
     * @return array Tableau de tous les utilisateurs
     */
    public function listUsers(): array {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}