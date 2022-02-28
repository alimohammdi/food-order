<?php 
require('../config/constants.php');

if(isset($_SESSION['user'])){
      session_destroy();
      redirect('login.php');

}


?>