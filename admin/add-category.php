<?php include('./partials/menu.php') ?>


<html>
      <body>
      <div class="main_contact">
                  <div class="wrapper">
                        <h1>Add Category</h1>
                        <br>
                        <?php 
                          if(isset($_SESSION['add-cat'])){
                                echo $_SESSION['add-cat'];
                                unset($_SESSION['add-cat']);
                          }
                          if(isset($_SESSION['upload'])){
                              echo $_SESSION['upload'];
                              unset($_SESSION['upload']);
                        }
                        ?>

                        
                              <form action="" method="POST"   enctype="multipart/form-data">
                                    <table  class="tbl-30">
                                          <tr>
                                                <td>Title :</td>
                                                <td>
                                                      <input type="text" name="title" placeholder="enter title">
                                                </td>
                                          </tr>
                                          <tr>
                                                <td>select image :</td>
                                                <td>
                                                      <input type="file" name="image">
                                                </td>
                                          </tr>
                                          <tr>
                                                <td>Feature :</td>
                                                <td>
                                                      <input type="radio" name="featured" value="yes">Yes
                                                      <input type="radio" name="featured" value="no">No
                                                </td>    
                                          </tr>
                                          <tr>
                                                <td>Action :</td>
                                                <td>
                                                      <input type="radio" name="active" value="yes">Yes
                                                      <input type="radio" name="active" value="no">No
                                                </td>
                                          </tr>
                                          <tr>
                                                <td>
                                                      <input type="submit" name="submit" value="add category" class="btn-secondary">
                                                </td>
                                          </tr>
                                    </table>
                              </form>
                              
                        
                  </div>
      </div>
      </body>
</html>

<?php 
  if(isset($_POST['submit'])  and !empty($_POST['title'])){

      $title = $_POST['title'];

      if($_FILES['image']['name'] != ""){
           
            $image_name = $_FILES['image']['name'];
            //rename image for create unic name 
            $exe = end(explode('.',$image_name));
            $image_name = "food_order_".rand(00,99).".".$exe;
            
            $tmp_path = $_FILES['image']['tmp_name'];
            $upload_path = "../images/category/".$image_name;

            $uploaded = move_uploaded_file($tmp_path,$upload_path);
            if($uploaded == false){
                  $_SESSION['upload'] = "<div class='error'>error : image not uploaded</div>";
                  redirect('add-category.php');
                  die();

            }
      }
      else{
            $image_name = "";
      }
      if(isset($_POST['featured'])){
            $featured = $_POST['featured'];

      }else{
            $featured = 'NO';

      }
      if(isset($_POST['active'])){
            $active = $_POST['active'];
      }else{
            $active = 'No';
      }


      // create sql quary 
      $sql = "INSERT INTO tbl_category set
       title = '$title',
       image_name ='$image_name',
       featured = '$featured',
       active = '$active'
      ";

      $res = mysqli_query($conn,$sql);

      if($res){
            $_SESSION['add-cat'] = "<div class='success'>add category successfuly</div>";
            redirect('manage-category.php');
      }
      else{
            $_SESSION['add-cat'] = "<div class='error'>add category not  successfuly</div>";
            redirect('add-category.php');
      }
      }
  

?>

<?php include("./partials/footer.php")?>