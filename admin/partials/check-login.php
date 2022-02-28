<?php 


if(!isset($_SESSION['user'])){
      $_SESSION['no_login_massage'] = "<div class='error  text_center'>please login whith acount</div>";
      redirect('login.php');
}

?>