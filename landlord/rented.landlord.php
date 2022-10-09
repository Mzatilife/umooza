<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';
if (isset($_GET['viewid'])) {
    $_SESSION['rented_prop_id'] = $_GET['viewid'];
    header("location: view.landlord.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Rented Properties</title>
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
        <h4>Rented Properties</h4>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    //creating an object to access warehouse data from the "managewarehousecontr.php" class -------------------->
                    $warehouse = new ManagePropertyContr();

                    $row = $warehouse->viewProperty($user_id, 3, 3, 3, 3, 3);
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
                        echo "
                        <td>" . $rw['district'] . ", " . $rw['area'] . "</td>
                        <td>K" . $price . " / " . $rw['period'] . " " . $rw['duration'] . "</td>
                        <td><img src='../uploads/" . $rw['image1'] . "' alt='image' width='60' height='40'></td>
                        <td>
                        <a href='rented.landlord.php?viewid=" . $rw['prop_id'] . "' class='btn btn-primary'>view</a>
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