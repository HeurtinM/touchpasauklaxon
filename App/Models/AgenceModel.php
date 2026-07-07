<?php
class AgenceModel {

    public function listAgences(){
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM agence");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createAgence($agenceName) {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO agence (nom_ville) VALUES (:nom_ville)");
        $stmt->execute([':nom_ville' => $agenceName]);
    }

    public function updateAgence($id,$agenceName){
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

    //verifie si une agence existe deja
    // renvoi un bool equivalent du nombre d'agence avec le nom donner, si aucune n'existe alors le bool sera false, sinon true
    public function agenceExists($nomVille): bool {
    require_once 'App/Core/Database.php';
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT COUNT(*) FROM agence WHERE nom_ville = :nom_ville");
    $stmt->execute([':nom_ville' => $nomVille]);
    return $stmt->fetchColumn() > 0;
}

    public function deleteAgence($id){
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM agence WHERE id_agence = :id");
        $stmt->execute([':id' => $id]);
    }
}