<?php
class AdminController{

    //recupere la liste des utilisateurs dans la db
    public function users(){
        require_once 'App/Models/UserModel.php';
        $model = new UserModel();
        $users = $model->listUsers();
        require 'templates/admin/users.php';
    }

    //recupere la liste des agences dans la db
    public function agences(){
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        $agences = $model->listAgences();
        require 'templates/admin/agences.php';
    }

    public function createAgence(){
        require 'templates/admin/createAgences.php';
    }
    
    public function storeAgence(){
    $agenceName = $_POST['nom_ville'];
    require_once 'App/Models/AgenceModel.php';
    $model = new AgenceModel();
    if($model->agenceExists($agenceName)){
        header('Location: /touchepasauklaxon/admin/agence/create?erreur=agence_exist');
    } else {
        $model->createAgence($agenceName);
        header('Location: /touchepasauklaxon/admin/agences');
    }}

    public function editAgence(){
        $id = $_GET['id'];
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        $agence = $model->getAgenceById($id);
        require 'templates/admin/editAgences.php';
    }

    public function updateAgence(){
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
        $id = $_GET['id'];
        require_once 'App/Models/AgenceModel.php';
        $model = new AgenceModel();
        $model->deleteAgence($id);
        header('Location: /touchepasauklaxon/admin/agences');        
    }

    public function trajets(): void {
    require 'templates/admin/trajets.php';
    }

    public function deleteTrajet(): void {
    $id = $_GET['id'];
    require_once 'App/Models/TrajetModel.php';
    $model = new TrajetModel();
    $model->deleteTrajet($id);
    header('Location: /touchepasauklaxon/admin/trajets');
}
}
