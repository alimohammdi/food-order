<?php 
include('./partials/menu.php');


if(isset($_GET['id'])){
      $id = $_GET['id'];

      $sql = "SELECT * FROM tbl_category WHERE id=$id";
      $res = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($res);

      if($count == 1){
            $rows = mysqli_fetch_assoc($res);
            $title = $rows['title'];
            $current_image = $rows['image_name'];
            $featured = $rows['featured'];
            $active = $rows['active'];
      }
      else{
      $_SESSION['error-up'] = "<div class='error'>error:this category not found</div>";
      redirect('manage-category.php');
      }
}
else{
redirect('manage-category.php');
}
?>

<body>
      <div class="main_contact">
                  <div class="wrapper">
                        <h1>Update Category</h1>

                              <br>
                                          <?php
                                                if(isset($_SESSION['update_image'])){
                                                      echo $_SESSION['update_image'];
                                                      unset($_SESSION['update_image']);
                                                }
                                                if(isset($_SESSION['remove'])){
                                                      echo $_SESSION['remove'];
                                                      unset($_SESSION['remove']);
                                                }
                                          ?>
                              <br>                       
                              <form action="" method="POST"   enctype="multipart/form-data">
                                    <table  class="tbl-30">
                                          <tr>
                                                <td>Title :</td>
                                                <td>
                                                      <input type="text" name="title" value="<?= $title ?>">
                                                </td>
                                          </tr>
                                          <tr>
                                                <td>current image</td>
                                          <td>
                                                <?php 
                                                      if($current_image != "")
                                                      {
                                                            ?>
                                                            <img src="<?= BASEURL?>images/category/<?=$current_image ?>" alt="" width="150px">
                                                                  <?php
                                                      }else{
                                                            echo "<div class='error'>no emage exist</div>";
                                                      }
                                                ?>
                                          </td>
                                          </tr>
                                          <tr>
                                                <td>select image :</td>
                                                <td>
                                                      <input type="file" name="new_image">
                                                </td>
                                          </tr>
                                          <tr>
                                                <td>Featured :</td>
                                                <td>
                                                      <input <?php if($featured == "yes"){echo "checked";}?> type="radio"  name="featured" value="yes">Yes

                                                      <input <?php if($featured == "no"){echo "checked";}?> type="radio"  name="featured" value="no">No
                                                </td>    
                                          </tr>
                                          <tr>
                                                      <td>Action :</td>
                                                      <td>
                                                            <input  <?php if($active == "yes"){echo "checked";} ?> type="radio" name="active" value="yes">Yes

                                                            <input  <?php ob_start(); if($active == "no"){echo "checked";} ?> type="radio" name="active" value="no">No
                                                      </td>
                                          </tr>
                                          <tr>
                                                <td>
                                                      <input type="hidden" name="current_image" value="<?= $current_image ?>">
                                                      <input type="hidden" name="id" value="<?= $id ?>">
                                                      <input type="submit" name="submit" value="Update category" class="btn-secondary">
                                                </td>
                                          </tr>
                                    </table>
                              </form>
                              
                        
                  </div>
      </div>
</body>



<?php 


if(isset($_POST['submit'])){
    $id =  $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if(isset($_FILES['new_image']['name'])){
          $image_name = $_FILES['new_image']['name'];
        
          if($image_name != ""){

            $exes = end(explode('.',$image_name));
            $image_name = "food_order_".rand(00,99).".".$exes;
            
            $tmp_path = $_FILES['new_image']['tmp_name'];
            $upload_path = "../images/category/".$image_name;

            $uploaded = move_uploaded_file($tmp_path,$upload_path);
            if($uploaded == false){
                  $_SESSION['update_image'] = "<div class='error'>error : image not uploaded</div>";
                  die();

            }
            if($current_image != ""){
                   // delete current image
                        $current_path = "../images/category/".$current_image;
                        $remove_current = unlink($current_path);
                        if($remove_current == false){

                              $_SESSION['remove'] = "<div class='error'>error : current image not removed</div>";
                              redirect('update-category.php');
                              die();
                        }


            }
           
          }else{
                $image_name=$current_image;
          }

    }else{
            $image_name = $current_image;
    }
     
    $sql2 = "UPDATE tbl_category SET
    title='$title',
    image_name = '$image_name',
    featured='$featured',
    active='$active'
    WHERE id='$id' ";

    $res2 = mysqli_query($conn,$sql2);

    if($res2){
                  $_SESSION['update'] =  "<div class='success'>update is successfuly</div>";
                  redirect('manage-category.php');
           

    }else{
          $_SESSION['update'] =  "<div class='error'>error:update not successfuly</div>";
          redirect('manage-category.php');
    }



}




?>


<?php include('./partials/footer.php')  ?> 