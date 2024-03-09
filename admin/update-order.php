<?php
// update-status.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'], $_POST['order_id'])) {
    // Get the status and order ID from the AJAX request
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];

    // Perform the update operation in the database
    // ...

    // Send a success response back to the AJAX request
    echo "Order status updated successfully";
} else {
    // Send an error response if the request is invalid
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request";
}