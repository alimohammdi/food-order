<?php require('./partials/menu.php') ?>


<div class="main_contact ">
                   <div class="wrapper">
                         <h2>Manage Order</h2>
                         <br>
                         <?php 
                          if(isset( $_SESSION['up-success'] )){
                                echo  $_SESSION['up-success'] ;
                                unset( $_SESSION['up-success'] );
                          }
                         ?>
                         <?php 
                          if(isset( $_SESSION['up-error'] )){
                                echo  $_SESSION['up-error'] ;
                                unset( $_SESSION['up-error'] );
                          }
                         ?>
                              <br>
                         <table class="full_tbl">
                               <tr>
                                     <th>S.N.</th>
                                     <th>Food</th>
                                     <th>Price</th>
                                     <th>Qty</th>
                                     <th>Total</th>
                                     <th>Date</th>
                                     <th>Status</th>
                                     <th>Name</th>
                                     <th>Phone</th>
                                     <th>Email</th>
                                     <th>Address</th>
                                     <th>Action</th>
                               </tr>

                                    <?php 
                                    $r = 1 ;
                                    $sql = "SELECT * FROM tbl_order order by id DESC";
                                    $res = mysqli_query($conn,$sql);
                                    $count = mysqli_num_rows($res);
                                    if($count > 0 ){
                                        while($rows = mysqli_fetch_assoc($res))  {
                                          $id = $rows['id'] ;
                                          $food = $rows['food'] ;
                                          $price = $rows['price'] ;
                                          $qty = $rows['qty'] ;
                                          $total = $rows['total'] ;
                                          $date = $rows['order_date'] ;
                                          $status = $rows['status'] ;
                                          $customer_name = $rows['customer_name'] ;
                                          $customer_contact = $rows['customer_contact'] ;
                                          $customer_email = $rows['customer_email'] ;
                                          $customer_address = $rows['customer_address'] ;
                                        

                                          ?>
                                          <tr>
                                                <td><?= $r ++ ?></td>
                                                <td><?= $food ?></td>
                                                <td><?= $price ?></td>
                                                <td><?= $qty ?></td>
                                                <td><?= $total?></td>
                                                <td><?= $date ?></td>
                                                <td>
                                                      <?php 
                                                       if($status == 'ordered'){
                                                             echo "<label>$status</label>";
                                                       }
                                                       if($status == 'on deliverey'){
                                                            echo "<label style='color: orange;'>$status</label>";
                                                      }
                                                      if($status == 'delivered'){
                                                            echo "<label style=' color: green ;' >$status</label>";
                                                      }
                                                      if($status == 'cancelled'){
                                                            echo "<label style=' color: red ;' >$status</label>";
                                                      }
                                                      ?>
                                                </td>
                                                <td><?= $customer_name ?></td>
                                                <td><?= $customer_contact ?></td>
                                                <td><?= $customer_email ?></td>
                                                <td><?= $customer_address ?></td>
                                                <td>
                                                <a href="<?= assets('update-order.php') ?>?id=<?=  $id ?>" class="btn-secondary">Update order</a> 
                                                </td>
                                                
                                          </tr>

                                          <?php
                                        }

                                    }else{
                                      echo "<tr><td colspan='12'> <div class='error'> not exist order</div></td> </tr>";
                                    }

                                    
                                    ?>
                               
                         </table>
                   </div>
</div>


<?php include('./partials/footer.php') ?>