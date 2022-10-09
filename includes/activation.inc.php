<?php
include_once 'classautoloader.inc.php';

if (isset($_GET['eid']) && isset($_GET['token']) && isset($_GET['exd'])) {
    $validation_key = $_GET['token'];
    $email = urldecode(base64_decode($_GET['eid']));
    $expire = urldecode(base64_decode($_GET['exd']));

    date_default_timezone_get();
    $current_date = date("Y-m-d H:i:s");

    if ($current_date >= $expire) {
        $msg2 = "Verification link expired";
    } else {

        $activate = new ManageUserContr;
        $result = $activate->checkActivation($email, $validation_key);

        if ($result == 1) {
            $msg2 = "Email already verified!";
        } else {
            $result2 = $activate->userActivation($email, $validation_key);

            if ($result2) {
                $msg = "Email has been successfully verified";
            } else {
                $msg2 = "Could not activate email";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Property Page</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
</head>

<body>
    <?php
    include "navbar2.inc.php";
    ?>
    <div class="row grid">
        <div class="col-md-6 p-3">
            <img src="../assets/images/activation.svg" width="100%" alt="activation svg">
        </div>
        <div class="col-md-6 bg-light text-center">
            <div class="p-3">
                <h3 class="p-3">Email Verification</h3>
                <?php
                if (isset($msg)) { ?>
                    <div class="alert alert-success fade show mt-3" role="alert">
                        <?php echo $msg; ?>
                    </div>
                <?php
                } elseif (isset($msg2)) { ?>
                    <div class="alert alert-danger fade show mt-3" role="alert">
                        <?php echo $msg2; ?>
                    </div>
                <?php } else {
                } ?>
                <a href="login.inc.php" class="btn btn-primary m-3">Login</a>
            </div>
        </div>
    </div>

    <?php
    include "footer2.inc.php";
    ?>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>