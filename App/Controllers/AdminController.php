<?php
class AdminController{

    //fonction privé pour check si la session en cours est bien celle d'un admin
    //verifi egalement si une session est en cours, pour "good practice"
    private function checkAdmin(): void {
        if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /touchepasauklaxon/');
            return;
        }
    }

    //recupere la liste des utilisateurs dans la db
    public function users(){
        $this->checkAdmin();
        require_once 'App/Models/UserModel.php';
        $model = new UserModel();
        $users = $model->listUsers();
        require 'templates/admin/users.php';
    }

    //recupere la liste des agences dans la db
    public function agences(){
        $this->checkAdmin();
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        $agences = $model->listAgences();
        require 'templates/admin/agences.php';
    }

    public function createAgence(){
        $this->checkAdmin();
        require 'templates/admin/createAgences.php';
    }
    
    public function storeAgence(){
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

    public function editAgence(){
        $this->checkAdmin();
        $id = $_GET['id'];
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        $agence = $model->getAgenceById($id);
        require 'templates/admin/editAgences.php';
    }

    public function updateAgence(){
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
    }}

    //fonction delete
    public function deleteAgence(){
        $this->checkAdmin();
        $id = $_GET['id'];
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        $model->deleteAgence($id);
        header('Location: /touchepasauklaxon/admin/agences');        
    }

    public function trajets(): void {
        $this->checkAdmin();
        require 'templates/admin/trajets.php';
    }

    public function deleteTrajet(): void {
        $this->checkAdmin();
        $id = $_GET['id'];
        require_once 'App/Models/TrajetModel.php';
        $model = new TrajetModel();
        $model->deleteTrajet($id);
        header('Location: /touchepasauklaxon/admin/trajets');
    }
}
