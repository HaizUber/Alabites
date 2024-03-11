<?php
include('config/constants.php'); // Include database connection

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$contact = $_POST['contact'] ?? '';
$reference = $_POST['reference'] ?? '';
$cartItems = $_POST['cartItems'] ?? ''; // Ensure this is properly formatted JSON on the client-side

try {
    // Ensure all required data is present
    if (empty($name) || empty($email) || empty($contact) || empty($reference) || empty($cartItems)) {
        throw new Exception("Incomplete form data.");
    }

    // Decode cart items JSON
    $cartItems = json_decode($cartItems);

    // Prepare variables for database insertion
    $orderId = null; // Will hold the generated order ID
    $sqlInsertOrder = "INSERT INTO tbl_neworders (customer_name, email, contact_number, reference_number) VALUES (?, ?, ?, ?)";
    $stmtInsertOrder = mysqli_prepare($conn, $sqlInsertOrder);

    // Insert order details
    mysqli_autocommit($conn, FALSE);
    mysqli_begin_transaction($conn);

    // Insert order record
    mysqli_stmt_bind_param($stmtInsertOrder, "ssss", $name, $email, $contact, $reference);
    mysqli_stmt_execute($stmtInsertOrder);
    $orderId = mysqli_insert_id($conn); // Get the newly inserted order ID

    if (!$orderId) {
        throw new Exception("Failed to insert order record.");
    }

    // Loop through cart items and insert into order details table
    $sqlInsertOrderDetail = "INSERT INTO tbl_order_items (order_id, food_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmtInsertOrderDetail = mysqli_prepare($conn, $sqlInsertOrderDetail);

    foreach ($cartItems as $item) {
        $foodId = $item->id ?? null;
        $quantity = $item->quantity ?? 0;
        $price = $item->price ?? 0;

        if (!$foodId) {
            throw new Exception("Invalid cart item format.");
        }

        mysqli_stmt_bind_param($stmtInsertOrderDetail, "iiid", $orderId, $foodId, $quantity, $price);
        mysqli_stmt_execute($stmtInsertOrderDetail);

        if (mysqli_errno($conn)) {
            throw new Exception("Failed to insert order detail for item: $foodId");
        }
    }

    // Commit the transaction if all insertions successful
    mysqli_commit($conn);
    echo 'success'; // Send success message back to JS

} catch (Exception $e) {
    // Rollback the transaction if any errors occur
    mysqli_rollback($conn);
    echo 'error'; // Send error message back to JS
    error_log($e->getMessage(), 3, 'C:/xampp/htdocs/files/alabites2/Alabites/error.log'); // Log the error for troubleshooting
} finally {
    // Close prepared statements and restore autocommit setting
    if (isset($stmtInsertOrder)) {
        mysqli_stmt_close($stmtInsertOrder);
    }
    if (isset($stmtInsertOrderDetail)) {
        mysqli_stmt_close($stmtInsertOrderDetail);
    }
    mysqli_autocommit($conn, TRUE);
}
?>
