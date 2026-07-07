<?php
require 'templates/layout/header.php';
?>

<!--formulaire de modification d'agence-->
<form action="/touchepasauklaxon/admin/agence/update" method="post">
  <div class="container">
    <?php if(isset($_GET['erreur'])): ?>
    <p style="color:red;">
        <?php 
        if($_GET['erreur'] === 'agence_exist') {
            echo "Cette agence existe déjà";
        }?>
    </p>
    <?php endif; ?>

    <!--champ caché pour pouvoir recuperer l'id de l'agence pour la methode update-->
    <input type="hidden" name="id_agence" value="<?php echo $agence['id_agence']; ?>">

    <input type="text" name="nom_ville" placeholder="Nom de la ville" value="<?php echo $agence['nom_ville']; ?>" required>

    <button type="submit">modifier l'agence</button>
  </div>
</form>

<?php
require 'templates/layout/footer.php';
?>