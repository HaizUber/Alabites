<?php
include_once '../config/constants.php';
include_once 'partials/login-check.php';


if (isset($_POST['submit'])) {
    $food_id = $_POST['food_id'];
    $status = $_POST['status'];

    // Update the status in the database
    $sql = "UPDATE tbl_food SET status = '$status' WHERE id = $food_id";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $_SESSION['update'] = "Status updated successfully.";
        header('location:'.SITEURL.'admin/manage-food.php');
    } else {
        $_SESSION['update'] = "Failed to update status.";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
}
?>
