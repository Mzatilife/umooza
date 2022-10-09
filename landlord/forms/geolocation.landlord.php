<?php
include "../../includes/session.inc.php";
include_once '../../includes/classautoloaderform.inc.php';

if (isset($_GET["lat"]) && isset($_GET["long"])) {
    $upload = new ManagePropertyContr;
    $type = $_SESSION['coord_type'];
    $dist = $_SESSION['coord_dist'];
    $area = $_SESSION['coord_area'];

    $rw = $upload->viewForCoord($user_id, $type, $dist, $area);
    $st = $upload->submitCoordinates($rw['prop_id'], $_GET['lat'], $_GET['long']);

if ($st) {
    header("location: final_step.landlord.php");
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
    <title>Geolocation</title>
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
        <h4 class="text-primary mt-3 mb-3">Share your location (Optional)</h4>
        <div class="alert alert-success fade show mt-3 text-center" role="alert">
            <p class="text-secondary" style="font-size: 16px;">Share your location !</p>
            <p class="text-secondary" style="font-size: 16px;">It is optional to submit your exact location or your item's location</p>
            <p class="text-secondary mt-4" style="font-size: 16px;">THANK YOU</p>
        </div>
        <button onclick="getLocation()" class="btn btn-primary">Share <span class="fa fa-map-pin"></span></button>
        <a href="final_step.landlord.php" class="btn btn-danger">Don't Share</a>

        <?php include "../footer.landlord.php"; ?>
    </main>
    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            window.location.href = "geolocation.landlord.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "An unknown error occurred."
                    break;
            }
        }
    </script>
    </div>
    </div>
    <script src="../../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/dashboard.js"></script>
    <script src="../../assets/js/form-validation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
</body>

</html>