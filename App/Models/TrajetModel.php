<?php

/**
 * Modèle gérant les opérations en base de données pour les trajets
 */
class TrajetModel {

    /**
     * Crée un nouveau trajet en base de données
     * 
     * @param int $idUser Identifiant de l'utilisateur proposant le trajet
     * @param int $agenceDep Identifiant de l'agence de départ
     * @param int $agenceArr Identifiant de l'agence d'arrivée
     * @param string $gdhDep Date et heure de départ
     * @param string $gdhArr Date et heure d'arrivée
     * @param int $nbPlaces Nombre total de places
     * @return void
     */
    public function createTrajet($idUser, $agenceDep, $agenceArr, $gdhDep, $gdhArr, $nbPlaces): void {
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

    /**
     * Récupère un trajet par son identifiant
     * 
     * @param int $id Identifiant du trajet
     * @return array Données du trajet
     */
    public function getTrajetById($id): array {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM trajet WHERE id_trajet = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Met à jour un trajet existant dans la base de données
     * 
     * @param int $id Identifiant du trajet à modifier
     * @param int $agenceDep Identifiant de la nouvelle agence de départ
     * @param int $agenceArr Identifiant de la nouvelle agence d'arrivée
     * @param string $gdhDep Nouvelle date et heure de départ
     * @param string $gdhArr Nouvelle date et heure d'arrivée
     * @param int $nbPlaces Nouveau nombre total de places
     * @return void
     */
    public function updateTrajet($id, $agenceDep, $agenceArr, $gdhDep, $gdhArr, $nbPlaces): void {
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

    /**
     * Supprime un trajet de la base de données
     * 
     * @param int $id Identifiant du trajet à supprimer
     * @return void
     */
    public function deleteTrajet($id): void {
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM trajet WHERE id_trajet = :id");
        $stmt->execute([':id' => $id]);
    }
}