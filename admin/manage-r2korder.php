<?php include('partials/menur2kcons.php'); 


if (isset($_POST['submit'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

// Set the time zone to Asia/Manila
date_default_timezone_set('Asia/Manila');


    if ($status === 'Claimed') {
        $resolved_datetime = date('Y-m-d H:i:s');
        $update_sql = "UPDATE tbl_order SET status = '$status', resolved_datetime = '$resolved_datetime' WHERE id = $order_id";
    } else {
        $update_sql = "UPDATE tbl_order SET status = '$status' WHERE id = $order_id";
    }

    $update_result = mysqli_query($conn, $update_sql);

    if ($update_result) {
        $_SESSION['update'] = "Order status updated successfully";
        header("location: " . SITEURL . "admin/manage-r2korder.php");
        exit();
    } else {
        $_SESSION['update'] = "Failed to update order status";
        header("location: " . SITEURL . "admin/manage-r2korder.php");
        exit();
    }
}
?>
<link rel="stylesheet" type="text/css" href="print.css" media="print">

<style>
    /* CSS styles for the summary section */
    .summary-section {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 5px;
        margin-top: 30px;
        text-align: center;
    }

    .summary-section h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .summary-section p {
        font-size: 18px;
        margin-bottom: 5px;
    }

    /* Rest of the CSS styles */

    /* ... existing CSS styles ... */

    /* Added CSS styles for search form */
    .search-form {
        margin-bottom: 20px;
    }

    .search-form input[type="text"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .search-form button {
        padding: 8px 15px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-form button:hover {
        background-color: #45a049;
    }

    /* Added CSS styles for table */
    .tbl-full {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .tbl-full thead tr th,
    .tbl-full tbody tr td {
        padding: 10px;
        text-align: center;
    }

    .tbl-full thead tr th {
        background-color: #f5f5f5;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
    }

    .tbl-full tbody tr td {
        border-bottom: 1px solid #f5f5f5;
        font-size: 16px;
    }

    .tbl-full tbody tr:last-child td {
        border-bottom: none;
    }

    /* Added CSS styles for summary section */
    .summary-section {
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    /* Updated styles for the update order button and status labels */
    .btn-secondary {
        display: inline-block;
        padding: 8px 15px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #45a049;
    }

    .status-label {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .status-label.reserved {
        background-color: orange;
        color: #fff;
    }

    .status-label.claimed {
        background-color: green;
        color: #fff;
    }

    /* Added CSS styles to highlight pending orders */
    .tbl-full .pending {
        background-color: orange;
        color: #fff;
    }

    .btn-danger {
        background-color: #f44336;
    }

    .btn-danger:hover {
        background-color: #d32f2f;
    }

    .btn-danger {
        display: inline-block;
        padding: 10px 20px;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    #scrollToBottomButton {
    position: fixed;
    bottom: 80px;
    right: 20px;
    background-color: green ;
    color: #fff;
    border: none;
    border-radius: 50%; /* Make it round */
    width: 50px;
    height: 50px;
    font-size: 24px; /* Adjust the size of the down arrow symbol */
    cursor: pointer;
    z-index: 999;
}

@media only screen and (max-width: 767px) {
    .summary-section {
        padding: 10px;
        margin-top: 10px;
    }

    .summary-section h2 {
        font-size: 20px;
    }

    .summary-section p {
        font-size: 16px;
    }

    .btn-secondary,
    .btn-danger {
        padding: 8px 12px;
        font-size: 14px;
    }

    .search-form input[type="text"] {
        padding: 6px;
        font-size: 14px;
    }

    .tbl-full {
        margin-top: 10px;
    }

    .tbl-full thead tr th {
        font-size: 12px;
    }

    .tbl-full tbody tr td {
        font-size: 14px;
    }
}

@keyframes entry-pop-out {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}

.tbl-full tbody tr {
    animation: entry-pop-out 0.5s ease both; /* Apply animation to table rows */
}

.tbl-full .cancelled {
    background-color: red; /* Red background for cancelled orders */
    color: #fff; /* White text color for better visibility */
}

/* Stylized filter button */
.filter-form button {
    padding: 12px 24px; /* Adjust padding for a larger button */
    background-color: #4caf50;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-weight: bold;
}

.filter-form button:hover {
    background-color: #45a049;
}

    /* Styling for the date range input fields */
    .filter-form input[type="date"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px; /* Add some space between date inputs */
    }

    /* Styling for the status filter select field */
    .filter-form select[name="status_filter"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px; /* Add some space between select and date inputs */
    }

    /* Stylized print summary button */
#print-summary-button {
    padding: 12px 24px; /* Adjust padding for a larger button */
    background-color: #337ab7; /* Blue color, you can change it as needed */
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-weight: bold;
    margin-top: 20px;
}

#print-summary-button:hover {
    background-color: #286090; /* Darker blue on hover, you can change it as needed */
}

</style>
<button id="scrollToBottomButton" onclick="scrollToBottom()">
    &#9660; <!-- Down arrow HTML entity -->
</button>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <?php if (isset($_SESSION['update'])): ?>
            <div class="success"><?php echo $_SESSION['update']; ?></div>
            <?php unset($_SESSION['update']); ?>
        <?php endif; ?>

        <form action="" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search by Reference#" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" name="search_by_reference">Search</button>
        </form>

        <form action="" method="GET" class="filter-form">
        <label> Sort by date: </label>
            <input type="date" name="start_date" placeholder="Start Date">
            <label>to</label>
            <input type="date" name="end_date" placeholder="End Date">
            
            <label> Status: </label>
            <select name="status_filter">
                <option value="all" <?php echo (isset($_GET['status_filter']) && $_GET['status_filter'] === 'all') ? 'selected' : ''; ?>>All</option>
                <option value="Reserved" <?php echo (isset($_GET['status_filter']) && $_GET['status_filter'] === 'Reserved') ? 'selected' : ''; ?>>Reserved</option>
                <option value="Claimed" <?php echo (isset($_GET['status_filter']) && $_GET['status_filter'] === 'Claimed') ? 'selected' : ''; ?>>Claimed</option>
                <option value="Cancelled" <?php echo (isset($_GET['status_filter']) && $_GET['status_filter'] === 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            </select>
            <button type="submit" name="filter">Filter</button>
        </form>

        <?php
        // Initialize the sorting condition (default: by order date)
        $sort_by_condition = "ORDER BY order_date DESC";

        // Initialize filter conditions
        $status_filter_condition = '';
        $date_filter_condition = '';

        // Check if the filter button is clicked
        if (isset($_GET['filter'])) {
            $status_filter = isset($_GET['status_filter']) ? $_GET['status_filter'] : 'all';

            // Handle status filtering
            if ($status_filter !== 'all') {
                $status_filter_condition = " AND status = '$status_filter'";
            }

            // Handle date filtering
            $start_date = $_GET['start_date'];
            $end_date = $_GET['end_date'];

            if (!empty($start_date) && !empty($end_date)) {
                $date_filter_condition = " AND order_date BETWEEN '$start_date' AND '$end_date'";
            }
        }

        // Initialize reference search condition
        $reference_search_condition = '';

// Check if the search button for reference number is clicked
if (isset($_GET['search_by_reference'])) {
    $search_reference = isset($_GET['search']) ? $_GET['search'] : '';

    // Handle reference number search using LIKE operator
    if (!empty($search_reference)) {
        $reference_search_condition = " AND customer_address LIKE '%$search_reference%'";
    }
}


        // Combine all conditions in the SQL query
        $sql = "SELECT *
            FROM tbl_order
            WHERE restaurant_id = 1" . $status_filter_condition . $date_filter_condition . $reference_search_condition . " " . $sort_by_condition;

        $result = mysqli_query($conn, $sql);

        if ($result):
            $count = mysqli_num_rows($result);
            $resolvedTotal = 0;

            if ($count > 0):
                ?>
                <table class="tbl-full">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Stall</th>
                            <th>Food</th>
                            <th>Price</th>
                            <th>Qty.</th>
                            <th>Total</th>
                            <th>Transaction Date</th>
                            <th>Status</th>
                            <th>Paid On</th>
                            <th>Customer Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Reference Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sn = 1;

                        while ($row = mysqli_fetch_assoc($result)):
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $price * $qty;
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                            $restaurant_id = $row['restaurant_id'];
                            $paid_on = $row['resolved_datetime'];
                            $Stocks = $row['Stocks']; // Fetch the 'stocks' value

                                if ($status === 'Claimed') {
                                    $resolvedTotal += $total;

                                    // Check if the order has already been processed
                                    if (!$row['processed']) {
                                        // Calculate the sold quantity to be added
                                        $sold = $qty;

                                        // Update the food's sold value in the database
                                        $escaped_food = mysqli_real_escape_string($conn, $food);
                                        $update_food_sql = "UPDATE tbl_food SET sold = sold + $qty WHERE title = '$escaped_food'";
                                        mysqli_query($conn, $update_food_sql);

                                        // Update the processed flag for the order
                                        $update_order_sql = "UPDATE tbl_order SET processed = 1 WHERE id = $id";
                                        mysqli_query($conn, $update_order_sql);

                                        // Check if stock is greater than or equal to 1 and update the feature and active columns
                                        if ($Stocks >= 1) {
                                            $update_feature_sql = "UPDATE tbl_food SET feature = 'Yes', active = 'Yes' WHERE title = '$escaped_food'";
                                            $update_feature_result = mysqli_query($conn, $update_feature_sql);

                                            if (!$update_feature_result) {
                                                $error = mysqli_error($conn);
                                                echo "Failed to update feature and active columns: $error";
                                            }
                                        }
                                    }
                                }
                                if ($status === 'Cancelled') {
                                    $resolvedTotal += $total;

                                    // Check if the order has already been processed
                                    if (!$row['processed']) {
                                        // Calculate the sold quantity to be added
                                        $sold = $qty;

                                        // Update the food's sold value in the database
                                        $escaped_food = mysqli_real_escape_string($conn, $food);
                                        $update_stock_sql = "UPDATE tbl_food SET Stocks = Stocks + $sold WHERE title = '$escaped_food'";
                                        mysqli_query($conn, $update_stock_sql);

                                        // Update the processed flag for the order
                                        $update_order_sql = "UPDATE tbl_order SET processed = 1 WHERE id = $id";
                                        mysqli_query($conn, $update_order_sql);

                                        // Check if stock is greater than or equal to 1 and update the feature and active columns
                                        if ($Stocks >= 1) {
                                            $update_feature_sql = "UPDATE tbl_food SET feature = 'Yes', active = 'Yes' WHERE title = '$escaped_food'";
                                            $update_feature_result = mysqli_query($conn, $update_feature_sql);

                                            if (!$update_feature_result) {
                                                $error = mysqli_error($conn);
                                                echo "Failed to update feature and active columns: $error";
                                            }
                                        }
                                    }
                                }

                            ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo "R2K"; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td>
                                    <label class="status-label <?php echo strtolower(str_replace(' ', '-', $status)); ?>"><?php echo $status; ?></label>
                                </td>
                                <td><?php echo $paid_on; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <?php if ($status !== 'Claimed' && $status !== 'Cancelled'): ?>
                                        <form action="" method="POST">
                                            <input type="hidden" name="order_id" value="<?php echo $id; ?>">
                                            <select name="status">
                                                <option <?php echo $status === "Claimed" ? "selected" : ""; ?> value="Claimed">Claimed</option>
                                                <option <?php echo $status === "Cancelled" ? "selected" : ""; ?> value="Cancelled">Cancelled</option>
                                            </select>
                                            <input type="submit" name="submit" value="Update" class="btn-secondary">
                                        </form>
                                    <?php else: ?>
                                        <span class="status-label"><?php echo $status; ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="summary-section">
                    <h2>Summary</h2>
                    <?php
                    if (empty($start_date) || empty($end_date)) {
                        // Calculate the oldest order date from your database
                        $oldestOrderDateSql = "SELECT MIN(order_date) AS oldest_date FROM tbl_order";
                        $oldestOrderDateResult = mysqli_query($conn, $oldestOrderDateSql);
                        $oldestDate = '';

                        if ($oldestOrderDateResult) {
                            $oldestDateRow = mysqli_fetch_assoc($oldestOrderDateResult);
                            $oldestDate = $oldestDateRow['oldest_date'];
                            $oldestDate = date('Y-m-d', strtotime($oldestDate)); // Format as YYYY-MM-DD
                        }

                        if (empty($start_date)) {
                            $start_date = $oldestDate;
                        }

                        if (empty($end_date)) {
                            $end_date = date('Y-m-d'); // Present date
                        }
                    }
                    ?>
                    <p>Dates Between: <?php echo $start_date; ?> - <?php echo $end_date; ?></p>
                    <p>Total Number of Orders: <?php echo $count; ?></p>
                    <p>Total Sales of Paid Orders: <?php echo "₱", $resolvedTotal; ?></p>
                    <button id="print-summary-button">Print Summary</button>
                </div>
            </div>

            <script>
                document.getElementById('print-summary-button').addEventListener('click', function () {
                    window.print();
                });
            </script>
        <?php else:
            echo "<p class='error'>No matching orders found</p>";
        endif;
        else:
            $error = mysqli_error($conn);
            echo "<p class='error'>Error: $error</p>";
        endif;
        ?>
    </div>
</div>





<?php
include('partials/footer.php');

?>

<script>
    // Function to scroll to the bottom of the page
function scrollToBottom() {
    window.scrollTo(0, document.body.scrollHeight);
}

// Event listener for button click
document.getElementById("scrollToBottomButton").addEventListener("click", scrollToBottom);
</script> 

<script>
    // Get all the table rows
const tableRows = document.querySelectorAll('.tbl-full tbody tr');

// Apply animation with delay to each row
tableRows.forEach((row, index) => {
    row.style.animationDelay = `${index * 0.1}s`; // Adjust the delay duration as needed
});
// Add animation class when the search button is clicked
const searchButton = document.querySelector('.search-form button');
searchButton.addEventListener('click', function () {
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.1}s`; // Adjust the delay duration as needed
        row.classList.add('animated-entry'); // Add animation class
    });
});
</script>


