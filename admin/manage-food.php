<?php require('./partials/menu.php') ?>


<html>
      <header>

            </header>
            <body>
                  <div class="main_contact ">
                              <div class="wrapper">
                                    <h2>Manage Food</h2>
                                    <br>

                                    <?php 
                                          if(isset($_SESSION['upload'])){
                                                echo $_SESSION['upload'];
                                                unset($_SESSION['upload']);
                                          }
                                          if(isset($_SESSION['remove'])){
                                                echo $_SESSION['remove'];
                                                unset($_SESSION['remove']);
                                          }
                                          if(isset($_SESSION['connect'])){
                                                echo $_SESSION['connect'];
                                                unset($_SESSION['connect']);
                                          }
                                          if(isset($_SESSION['update'])){
                                                echo $_SESSION['update'];
                                                unset($_SESSION['update']);
                                          }

                                         ?>
                                    <br />
                                    <a href="<?= BASEURL ?>admin/add-food.php"  class="btn-primary">Add food</a>
                                    <br />
                                          <br>
                                    <table class="full_tbl">
                                          <tr>
                                                <th>S.N.</th>
                                                <th>title</th>
                                                <th>description</th>
                                                <th>price</th>
                                                <th>image</th>
                                                <th>featured</th>
                                                <th>active</th>
                                                <th>action</th>
                                          </tr>
                                          <?php 
                                              $n = 1;
                                              $sql = "SELECT * FROM tbl_food";
                                              $res = mysqli_query($conn,$sql);
                                              if($res){
                                                 $count = mysqli_num_rows($res);
                                                  if($count > 0){
                                                        while($rows = mysqli_fetch_assoc($res)){
                                                              $id = $rows['id'];
                                                              $title = $rows['title'];
                                                              $description  = $rows['description'];
                                                              $image = $rows['image_name'];
                                                              $price = $rows['price'];                                                
                                                              $featured = $rows['featured'];
                                                              $active =$rows['active'];

                                                        
                                                        ?>
                                                                    <tr>
                                                                        <td><?= $n ++ ?></td>
                                                                        <td><?= $title ?></td>
                                                                        <td><?= $description ?></td>
                                                                        <td><?= $price.'$' ?></td>
                                                                        <td><?php 
                                                                        if($image != ""){
                                                                              ?>
                                                                              <img src="<?= "../images/food/".$image ?>" alt="" width="150px" >
                                                                              <?php
                                                                        }else{
                                                                              echo "<div class='error'>image not adedd</div>";
                                                                        }

                                                                       ?>
                                                                        </td>
                                                                        
                                                                        <td><?= $featured ?></td>
                                                                        <td><?= $active ?></td>
                                                                        <td>
                                                                        <a href="<?= assets('update-food.php') ?>?id=<?= $id ?>" class="btn-secondary">Update Food</a> 
                                                                        <br> <br>
                                                                         <a href="<?= assets('delete-food.php') ?>?id=<?=$id?>&image=<?= $image  ?>" class="btn-danjery">Delete  Food</a>  
                                                               
                                                                        </td>
                                                                    </tr>
                                                                  
                                                        <?php
                                                        }
                                                }else{
                                                      ?> 
                                                      <tr>
                                                            <td>
                                                                  <div class='error'>no eny data : please add food</div>
                                                            </td>
                                                      </tr>
                                                      <?php
                                                }
                                              }
                                             
                                          ?>
                              
                              </div>
                  </div>

            </body>
</html>


 <?php  // include('./partials/footer.php') ?>