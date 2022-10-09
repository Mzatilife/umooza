<?php
session_start();
unset($_SESSION['fname']);
unset($_SESSION['user_id']);
// session_unset();
// session_destroy();
header('location:../includes/login.inc.php');
?>