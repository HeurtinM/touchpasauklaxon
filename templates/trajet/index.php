<?php
require_once 'App/Core/Database.php';
$db = Database::getInstance()->getConnection();
$stmt = $db->prepare("
    SELECT trajet.*, 
           ad.nom_ville AS ville_depart, 
           aa.nom_ville AS ville_arrivee 
    FROM trajet
    JOIN agence ad ON trajet.id_agence_dep = ad.id_agence
    JOIN agence aa ON trajet.id_agence_arr = aa.id_agence
    WHERE nb_places_dispo > 0 AND gdh_depart > NOW() 
    ORDER BY gdh_depart ASC
");
$stmt->execute();
$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

 foreach($trajets as $trajet): ?>
    <div>
        <p>Départ : <?php echo $trajet['ville_depart']; ?></p>
        <p>Date départ : <?php echo $trajet['gdh_depart']; ?></p>
        <p>Arrivée : <?php echo $trajet['ville_arrivee']; ?></p>
        <p>Date arrivée : <?php echo $trajet['gdh_arrivee']; ?></p>
        <p>Places disponibles : <?php echo $trajet['nb_places_dispo']; ?></p>
    </div>
<?php endforeach; ?>