<?php 
    include('../config/constants.php'); 
    include('login-check.php');
?>
<html>
    <head>
        <title>Alabites Website - Admin Page</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <!-- Menu Section Starts -->


        <div class="menu text-center">
            <div class="wrapper">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/R2K.jpg" alt="Restaurant Logo" class="img-responsive"style="border-radius: 3%;">
                </a>
            </div>
                <ul>
				
                    <li><a href="manage-r2kcategory.php">Stall</a></li>
                    <li><a href="manage-r2kfood.php">Food</a></li>
                    <li><a href="manage-r2korder.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="../index.php">Back to Website</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->