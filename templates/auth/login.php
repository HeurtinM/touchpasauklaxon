<?php require 'templates/layout/header.php'; ?>

<!--repris le form directement de w3school-->
<!--formulaire de connection-->
<div class="container mt-4" style="max-width: 400px;">
    <h2 class="mb-4">Connexion</h2>

    <?php if(isset($_GET['erreur']) && $_GET['erreur'] === 'identifiants'): ?>
        <div class="alert alert-danger">Email ou mot de passe incorrect.</div>
    <?php endif; ?>

    <form action="/touchepasauklaxon/login" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Entrez votre email" required>
        </div>
        <div class="mb-3">
            <label for="psw" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="psw" placeholder="Entrez votre mot de passe" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
</div>

<?php require 'templates/layout/footer.php'; ?>