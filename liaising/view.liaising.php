<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

$property = new ManagePropertyContr();

if (isset($_GET['upload'])) {
    $upload = $_GET['upload'];
    $result = $property->approveProperty($upload, 1);

    if ($result) {
        $msg = "Property Uploaded!";
    } else {
        $msg2 = "Operation Failed!";
    }
} elseif (isset($_POST['reject'])) {
    $reject_id = $_GET['rejid'];
    $reasons = $_POST['reason'];

    $result = $property->rejectProperty($reject_id, $reasons);

    if ($result) {
        $msg = "Property rejected!";
    } else {
        $msg2 = "Operation failed!";
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
    <title>View Property Details</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <style>
        /*-------- Single Property Details ----------*/
        .small-img-col img {
            height: 62px;
            margin-left: 2px;
        }

        .single-property .col {
            display: flex;
        }

        .small-img-row {
            display: inline;
            justify-content: space-between;
        }

        .small-img-col {
            flex-basis: 24%;
            cursor: pointer;
        }

        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include "header.liaising.php";
    $property = new ManagePropertyContr();
    $row = $property->viewSingleProperty($_SESSION['prop_view_id']);
    $price = $row['price'];
    $price = number_format($price);
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
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
        <div class="col mt-3">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo ($row['type'] == 'other') ? $row['name'] : $row['type']; ?> Details</h5>
                            <p class="card-text"><?php echo $row['district'] . ", " . $row['area']; ?> | <span class="badge rounded-pill bg-secondary">K<?php echo $price . " / " . $row['period'] . " " . $row['duration']; ?></span></p>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-body">
                            <h5 class="card-title">Landlord Details</h5>
                            <p class="card-text"><?php echo $row['first_name'] . " " . $row['last_name']; ?>| <?php echo $row['address']; ?></p>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary">Phone</span> 0<?php echo $row['phone'];
                                                                                                                echo (empty($row['phone_2'])) ?: " | 0" . $row['phone_2']; ?></p>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary">Email</span> <?php echo $row['email']; ?></p>
                            <p class="card-text"><span class="badge rounded-pill bg-secondary">National ID</span>
                                <button class="p-0" data-bs-toggle="modal" data-bs-target="#image" style="width: 40%; border-radius:5px;"><img src="../uploads/nationalIDs/<?php echo $row['national_id']; ?>" width="100%" class="small-img"></button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $property = new ManagePropertyContr();
            $cord = $property->viewCoordinates($_SESSION['prop_view_id']);
            if (!empty($cord)) {
                $lat = $cord['latitude'];
                $lng = $cord['longitude'];
                $content = $row['name'] . " (" . $row['type'] . ")";
            ?>
                <div class="col-md-12 mt-3 mb-3">
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
                <div class="col-md-12 mt-3 mb-3">
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
            <?php
            if ($row['status'] == '2') {
                $reas = $property->viewReason($row['prop_id']); ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <h6>Reason for rejecting:</h6>
                    <?php echo $reas['reason']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }
            ?>
            <div class="mt-3">
                <?php if ($row['status'] != 1) {
                    echo "<a href='view.liaising.php?upload=" . $row['prop_id'] . "' class='btn btn-sm btn-success'>Upload</a>";
                } else {
                } ?>
                <?php if ($row['status'] != 2) {
                    echo "<button class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#reason'>Decline</button>";
                } else {
                } ?>
            </div>
        </div>

        <?php include "footer.liaising.php"; ?>
    </main>
    </div>
    </div>
    <!-- Reasons Modal-->
    <div class="modal fade" id="reason" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Upload Reasons for rejecting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?rejid=<?php echo $row['prop_id']; ?>" method="POST" class="needs-validation" novalidate>
                        <div class="col-sm-12">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea name="reason" class="form-control" id="reason" cols="30" rows="10" required></textarea>
                            <div class="invalid-feedback">
                                Please enter a valid reason.
                            </div>
                        </div>

                        <button class="w-100 btn btn-primary btn-lg mt-3" type="submit" name="reject">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
                </div>
            </div>
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
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/form-validation.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDToXPQJU-n51dqrk6Iy7S4BYhSKE3Gzj4&amp;callback=initMap">
    </script>
</body>

</html>