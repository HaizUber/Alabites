<?php include('partials/menur2kcons.php'); 

// Check whether Update Button is Clicked or Not
if (isset($_POST['submit'])) {
    // Get All the Values from Form
    $id = $_POST['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $total = $price * $qty;

    $status = $_POST['status'];

    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];

    // Set the timezone to Asia/Manila
    date_default_timezone_set('Asia/Manila');

    // Get the current time in the Philippines
    $resolved_datetime = date('Y-m-d H:i:s');

    // Update the Values
    $sql = "UPDATE tbl_order SET 
        qty = $qty,
        total = $total,
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_address = '$customer_address',
        resolved_datetime = '$resolved_datetime'
        WHERE id = $id";

    $res = mysqli_query($conn, $sql);

    // Check whether the update was successful or not
    // And Redirect to Manage Order with Message
    if ($res) {
        $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-r2korder.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
        header('location:' . SITEURL . 'admin/manage-r2lorder.php');
    }
}

?>




<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php 
            // Check whether id is set or not
            if(isset($_GET['id'])) {
                // Get the Order Details
                $id = $_GET['id'];

                // Get all other details based on this id
                // SQL Query to get the order details
                $sql = "SELECT * FROM tbl_order WHERE id = $id";
                // Execute Query
                $res = mysqli_query($conn, $sql);
                // Count Rows
                $count = mysqli_num_rows($res);

                if($count == 1) {
                    // Detail Available
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    $paid_on = $row['resolved_datetime']; // Get the "Paid On" date and time from the database
                } else {
                    // Detail not Available
                    // Redirect to Manage Order
                    header('location:'.SITEURL.'admin/manage-r2korder.php');
                }
            } else {
                // Redirect to Manage Order Page
                header('location:'.SITEURL.'admin/manage-r2korder.php');
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b> <?php echo $food; ?> </b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b> $ <?php echo $price; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Pending Order"){echo "selected";} ?> value="Pending Order">Pending Order</option>
                            <option <?php if($status=="Ongoing"){echo "selected";} ?> value="Ongoing">Ongoing</option>
                            <option <?php if($status=="Paid"){echo "selected";} ?> value="Paid">Paid</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>Reference Number: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5" readonly><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Paid On: </td>
                    <td>
                        <b><?php echo date('Y-m-d H:i:s', strtotime($paid_on)); ?></b>
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php 
?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
