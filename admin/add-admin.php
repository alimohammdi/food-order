
<?php  
require('./partials/menu.php');


if(isset($_POST['submit']) and !empty($_POST['fullname']) and !empty($_POST['username']) and !empty($_POST['password'])){
      $fullname = $_POST['fullname'];
      $username = $_POST['username'];
      $password = md5($_POST['password']);

$query = "INSERT INTO tbl_admin SET
  full_name = '$fullname',
  username = '$username', 
  password = '$password'

";


$rest = mysqli_query($conn,$query) ;

if($rest){
      $_SESSION['add'] = "<div class='success'>Added Is Successfuly.</div>" ;    //massage when added successfuly
      redirect('manage.admin.php');                   //function for redirect to manage admin 
      mysqli_close($conn);
}else{
      die(mysqli_connect_error());
      redirect('add-admin.php');
      $_SESSION['not_add'] = "<div class='success'>Added not Successfuly. please try again</div>";

}






}

?>

<html>
      <body>
            <div class="main_contact">
                  <div class="wrapper">
                        <h1>Add Admin</h1>
                        <br>
                        <?php if(isset($_SESSION['not_add'])){
                              echo $_SESSION['not_add'];
                              unset ($_SESSION['not_add']);
                        } ?>
                        

                      <form action="#" method="post">
                              <table>
                                    <tr>  <td>
                                                full name  :
                                           </td>
                                           <td>
                                                <input type="text" name="fullname" placeholder="Enter your name">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>
                                                user name :
                                          </td>
                                          <td>
                                                <input type="text" name="username"  placeholder="Enetr a user name ">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>
                                                password  :
                                          </td>
                                          <td>
                                                <input type="password" name="password" placeholder="password">
                                          </td>
                                    </tr>
                                     <tr>    
                                          <td colspan="2"  > 
                                                <input type="submit" name="submit" value="Add admin" class="btn-primary">
                                          </td>
                                    </tr>
                              </table>
                        </form>
                  </div>
            </div>
      </body>
</html>




<?php require('./partials/footer.php') ?>