<?php
class AuthController{

    public function showLogin(){
       require 'templates/auth/login.php';
    }

    public function login(){

        $email = $_POST['email'];
        $motDePasse = $_POST['psw']; 

        require_once 'App/core/Database.php'; //d'apres ce que j'ai trouvé, require once est la meilleur manière d'instancier une classe

        //fait principalement en suivant ceci: https://grafikart.fr/tutoriels/pdo-php-1141
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($motDePasse,$user['mot_de_passe'])){
            $_SESSION['user'] = $user;
            header('Location: /touchepasauklaxon/');
        }
        else{
            header('Location: /touchepasauklaxon/login?erreur=identifiants');
        }
    }

    public function logout(): void {
    session_destroy();
    header('Location: /touchepasauklaxon/');
    }
}