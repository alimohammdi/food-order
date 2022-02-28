<?php require("../config/constants.php")?>
<html>
      <head>
            <title>login food-order system</title>
            <link rel="stylesheet" href="../css/admin.css">
      </head>
      <body>
            <div  class="login">
                 
                <h2 class="text_center">login</h2><br><br>
                <?php
                  if(isset($_SESSION['login_error'])) {
                        echo $_SESSION['login_error'];
                  }
                  if(isset($_SESSION['no_login_massage'])){
                        echo $_SESSION['no_login_massage'];
                  }
                  ?>
            
            <form action="" method="POST" class="text_center">
                  <h3>username :</h3>
                  
                  <input type="text" name="username"  placeholder="inter username"><br><br>

                <h3>password :</h3>   
                  <input type="password" name="password" placeholder="inter password"><br><br><br>

                  <input type="submit" name="submit" value="LOGIN"  class="btn-primary">
            </form>
            </div>
      </body>
</html>



<?php 

if(isset($_POST['submit']) and !empty($_POST['username'])  and !empty($_POST['password'])){

      $username = $_POST['username'];
      $password =  md5($_POST['password']);

      $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password ='$password' ";

      $res = mysqli_query($conn,$sql);

      $count = mysqli_num_rows($res);
      $rows = mysqli_fetch_assoc($res);
      $admin_name = $rows['full_name'];

      if($count == 1){
            $_SESSION['login_success'] = "<div class='success'>login is successfuly<br>Hi $admin_name welcome to admin panel </div>";
            $_SESSION['user'] = $username;
            redirect('index.php');

      }
      else{
            $_SESSION['login_error'] = "<div class='error'>login not successfuly: username or password not match</div>";
            redirect('login.php');
      }

}


?>