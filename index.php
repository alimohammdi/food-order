<?php include('partials-front/menu.php') ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?= BASEURL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
               
                if(isset($_SESSION['insert_order']))
                {
                 echo $_SESSION['insert_order'];
                 unset($_SESSION['insert_order']);
                };
             
            ?>

            <?php  
            
            $sql = "SELECT * FROM tbl_category WHERE active='yes' AND featured='yes' limit 3 ";

            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);

            if($count > 0){
                while($rows = mysqli_fetch_assoc($res)){
                    $id = $rows['id'];
                    $image_name = $rows['image_name'];
                    $title = $rows['title'];

                 ?> 
                      <a href="<?= BASEURL ?>category-foods.php?category_id=<?= $id ?>">
                      <div class="box-3 float-container">
                          <?php  if($image_name != ""){
                              ?>
                                   <img src="<?= BASEURL ."images/category/".$image_name ?>" alt="Burger" class="img-responsive img-curve" >
                              <?php
                          }
                          else{
                                  echo "<div class='error'> emage not Available </div>";
                          } ?>

                          <h3 class="float-text text-white"><?= $title ?></h3>
                      </div>
                      </a>
                  <?php
                }

            } else{
                echo "<div class='error'> No Eny category </div>";
            }
          
          ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
               $sql2 = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes'";
               $res2 = mysqli_query($conn,$sql2);
               $count2 = mysqli_num_rows($res2);
               if($count2 > 0){
                   while($rows1 =  mysqli_fetch_assoc($res2)){
                       $food_title = $rows1['title'];
                       $image_food = $rows1['image_name'];
                       $id_food = $rows1['id'];
                       $price_food = $rows1['price'];
                       $description =$rows1['description'];
                       
                       ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                    if($image_food != ""){
                                        ?>
                                         <img src="<?=   BASEURL . "images/food/". $image_food  ?>" alt="" class="img-responsive img-curve">
                                        <?php

                                    } else{
                                        echo  "<div class='error'>no eny image for this food  </div>";
                                    }
                                    ?>
                                   
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?= $food_title ?></h4>
                                    <p class="food-price"><?= $price_food ."$"?></p>
                                    <p class="food-detail">
                                       <?= $description ?>
                                    </p>
                                    <br>

                                    <a href="<?= BASEURL ?>order.php?food_id=<?= $id_food ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                       <?php
                   }

               }else{
                   echo "<div class='error'>no eny food exist </div>";
               }
            
            ?>
            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php') ?>