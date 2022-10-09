<?php
session_start();
unset($_SESSION['fname']);
unset($_SESSION['user_id']);
include_once 'classautoloader.inc.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function compressedImage($source, $path, $quality)
{
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    imagejpeg($image, $path, $quality);
}

if (isset($_POST['register'])) {

    $fname = strip_tags($_POST['fname']);
    $lname = strip_tags($_POST['lname']);
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $phone = strip_tags($_POST['phone']);
    $phone2 = (!empty($_POST['phone2']) ? $_POST['phone2'] : null);
    $email = strip_tags($_POST['email']);
    $address = strip_tags($_POST['address']);
    $pass1 = strip_tags($_POST['password']);
    $pass2 = strip_tags($_POST['password2']);


    $register = new ManageUserContr;

    //email validation-------------------------------------------------------------------------------------------------->
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $msg = " Invalid email address!";
    }
    //if confirmation pwd == main pwd ---------------------------------------------------------------------------------->
    elseif ($pass1 != $pass2) {
        $msg = " The two passwords did not match!";
    } else {
        date_default_timezone_get();
        $date = date("Y-m-d H:i:s");
        $Generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $token = substr(str_shuffle($Generator), 0, 6);

        $mail = new PHPMailer(true);

        //email confirmation
        try {
            //Server settings
            $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                     
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'projectmahala@gmail.com';
            $mail->Password   = 'jatpxeomxxghwssf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('projectmahala@gmail.com');
            $mail->addAddress($email);

            $email2 = base64_encode(urlencode($email));
            $expire_date = date("Y-m-d H:i:s", time() + 60 * 2880);
            $expire_date = base64_encode(urlencode($expire_date));

            $mail->isHTML(true);
            $mail->Subject = "Verify your email";
            $mail->Body = "
            <div style = 'border-bottom: 2px solid #57648C; color:#57648C; padding:10px; border-radius: 10%; text-align:center; letter-spacing: 3px; line-height: 2.0;'>
            <h2>Thank you for registering</h2>
            <a href='localhost/rent/includes/activation.inc.php?eid={$email2}&token={$token}&&exd={$expire_date}'>click here to verify</a>
            <p>This link will expire in 2 days</p>
            </div>
            ";

            $send = $mail->send();
            if ($send) {

                //--------------------------------------------compressing image-----------------------------------------------------
                $valid_ext = array('png', 'jpeg', 'jpg');
                $photoExt1 = @end(explode('.', $image));

                $phototest1 = strtolower($photoExt1);
                $real_name = pathinfo($image, PATHINFO_FILENAME);
                $new_name = $real_name . time() . '.' . $phototest1;

                $location = "../uploads/nationalIDs/" . $new_name;
                $file_extension = pathinfo($location, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);


                if (in_array($file_extension, $valid_ext)) {
                    // Compress Image 
                    compressedImage($image_tmp, $location, 60);

                    $msg = $register->userRegistration($fname, $lname, $phone, $phone2, $email, $address, $new_name, $pass1, 'landlord', $token);
                } else {
                    $msg2 = "National ID format is not correct.";
                }
            } else {
                $msg2 = "Registration failed! please contact us";
            }
        } catch (Exception $e) {
            $msg2 = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
    <title>Register Landlord</title>
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="../assets/images/logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome-free-5.15.1-web/css/all.css">
    <link href="../assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
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
    <style>
        .logbg {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <?php
    include "navbar2.inc.php";
    ?>
    <div class="logbg">
        <div class="container">
            <div class="card">
                <div class="card-body bg-primary text-center">
                    <h5 class="card-title text-white">Fill in the form fields to register and upload a rental property.</h5>
                </div>
            </div>
            <hr>
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

        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" class="needs-validation container mt-3" novalidate>
            <div class="row g-3">
                <div class="col-sm-3">
                    <label for="firstName" class="form-label">First name</label>
                    <input type="text" name="fname" class="form-control" id="firstName" placeholder="John" required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>

                <div class="col-sm-3">
                    <label for="lastName" class="form-label">Last name</label>
                    <input type="text" name="lname" class="form-control" id="lastName" placeholder="Doe" required>
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-3">
                            <img src="../assets/images/id.jpg" alt="national ID image" width="100%" height="100%">
                        </div>
                        <div class="col-9">
                            <label for="image" class="form-label">National ID image</label>
                            <input type="file" name="image" id="image" class="form-control" aria-label="image file input" required>
                            <div class="invalid-feedback">
                                Please enter an image file.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
                    <div class="invalid-feedback">
                        Please enter a valid email address.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Lilongwe, Area 47" required>
                    <div class="invalid-feedback">
                        Please enter your address.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" name="phone" class="form-control" id="phone" required>
                    <div class="invalid-feedback">
                        Please enter a valid phone number.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="phone2" class="form-label">Phone 2 <span class="text-muted">(Optional)</span></label>
                    <input type="number" name="phone2" class="form-control" id="phone2">
                    <div class="invalid-feedback">
                        Please enter a valid phone number.
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <h6>The Password should:</h6>
                        <ul>
                            <li>Be atleast <b>8 characters</b> long</li>
                            <li>Contain atleast one number and one symbol</li>
                            <li>Contain <b>uppercase</b> and <b>lowercase</b> letters</li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div>
                        <label for="password2" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password2" onkeyup="checkPass();" required>
                        <div class="invalid-feedback">
                            Please enter a password.
                        </div>
                    </div>
                    <div>
                        <label for="confirm2" class="form-label">Confirm Password</label>
                        <input type="password" name="password2" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="confirm2" onkeyup="checkPass();" required>
                        <div class="invalid-feedback">
                            Please confirm the password.
                        </div>
                    </div>
                </div>

                <hr class="m-0 mt-2">

                <button class=" w-50 btn btn-primary btn-lg mb-4" type="submit" name="register">Register</button>

            </div>
        </form>
    </div>
    <?php
    include "footer2.inc.php";
    ?>

    <script src="../assets/boostrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/form-validation.js"></script>
</body>

</html>