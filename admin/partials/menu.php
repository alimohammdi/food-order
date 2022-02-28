<?php require('../config/constants.php');
   

//  check login or not 
   include('check-login.php');

   
?>


<html>
      <head>
            <title>food order -home page admin</title>
      </head>
      <link rel="stylesheet" href="../css/admin.css" >
      <body>
     
            <!-- menu section starts -->
            <div class="menu" > 
                 <div class="wrapper">
                       <ul>
                             <li><a href="index.php">Home</a></li>
                             <li><a href=<?= assets('manage.admin.php') ?>>Admin</a></li>
                             <li><a href=<?= assets('manage-category.php') ?>>category</a></li>
                             <li><a href=<?= assets('manage-food.php') ?>>Food</a></li>
                             <li><a href=<?= assets('manage-order.php') ?>>Order</a></li>
                             <li><a href=<?= assets('logout.php') ?>>Logout</a></li>
                       </ul>
                 </div>
            </div>
            <!-- menu section ends -->