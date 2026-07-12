<?php require 'templates/layout/header.php'; ?>

<!--formulaire d'edit de trajet, le meme que pour la création juste avec les champs pre-remplis par les valeur du trajet en cours de modifications-->
<div class="container mt-4">
    <h2 class="mb-4">Modifier un trajet</h2>

    <?php if(isset($_GET['erreur'])): ?>
    <div class="alert alert-danger">
        <?php 
        if($_GET['erreur'] === 'agences_identiques') {
            echo "L'agence de départ et d'arrivée doivent être différentes.";
        } elseif($_GET['erreur'] === 'dates_incoherentes') {
            echo "La date d'arrivée doit être après la date de départ.";
        }
        ?>
    </div>
    <?php endif; ?>

    <form action="/touchepasauklaxon/trajet/update" method="post">
        <!--champ caché pour recuperer l'id pour la function update-->
        <input type="hidden" name="id_trajet" value="<?php echo $trajet['id_trajet']; ?>">

        <!-- infos visible mais non modifiable par l'utilisateur comme demander dans le brief-->
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" value="<?php echo $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" value="<?php echo $_SESSION['user']['email']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="tel" class="form-control" value="<?php echo $_SESSION['user']['telephone']; ?>" readonly>
        </div>

        <?php 
        require_once 'App/Core/Database.php';
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM agence");
        $stmt->execute();
        $agences = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Agence de départ</label>
                <select name="id_agence_dep" class="form-select" required>
                    <?php foreach($agences as $agence): ?>
                        <option value="<?php echo $agence['id_agence']; ?>"
                            <?php if($agence['id_agence'] == $trajet['id_agence_dep']) echo 'selected'; ?>>
                            <?php echo $agence['nom_ville']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <label class="form-label">Agence d'arrivée</label>
                <select name="id_agence_arr" class="form-select" required>
                    <?php foreach($agences as $agence): ?>
                        <option value="<?php echo $agence['id_agence']; ?>"
                            <?php if($agence['id_agence'] == $trajet['id_agence_arr']) echo 'selected'; ?>>
                            <?php echo $agence['nom_ville']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Date et heure de départ</label>
                <input type="datetime-local" name="gdh_depart" class="form-control" value="<?php echo $trajet['gdh_depart']; ?>" required>
            </div>
            <div class="col">
                <label class="form-label">Date et heure d'arrivée</label>
                <input type="datetime-local" name="gdh_arrivee" class="form-control" value="<?php echo $trajet['gdh_arrivee']; ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre de places</label>
            <input type="number" name="nb_places_total" class="form-control" min="1" value="<?php echo $trajet['nb_places_total']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Modifier le trajet</button>
    </form>
</div>

<?php require 'templates/layout/footer.php'; ?>