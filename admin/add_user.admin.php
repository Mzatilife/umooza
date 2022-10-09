<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
include "../includes/register.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Add User</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-select.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include "header.admin.php";
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php
        if (isset($msg)) { ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        } elseif (isset($msg2)) { ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <?php echo $msg2; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else {
        } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation container mt-3" novalidate>
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="text" name="fname" class="form-control" id="firstName" placeholder="John" required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="lastName" class="form-label">Last name</label>
                    <input type="text" name="lname" class="form-control" id="lastName" placeholder="Doe" required>
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="email" class="form-label">User Position</label>
                    <select class="form-control selectpicker" data-live-search="true" name="type" aria-label=".form-select example" id="type" required>
                        <option selected>Open this select menu</option>
                        <option value="Liaising">Liaising Officer</option>
                        <option value="finance">Finance Officer</option>
                    </select>
                    <div class="invalid-feedback">
                        Valid user type is required.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" name="phone" class="form-control" id="phone" required>
                    <div class="invalid-feedback">
                        Please enter a valid phone number.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="phone2" class="form-label">Phone 2 <span class="text-muted">(Optional)</span></label>
                    <input type="number" name="phone2" class="form-control" id="phone2">
                    <div class="invalid-feedback">
                        Please enter a valid phone number.
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-50 btn btn-primary mb-4" type="submit" name="register">Register</button>

            </div>
        </form>

        <?php include "footer.admin.php"; ?>
    </main>
    </div>
    </div>
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bootstrap-select.js"></script>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/form-validation.js"></script>
</body>

</html>