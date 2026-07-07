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
        require_once 'App/Models/UserModel.php';
        $model = new AgenceModel();
        $users = $model->listAgences();
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
    }
}
}