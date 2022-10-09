<?php
include_once '../includes/classautoloader.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>About</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php
    include "navbar2.inc.php";
    ?>
    <main class="text-center">
        <div class="container">
            <div class="logo">
                <img src="../assets/images/logo.png" alt="logo" width="10%" height="100px">
            </div>
            <div>
                <?php
                $profile = new ProfileContr;
                $address = $profile->viewAddress();

                foreach ($address as $add) {
                ?> <div class="text-secondary">
                        <h3><?php echo $add['company_name']; ?></h3>
                        <?php
                        $abouts = $profile->viewAbout();

                        foreach ($abouts as $about) {
                        ?>
                            <p><?php echo $about['about']; ?></p>
                        <?php } ?>
                        <address><?php echo $add['company_name']; ?>, <br> P.O. Box <?php echo $add['postal_box']; ?>, <br> <?php echo $add['district']; ?></address>
                        <p><b>Phone:</b> 0<?php echo $add['phone']; ?> | <b>Email:</b> <?php echo $add['email']; ?></p>
                    </div>
                <?php } ?>
                <?php
                $urls = $profile->viewUrls();

                foreach ($urls as $url) { ?>
                    <div class="alert alert-primary row col-md-6 m-auto">
                        <p class="col-6"><a href="https://<?php echo $url['facebook']; ?>" class="text-decoration-none"><span class="fab fa-facebook"></span> Facebook</a></p>
                        <p class="col-6"><a href="https://<?php echo $url['instagram']; ?>" class="text-decoration-none text-warning"><span class="fab fa-instagram"></span> Instagram</a></p>
                        <p class="col-6"><a href="https://wa.me/<?php echo $url['whatsapp']; ?>" class="text-decoration-none text-success"><span class="fab fa-whatsapp"></span> Whatsapp</a></p>
                        <p class="col-6"><a href="https://<?php echo $url['twitter']; ?>" class="text-decoration-none"><span class="fab fa-twitter"></span> Twitter</a></p>
                    </div>
                <?php } ?>

            </div>

        </div>
    </main>
    <?php
    include "footer2.inc.php";
    ?>

    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>