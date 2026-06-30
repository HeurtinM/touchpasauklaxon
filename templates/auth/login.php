<?php
require 'templates/layout/header.php';
?>

<!--repris le form directement de w3school-->
<form action="/touchepasauklaxon/login" method="post">
  <div class="container">
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <button type="submit">Login</button>
  </div>
</form>

<?php
require 'templates/layout/footer.php';
?>