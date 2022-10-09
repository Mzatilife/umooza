<div class="bg-light">
  <footer class="py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="../index.php" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link  px-2 text-muted dropdown-toggle" href="#" id="dropdown05" data-bs-toggle="dropdown" aria-expanded="false">Add Property</a>
        <ul class="dropdown-menu" aria-labelledby="dropdown05">
          <li><a class="dropdown-item" href="login_landlord.inc.php">Login</a></li>
          <li><a class="dropdown-item" href="landlord_terms.inc.php">Register</a></li>
        </ul>
      </li>
      <li class="nav-item"><a href="about.inc.php" class="nav-link px-2 text-muted">About</a></li>
      <li class="nav-item"><a href="help.inc.php" class="nav-link px-2 text-muted">Help</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link  px-2 text-muted dropdown-toggle" href="#" id="dropdown05" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
        <ul class="dropdown-menu" aria-labelledby="dropdown05">
          <li><a class="dropdown-item" href="login.inc.php">Login</a></li>
          <li><a class="dropdown-item" href="customer_terms.inc.php">Register</a></li>
        </ul>
      </li>
    </ul>
    <?php
    $profile = new ProfileContr;
    $address = $profile->viewAddress();

    foreach ($address as $add) {
    ?>
      <p class="text-center text-muted">&copy; <script>
          document.write(new Date().getFullYear());
        </script> <?php echo $add['company_name'] ?></p>
    <?php } ?>
  </footer>
</div>