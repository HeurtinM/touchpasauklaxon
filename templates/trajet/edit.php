<?php
require 'templates/layout/header.php';
?>

<!--formulaire d'edit de trajet, le meme que pour la création juste avec les champs pre-remplis par les valeur du trajet en cours de modifications-->
<form action="/touchepasauklaxon/trajet/update" method="post">
    <?php if(isset($_GET['erreur'])): ?>
    <p style="color:red;">
        <?php 
        if($_GET['erreur'] === 'agences_identiques') {
            echo "L'agence de départ et d'arrivée doivent être différentes.";
        } elseif($_GET['erreur'] === 'dates_incoherentes') {
            echo "La date d'arrivée doit être après la date de départ.";
        }
        ?>
    </p>
    <?php endif; ?>
  <div class="container">
    <!-- infos visible mais non modifiable par l'utilisateur comme demander dans le brief-->
    <input type="text" value="<?php echo $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; ?>" readonly>
    <input type="email" value="<?php echo $_SESSION['user']['email']; ?>" readonly>
    <input type="tel" value="<?php echo $_SESSION['user']['telephone']; ?>" readonly>

    
    <?php 
    require_once 'App/Core/Database.php';
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM agence");
    $stmt->execute();
    $agences = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <select name="id_agence_dep" id="agenceDepart" required>
        <?php foreach($agences as $agence): ?>
            <option value="<?php echo $agence['id_agence']; ?>"
                <?php if($agence['id_agence'] == $trajet['id_agence_dep']) echo 'selected'; ?>>
                <?php echo $agence['nom_ville']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="id_agence_arr" id="agenceArrivee" required>
        <?php foreach($agences as $agence): ?>
            <option value="<?php echo $agence['id_agence']; ?>"
                <?php if($agence['id_agence'] == $trajet['id_agence_arr']) echo 'selected'; ?>>
                <?php echo $agence['nom_ville']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="datetime-local" name="gdh_depart" value="<?php echo $trajet['gdh_depart']; ?>" required>
    <input type="datetime-local" name="gdh_arrivee" value="<?php echo $trajet['gdh_arrivee']; ?>" required>

    <input type="number" name="nb_places_total" min="1" value="<?php echo $trajet['nb_places_total']; ?>" required>

    <button type="submit">Proposer le trajet</button>
  </div>
<?php
require 'templates/layout/footer.php';
?>