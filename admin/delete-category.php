<?php 
require('../config/constants.php');


if(isset($_GET['id']) AND isset($_GET['image_name'])){
      $id = $_GET['id'];
      $image_name = $_GET['image_name'];
    

      if($image_name != ""){
            $path = "../images/category/".$image_name;
            $remove = unlink($path);
            if($remove == false){
                  $_SESSION['remove'] = "<div class='error'>error delete image category not successfuly</div>";
                  redirect('manage-category.php');
                  die();

            }

      }
   if($id){
         $sql = "DELETE FROM tbl_category WHERE id=$id";
         $res = mysqli_query($conn,$sql);
         if($res){
               $_SESSION['delete-cat'] = "<div class='success'>delete category successfuly</div>";
               redirect('manage-category.php');
         }
         else{
            $_SESSION['delete-cat'] = "<div class='error'>error: delete image category not successfuly</div>";
            redirect('manage-category.php');
         }
   }   

}
else{
      redirect('manage-category.php');
}