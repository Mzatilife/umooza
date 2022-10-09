<?php
include "../../includes/session.inc.php";
include_once '../../includes/classautoloaderform.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Final Step</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>

<body>
    <?php include "header.landlord.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h4 class="text-primary mt-3 mb-3">Final Step (Successful)</h4>
        <div class="alert alert-success fade show mt-3 text-center" role="alert">
            <p class="text-secondary" style="font-size: 16px;">You have successfully submitted your item!</p>
            <p class="text-secondary" style="font-size: 16px;">Our agents will review the item and you might be contacted if need be.</p>
            <p class="text-secondary mt-4" style="font-size: 16px;">THANK YOU</p>
        </div>
        <a href="../property_type.landlord.php" class="btn btn-primary w-50">Finish</a>

        <?php include "../footer.landlord.php"; ?>
    </main>
    </div>
    </div>
    <script src="../../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/dashboard.js"></script>
    <script src="../../assets/js/form-validation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
</body>

</html>