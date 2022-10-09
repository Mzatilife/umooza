<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
  <div class="container-fluid">
    <!-- <h5 class="text-white m-3">UmoozaCity</h5> -->
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php"><span style="background-color:white; border-radius:30%; padding: 10px;"><img src="assets/images/logo.png" width="50" height="35"></span>  <b>umooza</b> <b class="text-danger">City</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample05">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active btn btn-primary" aria-current="page" href="index.php"><i class="fa fa-home"></i> Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle btn btn-outline-secondary" href="#" id="dropdown05" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-upload"></i> Add Rental</a>
          <ul class="dropdown-menu" aria-labelledby="dropdown05">
            <li><a class="dropdown-item" href="includes/login_landlord.inc.php">Login</a></li>
            <li><a class="dropdown-item" href="includes/landlord_terms.inc.php">Register</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-outline-secondary" href="includes/about.inc.php"><i class="fa fa-users"></i> About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-outline-secondary" href="includes/help.inc.php"><i class="fa fa-info-circle"></i> Help</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle btn btn-outline-secondary" href="#" id="dropdown05" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-credit-card"></i> Account</a>
          <ul class="dropdown-menu" aria-labelledby="dropdown05">
            <li><a class="dropdown-item" href="includes/login.inc.php">Login</a></li>
            <li><a class="dropdown-item" href="includes/customer_terms.inc.php">Register</a></li>
          </ul>
        </li>
      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="name" aria-label="Search">
        <input class="form-control me-2" type="search" placeholder="district" aria-label="Search">
        <button class="btn btn-primary" type="submit"><span class="fas fa-search"></span></button>
      </form> -->
    </div>
  </div>
</nav>