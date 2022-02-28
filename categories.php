<?php include('partials-front/menu.php') ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php  
            
              $sql = "SELECT * FROM tbl_category WHERE active='yes'  ";

              $res = mysqli_query($conn,$sql);
              $count = mysqli_num_rows($res);

              if($count > 0){
                  while($rows = mysqli_fetch_assoc($res)){
                      $id = $rows['id'];
                      $image_name = $rows['image_name'];
                      $title = $rows['title'];

                   ?> 
                        <a href="<?= BASEURL ?>category-foods.php?category_id=<?=$id?>">
                        <div class="box-3 float-container">
                            <?php  if($image_name != ""){
                                ?>
                                     <img src="<?= BASEURL ."images/category/".$image_name ?>" alt="Burger" class="img-responsive img-curve" >
                                <?php
                            }
                            else{
                                    echo "<div class=-='error'> emage not Available </div>";
                            } ?>
 
                            <h3 class="float-text text-white"><?= $title ?></h3>
                        </div>
                        </a>
                    <?php
                  }

              } else{
                  echo "<div class=-='error'> No Eny category </div>";
              }
            
            ?>



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php') ?>