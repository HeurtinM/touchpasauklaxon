<?php require 'templates/layout/header.php'; ?>

<?php
require_once 'App/Core/Database.php';
$db = Database::getInstance()->getConnection();
$stmt = $db->prepare("
    SELECT trajet.*, 
        ad.nom_ville AS ville_depart, 
        aa.nom_ville AS ville_arrivee,
        user.nom AS user_nom,
        user.prenom AS user_prenom,
        user.email AS user_email,
        user.telephone AS user_telephone 
    FROM trajet
    JOIN agence ad ON trajet.id_agence_dep = ad.id_agence
    JOIN agence aa ON trajet.id_agence_arr = aa.id_agence
    JOIN user ON trajet.id_user = user.id_user
    ORDER BY gdh_depart ASC
");
$stmt->execute();
$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

//boucle pour afficher tt les trajets
foreach($trajets as $trajet): ?>
    <div>
        <p>Départ : <?php echo $trajet['ville_depart']; ?></p>
        <p>Date départ : <?php echo $trajet['gdh_depart']; ?></p>
        <p>Arrivée : <?php echo $trajet['ville_arrivee']; ?></p>
        <p>Date arrivée : <?php echo $trajet['gdh_arrivee']; ?></p>
        <p>Places disponibles : <?php echo $trajet['nb_places_dispo']; ?></p>
        <a href="/touchepasauklaxon/admin/trajet/delete?id=<?php echo $trajet['id_trajet']; ?>">Supprimer</a>
    </div>
<?php endforeach; ?>


<?php require 'templates/layout/footer.php'; ?>