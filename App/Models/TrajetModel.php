<?php
class TrajetModel {
    public function createTrajet($idUser, $agenceDep, $agenceArr, $gdhDep, $gdhArr, $nbPlaces) {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO trajet (gdh_depart, gdh_arrivee, nb_places_total, nb_places_dispo, id_user, id_agence_dep, id_agence_arr) 
                               VALUES (:gdh_depart, :gdh_arrivee, :nb_places_total, :nb_places_dispo, :id_user, :id_agence_dep, :id_agence_arr)");
        $stmt->execute([
            ':gdh_depart' => $gdhDep,
            ':gdh_arrivee' => $gdhArr,
            ':nb_places_total' => $nbPlaces,
            ':nb_places_dispo' => $nbPlaces,
            ':id_user' => $idUser,
            ':id_agence_dep' => $agenceDep,
            ':id_agence_arr' => $agenceArr
        ]);
    }

    public function getTrajetById($id){
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM trajet WHERE id_trajet = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTrajet($id, $agenceDep, $agenceArr, $gdhDep, $gdhArr, $nbPlaces){
    require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE trajet SET 
            id_agence_dep = :id_agence_dep,
            id_agence_arr = :id_agence_arr,
            gdh_depart = :gdh_depart,
            gdh_arrivee = :gdh_arrivee,
            nb_places_total = :nb_places_total,
            nb_places_dispo = :nb_places_total
            WHERE id_trajet = :id");
        $stmt->execute([
            ':id_agence_dep' => $agenceDep,
            ':id_agence_arr' => $agenceArr,
            ':gdh_depart' => $gdhDep,
            ':gdh_arrivee' => $gdhArr,
            ':nb_places_total' => $nbPlaces,
            ':id' => $id
        ]);
    }

    public function deleteTrajet($id){
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM trajet WHERE id_trajet = :id");
        $stmt->execute([':id' => $id]);
    }
}