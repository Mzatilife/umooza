<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

//creating an object to access user data from the "manageusercontr.php" class ----------------------------------->
$category = new CategoryContr();

if (isset($_POST['add'])) {
    $name = $_POST['name'];

    $result =  $category->addCategory($name);

    if ($result) {
        $msg = "Category Added";
    } else{
        $msg2 = "couldn't Add category";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = $category->deleteCategory($id);

    if ($result) {
        $msg = "Category deleted";
    } else{
        $msg2 = "couldn't delete category";
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
    <title>Categories</title>
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
            <h4>Categories</h4>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#login"><span class="fa fa-add"></span> Add Category</a>
            </div>
        </div>
        <?php
        if (!empty($msg)) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        } elseif (!empty($msg2)) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $category = new CategoryContr();
                    $cat = $category->viewCategory();
                    $index = 1;
                    foreach ($cat as $ct) {
                        echo "
                    <tr>
                        <td>" . $index . "</td>
                        <td style = 'text-transform:capitalize;'>" . $ct['category_name'] . "</td>";
                    ?>
                        <td><a href="categories.admin.php?id=<?php echo $ct['category_id'] ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash-alt"></span> Delete</a></td>
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
      <!-- login Modal-->
      <div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <h4 class="h4 mb-4 mt-2 fw-normal text-center">Add Category</h4>
                            <?php
                            if (!empty($msg)) { ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo $msg; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } else {
                            } ?>

                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="floatingInput" required>
                                <label for="floatingInput">Category Name</label>
                            </div>

                            <button class="w-100 btn btn-lg btn-primary mb-4 mt-4" type="submit" name="add">Add Category</button>

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