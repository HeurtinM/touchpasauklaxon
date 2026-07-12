<?php require 'templates/layout/header.php'; ?>

<div class="mx-5 mt-4 mb-5">
    <h2 class="mb-3">Utilisateurs</h2>
    <div class="rounded overflow-hidden">
        <table class="table table-striped table-bordered text-center mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $user['nom']; ?></td>
                    <td><?php echo $user['prenom']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo chunk_split($user['telephone'], 2, ' '); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'templates/layout/footer.php'; ?>