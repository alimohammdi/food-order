<?php session_start();

define('BASEURL','http://localhost/food_order/');
define('LOCALHOST','localhost');
define('DB_NAME', 'food_order');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');


$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_connect_error()); // database connection

$db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_connect_error()); // selection database

//FUNCTION
function dd($varable){
      die('<pre>'.var_export($varable) .'</pre>');
}
function assets($url){
      return BASEURL."admin/".$url;
}
function redirect($path){   //redirect to outher page
      header("location:$path");
      exit();
}?>