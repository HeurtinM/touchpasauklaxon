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
    <?php if(isset($_SESSION['user'])): ?>
        <h2 class="my-3">Trajets proposés</h2>
    <?php else: ?>
        <h2 class="my-3">Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</h5>
    <?php endif; ?>
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
                <?php if(isset($_SESSION['user'])): ?>
                <div id="modal-<?php echo $trajet['id_trajet']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Auteur : <?php echo $trajet['user_nom']; ?> <?php echo $trajet['user_prenom']; ?></p>
                                <p>Téléphone : <?php echo chunk_split($trajet['user_telephone'],2,' ') ?></p>
                                <p>Email : <?php echo $trajet['user_email']; ?></p>
                                <p>Nombre de places : <?php echo $trajet['nb_places_total']; ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>