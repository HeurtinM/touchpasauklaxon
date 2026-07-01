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
        <?php if(isset($_SESSION['user'])): ?>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myModal">Détails</button>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                            <h4 class="modal-title">Trajet proposé par:</h4>
                        </div>
                        <div class="modal-body">
                            <p>Nom : <?php echo $trajet['user_nom']; ?></p>
                            <p>Prénom : <?php echo $trajet['user_prenom']; ?></p>
                            <p>Email : <?php echo $trajet['user_email']; ?></p>
                            <p>Téléphone : <?php echo $trajet['user_telephone']; ?></p>
                            <p>Nombre de places : <?php echo $trajet['nb_places_total']; ?></p>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
<?php endforeach; ?>