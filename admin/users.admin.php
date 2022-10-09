<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

//creating an object to access user data from the "manageusercontr.php" class ----------------------------------->
$user = new ManageUserContr();
include 'user_operations.admin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Users</title>
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
            <h4>Users</h4>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="add_user.admin.php" class="btn btn-primary">Add User</a>
            </div>
        </div>
        <?php
        if (!empty($msg)) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $msg; ?>
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
                        <th>Email</th>
                        <th>Phone #</th>
                        <th>Phone #2</th>
                        <th>Address</th>
                        <th>User Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone #</th>
                        <th>Phone #2</th>
                        <th>Address</th>
                        <th>User Type</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $row = $user->viewsUsers(1, 'landlord', 'customer');
                    $index = 1;
                    foreach ($row as $rw) {
                        echo "
                    <tr>
                        <td>" . $index . "</td>
                        <td>" . $rw['first_name'] . " " . $rw['last_name'] . "</td>
                        <td>" . $rw['email'] . "</td>
                        <td>0" . $rw['phone'] . "</td>";
                        if (empty($rw['phone_2'])) {
                            echo "<td>unavailable</td>";
                        } else {
                            echo "<td>0" . $rw['phone_2'] . "</td>";
                        }
                        echo "
                        <td>" . $rw['address'] . "</td>
                        <td>" . $rw['user_type'] . "</td>
                        <td>"; ?>
                        <div class="btn btn-sm m-0 p-0">
                            <button class="btn btn-primary btn-sm m-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="icon icon-sm">
                                    open <span class="fas fa-angle-down icon-dark"></span>
                                </span>
                            </button>
                            <div class="dropdown-menu">

                                <?php
                                if ($rw['user_status'] == '1') {
                                    echo "<a class='dropdown-item text-warning' href='users.admin.php?dis=" . $rw['user_id'] . "'><span class='fas fa-exclamation-triangle mr-2'></span> Deactivate</a>";
                                } else {
                                    echo "<a class='dropdown-item text-success' href='users.admin.php?en=" . $rw['user_id'] . "'><span class='fas fa-exclamation-triangle mr-2'></span> Activate</a>";
                                }
                                ?>

                                <a class="dropdown-item text-danger" href="users.admin.php?del=<?php echo $rw['user_id']; ?>" onclick="return confirm('are you sure you want to delete?')"><span class="fas fa-trash-alt mr-2"></span> Remove...</a>
                            </div>
                        </div>

                        </td>
                        </tr>
                    <?php
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