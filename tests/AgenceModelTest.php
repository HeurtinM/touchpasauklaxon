<?php
require_once __DIR__ . '/../App/Core/Database.php';
require_once __DIR__ . '/../App/Models/AgenceModel.php';

use PHPUnit\Framework\TestCase;

class AgenceModelTest extends TestCase {

    public function testCreateAgence(): void {
        $model = new AgenceModel();

        // Crée une agence de test
        $model->createAgence('VilleTest');
        $id = Database::getInstance()->getLastInsertId();

        // Vérifie que la création a bien eu lieu
        $agence = $model->getAgenceById($id);
        $this->assertNotNull($agence);
        $this->assertEquals('VilleTest', $agence['nom_ville']);

        // Supprime l'agence pour nettoyer la db
        $model->deleteAgence($id);
    }

    public function testUpdateAgence(): void {
        $model = new AgenceModel();

        // Crée une agence de test
        $model->createAgence('VilleTest');
        $id = Database::getInstance()->getLastInsertId();

        // Modifie l'agence
        $model->updateAgence($id, 'VilleTestModifiee');

        // Vérifie que la modification a bien eu lieu
        $agence = $model->getAgenceById($id);
        $this->assertEquals('VilleTestModifiee', $agence['nom_ville']);

        // Supprime l'agence pour nettoyer la db
        $model->deleteAgence($id);
    }

    public function testDeleteAgence(): void {
        $model = new AgenceModel();

        // Crée une agence de test
        $model->createAgence('VilleTest');
        $id = Database::getInstance()->getLastInsertId();

        // Supprime l'agence
        $model->deleteAgence($id);

        // Vérifie que l'agence n'existe plus
        $agence = $model->getAgenceById($id);
        $this->assertFalse($agence);
    }
}