<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
include "edit_options.landlord.php";

if (isset($_GET['reas'])) {
    $_SESSION['prop_reason_id'] = $_GET['reas'];
    header("location: reason.landlord.php");
}
if (isset($_GET['del'])) {
    $property = new ManagePropertyContr();
    $result = $property->approveProperty($_GET['del'], 5);

    if ($result) {
        $msg = "Property removed";
    } else {
        $msg2 = "Couldn't remove property";
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
    <title>Landlord Dashboard</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <script type="text/javascript" src="../assets/DataTables/datatables.min.js"></script>
    <link rel="stylesheet" href="../assets/DataTables/DataTables-1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>
    <?php include "header.landlord.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="row border-bottom pb-3 mb-3 mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Offers
                    </div>
                    <div class="card-body">
                        <?php
                        $property = new ManagePropertyContr();
                        //counts the property -------------------->
                        $payment = new PaymentContr();
                        $offer =  $payment->countLandlordFinances($user_id, 0, 0);
                        ?>
                        <h5 class="card-title">Total: <span class="badge rounded-pill bg-secondary"><?php echo $offer; ?></span></h5>
                    </div>
                    <div class="card-footer">
                        <a href="under_offer.landlord.php" class="btn btn-sm btn-primary">View</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Uploaded
                    </div>
                    <div class="card-body">
                        <?php
                        //counts the property -------------------->
                        $uploaded = $property->countOwnerProperty($user_id, 1, 1, 1, 1);
                        ?>
                        <h5 class="card-title">Total: <span class="badge rounded-pill bg-secondary"><?php echo $uploaded; ?></span></h5>
                    </div>
                    <div class="card-footer">
                        <a href="uploaded.landlord.php" class="btn btn-sm btn-primary">View</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Rented
                    </div>
                    <div class="card-body">
                        <?php
                        //counts the property -------------------->
                        $rented = $property->countOwnerProperty($user_id, 3, 3, 3, 3);
                        ?>
                        <h5 class="card-title">Total: <span class="badge rounded-pill bg-secondary"><?php echo $rented; ?></span></h5>
                    </div>
                    <div class="card-footer">
                        <a href="rented.landlord.php" class="btn btn-sm btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>

        <h4>Properties</h4>
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
            <table class="table table-striped table-sm" id="example">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    //creating an object to access warehouse data from the "managepropertycontr.php" class -------------------->
                    $warehouse = new ManagePropertyContr();

                    $row = $warehouse->viewProperty($user_id, 0, 1, 2, 3, 4);
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
                        echo "<td>" . $rw['district'] . ", " . $rw['area'] . "</td>
                        <td>K" . $price . " / " . $rw['period'] . " " . $rw['duration'] . "</td>";

                        if ($rw['status'] == 0) {
                            echo "<td><span class='badge bg-light text-secondary p-2' style='font-size:13px;'>Pending</span></td>";
                        } elseif ($rw['status'] == 1) {
                            echo "<td><span class='badge bg-light text-primary p-2' style='font-size:13px;'>Uploaded</span></td>";
                        } elseif ($rw['status'] == 2) {
                            echo "<td><span class='badge bg-light text-danger p-2' style='font-size:13px;'>Rejected</span></td>";
                        } elseif ($rw['status'] == 3) {
                            echo "<td><span class='badge bg-light text-success p-2' style='font-size:13px;'>Rented</span></td>";
                        } else {
                            echo "<td><span class='badge bg-light text-warning p-2' style='font-size:13px;'>Invalid</span></td>";
                        } ?>
                        <td>
                            <?php if ($rw['status'] == 3) {
                                echo "<span class='badge bg-light text-success p-2' style='font-size:13px;'>Rented</span>";
                            } else { ?>
                                <div class="btn btn-sm m-0 p-0">
                                    <button class="btn btn-primary btn-sm m-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm">
                                            open <span class="fas fa-angle-down icon-dark"></span>
                                        </span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <?php
                                        if ($rw['status'] == '2') {
                                            echo "<a class='dropdown-item text-primary' href='index.landlord.php?reas=" . $rw['prop_id'] . "'><span class='fas fa-eye mr-2'></span> View</a>";
                                        } else {
                                        }
                                        ?>
                                        <a class="dropdown-item text-primary" href="index.landlord.php?edit=<?php echo $rw['prop_id']; ?>"><span class="fas fa-edit mr-2"></span> Edit</a>
                                        <a class="dropdown-item text-danger" href="index.landlord.php?del=<?php echo $rw['prop_id']; ?>" onclick="return confirm('are you sure you want to remove? your property will be reviewed again if you restore!')"><span class="fas fa-trash-alt mr-2"></span> Remove</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    <?php
                        echo "</tr>";

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
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({});

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