<?php
include_once 'classautoloader.inc.php';

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$me = '';
$resetcode = '';

if (isset($_POST['continue'])) {
    $email = $_POST['email'];
    $name = $_POST['fname'];
    if (empty($email)) {
        echo " ";
    } else {
        $_SESSION['fname'] = $name;
        $_SESSION['email'] = $email;

        $code = new ManageUserContr();
        $ans = $code->checkUser($name, $email);

        if ($ans) {

            $Generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $resetcode = substr(str_shuffle($Generator), 0, 4);
            //echo $resetcode;

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                     
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'projectmahala@gmail.com';
                $mail->Password   = 'projectmahala@24';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                //Recipients
                $mail->setFrom('projectmahala@gmail.com');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = "UmoozaCity :  Recovery Code";
                $mail->Body    = "
                <div style = 'border-bottom: 2px solid #57648C; color:#57648C; padding:10px; border-radius: 10%; text-align:center; letter-spacing: 3px; line-height: 2.0;'>
                <p> Recovery Code: <b>$resetcode</b><br> Enter it in the field to reset your password </p>
                </div>
                ";

                $mail->send();
                $msg = 'We have sent a reset code to your email';

                $_SESSION['resetcode'] = $resetcode;
                header("refresh:2, url=code.inc.php");
            } catch (Exception $e) {
                $msg2 = "Message could not be sent. Check internet connection";
            }
        } else {
            $msg2 = "Email and username not found";
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
                <div class="alert alert-secondary fade show" role="alert">
                    <p>Lost your password? it happens enter your first name and email address, we will send you a reset code to your email address.</p>
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
                    <input type="text" name="fname" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput">First Name</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="email" class="form-control" id="floatingPassword" placeholder="John" required>
                    <label for="floatingPassword">Email</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary mb-4 mt-3" type="submit" name="continue">Continue</button>
                <a href="login.php">Everything is ok? Login</a>
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