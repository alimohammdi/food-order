<?php include('partials-front/menu.php') ?>
<?php 
   if(isset($_GET['food_id']) AND $_GET['food_id'] != ""){
       $food_id = $_GET['food_id'];

       $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
       $res = mysqli_query($conn,$sql);
       $count = mysqli_num_rows($res);
       if($count == 1){
           $rows = mysqli_fetch_assoc($res);
           $title = $rows['title'];
           $image_name = $rows['image_name'];
           $price = $rows['price'];


       }else{
           redirect('foods.php');

       }


   }else{
       redirect('foods.php');
   }


?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <br>
            <?php 
               if(isset($_SESSION['insert_error']))
               {
                echo $_SESSION['insert_error'];
                unset($_SESSION['insert_error']);
               };
            ?>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <?php 
                    if($image_name != ""){
                        ?>
                         <div class="food-menu-img">
                             <img src="<?= BASEURL ?>images/food/<?= $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                         </div>
                        <?php
                    }else{
                        echo "<div class='error'>not image foud</div>";
                    }
                    
                    
                    ?>

                   
    
                    <div class="food-menu-desc">
                        <h3><?= $title?></h3>
                        <p class="food-price">$<?= $price?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>
                    <input type="hidden" name="food" value="<?= $title ?>">
                    <input type="hidden" name="price" value="<?= $price ?>">
                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php 
    if(isset($_POST['submit'])){

        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $qty * $price ; 
        $date = date('Y-m-d h-i-sa');
        $status = "ordered";
        $name = $_POST['full-name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        // insert to database 
        $sql2 = " INSERT INTO tbl_order SET 
        food = '$food',
        price = '$price',
        qty = '$qty',
        total = '$total',
        order_date = '$date',
        status = '$status',
        customer_name = '$name',
        customer_contact = '$contact',
        customer_email = '$email',
        customer_address = '$address'";
        
        $res2 = mysqli_query($conn,$sql2);

        if($res2){
            $_SESSION['insert_order'] = "<div class='success text-center'>Ordered Is Successfuly </div>";
            redirect('index.php');

            
        }else{
            $_SESSION['insert_error'] = "<div class='error text-center'>ordered not successfuly please try again</div>";
            
        }

    }
    
    
    
    ?>

    <?php include('partials-front/footer.php') ?>