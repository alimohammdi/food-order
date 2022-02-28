<?php require('./partials/menu.php') ?>

<html>
      <body>           
                  <div class="main_contact ">
                                          <div class="wrapper">
                                                <h2>Manage category</h2><br>
                                                <?php 
                                                      if(isset($_SESSION['add-cat'])){
                                                            echo $_SESSION['add-cat'];
                                                            unset($_SESSION['add-cat']);
                                                      }
                                                      if(isset($_SESSION['remove'])){
                                                            echo $_SESSION['remove'];
                                                            unset($_SESSION['remove']);
                                                      }
                                                      if(isset($_SESSION['delete-cat'])){
                                                            echo $_SESSION['delete-cat'];
                                                            unset($_SESSION['delete-cat']);
                                                      }
                                                      if(isset($_SESSION['error-up'])){
                                                            echo $_SESSION['error-up'];
                                                            unset($_SESSION['error-up']);
                                                      }
                                                      if(isset($_SESSION['update'])){
                                                            echo $_SESSION['update'];
                                                            unset($_SESSION['update']);
                                                      }
                                                ?>
                        
                                                <br><br>     
                                                <a href="<?= assets('add-category.php') ?>"  class="btn-primary">Add Category</a>
                                                <table class="full_tbl">
                                                      <tr>
                                                            <th>S.N.</th>
                                                            <th>title</th>
                                                            <th>image</th>
                                                            <th>featured</th>
                                                            <th>action</th>
                                                            <th>ACTION</th>
                                                      </tr>
                                                            <?php 
                                                                 $sql_cat = "SELECT * FROM tbl_category";
                                                                 $res = mysqli_query($conn,$sql_cat);
                                                                 $count = mysqli_num_rows($res);
                                                                 $num = 1;

                                                                 if($count > 0){
                                                                      while( $rows = mysqli_fetch_assoc($res)){
                                                                            $id = $rows['id'];
                                                                            $title = $rows['title'];
                                                                            $featured = $rows['featured'];
                                                                            $active = $rows['active'];
                                                                            $image_name = $rows['image_name'];
                                                                           
                                                                            
                                                                            ?>
                                                                              <tr>
                                                                                    <td><?= $num ++?> </td>
                                                                                    <td><?= $title ?></td>
                                                                                    <td><?php
                                                                                    if($image_name != ""){
                                                                                         ?>
                                                                                         <img src="<?=  BASEURL ?>images/category/<?= $image_name ?>" alt="" width="100px">
                                                                                    <?php
                                                                                    }else{
                                                                                          echo "<div class='error'>image not adedd</div>";
                                                                                    }?>
                                                                                    </td>
                                                                                    <td><?= $featured ?></td>
                                                                                    <td><?=  $active ?></td>
                                                                                    <td>
                                                                                    <a href="<?= assets('update-category.php') ?>?id=<?= $id ?>" class="btn-secondary">Update category</a> 
                                                                                    <a href="<?= assets('delete-category.php') ?>?id=<?= $id ?>& image_name=<?= $image_name ?>" class="btn-danjery">Delete category</a>
                                                                                    </td>
                                                                              </tr>
                                                                           
                                                                                    <?php

                                                                      };


                                                                  }else{
                                                                       ?>
                                                                       <tr>
                                                                       <td colspan="6"><div class='error'>not exist category</div> </td>
                                                                       </tr>
                                                                      
                                                                 <?php
                                                                  }
                                                            
                                                            
                                                            
                                                            ?>

                                                    
                  
                                          </div>
                  </div>
      </body>
</html>



