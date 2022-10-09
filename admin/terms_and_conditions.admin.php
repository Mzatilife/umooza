<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

$profile = new ProfileContr;

if (isset($_POST['custerms'])) {
    $customer = strip_tags($_POST['customer']);
    // passing information
    $msg = $profile->changeCustomerTerms($customer);
}

if (isset($_POST['landterms'])) {
    $landlord = strip_tags($_POST['landlord']);
    // passing information
    $msg = $profile->changeLandlordTerms($landlord);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Admin Dashboard</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include "header.admin.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container">
            <h3 class="text-center m-3">Updating Terms and Conditions</h3>
            <?php
            if (isset($msg)) { ?>
                <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } else {
            }
            ?>
            <hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation container mt-3" novalidate>
                <?php
                $terms = $profile->viewTerms();

                foreach ($terms as $term) { ?>
                    <div class="col-sm-12">
                        <label for="firstName" class="form-label">Landlord Terms and Conditions</label>
                        <textarea name="landlord" class="form-control" id="landlord" cols="30" rows="5" required><?php echo $term['landlord'] ?></textarea>
                        <div class="invalid-feedback">
                            Enter valid terms and conditions.
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-sm btn-primary mt-3" type="submit" name="landterms"><span class="fa fa-cog"></span> Update</button>
                    </div>
                <?php } ?>
            </form>
            <hr>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation container mt-3" novalidate>
                <?php
                $terms = $profile->viewTerms();

                foreach ($terms as $term) { ?>
                    <div class="col-sm-12">
                        <label for="customer" class="form-label">Customer Terms and Conditions</label>
                        <textarea name="customer" class="form-control" id="customer" cols="30" rows="5" required><?php echo $term['customer'] ?></textarea>
                        <div class="invalid-feedback">
                            Enter valid terms and conditions.
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-sm btn-primary mt-3" type="submit" name="custerms"><span class="fa fa-cog"></span> Update</button>
                    </div>
                <?php } ?>
            </form>

        </div>

        <?php include "footer.admin.php"; ?>
    </main>
    </div>
    </div>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/form-validation.js"></script>
</body>

</html>