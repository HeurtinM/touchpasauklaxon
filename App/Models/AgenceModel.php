<?php

/**
 * Modèle gérant les opérations en base de données pour les agences
 */
class AgenceModel {

    /**
     * Récupère toutes les agences dans la base de données
     * 
     * @return array Tableau de toutes les agences
     */
    public function listAgences(): array {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM agence");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère une agence par son identifiant
     * 
     * @param int $id Identifiant de l'agence
     * @return array Données de l'agence
     */
    public function getAgenceById($id): array|false {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM agence WHERE id_agence = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle agence dans la base de données
     * 
     * @param string $agenceName Nom de la ville de l'agence
     * @return void
     */
    public function createAgence($agenceName): void {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO agence (nom_ville) VALUES (:nom_ville)");
        $stmt->execute([':nom_ville' => $agenceName]);
    }

    /**
     * Met à jour le nom d'une agence existante
     * 
     * @param int $id Identifiant de l'agence à modifier
     * @param string $agenceName Nouveau nom de la ville
     * @return void
     */
    public function updateAgence($id, $agenceName): void {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE agence SET 
            nom_ville = :nom_ville
            WHERE id_agence = :id");
        $stmt->execute([
            ':nom_ville' => $agenceName,
            ':id' => $id
        ]);
    }

    /**
     * Vérifie si une agence existe déjà dans la base de données
     * Renvoie un bool équivalent du nombre d'agences avec le nom donné,
     * si aucune n'existe alors le bool sera false, sinon true
     * 
     * @param string $nomVille Nom de la ville à vérifier
     * @return bool True si l'agence existe, false sinon
     */
    public function agenceExists($nomVille): bool {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM agence WHERE nom_ville = :nom_ville");
        $stmt->execute([':nom_ville' => $nomVille]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Supprime une agence de la base de données
     * 
     * @param int $id Identifiant de l'agence à supprimer
     * @return void
     */
    public function deleteAgence($id): void {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM agence WHERE id_agence = :id");
        $stmt->execute([':id' => $id]);
    }
}