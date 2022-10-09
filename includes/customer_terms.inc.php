<?php
include_once 'classautoloader.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Terms and conditions</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="text-center mt-3">
        <h3>Terms and Conditions</h3>
    </div>
    <div class="col-md-12">
        <div class="container">
            <hr class="mb-0">
            <pre>
                        <p>
                            <?php
                            $profile =  new ProfileContr;

                            $terms = $profile->viewTerms();

                            foreach ($terms as $term) {
                                echo $term['customer'];
                            }
                            ?>
                            </p>
                        </pre>
            <hr class="mt-0">
        </div>
        <div class="text-center">
            <a class="btn btn-success m-3" href="register_customer.inc.php"><span class="fa fa-check"></span> Accept</a>
            <a href="../index.php" onclick="return confirm('Accept terms and conditions to continue, else exit!')" class="btn btn-danger"><span class="fa fa-times"></span> Decline</a>
        </div>
    </div>
</body>

</html>