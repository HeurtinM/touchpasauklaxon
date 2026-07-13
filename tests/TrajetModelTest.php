<?php
require_once __DIR__ . '/../App/Core/Database.php';
require_once __DIR__ . '/../App/Models/TrajetModel.php';

use PHPUnit\Framework\TestCase;

class TrajetModelTest extends TestCase {
    
    public function testCreateTrajet(){
        $model = new TrajetModel();

        // Crée un trajet de test
        $model->createTrajet(2, 1, 2, '2027-01-01 10:00:00', '2027-01-01 18:00:00', 4);
        $id = Database::getInstance()->getLastInsertId();

        // Vérifie que la creation a bien eu lieu
        $trajet = $model->getTrajetById($id);
        $this->assertNotNull($trajet);
        $this->assertEquals(4, $trajet['nb_places_total']);

        //supprime le trajet pour nettoyer la db
        $model->deleteTrajet($id);
    }

    public function testUpdateTrajet(){
        $model = new TrajetModel();
        
        // Crée un trajet de test
        $model->createTrajet(2, 1, 2, '2027-01-01 10:00:00', '2027-01-01 18:00:00', 4);
        $id = Database::getInstance()->getLastInsertId();
        
        // Modifie le trajet
        $model->updateTrajet($id, 1, 3, '2027-01-01 10:00:00', '2027-01-01 18:00:00', 6);
        
        // Vérifie que la modification a bien eu lieu
        $trajet = $model->getTrajetById($id);
        $this->assertEquals(6, $trajet['nb_places_total']);
        $this->assertEquals(3, $trajet['id_agence_arr']);

        //supprime le trajet pour nettoyer la db
        $model->deleteTrajet($id);
    }

    public function testDeleteTrajet(){
        $model = new TrajetModel();
        
        // Crée un trajet de test
        $model->createTrajet(2, 1, 2, '2027-01-01 10:00:00', '2027-01-01 18:00:00', 4);
        $id = Database::getInstance()->getLastInsertId();
        
        // Supprime le trajet
        $model->deleteTrajet($id);
        
        // Vérifie que le trajet n'existe plus
        $trajet = $model->getTrajetById($id);
        $this->assertFalse($trajet);
    }


}