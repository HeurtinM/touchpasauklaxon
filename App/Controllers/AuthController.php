<?php

/**
 * Contrôleur gérant l'authentification des utilisateurs
 */
class AuthController {

    /**
     * Affiche le formulaire de connexion
     * 
     * @return void
     */
    public function showLogin(): void {
        require 'templates/auth/login.php';
    }

    /**
     * Traite le formulaire de connexion
     * Vérifie les identifiants et crée une session si correct
     * Fait principalement en suivant : https://grafikart.fr/tutoriels/pdo-php-1141
     * 
     * @return void
     */
    public function login(): void {
        //recupere l'email et mdp fourni
        $email = $_POST['email'];
        $motDePasse = $_POST['psw'];

        //instancie la db si ce n'est pas deja fait pour cette execution du script
        require_once 'App/core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //verifie si l'email et mdp sont corrects et renvoi sur une session connectée si oui, affiche un message d'erreur si non
        if($user && password_verify($motDePasse, $user['mot_de_passe'])){
            $_SESSION['user'] = $user;
            header('Location: /touchepasauklaxon/');
        } else {
            header('Location: /touchepasauklaxon/login?erreur=identifiants');
        }
    }

    /**
     * Termine la session en cours et redirige vers l'accueil
     * 
     * @return void
     */
    public function logout(): void {
        session_destroy();
        header('Location: /touchepasauklaxon/');
    }
}