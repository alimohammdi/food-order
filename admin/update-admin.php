<?php 
require('../admin/partials/menu.php');


if(isset($_GET['id'])){
      $id = $_GET['id'];
      $sql = "SELECT * FROM tbl_admin WHERE id= '$id'";
      $res= mysqli_query($conn,$sql);
      if($res){
            $count = mysqli_num_rows($res);
            if($count==1){
                  $rows = mysqli_fetch_assoc($res);
                  $full_name = $rows['full_name'];
                  $username = $rows['username'];

            }else{
                  redirect(BASEURL.'admin/manage.admin.php');
            }
      }
      else{
            redirect(BASEURL.'admin/manage.admin.php');
      }


}
else{
      redirect(BASEURL.'admin/manage.admin.php');
}

?>
<html>
      <body>
            <div class="main_contact">
                  <div class="wrapper">
                        <h1>Apdate Admin</h1>
                       
                        <form action="#" method="post">
                        <table>
                              <tr>  <td>
                                          full name  :
                                     </td>
                                     <td>
                                          <input type="text" name="fullname" value="<?= $full_name ?>">
                                    </td>
                              </tr>
                              <tr>
                                    <td>
                                          user name :
                                    </td>
                                    <td>
                                          <input type="text" name="username"  value="<?= $username ?>" ">
                                    </td>
                              </tr>
                                </tr>
                               <tr>    
                                    <td colspan="2"  > 
                                          <input type="hidden" name="id" value="<?= $id ?>">
                                          <input type="submit" name="submit" value="Apdate admin" class="btn-primary">
                                    </td>
                              </tr>
                        </table>
                  </form>
            </div>
      </div>
</body>
</html>

<?php 

if(isset($_POST['submit'])){
      $id = $_POST['id'];
      $newfull_name = $_POST['fullname'];
      $newusername = $_POST['username'];
      $upsql = "UPDATE tbl_admin SET 
      full_name = '$newfull_name',
      username = '$newusername'
      WHERE id = '$id'
      ";
      $upres = mysqli_query($conn,$upsql);
      if($upres){
            $_SESSION['update'] = "<div class='success'>update is successfuly</div>";
            redirect(BASEURL.'admin/manage.admin.php');
      } 
      else{
            $_SESSION['update'] = "<div class='error'>error : update not successfuly</div>";
            redirect(BASEURL.'admin/manage.admin.php');

      }
}



?>


<?php require('./partials/footer.php') ?>


