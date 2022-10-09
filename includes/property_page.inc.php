<?php
include_once 'classautoloader.inc.php';
session_start();

$property = new ManagePropertyContr();

if (isset($_GET['id'])) {
    $_SESSION['property_index_id'] = $_GET['id'];
    $views = $_GET['views'] + 1;
    $property->changeViews($_GET['id'], $views);
    header("location: property_details.inc.php");
}

if (isset($_GET['next_page_id'])) {
    $_SESSION['next_page_id'] = $_GET['next_page_id'];
    header("location: property_page.inc.php");
}

$shout = new ShoutoutContr();
if (isset($_POST['submit'])) {

    $name = strip_tags($_POST['name']);
    $phone = strip_tags($_POST['phone']);
    $email = strip_tags($_POST['email']);
    $prop_id = strip_tags($_POST['propID']);
    $shoutout = strip_tags($_POST['shoutout']);

    $result = $shout->submitShoutout($prop_id, $name, $phone, $email, $shoutout);
    if ($result == 2) {
        $msg = "Shoutout submitted!";
    } elseif ($result == 0) {
        $msg2 = "Couldn't submit shoutout!";
    } elseif ($result == 1) {
        $msg2 = "Error, You already made a shoutout!";
    }
}
?>
<!DOCTYPE html>
<html>

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
    <link rel="stylesheet" href="../assets/css/bd_aside.css">
    <link rel="stylesheet" href="../assets/css/propdetails.css">
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
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
                                    <li><a class="d-inline-flex align-items-center rounded" style="text-transform:capitalize;" href="property_page.inc.php?next_page_id=<?php echo $ct['category_name'] ?>"><?php echo $ct['category_name'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-md-10">
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
            }

            $type = $_SESSION['next_page_id'];
            ?>
            <h2 class="h6 pt-4 pb-3 mb-4 border-bottom">Item / <span class="text-muted" style="text-transform: capitalize;"><?php echo $type; ?></span></h2>
            <div class="row mb-3">
                <?php
                $property = new ManagePropertyContr();

                $row = $property->viewProperties(1, 4, $type, $type, $type, $type, $type, $type, $type, $type, 0, 12);
                foreach ($row as $rw) {
                    $price = number_format($rw['price']);
                    $shoutout_count = $shout->countShoutout($rw['prop_id']);
                ?>
                    <div class="col-6 col-md-3 themed-grid-col mt-3">
                        <div class="thumb-wrapper item">
                            <?php if ($shoutout_count >= 4) {
                            } else { ?>
                                <span class="wish-icon"><button class="btn shout" value="<?php echo $rw['prop_id'] ?>"><i class="fa fa-star"></i></button></span>
                            <?php } ?>
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
                                <h4 class="text-primary" style="text-transform: capitalize;"><?php echo ($rw['type'] == 'other'  || $rw['type'] == 'electronic') ? $rw['name'] : $rw['type']; ?></h4>
                                <p class="item-price text-secondary bg-light p-1 rounded-pill"><span class="fa fa-map-marker-alt"></span> <?php echo  $rw['district'] . ", " . $rw['area']; ?></p>
                                <p class="item-price text-danger"><?php echo "K" . $price . " / " . $rw['period'] . " " . $rw['duration']; ?></p>
                                <a href="property_page.inc.php?id=<?php echo $rw['prop_id']; ?>&views=<?php echo $rw['views']; ?>" class="btn btn-primary rounded-pill btn-sm">Rent now</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    include "footer2.inc.php"; ?>
    <!-- Image Modal-->
    <div class="modal fade" id="shoutout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Make a shoutout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" class="needs-validation container mt-3" novalidate>
                        <div class="col-sm-12">
                            <label for="Name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="Name" placeholder="John Doe" required>
                            <div class="invalid-feedback">
                                Valid name is required.
                            </div>
                        </div>
                        <input type="number" name="propID" id="propId" hidden>
                        <div class="col-sm-12">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" name="phone" class="form-control" id="phone" placeholder="0888888888" required>
                            <div class="invalid-feedback">
                                Valid phone number is required.
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
                            <div class="invalid-feedback">
                                Valid email is required.
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="description" class="form-label">Shoutout/Comment</label>
                            <textarea name="shoutout" class="form-control" id="description" cols="30" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                Please enter a property shout/comment.
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="w-50 btn btn-primary mb-4" type="submit" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/form-validation.js"></script>
    <!-- <script type="text/javascript">
        var colors = ["Chiller", "Brush Script MT", "Bradley Hand ITC"]
        var currentColor = 0
        var lis = document.getElementById("full")

        function changeColor() {
            --currentColor
            if (currentColor < 0) currentColor = colors.length - 1
            for (var i = 0; i < 3; i++) {
                lis.style.fontFamily = colors[(currentColor + i) % colors.length]
            }
        }

        setInterval(changeColor, 10000)
    </script> -->

    <script>
        $(document).ready(function() {
            $(document).on('click', '.shout', function() {
                var id = $(this).val();

                $('#shoutout').modal('show');
                $('#propId').val(id);
            });
        });
    </script>
</body>

</html>