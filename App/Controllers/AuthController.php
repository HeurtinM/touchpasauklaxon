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
            # Source - https://stackoverflow.com/a/13837459
            # Posted by Yogesh Suthar, modified by community. See post 'Timeline' for change history
            # Retrieved 2026-06-23, License - CC BY-SA 3.0

            echo '<script language="javascript">';
            echo 'alert("mot de passe incorrect")';
            echo '</script>';
        }
    }

    public function logout(): void {
    session_destroy();
    header('Location: /touchepasauklaxon/');
    }
}