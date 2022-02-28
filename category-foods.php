<?php include('partials-front/menu.php') ?>


<?php 
       if(!isset($_GET['category_id']) or empty($_GET['category_id'])){
        redirect('index.php');
        

       }
       else{
           $id = $_GET['category_id'];
           $sql = "SELECT title FROM tbl_category WHERE id='$id'";
           $res = mysqli_query($conn,$sql);
           $count = mysqli_num_rows($res);
           if($count > 0){
               $rows = mysqli_fetch_assoc($res);
               $title = $rows['title'];
               
           }
           else{
               redirect('index.php');
           }
    
       }
     ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="<?= BASEURL ?>categories.php" class="text-white"><?= $title ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            $sql2 = "SELECT * FROM tbl_food WHERE category_id='$id'";

            $res2 = mysqli_query($conn,$sql2);
            $count2 = mysqli_num_rows($res);

            if($count2 > 0){
                while($rows2 = mysqli_fetch_assoc($res2)){
                    $title_food = $rows2['title'];
                    $description = $rows2['description'];
                    $image_name = $rows2['image_name'];
                    $price = $rows2['price'];

                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                   if($image_name != ""){
                                       ?>
                                    <img src="<?= BASEURL ?>images/food/<?= $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                   }else{
                                    echo "<div class='error'>no image food</div>";
                                   }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?= $title_food ?></h4>
                                <p class="food-price"><?= $price?></p>
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
                echo "<div class='error'> no eny food whith title </div>";
            }
            
            
            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>