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
    <title>Rented Property</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include "header.admin.php";
    $property = new ManagePropertyContr();
    $shoutout = new shoutoutContr();
    $payment = new PaymentContr();
    $user = new ManageUserContr();
    $row = $property->viewSingleProperty($_SESSION['rented_prop_id']);
    $pay = $payment->viewRented($_SESSION['rented_prop_id']);
    $res = $user->viewUser($pay['customer_id']);
    $price = $row['price'];
    $price = number_format($price);
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col mt-3">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-6">
                        <!-- viewing the images using the slider -->
                        <!-- viewing the images using the slider -->
                        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active h-25">
                                    <img class="bd-placeholder-img" width="100%" height="300px" src="../uploads/<?php echo $row['image1']; ?>" alt="image" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                </div>
                                <div class="carousel-item">
                                    <img class="bd-placeholder-img" width="100%" height="300px" src="../uploads/<?php echo $row['image2']; ?>" alt="image" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                </div>
                                <div class="carousel-item">
                                    <img class="bd-placeholder-img" width="100%" height="300px" src="../uploads/<?php echo $row['image3']; ?>" alt="image" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                </div>
                                <div class="carousel-item">
                                    <img class="bd-placeholder-img" width="100%" height="300px" src="../uploads/<?php echo $row['image4']; ?>" alt="image" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title" style="text-transform: capitalize;"><?php echo ($row['type'] == 'other' || $row['type'] == 'electronic') ? $row['name'] : $row['type']; ?> Details</h5>
                            <p class="card-text"><?php echo $row['district'] . ", " . $row['area']; ?> | <span class="badge rounded-pill bg-secondary">K<?php echo $price . " / " . $row['period'] . " " . $row['duration']; ?></span></p>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Landlord Details</h5>
                            <p class="card-text"><?php echo $row['first_name'] . " " . $row['last_name']; ?> | <?php echo $row['address']; ?></p>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary">Phone</span> 0<?php echo $row['phone'];
                                                                                                                echo (empty($row['phone_2'])) ?: " | 0" . $row['phone_2']; ?></p>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary">Email</span> <?php echo $row['email']; ?></p>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary">National ID</span>
                                <button class="p-0" data-bs-toggle="modal" data-bs-target="#image" style="width: 40%; border-radius:5px;"><img src="../uploads/nationalIDs/<?php echo $row['national_id']; ?>" width="100%" class="small-img"></button>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Customer Details</h5>
                            <p class="card-text"><?php echo $res['first_name'] . " " . $res['last_name']; ?> | <?php echo $res['address']; ?></p>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary">Phone</span> 0<?php echo $res['phone'];
                                                                                                                echo (empty($res['phone_2'])) ?: " | 0" . $res['phone_2']; ?></p>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary">Email</span> <?php echo $res['email']; ?></p>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary">National ID</span>
                                <button class="p-0" data-bs-toggle="modal" data-bs-target="#image2" style="width: 40%; border-radius:5px;"><img src="../uploads/nationalIDs/<?php echo $res['national_id']; ?>" width="100%" class="small-img"></button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include "footer.admin.php"; ?>
    </main>
    </div>
    </div>

    <!-- Image Modal-->
    <div class="modal fade" id="image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">National ID image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <img src="../uploads/nationalIDs/<?php echo $row['national_id']; ?>" width="100%" alt="national ID image">
            </div>
        </div>
    </div>
    <!-- Image Modal-->
    <div class="modal fade" id="image2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">National ID image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <img src="../uploads/nationalIDs/<?php echo $res['national_id']; ?>" width="100%" alt="national ID image">
            </div>
        </div>
    </div>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/form-validation.js"></script>
</body>

</html>