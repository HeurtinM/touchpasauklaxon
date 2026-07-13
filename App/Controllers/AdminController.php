<?php

/**
 * Contrôleur gérant les fonctionnalités de l'administrateur
 */
class AdminController {

    /**
     * Verifie si il y a une session en cours, pour la "good practice"
     * Verifie si la session en cours est bien celle d'un admin
     * Redirige vers l'accueil si ce n'est pas le cas
     * 
     * @return void
     */
    private function checkAdmin(): void {
        if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /touchepasauklaxon/');
            return;
        }
    }

    /**
     * Affiche la liste de tous les utilisateurs
     * 
     * @return void
     */
    public function users(): void {
        $this->checkAdmin();
        require_once 'App/Models/UserModel.php';
        $model = new UserModel();
        $users = $model->listUsers();
        require 'templates/admin/users.php';
    }

    /**
     * Affiche la liste de toutes les agences
     * 
     * @return void
     */
    public function agences(): void {
        $this->checkAdmin();
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        $agences = $model->listAgences();
        require 'templates/admin/agences.php';
    }

    /**
     * Affiche le formulaire de création d'une agence
     * 
     * @return void
     */
    public function createAgence(): void {
        $this->checkAdmin();
        require 'templates/admin/createAgences.php';
    }

    /**
     * Traite le formulaire de création d'une agence
     * Vérifie qu'il n'y a pas deja une agence du meme nom
     * 
     * @return void
     */
    public function storeAgence(): void {
        $this->checkAdmin();
        $agenceName = $_POST['nom_ville'];
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        if($model->agenceExists($agenceName)){
            header('Location: /touchepasauklaxon/admin/agence/create?erreur=agence_exist');
        } else {
            $model->createAgence($agenceName);
            header('Location: /touchepasauklaxon/admin/agences');
        }
    }

    /**
     * Affiche le formulaire de modification d'une agence
     * 
     * @return void
     */
    public function editAgence(): void {
        $this->checkAdmin();
        $id = $_GET['id'];
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        $agence = $model->getAgenceById($id);
        require 'templates/admin/editAgences.php';
    }

    /**
     * Traite le formulaire de modification d'une agence
     * Vérifie que le nouveau nom n'existe pas déjà avant de mettre à jour
     * 
     * @return void
     */
    public function updateAgence(): void {
        $this->checkAdmin();
        $agenceName = $_POST['nom_ville'];
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        if($model->agenceExists($agenceName)){
            header('Location: /touchepasauklaxon/admin/agence/create?erreur=agence_exist');
        } else {
            $id = $_POST['id_agence'];
            $model->updateAgence($id, $agenceName);
            header('Location: /touchepasauklaxon/admin/agences');
        }
    }

    /**
     * Supprime une agence de la base de données
     * 
     * @return void
     */
    public function deleteAgence(): void {
        $this->checkAdmin();
        $id = $_GET['id'];
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        $model->deleteAgence($id);
        header('Location: /touchepasauklaxon/admin/agences');
    }

    /**
     * Affiche la liste de tous les trajets
     * 
     * @return void
     */
    public function trajets(): void {
        $this->checkAdmin();
        require 'templates/admin/trajets.php';
    }

    /**
     * Supprime un trajet de la base de données
     * 
     * @return void
     */
    public function deleteTrajet(): void {
        $this->checkAdmin();
        $id = $_GET['id'];
        require_once 'App/Models/TrajetModel.php';
        $model = new TrajetModel();
        $model->deleteTrajet($id);
        header('Location: /touchepasauklaxon/admin/trajets');
    }
}