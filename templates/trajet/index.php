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
$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC); ?>

<div class="mx-5">
    <h2 class="my-3">Trajets proposés</h2>
    <div class="rounded overflow-hidden"> <!--div pour appliquer les coins arrondi-->
        <table class="table table-striped table-bordered text-center mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Départ</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Places</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!--boucle pour afficher les trajets-->
                <?php foreach($trajets as $trajet): ?>
                <tr>
                    <td><?php echo $trajet['ville_depart']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($trajet['gdh_depart'])); ?></td>
                    <td><?php echo date('H:i', strtotime($trajet['gdh_depart'])); ?></td>
                    <td><?php echo $trajet['ville_arrivee']; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($trajet['gdh_arrivee'])); ?></td>
                    <td><?php echo date('H:i', strtotime($trajet['gdh_arrivee'])); ?></td>
                    <td><?php echo $trajet['nb_places_dispo']; ?></td>
                    <td>
                        <?php if(isset($_SESSION['user'])): ?>
                            <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $trajet['id_trajet']; ?>">
                                <i class="bi bi-eye"></i>
                            </button>
                            <?php if($_SESSION['user']['id_user'] == $trajet['id_user']): ?>
                                <a href="/touchepasauklaxon/trajet/edit?id=<?php echo $trajet['id_trajet']; ?>" class="btn btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="/touchepasauklaxon/trajet/delete?id=<?php echo $trajet['id_trajet']; ?>" class="btn btn-sm text-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>