<?php
require 'templates/layout/header.php';
?>
<?php
 if(isset($_GET['succes']) && $_GET['succes'] === 'trajet_modifie'): ?>
    <div class="alert mx-5 mt-3" style="background-color: #e9e9e9;">
        Le trajet a été modifié
    </div>
<?php endif;?>
<?php
require 'templates/trajet/index.php'
?>
<?php
require 'templates/layout/footer.php';
?>