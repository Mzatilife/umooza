<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
$payment = new PaymentContr();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Closed Deals</title>
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
            <h4>Closed Deals</h4>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="finances.finance.php" class="btn btn-secondary">Finances</a>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="payments.finance.php" class="btn btn-primary">Payments</a>
            </div>
        </div>
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
                        <th>Sent</th>
                        <th>Remark</th>
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
                        <th>Sent</th>
                        <th>Remark</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    //creating an object to access user data from the "manageusercontr.php" class -------------------->
                    $user = new ManageUserContr();

                    $row = $payment->viewPayment(2, 4);
                    $index = 1;
                    foreach ($row as $rw) {
                        $res = $user->viewUser($rw['customer_id']);
                        $owner = number_format($rw['rent_price']);
                    ?>
                        <tr>
                            <td><?php echo $index; ?>.</td>
                            <td><?php echo $res['first_name'] . " " . $res['last_name']; ?></td>
                            <td>0<?php echo $res['phone']; ?></td>
                            <td style="text-transform: capitalize;"><?php echo ($rw['type'] == 'other' || $rw['type'] == 'electronic') ? $rw['name'] : $rw['type']; ?></td>
                            <td><?php echo $rw['first_name'] . " " . $rw['last_name']; ?></td>
                            <td>0<?php echo $rw['phone']; ?></td>
                            <td class="bg-secondary text-white">K <?php echo $owner; ?> MWK</td>
                            <?php if ($rw['ren_status'] == 2) { ?>
                                <td class="bg-primary text-white">Deal Closed</td>
                            <?php } elseif ($rw['ren_status'] == 4) { ?>
                                <td class="bg-primary text-white">Payment Reversed</td>
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