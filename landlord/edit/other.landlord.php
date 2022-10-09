<?php
include "../../includes/session.inc.php";
include_once '../../includes/classautoloaderform.inc.php';
include "edit.landlord.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Edit Property</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <script src="commission.js"></script>
</head>

<body>
    <?php include "header.landlord.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h4 class="text-primary mt-3 mb-3"> Edit <i>(Item Details)</i></h4>
        <div class="alert alert-primary fade show text-dark p-3 mb-3" role="alert">
            <p style="font-size: 16px;">Fill in the form fields to edit your <b class="text-info"><?php echo $_SESSION['prop_type']; ?></b>.</p>
            <ul class="text-danger m-0">
                <li>
                    <p style="font-size: 16px;">If you edit the property, it will have to be reviewed again!</p>
                </li>
            </ul>
        </div>
        <?php
        if (!empty($msg2)) { ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <?php echo $msg2; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else {
        }
        $property = new ManagePropertyContr();
        $row = $property->viewSingleProperty($_SESSION['prop_edit_id']);
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" class="needs-validation container mt-3" novalidate>
            <div class="row g-3">
                <input type="text" name="prop_id" value="<?php echo $_SESSION['prop_edit_id']; ?>" hidden>
                <div class="col-sm-6">
                    <label for="Name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" name="name" id="Name" value="<?php echo $row['name']; ?>" required>
                    <div class="invalid-feedback">
                        Valid property name is required.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="price" class="form-label">Quantity (Sets) <span class="text-danger">Enter the number of properties for rent</span></label>
                    <input type="number" class="form-control" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" required>
                    <div class="invalid-feedback">
                        Please enter the quantity.
                    </div>
                </div>
                <h5 id="payment" class="bg-info text-center text-white m-0"></h5>
                <div class="col-sm-6">
                    <label for="price" class="form-label">Price</label>
                    <div class="input-group">
                        <span class="input-group-text">K</span>
                        <input type="text" class="form-control" name="price" aria-label="Amount (to the nearest kwacha)" value="<?php echo $row['price']; ?>" min="1" id="price" onchange="computeCom()" required>
                        <span class="input-group-text">.00</span>
                    </div>
                    <div class="invalid-feedback">
                        Please enter a valid price.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="period" class="form-label">Payment Period</label>
                    <div class="input-group">
                        <input type="number" class="form-control" name="period" id="period" value="<?php echo $row['period']; ?>" min="1" aria-label="payment period" aria-describedby="basic-addon2" onchange="computeCom()" required>
                        <select class="form-select selectpicker" data-live-search="true" name="duration" aria-label=".form-select example" id="type" required>
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
                    <input type="text" class="form-control" name="district" id="district" value="<?php echo $row['district']; ?>" required>
                    <div class="invalid-feedback">
                        Please enter a valid district.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="area" class="form-label">Area/Village</label>
                    <input type="text" class="form-control" name="area" id="area" value="<?php echo $row['area']; ?>" required>
                    <div class="invalid-feedback">
                        Please enter a valid area.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="password" class="form-label">Images</label>
                    <p>
                        1<img width="70" height="50" src="../../uploads/<?php echo $row['image1']; ?>">
                        2<img width="70" height="50" src="../../uploads/<?php echo $row['image2']; ?>">
                        3<img width="70" height="50" src="../../uploads/<?php echo $row['image3']; ?>">
                        4<img width="70" height="50" src="../../uploads/<?php echo $row['image4']; ?>">
                    </p>
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
                    <textarea name="description" class="form-control" id="description" cols="30" rows="4" required><?php echo $row['description']; ?></textarea>
                    <div class="invalid-feedback">
                        Please enter a property description/comment.
                    </div>
                </div>

                <hr class="my-4">

                <button class="w-50 btn btn-primary btn-lg mb-4" type="submit" name="edit">Edit</button>

            </div>
        </form>
        <?php include "../footer.landlord.php"; ?>
    </main>
    </div>
    </div>
    <script src="../../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/dashboard.js"></script>
    <script src="../../assets/js/form-validation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
</body>

</html>