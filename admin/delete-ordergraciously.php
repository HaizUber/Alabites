<?php 
    // Include Constants Page
    include('../config/constants.php');

    // Check if ID is set
    if(isset($_GET['id']))
    {
        // Process to Delete
        // 1. Get ID
        $id = $_GET['id'];

        // 2. Delete Order from Database
        $sql = "DELETE FROM tbl_order WHERE id=$id";
        // Execute the Query
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed or not and set the session message accordingly
        // 3. Redirect to Manage Order with Session Message
        if($res==true)
        {
            // Order Deleted
            $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-graciouslyorder.php');
        }
        else
        {
            // Failed to Delete Order
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Order.</div>";
            header('location:'.SITEURL.'admin/manage-graciouslyorder.php');
        }
    }
    else
    {
        // Redirect to Manage Order Page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-graciouslyorder.php');
    }
?>
