<?php
session_start();
unset($_SESSION['fname']);
unset($_SESSION['user_id']);
include_once 'classautoloader.inc.php';

if (isset($_POST['login'])) {
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    // passing login information
    $login = new ManageUserContr;
    $msg = $login->userLogin($email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mahala Mzati Mkwepu">
    <title>Login</title>
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
                <h1 class="h3 mb-3 mt-4 fw-normal">Please sign in</h1>

                <?php
                if (!empty($msg)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $msg; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } else {
                } ?>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary mb-4 mt-3" type="submit" name="login">Sign in</button>
                <a href="forgot_password.inc.php">Forgot password?</a>
            </form>
        </main>
    </div>
    <?php
    include "footer2.inc.php";
    ?>

    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var colors = ["Chiller", "Brush Script MT", "Bradley Hand ITC"]
        var currentColor = 0
        var lis = document.getElementById("full")

        function changeColor() {
            --currentColor
            if (currentColor < 0) currentColor = colors.length - 1
            for (var i = 0; i < 3; i++) {
                lis.style.fontFamily = colors[(currentColor + i) % colors.length]
            }
        }

        setInterval(changeColor, 10000)
    </script>
</body>

</html>