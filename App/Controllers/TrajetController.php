<?php

/**
 * Contrôleur gérant les opérations sur les trajets
 */
class TrajetController {

    /**
     * Affiche le formulaire de création d'un trajet
     * 
     * @return void
     */
    public function create(): void {
        require 'templates/trajet/create.php';
    }

    /**
     * Traite le formulaire de création d'un trajet
     * Vérifie la cohérence des données
     * 
     * @return void
     */
    public function store(): void {
        //variable recuperé via le formulaire
        $idUser = $_SESSION['user']['id_user'];
        $agenceDep = $_POST['id_agence_dep'];
        $agenceArr = $_POST['id_agence_arr'];
        $gdhDep = $_POST['gdh_depart'];
        $gdhArr = $_POST['gdh_arrivee'];
        $nbPlaces = $_POST['nb_places_total'];

        //verifie que l'agence de départ et d'arriver sont différente, puis vérifie que l'heure et date de départ avant l'heure d'arriver.
        //si tout est correcte, le trajet est enregistrer dans la db
        if($agenceArr == $agenceDep){
            header('Location: /touchepasauklaxon/trajet/create?erreur=agences_identiques');
        } else if($gdhArr < $gdhDep){
            header('Location: /touchepasauklaxon/trajet/create?erreur=dates_incoherentes');
        } else {
            require_once 'App/Models/TrajetModel.php';
            $model = new TrajetModel();
            $model->createTrajet($idUser, $agenceDep, $agenceArr, $gdhDep, $gdhArr, $nbPlaces);
            header('Location: /touchepasauklaxon/');
        }
    }

    /**
     * Affiche le formulaire de modification d'un trajet
     * 
     * @return void
     */
    public function edit(): void {
        $id = $_GET['id'];
        require_once 'App/Models/TrajetModel.php';
        $model = new TrajetModel();
        $trajet = $model->getTrajetById($id);
        require 'templates/trajet/edit.php';
    }

    /**
     * Traite le formulaire de modification d'un trajet
     * Vérifie la cohérence des données
     * 
     * @return void
     */
    public function update(): void {
        //variable recuperé via le formulaire
        $id = $_POST['id_trajet'];
        $idUser = $_SESSION['user']['id_user'];
        $agenceDep = $_POST['id_agence_dep'];
        $agenceArr = $_POST['id_agence_arr'];
        $gdhDep = $_POST['gdh_depart'];
        $gdhArr = $_POST['gdh_arrivee'];
        $nbPlaces = $_POST['nb_places_total'];

        //verifie que l'agence de départ et d'arriver sont différente, puis vérifie que l'heure et date de départ avant l'heure d'arriver.
        //si tout est correcte, le trajet est mis à jour dans la db
        if($agenceArr == $agenceDep){
            header('Location: /touchepasauklaxon/trajet/edit?id=' . $id . '&erreur=agences_identiques');
        } else if($gdhArr < $gdhDep){
            header('Location: /touchepasauklaxon/trajet/edit?id=' . $id . '&erreur=dates_incoherentes');
        } else {
            require_once 'App/Models/TrajetModel.php';
            $model = new TrajetModel();
            $model->updateTrajet($id, $agenceDep, $agenceArr, $gdhDep, $gdhArr, $nbPlaces);
            header('Location: /touchepasauklaxon/?succes=trajet_modifie');
        }
    }

    /**
     * Supprime un trajet de la base de données
     * 
     * @return void
     */
    public function delete(): void {
        $id = $_GET['id'];
        require_once 'App/Models/TrajetModel.php';
        $model = new TrajetModel();
        $model->deleteTrajet($id);
        header('Location: /touchepasauklaxon/');
    }
}