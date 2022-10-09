<?php
include "../../includes/session.inc.php";
include_once '../../includes/classautoloaderform.inc.php';
include "upload.landlord.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Submit Property</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap-select.css">
    <link href="../../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <script src="commission.js"></script>
</head>

<body>
    <?php include "header.landlord.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h4 class="text-primary mt-3 mb-3">Step 2 <i>(Item Details)</i></h4>
        <div class="alert alert-primary fade show text-dark p-3 mb-3" role="alert">
            <p style="font-size: 16px;">Fill in the form fields to upload your <b class="text-info"><?php echo $_SESSION['prop_type']; ?></b></p>
        </div>
        <?php
        if (!empty($msg2)) { ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <?php echo $msg2; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else {
        } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" class="needs-validation container mt-3" novalidate>
            <div class="row g-3">
                <input type="text" name="type" value="<?php echo $_SESSION['prop_type']; ?>" hidden>
                <div class="col-sm-6">
                    <label for="Name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="name" id="Name" placeholder="i.e speakers" required>
                    <div class="invalid-feedback">
                        Valid property name is required.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="price" class="form-label">Quantity (Sets) <span class="text-danger">Enter the number of properties for rent</span></label>
                    <input type="number" class="form-control" name="quantity" value="1" min="1" required>
                    <div class="invalid-feedback">
                        Please enter the quantity.
                    </div>
                </div>
                <h5 id="payment" class="bg-info text-center text-white m-0"></h5>
                <div class="col-sm-6">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">K</span>
                        <input type="text" class="form-control" name="price" aria-label="Amount (to the nearest kwacha)" value="1" min="1" id="price" onchange="computeCom()" required>
                        <span class="input-group-text">.00</span>
                    </div>
                    <div class="invalid-feedback">
                        Please enter a valid price.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="period" class="form-label">Payment Period</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="period" id="period" value="1" min="1" aria-label="payment period" aria-describedby="basic-addon2" onchange="computeCom()" required>
                        <select class="form-select" data-live-search="true" name="duration" aria-label=".form-select example" id="type" required>
                            <option value="months">Months</option>
                            <option value="days">Days</option>
                            <option value="hours">Hours</option>
                        </select>
                    </div>
                    <div class="invalid-feedback">
                        Please enter your payment period.
                    </div>
                </div>
                <!--  -->

                <div class="col-sm-6">
                    <label for="district" class="form-label">District</label>
                    <select class="form-control selectpicker me-2" data-live-search="true" aria-label="Default select example" name="district" id="district" required>
                        <option selected disabled>Select District</option>
                        <?php
                        $profile = new ProfileContr;
                        $districts = $profile->viewDistricts();

                        foreach ($districts as $dist) {
                        ?>
                            <option value="<?php echo $dist['name'] ?>"><?php echo $dist['name'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">
                        Please enter a valid district.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="area" class="form-label">Area/Village</label>
                    <input type="text" class="form-control" name="area" id="area" placeholder="Livingstonia" required>
                    <div class="invalid-feedback">
                        Please enter a valid area.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="password" class="form-label">Images</label>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Upload <b>exactly 4</b> images! (jpg, jpeg and png only)
                    </div>
                    <input type="file" name="images[]" id="images" accept="image/*" class="form-control" aria-label="image file input" required multiple>
                    <div class="invalid-feedback">
                        Please enter image files.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="description" class="form-label">Description/Comment</label>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="4" required></textarea>
                    <div class="invalid-feedback">
                        Please enter a property description/comment.
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-50 btn btn-primary btn-lg mb-4" type="submit" name="submit">Submit</button>

            </div>
        </form>
        <?php include "../footer.landlord.php"; ?>
    </main>
    </div>
    </div>
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/bootstrap-select.js"></script>
    <script src="../../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/dashboard.js"></script>
    <script src="../../assets/js/form-validation.js"></script>
</body>

</html>