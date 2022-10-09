<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Properties</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include "header.landlord.php";
    $property = new ManagePropertyContr();
    $row = $property->viewReason($_SESSION['prop_reason_id']);
    $price = $row['price'];
    $price = number_format($price);
     ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col mt-3">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ($row['type'] == 'other' || $row['type'] == 'electronic' || !empty($row['name'])) ? $row['name'] : $row['type']; ?> Details</h5>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary p-2">Uploaded</span>: <?php echo $row['date']; ?></p>
                            <p class="card-text"><?php echo $row['district'] . ", " . $row['area']; ?> | <span class="badge rounded-pill bg-secondary p-2">K<?php echo $price . " / " . $row['period'] . " " . $row['duration']; ?></span></p>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            
                        <h5 class="card-title">Reason for rejection</h5>
                            <div class="alert alert-danger fade show mt-3" role="alert">
                                <?php echo $row['reason']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.landlord.php"; ?>
    </main>
    </div>
    </div>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>