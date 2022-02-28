<?php include('partials-front/menu.php') ?>

<?php 

$search = mysqli_real_escape_string($conn,$_POST['search']);

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?= $search ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php 
            //    $search = mysqli_real_escape_string($conn,$_POST['search']);
                 $search = $_POST['search'];
              

               //connect to database
               $sql = "SELECT * FROM tbl_food WHERE title LIKE'%$search%' OR description  LIKE '%$search%'";
               $res  = mysqli_query($conn,$sql);
               $count = mysqli_num_rows($res);

               if($count > 0){
                   while($rows = mysqli_fetch_assoc($res)){
                       $title = $rows['title'];
                       $description = $rows['description'];
                       $image_name = $rows['image_name'];
                       $price = $rows['price'];

                       ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                     if($image_name != ""){
                                         ?>
                                          <img src="<?= BASEURL ?>images/food/<?= $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                         <?php

                                     }else{
                                        echo "<div class='error'>no image for this food</div>";
                                        die();
                                     }
                                    ?>
                                   
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?= $title ?></h4>
                                    <p class="food-price"><?= $price ?></p>
                                    <p class="food-detail">
                                       <?= $description ?>
                                    </p>
                                    <br>

                                    <a href="#" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                       <?php
                   }

               }else{
                   echo "<div class='error'>not eny food whith words</div>";
                   die();
               }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>