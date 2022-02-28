<?php require('./partials/menu.php') ?>
<?php 
      if(isset($_GET['id'])){
            $id = $_GET['id'];
      }else {
            redirect('manage.admin.php');
      }
     
?>
<html>
      <body>
            <div class="main_contact">
                  <div class="wrapper">
                        <h1>Change password</h1>
                        
                      <form action="#" method="post">
                              <table>
                                 </tr>
                                    <tr>
                                          <td>
                                                current password :
                                          </td>
                                          <td>
                                                <input type="password" name="current-pas"  placeholder="current password">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>
                                                new password  :
                                          </td>
                                          <td>
                                                <input type="password" name="new-pas" placeholder="new password">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>
                                                confirm password  :
                                          </td>
                                          <td>
                                                <input type="password" name="confirm-pas" placeholder="confirm password">
                                          </td>
                                    </tr>
                                     <tr>    
                                          <td colspan="2"  > 
                                                <input type="hidden" name="id"  value="<?= $id ?>">
                                                <input type="submit" name="submit" value="change password" class="btn-secondary">
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
      $curect_pas = md5($_POST['current-pas']);
      $new_pas = md5($_POST['new-pas']) ;
      $confirm_pas = md5($_POST['confirm-pas']) ;
      $id = $_POST['id'];


      $sql ="SELECT * FROM tbl_admin WHERE id= $id AND   password = '$curect_pas'";
      $res = mysqli_query($conn,$sql);

      if($res){
            
            $count = mysqli_num_rows($res);
            if($count==1){

                  if($new_pas == $confirm_pas){
                        
                        $sql2 = "UPDATE tbl_admin SET 
                        password ='$confirm_pas' WHERE id = '$id'";
                        $res2 = mysqli_query($conn,$sql2);
                        if($res2){
                              $_SESSION['new_pas'] = "<div class='success'>change password is successfuly</div";
                              redirect('manage.admin.php');
                        }

                  }else{
                        $_SESSION['not-found-admin'] = "<div class='error'>new password and confirm password dose not Equal ,please try again.</div";
                        redirect('manage.admin.php');
                  }

            }
            else{
                  $_SESSION['not-found-admin'] = "<div class='error'>sorry not found this admin ,please try again.</div";
                        redirect('manage.admin.php');
            }


      }
}









?>


<?php require('./partials/footer.php') ?>