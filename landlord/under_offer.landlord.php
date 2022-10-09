<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

if (isset($_POST['confirm'])) {
    $code = strip_tags($_POST['code']);
    $prop_id = strip_tags($_POST['propID']);

    $property = new ManagePropertyContr();
    $payment = new paymentContr();

    $confirm = $payment->confirmCode($prop_id, $code);
    $row = $property->viewSingleProperty($prop_id);

    if ($confirm) {
        $res = $payment->changeRenstatusPropid($prop_id, 1);
        if ($row['quantity'] == 1) {
            $result = $property->approveProperty($prop_id, 3);
            $msg = "Rental confirmed";
        } else {
            $msg = "Rental confirmed";
        }
    } else {
        $msg2 = "Couldn't confirm rental";
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
    <title>Under Offer Properties</title>
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
    <?php include "header.landlord.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <!-- Begin Page Content -->
        <h4>Properties Under offer</h4>
        <hr>
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
        <div class="table-responsive">
            <table class="table table-striped" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Customer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Customer</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    //creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
                    $payment = new PaymentContr();
                    $user = new ManageUserContr();

                    $row = $payment->viewLandlordFinances($user_id, 0, 0, 0, 0);
                    $index = 1;
                    foreach ($row as $rw) {
                        $res = $user->viewUser($rw['customer_id']);
                        $price = number_format($rw['rent_price']);
                        echo "
                        <tr>
                        <td>" . $index . ".</td>";
                        if ($rw['type'] == 'other' || $rw['type'] == 'electronic' || !empty($rw['name'])) {
                            echo "<td>" . $rw['name'] . "</td>";
                        } else {
                            echo "<td>" . $rw['type'] . "</td>";
                        }
                        echo "
                        <td>" . $rw['district'] . ", " . $rw['area'] . "</td>
                        <td>K" . $price . " / " . $rw['period'] . " " . $rw['duration'] . "</td>
                        <td>" . $res['first_name'] . " " . $res['last_name'] . "</td>
                        <td>
                        <button class='btn btn-primary confirm' value='" . $rw['prop_id'] . "'>confirm</button>
                        </td>
                    </tr>";

                        $index++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php include "footer.landlord.php"; ?>
    </main>
    </div>
    </div>

    <!-- Confirmation Modal-->
    <div class="modal fade" id="confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm rental</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" class="needs-validation container mt-3" novalidate>
                        <div class="col-sm-12">
                            <label for="Name" class="form-label">Rental Code</label>
                            <input type="text" name="code" class="form-control" id="Name" placeholder="Enter rental code" required>
                            <div class="invalid-feedback">
                                Rental code is required.
                            </div>
                        </div>
                        <input type="number" name="propID" id="propId" hidden>
                        <hr class="my-4">
                        <button class="w-50 btn btn-primary mb-4" type="submit" name="confirm">Confirm</button>
                    </form>
                </div>
            </div>
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
    <script>
        $(document).ready(function() {
            $(document).on('click', '.confirm', function() {
                var id = $(this).val();

                $('#confirm').modal('show');
                $('#propId').val(id);
            });
        });
    </script>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/form-validation.js"></script>
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