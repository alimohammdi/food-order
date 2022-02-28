<?php include('./partials/menu.php') ?>


<html>
      <body>
      <div class="main_contact">
                  <div class="wrapper">
                        <h1>Add food</h1>
                        <br>
                        <?php 
                           if(isset($_SESSION['imagee'])){
                                 echo $_SESSION['imagee'];
                                 unset($_SESSION['imagee']);
                           }
                           if(isset($_SESSION['upload'])){
                              echo $_SESSION['upload'];
                              unset($_SESSION['upload']);
                        }
                        ?>
                        <br>
                      <form action="" method="POST" enctype="multipart/form-data">
                              <table>
                                    <tr>  <td>
                                                Title  :
                                           </td>
                                           <td>
                                                <input type="text" name="title" placeholder="Enter title food">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>
                                                Description :
                                          </td>
                                          <td>
                                                <textarea name="description" cols="30" rows="10"  placeholder="enter description food"></textarea>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>image :</td>
                                          <td>
                                               <input type="file" name="image">
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
                                                                  <option value="<?= $id ?>"><?= $title ?></option>
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
                                                <input type="number" name="price" placeholder="price">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>featured :</td>
                                          <td>
                                                <input type="radio" name="featured" value="yes">Yes
                                                <input type="radio" name="featured" value="no">No
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>active :</td>
                                          <td>
                                                <input type="radio" name="active" value="yes">Yes
                                                <input type="radio" name="active" value="no">No
                                          </td>
                                    </tr>
                                     <tr>    
                                          <td colspan="2"  > 
                                                <input type="submit" name="submit" value="Add food" class="btn-primary">
                                          </td>
                                    </tr>
                              </table>
                        </form>
                  </div>
            </div>
      </body>
</html>

<?php 
if(isset($_POST['submit']) and !empty($_POST['title']) and !empty($_POST['price'])){
      $title = $_POST['title'];
      $description = $_POST['description'];
      $category = $_POST['category'];
      $price = $_POST['price'];

      if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
      }
      else{
            $featured = 'no';
      }
      if(isset($_POST['active'])){
            $active = $_POST['active'];
      }
      else{
            $active = 'no';
      }
      if (isset($_FILES['image']['name'])){
            $image_name = $_FILES['image']['name'];
           

            if($image_name != ""){

                 
                 
                  $exe = end(explode('.',$image_name));
                  $image_name = "new_food_".rand(000,999).".".$exe;
                  $tmp_image = $_FILES['image']['tmp_name'];
                  $image_path ="../images/food/". $image_name;
                  
      
                  $upload = move_uploaded_file($tmp_image,$image_path);
                  if($upload == false){
                        $_SESSION['imagee'] = "<div class='error'>uploaded image not successfuly please try againe</div>";
                        redirect('add-food.php');
                        die();
                       
      
                  } 
            }
            else{
                  $image_name = "";
            }
      }
      else{
            $image_name = "";
      }

        $sql2 = "INSERT INTO tbl_food set 
            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category',                       
            featured = '$featured',
            active = '$active'
            ";

      $res2 = mysqli_query($conn,$sql2);

      if($res2){
            $_SESSION['upload'] = "<div class='success'>uploaded food fuccessfuly </div>";
            redirect('manage-food.php');
           
      }else{
            $_SESSION['upload'] = "<div class='error'>uploaded food not fuccessfuly </div>";
            redirect('manage-food.php');
         
      }
}
?>
<?php include("./partials/footer.php")?>