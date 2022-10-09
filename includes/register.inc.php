<?php
declare(strict_types = 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include_once 'classautoloader.inc.php';

if(isset($_POST['register'])){
$fname = strip_tags($_POST['fname']);
$lname = strip_tags($_POST['lname']);
$email = strip_tags($_POST['email']);
$type = strip_tags($_POST['type']);
$phone = strip_tags($_POST['phone']);
$phone2 = (!empty($_POST['phone2']) ? $_POST['phone2'] : null);

  $me='';
  $pwdcode='';
  // $msg = $msg2 = "";
  $Generator ="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  $pwdcode = substr(str_shuffle($Generator),0,8);
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
    $mail->Subject = "Umooza City :  Login Credentials";
    $mail->Body    = "
    <div style = 'border-bottom: 2px solid #57648C; color:#57648C; padding:10px; border-radius: 10%; text-align:center; letter-spacing: 3px; line-height: 2.0;'>
    <p>Hello, use your email to log into the system <br>Password : <b>$pwdcode</b></p>
    </div>
    ";
    $mail->send();
     
    $register = new ManageUserContr;

    try{
     $result = $register->userRegistration($fname, $lname, $phone, $phone2, $email, NULL, NULL, $pwdcode, $type, NULL);
     
     if ($result) {
       $msg = "User added!";
     } else {
      $msg2 = "operation failed!";
     }

    }catch(TypeError $e){
      $msg2 = "Error: " .$e->getMessage();
    }

   } catch (Exception $e) {
    $msg2 = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";  
   } 
}
