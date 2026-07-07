<?php
require 'templates/layout/header.php';
?>

<!--formulaire de création d'agence-->
<form action="/touchepasauklaxon/admin/agence/store" method="post">
  <div class="container">
    <?php if(isset($_GET['erreur'])): ?>
    <p style="color:red;">
        <?php 
        if($_GET['erreur'] === 'agence_exist') {
            echo "Cette agence existe déjà";
        }?>
    </p>
    <?php endif; ?>

    <input type="text" name="nom_ville" placeholder="Nom de la ville" required>

    <button type="submit">crée l'agence</button>
  </div>
</form>

<?php
require 'templates/layout/footer.php';
?>