<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="../index.landlord.php">Umooza <i class="text-danger">City</i></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <span class="w-100"></span>
    <div class="dropdown p-3">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="d-lg-inline text-gray-600 small"><?php echo $fname; ?></span>
            <img class="img-profile rounded-circle" style="width: 30px; margin-left:5px;" src="../../assets/images/profile.svg">
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="../profile.landlord.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Sign out</a></li>
        </ul>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.landlord.php">
                            <span class="fas fa-home"></span>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../property_type.landlord.php">
                            <span class="fas fa-upload"></span>
                            Submit Item
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../properties.landlord.php">
                            <span class="fas fa-building"></span>
                            Rentals
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../finances.landlord.php">
                            <span class="fas fa-credit-card"></span>
                            Finances
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../property_archive.landlord.php">
                            <span class="fas fa-trash-alt"></span>
                            Item Archive
                        </a>
                    </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Reports</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="../property_report.landlord.php">
                            <span data-feather="file-text"></span>
                            Property Report
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../financial_report.landlord.php">
                            <span data-feather="file-text"></span>
                            Financial Report
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Ready to leave?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to leave.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                        <a href="../../includes/logout.inc.php" class="btn btn-primary">logout</a>
                    </div>
                </div>
            </div>
        </div>