<?php
include_once 'classautoloader.inc.php';
session_start();

$property = new ManagePropertyContr();

if (isset($_GET['next_page_id'])) {
    $_SESSION['next_page_id'] = $_GET['next_page_id'];
    header("location: property_page.inc.php");
}
if (isset($_GET['id'])) {
    $_SESSION['property_index_id'] = $_GET['id'];
    $views = $_GET['views'] + 1;
    $property->changeViews($_GET['id'], $views);
    header("location: property_details.inc.php");
}
if (isset($_POST['login'])) {
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    // passing login information
    $login = new ManageUserContr;
    $msg = $login->userLogin($email, $password);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Property Details</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bd_aside.css">
    <link rel="stylesheet" href="../assets/css/propdetails.css">
    <style>
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    include "navbar2.inc.php";
    ?>
    <div class="row grid">
        <div class="col-md-2 bg-light">
            <div class="bd-aside sticky-xl-top align-self-start container-fluid">
                <h2 class="h6 pt-4 pb-3 mb-4 border-bottom">Rentals</h2>
                <nav class="small" id="toc">
                    <ul class="list-unstyled">
                        <li class="my-2">
                            <button class="btn d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#contents-collapse" aria-controls="contents-collapse">Categories</button>
                            <ul class="list-unstyled ps-3 collapse" id="contents-collapse">
                                <?php
                                $category = new CategoryContr();
                                $cat = $category->viewCategory();
                                foreach ($cat as $ct) {
                                ?>
                                    <li><a class="d-inline-flex align-items-center rounded" style="text-transform:capitalize;" href="property_details.inc.php?next_page_id=<?php echo $ct['category_name'] ?>"><?php echo $ct['category_name'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-10">
            <?php
            if (!empty($msg)) { ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } else {
            } ?>
            <div class="album py-5 bg-light">
                <?php
                $property = new ManagePropertyContr();
                $row = $property->viewSingleProperty($_SESSION['property_index_id']);
                $price = number_format($row['price']);
                ?>
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6">
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
                                    <?php
                                    $date = strtotime($row['date']);
                                    ?>
                                    <span class="bread-crumbs text-secondary text-sm">Posted on: <?php echo date("d M Y", $date) . " | " . $row['views']; ?> views</span>
                                    <h1 class="card-title text-primary mt-0" style="text-transform: capitalize;"><?php echo ($row['type'] == 'other' || $row['type'] == 'electronic' || !empty($row['name'])) ? $row['name'] : $row['type']; ?></h1>
                                    <h5 class="card-text text-secondary"><span class="text-dark bg-light rounded-pill p-2"><i class="fa fa-map-marker-alt text-primary"></i> Location:</span> <i><?php echo  $row['district'] . ", " . $row['area']; ?></i> | <span class="text-dark bg-light rounded-pill p-2"><i class="fa fa-tag text-primary"></i> Price:</span> <i><?php echo "K" . $price . " / " . $row['period'] . " " . $row['duration']; ?></i></h5>
                                    <h5 class="mt-3 m-0">Property Details <i class="fa fa-tags text-primary"></i></h5>
                                    <hr>
                                    <p class="card-text text-secondary"><?php echo ($row['type'] == 'land') ? "<span class='text-dark bg-light rounded-pill p-2'>" . $row['land'] . " accres <i class='fa fa-map text-primary'></i></span><br>" : NULL; ?><?php echo $row['description']; ?></p>
                                    <hr>
                                    <?php if ($row['status'] == 4) { ?>
                                        <div class="alert alert-warning text-center alert-dismissible fade show mt-3" role="alert">
                                            <b>Property under offer!</b>
                                        </div>
                                    <?php } else { ?>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login">Rent</button>
                                        <!-- <button class="btn btn-success" style="float:right;" data-bs-toggle="modal" data-bs-target="#book">Book</button> -->
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="row g-0">
                        <?php
                        $property = new ManagePropertyContr();
                        $cord = $property->viewCoordinates($_SESSION['property_index_id']);
                        if (!empty($cord)) {
                            $lat = $cord['latitude'];
                            $lng = $cord['longitude'];
                            $content = $row['name'] . " (" . $row['type'] . ")";
                        ?>
                            <div class="col-md-6 p-1">
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
                            <div class="col-md-6 p-1">
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
                        <div class="col-md-6">
                            <?php

                            $rel = $property->searchRelatedProperty($row['prop_id'], 1, $row['type'], $row['district'], $row['area'], 0, 4);
                            if (empty($rel)) {
                            } else {
                            ?>
                                <h2 class="h6 pt-4 pb-3 border-bottom">Related Properties</h2>
                                <div class="row mb-3">
                                    <?php
                                    foreach ($rel as $rw) {
                                        $price = number_format($rw['price']);
                                    ?>
                                        <div class="col-6 col-md-3 themed-grid-col mt-3">
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
                                                    <h4 class="text-primary" style="text-transform: capitalize;"><?php echo ($rw['type'] == 'other' || $rw['type'] == 'electronic') ? $rw['name'] : $rw['type']; ?></h4>
                                                    <p class="item-price text-secondary bg-light p-1 rounded-pill" style="font-size: 12px;"><span class="fa fa-map-marker-alt"></span> <?php echo  $rw['district'] . ", " . $rw['area']; ?></p>
                                                    <p class="item-price text-danger" style="font-size: 12px;"><?php echo "K" . $price . " / " . $rw['period'] . " " . $rw['duration']; ?></p>
                                                    <a href="property_details.inc.php?id=<?php echo $rw['prop_id']; ?>&views=<?php echo $rw['views']; ?>" class="btn btn-primary rounded-pill btn-sm">Rent now</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php
                            }
                            $shout = new ShoutoutContr();
                            $res = $shout->viewShoutout($row['prop_id']);
                            if (empty($res)) {
                            } else {
                            ?>
                                <h2 class="h6 pt-4 pb-3 border-bottom">ShoutOuts</h2>
                                <div>
                                    <ul>
                                        <?php
                                        foreach ($res as $rs) {
                                        ?>
                                            <li class="mb-2 alert alert-info">
                                                <p class="alert alert-warning"><i>"<?php echo $rs['shoutout'] ?>"</i> <br><?php echo $rs['user_name']; ?></p>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- login Modal-->
        <div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Don't have an account? <a href="customer_terms.inc.php">Register</a></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <h1 class="h3 mb-4 mt-2 fw-normal text-center">Please sign in</h1>
                            <?php
                            if (!empty($msg)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $msg; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } else {
                            } ?>

                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <button class="w-100 btn btn-lg btn-primary mb-4 mt-4" type="submit" name="login">Sign in</button>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="forgot_password.inc.php">Forgot password?</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking Modal-->
        <div class="modal fade" id="book" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Terms and conditions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <ul>
                                <li>The property will be reserved/booked for a day.</li>
                                <li>The booking fee is K 1000, NON REFUNDABLE!</li>
                                <li>Pay to: 0887043733</li>
                            </ul>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation container mt-3" novalidate>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="John Doe" required>
                                    <div class="invalid-feedback">
                                        Valid name is required.
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
                                    <div class="invalid-feedback">
                                        Valid email is required.
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="number" name="number" class="form-control" id="number" placeholder="0884567644" required>
                                    <div class="invalid-feedback">
                                        Please enter a vslid mobile number.
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="date" class="form-label">Suggested Date</label>
                                    <input type="date" name="date" class="form-control" id="date" required>
                                    <div class="invalid-feedback">
                                        Please enter a suggested date.
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="time" class="form-label">Sugggested Time</label>
                                    <input type="time" name="time" class="form-control" id="time" required>
                                    <div class="invalid-feedback">
                                        Please enter a suggested time.
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="refno" class="form-label">Reference Number </label>
                                    <input type="text" name="refno" class="form-control" id="refno" placeholder="XXX-XXX-XXX" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid reference number.
                                    </div>
                                </div>

                                <hr class="my-4">
                                <div class="col-sm-12 text-center">
                                    <button class="w-50 btn btn-primary mb-4" type="submit" name="book">Book</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "footer2.inc.php"; ?>
        <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/form-validation.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDToXPQJU-n51dqrk6Iy7S4BYhSKE3Gzj4&amp;callback=initMap">
        </script>

</body>

</html>