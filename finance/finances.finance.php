<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
$payment = new PaymentContr();
if (isset($_GET['id'])) {
    $rented_id = $_GET['id'];
    $result = $payment->changeRenstatus($rented_id, 2);

    if ($result) {
        $msg = "Deal closed";
    } else {
        $msg2 = "Something went wrong!";
    }
}
if (isset($_GET['rev_id'])) {
    $rented_id = $_GET['rev_id'];
    $result = $payment->changeRenstatus($rented_id, 4);

    if ($result) {
        $msg = "Deal closed";
    } else {
        $msg2 = "Something went wrong!";
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
    <title>Finances</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <script type="text/javascript" src="../assets/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" href="../assets/DataTables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include "header.finance.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h4>Finances</h4>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="closed_deals.finance.php" class="btn btn-secondary">closed Deals</a>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="payments.finance.php" class="btn btn-primary">Payments</a>
            </div>
        </div>
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
        <!-- Begin Page Content -->
        <div class="table-responsive">
            <table class="table table-striped" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Customer #</th>
                        <th>Property</th>
                        <th>Landlord</th>
                        <th>Landlord #</th>
                        <th>Remark</th>
                        <th>Send</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Customer #</th>
                        <th>Property</th>
                        <th>Landlord</th>
                        <th>Landlord #</th>
                        <th>Remark</th>
                        <th>Send</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    //creating an object to access user data from the "manageusercontr.php" class -------------------->
                    $user = new ManageUserContr();

                    $row = $payment->viewPayment(1, 3);
                    $index = 1;
                    foreach ($row as $rw) {
                        $res = $user->viewUser($rw['customer_id']);
                        $owner = number_format($rw['rent_price']);
                    ?>
                        <tr>
                            <td><?php echo $index; ?>.</td>
                            <td><?php echo $res['first_name'] . " " . $res['last_name']; ?></td>
                            <?php if ($rw['ren_status'] == 3) { ?>
                            <td class="bg-primary text-white">0<?php echo $res['phone']; ?></td>
                            <?php } else { ?>
                            <td>0<?php echo $res['phone']; ?></td>
                            <?php } ?>
                            <td style="text-transform: capitalize;"><?php echo ($rw['type'] == 'other' || $rw['type'] == 'electronic') ? $rw['name'] : $rw['type']; ?></td>
                            <td><?php echo $rw['first_name'] . " " . $rw['last_name']; ?></td>
                            <?php if ($rw['ren_status'] == 1) { ?>
                            <td class="bg-primary text-white">0<?php echo $rw['phone']; ?></td>
                            <?php } else { ?>
                            <td>0<?php echo $rw['phone']; ?></td>
                            <?php } ?>
                            <?php if ($rw['ren_status'] == 1) { ?>
                            <td class="bg-primary text-white">Code Approved</td>
                            <?php } elseif ($rw['ren_status'] == 3) { ?>
                            <td>Reverse Payment</td>
                            <?php } ?>
                            <td class="bg-primary text-white"><?php echo $owner; ?> MWK</td>
                            <?php if ($rw['ren_status'] == 1) { ?>
                            <td><a href="finances.finance.php?id=<?php echo $rw['rented_id']; ?>" class="btn btn-primary">close deal</a></td>
                            <?php } elseif ($rw['ren_status'] == 3) { ?>
                            <td><a href="finances.finance.php?rev_id=<?php echo $rw['rented_id']; ?>" class="btn btn-primary">close deal</a></td>
                            <?php } ?>
                        </tr>
                    <?php
                        $index++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php include "footer.finance.php"; ?>
    </main>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false,
                buttons: ['print', 'excel', 'pdf', 'csv']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script type="text/javascript" src="../assets/DataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
    <script src="../assets/DataTables/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="../assets/DataTables/DataTables-1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/DataTables/Buttons-1.6.3/js/dataTables.buttons.min.js"></script>
    <script src="../assets/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="../assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../assets/DataTables/Buttons-1.6.3/js/buttons.html5.js"></script>
    <script src="../assets/DataTables/Buttons-1.6.3/js/buttons.print.min.js"></script>
    <script src="../assets/DataTables/Buttons-1.6.3/js/buttons.colVis.min.js"></script>
    <script src="../assets/DataTables/Buttons-1.6.3/js/buttons.colVis.js"></script>
    <script src="../assets/DataTables/Responsive-2.2.5/js/dataTables.responsive.min.js"></script>
    <script src="../assets/DataTables/Responsive-2.2.5/js/responsive.bootstrap4.min.js"></script>
</body>

</html>