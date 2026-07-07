<?php require 'templates/layout/header.php'; ?>

<?php foreach($users as $user): ?>
    <div>
        <p><?php echo $user['nom'] . ' ' . $user['prenom']; ?></p>
        <p><?php echo $user['email']; ?></p>
        <p><?php echo $user['telephone']; ?></p>
    </div>
<?php endforeach; ?>

<?php require 'templates/layout/footer.php'; ?>