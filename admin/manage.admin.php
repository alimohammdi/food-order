 <?php include('./partials/menu.php') ?>
                 <!-- main content section starts -->
                 <div class="main_contact ">
                   <div class="wrapper">
                         <h1>Manage Admin</h1>
                         <br />
                         <?php if(isset($_SESSION['add'])){
                             echo $_SESSION['add'];
                             unset($_SESSION['add']);
                         } ?>
                          <?php if(isset($_SESSION['update'])){
                             echo $_SESSION['update'];
                             unset($_SESSION['update']);
                         } ?>
                         
                          <?php if(isset($_SESSION['delete'])){
                             echo $_SESSION['delete'];
                             unset($_SESSION['delete']);
                         }?>
                          <?php if(isset($_SESSION['not-found-admin'])){
                             echo $_SESSION['not-found-admin'];
                             unset($_SESSION['not-found-admin']);
                         }?>
                         <?php if(isset($_SESSION['new_pas'])){
                             echo $_SESSION['new_pas'];
                             unset($_SESSION['new_pas']);
                         }?>
                            <br />
                         <a href="add-admin.php"  class="btn-primary">Add Admin</a>

            
                          <br />

                         <table class="full_tbl">
                               <tr>
                                     <th>S.N.</th>
                                     <th>FULL NAME</th>
                                     <th>USER NAME</th>
                                     <th>ACTION</th>
                               </tr>



                               <?php 
                                   $sql = "SELECT * FROM tbl_admin";
                                   $res = mysqli_query($conn,$sql);

                                   $sn = 1 ;  // varable for id admin 

                                   if($res){
                                       $count = mysqli_num_rows($res);
                                        if($count > 0){
                                            while($rows= mysqli_fetch_assoc($res)){
                                               $id = $rows['id'];
                                               $fullname = $rows['full_name'];
                                               $username = $rows['username'];

                                               ?>
                                                             <tr>
                                                                <td><?= $sn++?></td>
                                                                <td><?= $fullname?></td>
                                                                <td><?= $username?></td>
                                                                <td>
                                                                    <a href="<?= assets('change-password.php')?>?id=<?= $id ?>" class="btn-primary">Change password</a>
                                                                    <a href="<?= assets('update-admin.php')?>?id=<?= $id ?>" class="btn-secondary">Update Admin</a> 
                                                                    <a href="<?= assets('delete-admin.php')?>?id=<?= $id ?>" class="btn-danjery">Delete Admin</a>  
                                                                </td>
                                                            </tr>
                                               <?php 

                                           }

                                       }else{

                                       }

                                   }
                               ?>
                               
                        
                         </table>

                   </div>
            </div>
            <!-- main content  section ends -->

            <?php include('./partials/footer.php') ?>

      
