<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

if (isset($_GET['view'])) {
    $_SESSION['prop_view_id'] = $_GET['view'];
    header("location: view.admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Admin Dashboard</title>
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
    <?php include "header.admin.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="row border-bottom pb-3 mb-3 mt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body">
                        <?php
                        $property = new ManageUserContr();
                        //counts the property -------------------->
                        $user = $property->countUsers('customer', 'customer', 'landlord', 'landlord', 1, 1);
                        ?>
                        <h5 class="card-title">Total: <span class="badge rounded-pill bg-secondary"><?php echo $user; ?></span></h5>
                    </div>
                    <div class="card-footer">
                        <a href="users.admin.php" class="btn btn-sm btn-primary">View</a>
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
                        $property = new ManagePropertyContr();
                        //counts the property -------------------->
                        $uploaded = $property->countAdminProperty(1, 1, 1, 1);
                        ?>
                        <h5 class="card-title">Total: <span class="badge rounded-pill bg-secondary"><?php echo $uploaded; ?></span></h5>
                    </div>
                    <div class="card-footer">
                        <a href="uploaded.admin.php" class="btn btn-sm btn-primary">View</a>
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
                        $rented = $property->countAdminProperty(3, 3, 3, 3);
                        ?>
                        <h5 class="card-title">Total: <span class="badge rounded-pill bg-secondary"><?php echo $rented; ?></span></h5>
                    </div>
                    <div class="card-footer">
                        <a href="rented.admin.php" class="btn btn-sm btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>

        <h4>Recent Uploads</h4>
        <div class="table-responsive">
            <table class="table table-striped table-sm" id="example">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    //creating an object to access property data from the "managepropertycontr.php" class -------------------->
                    $warehouse = new ManagePropertyContr();

                    $row = $warehouse->viewPropertyAdmin(0, 0, 0, 0, 0);
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
                        <td>K" . $price . " / " . $rw['period'] . " " . $rw['duration'] . "</td>
                        <td>" . date('d M Y', strtotime($rw['date'])) . "</td>
                        <td><a href='index.admin.php?view=" . $rw['prop_id'] . "' class='btn btn-sm btn-primary'>View</a></td>
                    </tr>";

                        $index++;
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