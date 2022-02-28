<?php include('./partials/menu.php');?>
<?php 

if (isset($_GET['id']) and !empty($_GET['id'])){
      $id_order = $_GET['id'];

      $sql = "SELECT * FROM tbl_order where id = '$id_order'";
      $res = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($res);
      if($count > 0){
            $rows =mysqli_fetch_assoc($res);
            $food = $rows['food'] ;
            $price = $rows['price'] ;
            $qty = $rows['qty'] ;
            $status = $rows['status'] ;
            $customer_name = $rows['customer_name'] ;
            $customer_contact = $rows['customer_contact'] ;
            $customer_email = $rows['customer_email'] ;
            $customer_address = $rows['customer_address'] ;

      }else{
            redirect('manage-order.php');

      }
}else{
      redirect('manage-order.php');
}
?>
<body>
      <div class="main_contact">
                  <div class="wrapper">
                        <h1>Update order</h1>
                      

                        <form action="" method="POST"  enctype="multipart/form-data">
                              <table>
                                    <tr>  <td>
                                                Food  :
                                           </td>
                                           <td>
                                                <?= $food ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>
                                                price  :
                                          </td>
                                          <td>
                                                <?= $price .'$' ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Qty  :</td>
                                          <td>
                                               <input type="number" name="qty" value="<?= $qty ?>">
                                                
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Status :</td>
                                         <td>
                                          <select name="status">
                                                      <option <?php if($status == 'ordered'){echo 'selected' ;}?> value="ordered">ordered</option>
                                                      <option <?php if($status == 'on deliverey'){echo 'selected' ;}?>value="on deliverey" >on deliverey</option>
                                                      <option <?php if($status == 'delivered'){echo 'selected' ;}?>value="delivered">delivered</option>
                                                      <option <?php if($status == 'cancelled'){echo 'selected' ;}?>value="cancelled">cancelled</option>
                                          </select>
                                         </td>
                                    </tr>

                                    <tr>
                                          <td>Custumer name :</td>
                                          <td>
                                                <input type="text" name="name" value="<?=$customer_name?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>Phone number :</td>
                                          <td>
                                                <input type="tel" name="phone" value="<?php ob_start(); echo $customer_contact?>">
                                          </td>
                                    </tr>
                                    <tr> 
                                          <td>Email :</td>
                                          <td>
                                                <input type="email" name="email" value="<?php ob_start(); echo  $customer_email?>">
                                          </td>
                                    </tr>
                                    <tr>
                                          <td>address : </td>
                                          <td>
                                                <textarea name="address" rows="8" cols="22"><?=$customer_address?></textarea>
                                          </td>
                                    </tr>

                                    <tr>
                                         <td>
                                               <input type="hidden" name="id" value="<?= $id_order?>">
                                               <input type="hidden" name="price" value="<?= $price ?>">
                                                <input type="submit" name="submit" value="update order" class="btn-primary">
                                          </td>
                                    </tr>
                              </table>
                        </form>
                              <?php 
                                 if(isset($_POST['submit'])){
                              
                                    $id = $_POST['id'] ;
                                 
                                    $qty = $_POST['qty'] ;
                                    $price = $_POST['price'];
                                    $total = $price * $qty ;
                                    $status = $_POST['status'] ;
                                    $name = $_POST['name'] ;
                                    $contact = $_POST['phone'] ;
                                    $email = $_POST['email'] ;
                                    $address = $_POST['address'] ;


                                    $sql2 = "UPDATE tbl_order SET 
                                    qty = '$qty',
                                    total = '$total',
                                    status = '$status',
                                    customer_name = '$name',
                                    customer_contact = '$contact',
                                    customer_email = '$email',
                                    customer_address = '$address' 
                                    WHERE id = '$id'";

                                    $res2 = mysqli_query($conn,$sql2);
                                    if($res2 == true){
                                          $_SESSION['up-success'] = "<div class='success'>update is successfuly</div>";
                                          redirect('manage-order.php');

                                    }else{
                                          $_SESSION['up-error'] = "<div class='success'>update not  successfuly please try again </div>";
                                          redirect('manage-order.php');
                                    }
                                 }
                              ?>

                  </div>

      </div>


</body>

<?php include('./partials/footer.php') ?>
