<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/touchepasauklaxon/public/css/style.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
<div class="mx-5 my-3 px-3"> <!--div pour gerer le margin de la navbar sans toucher au style navbar de bootstrap-->
    <nav class="navbar border border-3 border-dark rounded mx-3 my-3 px-3">
        <a class="navbar-brand fw-bold" href="/touchepasauklaxon/">Touche pas au klaxon</a>
        <div class="d-flex align-items-center gap-2">
            <!--verifi si une session utilisateur est ouverte, puis regarde si l'utilisateur est un admin et affiche les liens nav en fonction-->
            <?php if(isset($_SESSION['user'])): ?>
                <?php if($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="/touchepasauklaxon/admin/users" class="btn btn-secondary">Utilisateurs</a>
                    <a href="/touchepasauklaxon/admin/agences" class="btn btn-secondary">Agences</a>
                    <a href="/touchepasauklaxon/admin/trajets" class="btn btn-secondary">Trajets</a>
                    <span class="mx-2">Bonjour <?php echo $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; ?></span>
                    <a href="/touchepasauklaxon/logout" class="btn btn-primary">Déconnexion</a>
                <?php else: ?>
                    <a href="/touchepasauklaxon/trajet/create" class="btn btn-primary">Créer un trajet</a>
                    <span class="mx-2">Bonjour <?php echo $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; ?></span>
                    <a href="/touchepasauklaxon/logout" class="btn btn-primary">Déconnexion</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="/touchepasauklaxon/login" class="btn btn-primary">Connexion</a>
            <?php endif; ?>
        </div>
    </nav>
</div>
