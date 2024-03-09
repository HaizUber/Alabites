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
			<a href="#" title="Logo">
                    <img src="images/Graciously.jpg" alt="Restaurant Logo" class="img-responsive" style= "max-width:10%; float: left;border-radius: 3%;">
                <ul>
                    <li><a href="manage-graciouslycategory.php">Stall</a></li>
                    <li><a href="manage-graciouslyfood.php">Food</a></li>
                    <li><a href="manage-graciouslyorder.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="../index.php">Back to Website</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->