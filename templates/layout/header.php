<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav>
    <?php if(isset($_SESSION['user'])): ?>
        <?php if($_SESSION['user']['role'] === 'admin'): ?>
            <a href="/touchepasauklaxon/admin">Touche pas au klaxon</a>
            <a href="/touchepasauklaxon/admin/users">Utilisateurs</a>
            <a href="/touchepasauklaxon/admin/agences">Agences</a>
            <a href="/touchepasauklaxon/admin/trajets">Trajets</a>
            <?php echo $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; ?>
            <a href="/touchepasauklaxon/logout">Se déconnecter</a>
        <?php else: ?>
            <a href= "/touchepasauklaxon/trajet/create">Proposer un trajet</a> 
            <?php echo $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; ?>
            <a href="/touchepasauklaxon/logout">Se déconnecter</a>
        <?php endif; ?>
    <?php else: ?>
       <a href="/touchepasauklaxon/login">Se connecter</a>
    <?php endif; ?>
</nav>
