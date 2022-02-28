
      <?php include('./partials/menu.php') ?>
            <!-- main content section starts -->
            <div class="main_contact ">
                   <div class="wrapper">
                         <h1>dashboard</h1>
                        
                         <?php
                         
                              if(isset($_SESSION['login_success'])) {
                                    echo $_SESSION['login_success'];
                                    unset($_SESSION['login_success']);
                              }
                          ?>
                          <br> 
                          <?php 
                               $sql = "SELECT * FROM tbl_category";
                               $res = mysqli_query($conn,$sql);
                               $count = mysqli_num_rows($res);
                          ?>

                         <div class="col-4 text_center">
                               <h2><?= $count ?></h2>
                               
                               Category
                         </div>

                         <?php 
                               $sql1 = "SELECT * FROM tbl_food";
                               $res1 = mysqli_query($conn,$sql1);
                               $count1 = mysqli_num_rows($res1);
                          ?>


                         <div class="col-4 text_center">
                               <h2><?= $count1?></h2>
                              
                               Food
                         </div>

                         <?php 
                               $sql2 = "SELECT * FROM tbl_admin";
                               $res2 = mysqli_query($conn,$sql2);
                               $count2 = mysqli_num_rows($res2);
                          ?>

                         <div class="col-4 text_center">
                               <h2><?= $count2 ?></h2>
                               
                               Admin
                         </div>

                         <?php 
                               $sql3 = "SELECT * FROM tbl_order";
                               $res3 = mysqli_query($conn,$sql3);
                               $count3 = mysqli_num_rows($res3);
                          ?>

                         <div class="col-4 text_center">
                               <h2><?= $count3?></h2>
                               
                               Total order 
                         </div>

                         <?php 
                              $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'delivered'";
                              $res4 = mysqli_query($conn,$sql4);
                              $rewiue = mysqli_fetch_assoc($res4);
                              
                         
                         ?>

                         <div class="col-4 text_center">
                               <h2>$<?= $rewiue['Total'] ?></h2>
                               
                               Rewiue Generated
                         </div> 
                         <div class="clearfix"></div>
                 </div>
            </div>
            <!-- main content  section ends -->

          <?php include('./partials/footer.php') ?>
      </body>
</html>