<?php
class UserModel {

    public function listUsers(){
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}