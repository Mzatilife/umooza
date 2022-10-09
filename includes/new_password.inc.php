<?php
include_once 'classautoloader.inc.php';

session_start();
if (isset($_POST['submit'])) {
    $fname = $_SESSION['fname'];
    $email = $_SESSION['email'];
    $password1 = $_POST['password2'];
    $password2 = $_POST['confirm2'];

    $uppercase = preg_match('@[A-Z]@', $password1);
    $lowercase = preg_match('@[a-z]@', $password1);
    $number    = preg_match('@[0-9]@', $password1);
    $specialChars = preg_match('@[^\w]@', $password1);

    if (empty($password1) && empty($password2)) {
        $msg2 = "All fields are required";
    } elseif ($password1 != $password2) {
        $msg2 = "Passwords do not match";
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password1) < 8) {
        $msg2 = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    } else {

        $code = new ManageUserContr();
        $result = $code->resetPassword($fname, $email, $password1);

        if ($result) {
            $msg = "Your password has been reset";
            header("refresh:4, url= login.inc.php");
        } else {
            $msg2 = "Cannot reset password";
        }
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
    <title>Forgot Password</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        html,
        /* body {
            height: 100%;
        } */

        .logbg {
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
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
    <?php
    include "navbar2.inc.php";
    ?>
    <div class="logbg">
        <main class="form-signin text-center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h1 class="h3 mb-3 mt-4 fw-normal">Reset Password</h1>
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
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <h6>The Password should:</h6>
                    <ul>
                        <li>Be atleast <b>8 characters</b> long</li>
                        <li>Contain atleast one number and one symbol</li>
                        <li>Contain <b>uppercase</b> and <b>lowercase</b> letters</li>
                    </ul>
                </div>
                <div class="form-floating">
                    <input type="password" name="password2" class="form-control" id="floatingInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup="checkPass();" required>
                    <label for="floatingInput">New Password</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="confirm2" class="form-control" id="floatingPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup="checkPass();" required>
                    <label for="floatingPassword">Confirm Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary mb-4 mt-3" type="submit" name="submit">Reset</button>
            </form>
        </main>
    </div>
    <?php
    include "footer2.inc.php";
    ?>

    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/form-validation.js"></script>
</body>

</html>