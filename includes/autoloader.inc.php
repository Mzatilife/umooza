<?php
// spl_autoload_register('myAutoLoader');

// function myAutoLoader($className){

// $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

// $extension = ".class.php";

// if(strpos($url, 'includes')!== false){
//    $path = "../classes/";
// 	}else{
//  	$path = "classes/";
//  	}

// include_once  $path . $className . $extension;

//  }

include_once "classes/dbh.class.php";
include_once "classes/manageproperty.class.php";
include_once "classes/managepropertycontr.class.php";
include_once "classes/manageuser.class.php";
include_once "classes/manageusercontr.class.php";
include_once "classes/payment.class.php";
include_once "classes/paymentcontr.class.php";
include_once "classes/profile.class.php";
include_once "classes/profilecontr.class.php";
include_once "classes/shoutout.class.php";
include_once "classes/shoutoutcontr.class.php";
include_once "classes/category.class.php";
include_once "classes/categorycontr.class.php";

?>