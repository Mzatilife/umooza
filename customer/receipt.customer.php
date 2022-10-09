<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
$payment = new PaymentContr();
$property = new ManagePropertyContr();

if (isset($_GET['reverse_id']) && isset($_GET['prop_id'])) {
    $id = $_GET['reverse_id'];
    $prop_id = $_GET['prop_id'];
    $res = $payment->changeRenstatus($id, 3);
    $result = $property->approveProperty($prop_id, 1);
    if ($res && $result) {
        $msg = "Rental reversed, your money will be sent back to you, transaction fees will apply!";
    } else {
        $msg2 = "Rental could not be reversed please contact us!";
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
    <title>Receipt</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include "header.customer.php" ?>

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
        <div class="row">
            <?php
            $row = $payment->viewRentalCode($user_id);
            foreach ($row as $rw) {
                $price = number_format($rw['price']);
            ?>
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text text-secondary text-justify"><?php echo $rw['first_name'] . " " . $rw['last_name'] . ", 0" . $rw['phone']; ?></p>
                            <p class="card-text text-secondary text-justify"><?php echo ($rw['type'] == 'other' || $rw['type'] == 'electronic' || !empty($rw['name'])) ? $rw['name'] : $rw['type']; ?><?php echo " | " . $rw['district'] . ", " . $rw['area']; ?> <br> K<?php echo $price . " / " . $rw['period'] . " " . $rw['duration']; ?></p>
                            <p class=" border border-danger p-2 rounded text-danger text-justify">Please, do not disclose your code to anyone, until you are satisfied with the property. If you are not satisfied, reverse transaction.
                                **********************************
                                <br> CODE: <span class="rounded-pill bg-success text-white p-1 text-center"><?php echo $rw['rent_code']; ?></span>
                                **********************************
                            </p>
                            <?php if ($rw['ren_status'] == 0) { ?>
                                <a href="receipt.customer.php?reverse_id=<?php echo $rw['rented_id'] ?>&prop_id=<?php echo $rw['prop_id'] ?>" class="btn btn-danger btn-sm"><span class="fas fa-rewind"></span> Reverse</a>
                            <?php } elseif ($rw['ren_status'] == 1) {
                                echo "Code Used";
                            } elseif ($rw['ren_status'] == 2) {
                                echo "Deal Closed";
                            } elseif ($rw['ren_status'] == 3) {
                                echo "Payment reversed";
                            } elseif ($rw['ren_status'] == 4) {
                                echo "Money sent back to you";
                            } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </main>
    </div>
    </div>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>