<?php require 'templates/layout/header.php'; ?>

<a href="/touchepasauklaxon/admin/agence/create">Créer une agence</a>

<?php foreach($agences as $agence): ?>
    <div>
        <p>Ville : <?php echo $agence['nom_ville']; ?></p>
        <a href="/touchepasauklaxon/admin/agence/edit?id=<?php echo $agence['id_agence']; ?>">Modifier</a>
        <a href="/touchepasauklaxon/admin/agence/delete?id=<?php echo $agence['id_agence']; ?>">Supprimer</a>
    </div>
<?php endforeach; ?>

<?php require 'templates/layout/footer.php'; ?>