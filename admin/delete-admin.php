<?php 
require('../config/constants.php');

if(isset($_GET['id'])){
      $id = $_GET['id'];

      $sql = "DELETE FROM tbl_admin WHERE id='$id'";

      $res = mysqli_query($conn,$sql);

      if($res){
            $_SESSION['error'] = "<div class='success'>delete is successfuly</div>";
            redirect(BASEURL.'admin/manage.admin.php');

      }else{
            $_SESSION['error'] = "<div class='error'>error : delet not successfuly ,please try later.</div>";
            redirect(BASEURL.'admin/manage.admin.php');

      }
}


?>