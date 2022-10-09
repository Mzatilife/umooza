<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

if (isset($_POST['submit'])) {
    $type =  strip_tags($_POST['type']);
    if ($type == 'house') {
        $_SESSION['prop_type'] = $type;
        header("location: forms/house.landlord.php");
    } elseif ($type == 'office') {
        $_SESSION['prop_type'] = $type;
        header("location: forms/office.landlord.php");
    } elseif ($type == 'hostel') {
        $_SESSION['prop_type'] = $type;
        header("location: forms/hostel.landlord.php");
    } elseif ($type == 'flats') {
        $_SESSION['prop_type'] = $type;
        header("location: forms/flats.landlord.php");
    } elseif ($type == 'land') {
        $_SESSION['prop_type'] = $type;
        header("location: forms/land.landlord.php");
    } elseif ($type == 'electronic') {
        $_SESSION['prop_type'] = $type;
        header("location: forms/electronic.landlord.php");
    } elseif ($type == 'other') {
        $_SESSION['prop_type'] = $type;
        header("location: forms/other.landlord.php");
    } else {
        $_SESSION['prop_type'] = $type;
        header("location: forms/new.landlord.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Property Type</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-select.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include "header.landlord.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h4 class="text-primary mt-3 mb-3">Step 1</h4>
        <div class="alert alert-primary fade show text-dark p-3 mb-3" role="alert">
            <p style="font-size: 16px;">Select the item type to continue. If the item does not exist on the list, <b class="text-info">choose "other"</b></p>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" class="needs-validation container mt-3" novalidate>
                        <h5 class="card-title mb-3">Select item type</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 form-group">
                                <select class="form-control selectpicker" data-live-search="true" aria-label="Default select example" name="type" required>
                                    <option selected disabled>Open this select menu</option>
                                    <?php
                                    $category = new CategoryContr();
                                    $cat = $category->viewCategory();
                                    foreach ($cat as $ct) {
                                    ?>
                                        <option style="text-transform:capitalize;" value="<?php echo $ct['category_name'] ?>"><?php echo $ct['category_name'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Valid property type is required.
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <button type="submit" name="submit" class="btn btn-primary w-20">Select</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include "footer.landlord.php"; ?>
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