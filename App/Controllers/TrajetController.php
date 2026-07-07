<?php
class TrajetController{
    public function create(){
        require 'templates/trajet/create.php';
    }

    public function store(){
        //variable recuperé via le formulaire
        $idUser = $_SESSION['user']['id_user'];

        $agenceDep = $_POST['id_agence_dep'];
        $agenceArr = $_POST['id_agence_arr'];

        $gdhDep = $_POST['gdh_depart'];
        $gdhArr = $_POST['gdh_arrivee'];

        $nbPlaces = $_POST['nb_places_total'];

        //verifie que l'agence de départ et d'arriver sont différente, puis vérifie que l'heure et date de départ avant l'heure d'arriver. 
        // Si tout est correcte, le trajet est enregistrer dans la db
        if($agenceArr == $agenceDep){
            header('Location: /touchepasauklaxon/trajet/create?erreur=agences_identiques');
        }
        else if($gdhArr<$gdhDep){
            header('Location: /touchepasauklaxon/trajet/create?erreur=dates_incoherentes');
        }
        else{
            require_once 'App/Models/TrajetModel.php';
            $model = new TrajetModel();
            $model->createTrajet($idUser, $agenceDep, $agenceArr, $gdhDep, $gdhArr, $nbPlaces);
            header('Location: /touchepasauklaxon/');
        };
    }
    
    //fonction edit
    public function edit(){
        $id = $_GET['id'];
        require_once 'App/Models/TrajetModel.php';
        $model = new TrajetModel();
        $trajet = $model->getTrajetById($id);
        require 'templates/trajet/edit.php';
    }

    public function update(){
        //variable recuperé via le formulaire
        $id = $_POST['id_trajet'];

        $idUser = $_SESSION['user']['id_user'];

        $agenceDep = $_POST['id_agence_dep'];
        $agenceArr = $_POST['id_agence_arr'];

        $gdhDep = $_POST['gdh_depart'];
        $gdhArr = $_POST['gdh_arrivee'];

        $nbPlaces = $_POST['nb_places_total'];

        //verifie que l'agence de départ et d'arriver sont différente, puis vérifie que l'heure et date de départ avant l'heure d'arriver. 
        // Si tout est correcte, le trajet est enregistrer dans la db
       if($agenceArr == $agenceDep){
        header('Location: /touchepasauklaxon/trajet/edit?id=' . $id . '&erreur=agences_identiques');
        } else if($gdhArr < $gdhDep){
            header('Location: /touchepasauklaxon/trajet/edit?id=' . $id . '&erreur=dates_incoherentes');
        } else {
            require_once 'App/Models/TrajetModel.php';
            $model = new TrajetModel();
            $model->updateTrajet($id, $agenceDep, $agenceArr, $gdhDep, $gdhArr, $nbPlaces);
            header('Location: /touchepasauklaxon/');
        }
    }

    //fonction delete
    public function delete(){
        $id = $_GET['id'];
        require_once 'App/Models/TrajetModel.php';
        $model = new TrajetModel();
        $model->deleteTrajet($id);
        header('Location: /touchepasauklaxon/');        
    }
}