<?php
include "../includes/session.inc.php";
include_once '../includes/classautoloader.inc.php';

$profile = new ProfileContr;

if (isset($_POST['changepass'])) {
    $old_password = strip_tags($_POST['oldpass']);
    $new_password = strip_tags($_POST['newpass']);
    $conf_password = strip_tags($_POST['conpass']);

    if ($new_password != $conf_password) {
        $msg = "The two passwords did not match!";
    } else {
        // passing information
        $msg = $profile->changePassword($user_id, $old_password, $new_password);
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
    <title>Property Type</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <script type="text/javascript">
        function checkPass() {
            //Store the password field objects into variables ...
            var password = document.getElementById('password2');
            var confirm = document.getElementById('confirm2');
            //Store the Confirmation Message Object ...
            var message = document.getElementById('confirm-message2');
            //Set the colors we will be using ...
            var good_color = "#66cc66";
            var bad_color = "#ff6666";
            if (password.value == confirm.value) {
                confirm.style.backgroundColor = good_color;
                message.style.color = good_color;
                message.innerHTML = 'Passwords matched!';
            } else {
                confirm.style.backgroundColor = bad_color;
                message.style.color = bad_color;
                message.innerHTML = '<i>Did not match!</i>';
            }
        }
    </script>
</head>

<body>
    <?php include "header.landlord.php" ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container">
            <h3 class="text-center m-3">Profile Information</h3>
            <?php
            if (isset($msg)) { ?>
                <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert">
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } else {
            }
            ?>
            <hr>
            <div class="row">
                <div class="col-md-4 text-center">
                    <strong>Password</strong>
                </div>
                <div class="col-md-4 text-center">
                    <strong>***********</strong>
                </div>
                <div class="col-md-4 text-center">
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#password"><span class="fa fa-cog"></span> Update</button>
                </div>
            </div>
        </div>
        <?php include "footer.landlord.php"; ?>
    </main>
    </div>
    </div>
    <!-- changing Password Modal-->
    <div class="modal fade" id="password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation container mt-3" novalidate>
                        <div class="col-sm-12">
                            <label for="firstName" class="form-label">Old Password</label>
                            <input type="password" name="oldpass" class="form-control" id="firstName" required>
                            <div class="invalid-feedback">
                                Valid password is required.
                            </div>
                        </div>
                        <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                            <h6>The Password should:</h6>
                            <ul>
                                <li>Be atleast <b>8 characters</b> long</li>
                                <li>Contain atleast one number and one symbol</li>
                                <li>Contain <b>uppercase</b> and <b>lowercase</b> letters</li>
                            </ul>
                        </div>
                        <div class="col-sm-12">
                            <label for="password2" class="form-label">New Password</label>
                            <input type="password" name="newpass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password2" onkeyup="checkPass();" required>
                            <div class="invalid-feedback">
                                Valid new password is required.
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <label for="confirm2" class="form-label">Confirm Password</label>
                            <input type="password" name="conpass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="confirm2" onkeyup="checkPass();" required>
                            <div class="invalid-feedback">
                                Valid new password is required.
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-50 btn btn-primary btn-sm mb-4" type="submit" name="changepass"><span class="fa fa-cog"></span> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/form-validation.js"></script>

</body>

</html>