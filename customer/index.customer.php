<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

$property = new ManagePropertyContr();
$payment = new PaymentContr();
$shoutout = new ShoutoutContr();

if (isset($_GET['id'])) {
    $_SESSION['property_index_id'] = $_GET['id'];
}

if (isset($_POST['confirm'])) {
    $reference = $_POST['refno'];
    $row = $payment->checkPayment($reference);
    $prop = $property->viewSingleProperty($_SESSION['property_index_id']);
    $Generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $rental_code = substr(str_shuffle($Generator), 0, 6);

    if (!empty($row)) {
        if ($row['status'] == 1) {
            $msg2 = "The payment has already been used!";
        } else {
            $rec_amount = intval(preg_replace('/[^\d.]/', '', $row['amount']));
            if (intval($rec_amount) >= $prop['price']) {
                $result = $payment->rentProperty($row['payment_id'], $prop['prop_id'], $user_id, $rental_code, $prop['price']);
                $result3 = $payment->changePaymentStatus($row['payment_id'], 1);
                if ($prop['quantity'] == 1) {
                    $result2 = $property->approveProperty($prop['prop_id'], 4);
                } else {
                    $quantity = $prop['quantity'] - 1;
                    $result2 = $property->editQuantity($prop['prop_id'], $quantity);
                }
                if ($result2 && $result && $result3) {
                    $msg = "Property rented! ";
                } else {
                    $msg2 = "Error, couldn't process payment";
                }
            } else {
                $msg2 = "The amount paid is not enough!";
            }
        }
    } else {
        $msg2 = "Payment was not done!";
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
    <title>Customer Dashboard</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/propdetails.css">
    <script src="../assets/js/jquery-1.10.2.min.js"></script>
    <style>
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include "header.customer.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <?php
        if (!empty($_SESSION['property_index_id'])) {
            $row = $property->viewSingleProperty($_SESSION['property_index_id']);
            $check = $property->checkProperty($_SESSION['property_index_id'], 3);
            $price = number_format($row['price']);
        }

        if (empty($row) || empty($_SESSION['property_index_id']) || $check == 1) {
        ?>
            <div class="container mt-3">
                <div class="alert alert-info fade show" role="alert">
                    <p>Welcome <?php echo $fname; ?>,<br> You are a successfully registered customer. To rent select the prefered property. Go to the home page, select the property you want to rent and then login. <br><br>Administration</p>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row grid">
                <div class="col-md-8">
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
                    <div class="fluid-container mt-3">
                        <div class="card border-secondary border-3">
                            <div class="card-body text-center row">
                                <div class="col-md-3 row">
                                    <img src="../assets/images/mpamba.webp" class="col-6" alt="mpamba logo" width="100%">

                                    <img src="../assets/images/airtel.png" class="col-6" alt="mpamba logo" width="100%">
                                </div>
                                <?php
                                $profile = new ProfileContr;
                                $address = $profile->viewAddress();

                                foreach ($address as $add) {
                                ?>
                                    <h5 class="card-title col-md-9">Make Payments to: <span class="text-success">0<?php echo $add['mpamba'] ?></span> OR <span class="text-danger">0<?php echo $add['airtel_money'] ?></span></h5>
                                <?php } ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-md-6">
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
                                        <h3 class="card-title text-primary"><?php echo ($row['type'] == 'other' || $row['type'] == 'electronic' || !empty($row['name'])) ? $row['name'] : $row['type']; ?></h3>
                                        <p class="card-text"><?php echo  $row['district'] . ", " . $row['area']; ?> | <span class="badge rounded-pill bg-secondary"><?php echo "K" . $price . " / " . $row['period'] . " " . $row['duration']; ?></span></p>
                                        <p class="card-text"><?php echo ($row['type'] == 'land') ? $row['land'] . " accres <br>" : NULL; ?><?php echo $row['description']; ?></p>
                                        <hr>
                                        <?php if ($row['status'] == 3) {
                                            echo "<div class='alert alert-primary'>Property Rented</div>";
                                        } elseif ($row['status'] == 4) {
                                            echo "<div class='alert alert-primary'>Property Under Offer</div>";
                                        } else { ?>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#rent">Rent</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $property = new ManagePropertyContr();
                    $cord = $property->viewCoordinates($_SESSION['property_index_id']);
                    if (!empty($cord)) {
                        $lat = $cord['latitude'];
                        $lng = $cord['longitude'];
                        $content = $row['name'] . " (" . $row['type'] . ")";
                    ?>
                        <div class="col-md-12 mt-3">
                            <div id="map"></div>
                            <script>
                                function initMap() {

                                    //map options
                                    var options = {
                                        zoom: 15,
                                        center: {
                                            lat: <?php echo $lat; ?>,
                                            lng: <?php echo $lng; ?>
                                        }
                                    }

                                    //New map
                                    var map = new google.maps.Map(document.getElementById('map'), options);


                                    // Array of markers
                                    var markers = [{
                                            coords: {
                                                lat: <?php echo $lat; ?>,
                                                lng: <?php echo $lng; ?>
                                            },
                                            content: '<h1><?php echo $content; ?></h1>'
                                        },

                                    ];

                                    //Loop through Marker

                                    for (var i = 0; i < markers.length; i++) {

                                        //Add marker
                                        addMarker(markers[i]);
                                    }


                                    //Add marker function
                                    function addMarker(props) {
                                        var marker = new google.maps.Marker({

                                            position: props.coords,
                                            map: map
                                        });

                                        //check for custom icon
                                        if (props.iconImage) {
                                            //set icon image
                                            marker.setIcon(props.iconImage);
                                        }

                                        //chech information content
                                        if (props.content) {

                                            var infoWindow = new google.maps.InfoWindow({
                                                content: props.content
                                            });

                                            marker.addListener('click', function() {
                                                infoWindow.open(map, marker);
                                            });

                                        }
                                    }
                                }
                            </script>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-md-12 mt-3">
                            <?php
                            $area = "Malawi, " . $row['district'] . ", " . $row['area'];
                            echo '<iframe
       width="100%"
       height="100%"
       frameborder="0" style="border:0"
       src="https://www.google.com/maps/embed/v1/place?q=' . $area . '&key=AIzaSyDToXPQJU-n51dqrk6Iy7S4BYhSKE3Gzj4">
    </iframe>';
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-md-4 bg-light">
                    <?php

                    $rel = $property->searchRelatedProperty($row['prop_id'], 1, $row['type'], $row['district'], $row['area'], 0, 4);
                    if (empty($rel)) {
                    } else {
                    ?>
                        <h2 class="h6 pt-4 pb-3 border-bottom">Other Properties</h2>
                        <div class="row mb-3">
                            <?php
                            foreach ($rel as $rw) {
                                $price = number_format($rw['price']);
                            ?>
                                <div class="col-6 col-md-6 themed-grid-col mt-3">
                                    <div class="thumb-wrapper item">
                                        <div class="img-box">
                                            <div id="carouselExampleControls<?php echo $rw['prop_id']; ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100" src="../uploads/<?php echo $rw['image1']; ?>" style="height: 120px;" alt="First slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="../uploads/<?php echo $rw['image2']; ?>" style="height: 120px;" alt="Second slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="../uploads/<?php echo $rw['image3']; ?>" style="height: 120px;" alt="Third slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100" src="../uploads/<?php echo $rw['image4']; ?>" style="height: 120px;" alt="Fouth slide">
                                                    </div>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?php echo $rw['prop_id']; ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?php echo $rw['prop_id']; ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="thumb-content">
                                            <h4 class="text-primary"><?php echo ($rw['type'] == 'other' || $rw['type'] == 'electronic' || !empty($rw['name'])) ? $rw['name'] : $rw['type']; ?></h4>
                                            <p class="item-price" style="font-size: 12px;"><?php echo  $rw['district'] . ", " . $rw['area']; ?></p>
                                            <p class="item-price text-danger" style="font-size: 12px;"><?php echo "K" . $price . " / " . $rw['period'] . " " . $rw['duration']; ?></p>
                                            <a href="index.customer.php?id=<?php echo $rw['prop_id']; ?>" class="btn btn-primary btn-sm">view</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php include "footer.customer.php"; ?>
    </main>
    </div>
    </div>
    <!-- Rent Modal-->
    <div class="modal fade" id="rent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" class="needs-validation container mt-3" novalidate>
                        <?php
                        if (!empty($msg)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $msg; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php } else {
                        } ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="refno" class="form-label"><b>Enter Reference Number:</b></label>
                                <input type="text" name="refno" class="form-control" id="refno" placeholder="XXX-XXX-XXX" required>
                                <div class="invalid-feedback">
                                    Enter valid reference number.
                                </div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <button class="w-50 btn btn-sm btn-primary mb-4 mt-4" type="submit" name="confirm">confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/form-validation.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDToXPQJU-n51dqrk6Iy7S4BYhSKE3Gzj4&amp;callback=initMap">
    </script>
</body>
<div id="status">

</div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            $("#status").load("../includes/payment.inc.php");
            refresh();
        }, 500);
    });
</script>

</html>