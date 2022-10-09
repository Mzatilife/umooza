<?php
include_once 'classautoloader.inc.php';
session_start();
$me = '';

$reset = $_SESSION['resetcode'];
if (isset($_POST['submit'])) {
    $code = $_POST['code'];

    if ($code != $reset) {
        $msg2 = "Invalid code";
    } else {
        header("location: new_password.inc.php");
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
            max-width: 330px;
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
</head>

<body>
    <?php
    include "navbar2.inc.php";
    ?>
    <div class="logbg">
        <main class="form-signin text-center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h1 class="h3 mb-3 mt-4 fw-normal">Forgot Password?</h1>
                <div class="alert alert-secondary fade show" role="alert">Enter the code sent to your email.
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
                <div class="form-floating">
                    <input type="text" name="code" class="form-control" id="floatingPassword" required>
                    <label for="floatingPassword">Enter code</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary mb-4 mt-3" type="submit" name="submit">Verify</button>
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