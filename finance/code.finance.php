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
    <title>Rental Codes</title>
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
            <h4>Rental Codes</h4>
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
                        <th>Code</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Customer #</th>
                        <th>Property</th>
                        <th>Code</th>
                        <th>Remark</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    //creating an object to access user data from the "manageusercontr.php" class -------------------->
                    $user = new ManageUserContr();

                    $row = $payment->viewPaymentWithoutStatus();
                    $index = 1;
                    foreach ($row as $rw) {
                        $res = $user->viewUser($rw['customer_id']);
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
                            <td class="bg-primary text-white"><?php echo $rw['rent_code']; ?></td>
                            <?php if ($rw['ren_status'] == 0) { ?>
                                <td>code not used</td>
                            <?php } elseif ($rw['ren_status'] == 1) { ?>
                                <td>code used</td>
                            <?php } elseif ($rw['ren_status'] == 2) { ?>
                                <td>deal closed</td>
                            <?php } elseif ($rw['ren_status'] == 3) { ?>
                                <td>code reversed</td>
                            <?php } elseif ($rw['ren_status'] == 4) { ?>
                                <td>payment reversed</td>
                            <?php } ?>
                            <?php if ($rw['ren_status'] == 0) { ?>
                                <td><a href="code.finance.php?reverse_id=<?php echo $rw['rented_id'] ?>&prop_id=<?php echo $rw['prop_id'] ?>" class="btn btn-danger">reverse</a></td>
                            <?php } else { ?>
                                <td>none</td>
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