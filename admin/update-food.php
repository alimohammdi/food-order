<?php include('./partials/menu.php') ;


if(isset($_GET['id']) and $_GET['id'] != ""){
      $id_food = $_GET['id'];

      $sql1 = "SELECT * FROM tbl_food WHERE id=$id_food";
      $res1 = mysqli_query($conn,$sql1);
      $count1 = mysqli_num_rows($res1);
      if($res1){
            if($count1 == 1){
                  $rows = mysqli_fetch_assoc($res1);
                  $id_food = $rows['id'];
                  $food_title = $rows['title'];
                  $description  = $rows['description'];
                  $current_category = $rows['category_id'];
                  $current_image = $rows['image_name'];
                  $price = $rows['price'];                                                
                  $featured = $rows['featured'];
                  $active =$rows['active'];
                  



            }else{
                  $_SESSION['connect'] = "<div class='error'>error : this id for food not found</div>";
                    redirect('manage-food.php');
                     die();
            }

      }
      else{
            $_SESSION['connect'] = "<div class='error'>error : connect whith database not successfuly</div>";
            redirect('manage-food.php');
            die();
      }

}
else{
      redirect('manage-food.php');
}

?>


<body>
      <div class="main_contact">
                  <div class="wrapper">
                        <h1>Update Food</h1>
                        <br>
                        <?php 
                        if(isset($_SESSION['upload_image'])){
                              echo $_SESSION['upload_image'];
                              unset($_SESSION['upload_image']);
                        }
                        if(isset($_SESSION['delete_currentimage'])){
                              echo $_SESSION['delete_currentimage'];
                              unset($_SESSION['delete_currentimage']);}
                        ?>
                        <br>

                        <form action="" method="POST" enctype="multipart/form-data">
                              <table>
                                    <tr>  <td>
                                                Title  :
                                           </td>
                                           <td>
                                                <input type="text" name="title" value="<?= $food_title ?>" >
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>
                                                Description :
                                          </td>
                                          <td>
                                                <textarea name="description" cols="30" rows="10"  ><?= $description ?></textarea>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Current image :</td>
                                          <td>
                                                <?php if($current_image != ""){
                                                      ?> <img src="<?= "../images/food/". $current_image ?>" width="150px">
                                                      <?php
                                                }else{
                                                      echo "<div class='error'>no image for this food</div>";
                                                }
                                                
                                                ?>
                                               
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>New image :</td>
                                          <td>
                                               <input type="file" name="new_image">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>category :</td>
                                          <td>
                                                <select name="category" ><?php 
                                                                    $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                                                                    $res = mysqli_query($conn,$sql);
                                                                    $count = mysqli_num_rows($res);
                                                              if($count != 0 ){
                                                                while(  $rows = mysqli_fetch_assoc($res)){
                                                                    $id = $rows['id'];
                                                                    $title = $rows['title'];?>
                                                                    <option <?php if($current_category == $id){echo 'selected';} ?> value="<?= $id ?>"><?= $title ?></option>
                                                            <?php
                                                                 }
                                                            }
                                                            else{?><option value="0">not exist category</option><?php  } ob_start();?></select>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>
                                                price  :
                                          </td>
                                          <td>
                                                <input type="number" name="price" value="<?= $price ?>" >
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>featured :</td>
                                          <td>
                                                <input <?php if($featured == 'yes'){echo 'checked';} ?> type="radio" name="featured" value="yes">Yes
                                                <input <?php if($featured == 'no'){echo 'checked';} ?> type="radio" name="featured" value="no">No
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>active :</td>
                                          <td>
                                                <input <?php if($active == 'yes'){echo 'checked';} ?> type="radio" name="active" value="yes">Yes
                                                <input <?php if($active == 'no'){echo 'checked';} ?> type="radio" name="active" value="no">No
                                          </td>
                                    </tr>
                                     <tr>    
                                          <td colspan="2"  > 
                                                <input type="hidden" name="hidden_id" value="<?= $id_food ?>">
                                                <input type="hidden" name="current_image" value="<?= $current_image ?>">
                                                <input type="submit" name="submit" value="update food" class="btn-primary">
                                          </td>
                                    </tr>
                              </table>
                        </form>

                  </div>

      </div>


</body>


<?php 

if(isset($_POST['submit'])){
      $id_up = $_POST['hidden_id'];
      $title = $_POST['title'];
      $description = $_POST['description'];
      $category = $_POST['category'];
      $price = $_POST['price'];
      $featured = $_POST['featured'];
      $active = $_POST['active'];
      
      

      if(isset($_FILES['new_image']['name'])){
            $image_name = $_FILES['new_image']['name'];
            
            if($image_name != ""){

                 
                  $exe = explode('.',$image_name);
                 
                  $file_extension = end($exe);
                  $image_name = "new_food_".rand(000,999).".".$file_extension ;
                  $image_path = "../images/food/". $image_name;
                 
                  $image_tmp = $_FILES['new_image']['tmp_name'];
                  $uploaded = move_uploaded_file($image_tmp,$image_path);
                 
                  if($uploaded){

                        //delete current image 
                        if(isset($_POST['current_image']) AND $_POST['current_image'] != ""){
                              $currrent_image = $_POST['current_image'];
                              $path = "../images/food/". $current_image;
                              $unlink = unlink($path);
                              if($unlink){
                                    $_SESSION['delete_image'] = "<div class='sucess'>error : current image  deleted</div>";
                              }else{
                                    $_SESSION['delete_currentimage'] = "<div class='error'>error :current image not uploaded</div>";
                                     redirect('update-food.php');
                                     die();
                              }
                        }


                  }else{
                        $_SESSION['upload_image'] = "<div class='error'>error : new image not uploaded</div>";
                        redirect('update-food.php');
                        die();
                  }


            }else{
                  $image_name = $current_image;
            }

      }else{
            $image_name = $current_image ;
      }


   $sql3 = "UPDATE tbl_food SET 
      title = '$title',
      description = '$description',
      price = '$price' ,
      featured = '$featured' ,
      active = '$active' ,
      category_id = '$category',
      image_name = '$image_name'
      WHERE id='$id_up'
      ";
      
   $res3 = mysqli_query($conn,$sql3);

   if($res3){
      $_SESSION['update'] = "<div class='success'>update is successfuly</div>";
      redirect('manage-food.php');
      die();

   }else{
      $_SESSION['update'] = "<div class='error'>update is not successfuly</div>";
      redirect('manage-food.php');
      die();
   }
}



?>
<?php include('./partials/footer.php') ?>