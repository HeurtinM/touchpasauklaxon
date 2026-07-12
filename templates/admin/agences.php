<?php require 'templates/layout/header.php'; ?>

<!-- pas de visuel fourni donc j'ai fait au plus simple en ce basant sur la presentations des trajets dans la page d'acceuil-->
<div class="mx-5 mt-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Agences</h2>
        <a href="/touchepasauklaxon/admin/agence/create" class="btn btn-primary">Créer une agence</a>
    </div>
    <div class="rounded overflow-hidden">
        <table class="table table-striped table-bordered text-center mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Ville</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($agences as $agence): ?>
                <tr>
                    <td><?php echo $agence['nom_ville']; ?></td>
                    <td>
                        <a href="/touchepasauklaxon/admin/agence/edit?id=<?php echo $agence['id_agence']; ?>" class="btn btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="/touchepasauklaxon/admin/agence/delete?id=<?php echo $agence['id_agence']; ?>" class="btn btn-sm text-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'templates/layout/footer.php'; ?>