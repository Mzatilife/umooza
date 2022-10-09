<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

//creating an object to access user data from the "manageusercontr.php" class ----------------------------------->
$user = new ManageUserContr();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Property Report</title>
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
    <?php include "header.admin.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h4>Property Report</h4>
        </div>
        <?php
        if (!empty($msg)) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else {
        } ?>
        <div class="row">
            <div class="col mb-4">
                <div class="card border-bottom-primary h-10 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Uploaded</div>
                                <?php
                                $property = new ManagePropertyContr();
                                //counts the property -------------------->
                                $uploaded = $property->countAdminProperty(1, 1, 1, 1);
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $uploaded; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-upload fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-bottom-primary h-10 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Reject</div>
                                <?php
                                $rejected = $property->countAdminProperty(2, 2, 2, 2);
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $rejected; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">  
                <div class="card border-bottom-primary h-10 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Under offer</div>
                                <?php
                                $payment = new PaymentContr();
                                $offer = $payment->countPayment(0, 0);
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $offer; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card border-bottom-primary h-10 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Rented</div>
                                <?php
                                $rented = $property->countAdminProperty(3, 3, 3, 3);
                                ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $rented; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Landlord</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Upload Date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Location</th>
                        <th>Landlord</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Upload Date</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    //creating an object to access property data from the "managepropertycontr.php" class -------------------->
                    $property = new ManagePropertyContr();

                    $row = $property->viewPropertyAdmin(0, 1, 2, 3, 4);
                    $index = 1;
                    foreach ($row as $rw) {
                        $price = number_format($rw['price']);
                        echo "
                        <tr>
                        <td>" . $index . "</td>";
                        if ($rw['type'] == 'other' || $rw['type'] == 'electronic') {
                            echo "<td>" . $rw['name'] . "</td>";
                        } else {
                            echo "<td>" . $rw['type'] . "</td>";
                        }
                        echo
                        "<td>" . $rw['district'] . ", " . $rw['area'] . "</td>
                        <td>" . $rw['first_name'] . " " . $rw['last_name'] . "</td>";
                        if ($rw['status'] == 0) {
                            echo "<td><span class='badge bg-light text-secondary p-2' style='font-size:13px;'>Pending</span></td>";
                        } elseif ($rw['status'] == 1) {
                            echo "<td><span class='badge bg-light text-primary p-2' style='font-size:13px;'>Uploaded</span></td>";
                        } elseif ($rw['status'] == 2) {
                            echo "<td><span class='badge bg-light text-danger p-2' style='font-size:13px;'>Rejected</span></td>";
                        } elseif ($rw['status'] == 3) {
                            echo "<td><span class='badge bg-light text-success p-2' style='font-size:13px;'>Rented</span></td>";
                        } elseif ($rw['status'] == 4) {
                            echo "<td><span class='badge bg-light text-info p-2' style='font-size:13px;'>Under Offer</span></td>";
                        } else {
                            echo "<td><span class='badge bg-light text-warning p-2' style='font-size:13px;'>Invalid</span></td>";
                        }
                        echo "<td>K" . $price . " / " . $rw['period'] . " " . $rw['duration'] . "</td>
                        <td>" . date('d M Y', strtotime($rw['date'])) . "</td>
                        </tr>";
                        $index ++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php include "footer.admin.php"; ?>
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