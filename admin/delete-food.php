<?php include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image'])){
      $id = $_GET['id'];
      $image_name = $_GET['image'];
   

      if($image_name != ""){
            $image_path = "../images/food/". $image_name;
            $remove = unlink($image_path);
            if($remove == false){
                  $_SESSION['remove'] = "<div class='error'>error: delete image not successfuly ,please try again</div>";
                  redirect('manage-food.php');
                  die();
            }
      }

      $sql = "DELETE FROM tbl_food WHERE id=$id";
      $res = mysqli_query($conn,$sql);
      if($res){
            $_SESSION['delete'] = "<div class='success'> delete is successfuly </div>";
                  redirect('manage-food.php');
                  die();
      }else{
            $_SESSION['delete'] = "<div class='error'> delete is not successfuly :please try again </div>";
                  redirect('manage-food.php');
                  die(); 
      }

      
}
else {
      redirect('manage-food.php');
}
 
?>