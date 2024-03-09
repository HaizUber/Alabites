<style>
/* The Modal (background) */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  top: 20;
  padding: 20px;
  border: 2px solid #444; /* Add border for a receipt-like look */
  border-radius: 10px; /* Rounded edges */
  width: 80%;
  max-width: 400px; /* Smaller box */
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  animation-name: animatetop;
  animation-duration: 0.4s;
}

/* Add Animation */
@keyframes animatetop {
  from { top: -300px; opacity: 0; }
  to { top: 0; opacity: 1; }
}

/* The Close Button */
.close {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: green;
  text-decoration: none;
  cursor: pointer;
}

/* Modal Header */
.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

/* Modal Body */
.modal-body {
  padding: 2px 16px;
}

/* Modal Footer */
.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

/* Modal Title */
.modal-title {
  font-size: 24px;
  color: #333;
  margin-bottom: 10px;
}

/* Modal Reference Number */
.modal-reference {
  font-size: 18px;
  color: #444;
}

@media (max-width: 768px) {
  .modal-content {
    max-width: 90%;
  }
  .modal-title {
    font-size: 20px;
  }
  .modal-reference {
    font-size: 16px;
  }
}

.btn.btn-primary {
  background-color: #5cb85c;
  color: white;
  font-size: 16px;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.btn.btn-primary:disabled {
  background-color: gray;
  cursor: not-allowed;
  pointer-events: none; /* Disable hover when button is disabled */
}

.btn.btn-primary:not(:disabled):hover {
  background-color: #449d44; /* Color change on hover only when enabled */
}

body {
            font-family: Arial, sans-serif;
        }

        .closed-banner {
            background-color: #ff0000;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            display: none; /* Initially hidden */
        }

        .closed-banner.show {
            display: block; /* Display when website is closed */
        }

        .closed-banner h3 {
            font-size: 24px;
        }

        .closed-banner p {
            font-size: 16px;
        }

        /* Add animation styles here */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .closed-banner.animation {
            animation: fadeIn 1s; /* Apply fadeIn animation */
        }
        .stock-message {
        color: red; /* Text color for the error message */
        font-size: 14px; /* Adjust the font size as needed */
        margin-top: 5px; /* Add spacing above the message */
    }
    .order-total {
        font-size: 18px; /* Adjust the font size as needed */
        margin-top: 10px; /* Add spacing above the total display */
    }
    

</style>


<?php
// Check if the website is closed based on time
$timezone = new DateTimeZone('Asia/Manila');
$currentDateTime = new DateTime(null, $timezone);
$startTime = '07:00:00'; // 7am (07:00:00)
$endTime = '17:00:00'; // 5pm (17:00:00)

$currentTime = $currentDateTime->format('H:i:s'); // Get the current time in 'H:i:s' format

$websiteClosed = ($currentTime < $startTime || $currentTime >= $endTime);

if ($websiteClosed) {
    // Redirect to alabitesclosed.php
    header('Location: alabitesclosed.php');
    exit(); // Ensure the script stops executing after the redirect
} else {
    // Website is open, display regular content
    include('partials-front/menu.php');
}
?>


 <?php
// Check whether food id is set or not
if (isset($_GET['food_id'])) {
    // Get the Food id and details of the selected food
    $food_id = $_GET['food_id'];

    // Get the Details of the Selected Food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    // Execute the Query
    $res = mysqli_query($conn, $sql);
    // Count the rows
    $count = mysqli_num_rows($res);
    // Check whether the data is available or not
    if ($count == 1) {
        // We have data
        // Get the Data from Database
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
        $Stocks = $row['Stocks'];
        $sold = $row['sold'];
    } else {
        // Food not available
        // Redirect to Home Page
        header('location:' . SITEURL);
        exit(); // Add this line to stop executing the rest of the code
    }
} else {
    // Redirect to homepage
    header('location:' . SITEURL);
    exit(); // Add this line to stop executing the rest of the code
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        <!-- Rest of the code... -->
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="row">
                    <div class="col-md-6">
                        <div class="food-menu-img">
                            <?php
                            // Check whether the image is available or not
                            if ($image_name == "") {
                                // Image not Available
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                // Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>" alt="food" class="img-responsive img-curve">
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="food-menu-desc">
                            <h3><?php echo $title; ?></h3>
                            <input type="hidden" name="food" value="<?php echo $title; ?>">
                            <div class="order-label">Stocks</div>
                            <p><?php echo $Stocks; ?></p>
                            <p class="food-price">₱<?php echo $price; ?></p>
                            <input type="hidden" name="price" value="<?php echo $price; ?>">

                            <div class="order-label">Quantity</div>
                            <input type="number" name="qty" class="input-responsive" value="1" min="1" max="<?php echo $Stocks; ?>" required>
                            <input type="hidden" name="sold" value="<?php echo $sold; ?>">
                            <div class="stock-message"></div> <!-- Stock message element -->
                            <div class="order-total">Total: ₱<span id="total"></span></div>
                        </div>
                    </div>
                </div>

                <script>
    // Get the elements
    const priceElement = document.querySelector('.food-price');
    const qtyElement = document.querySelector('input[name="qty"]');
    const totalElement = document.getElementById('total');
    const stockMessage = document.querySelector('.stock-message'); // Add stock message element

    // Retrieve the price from the HTML
    const price = parseFloat(priceElement.textContent.replace('₱', ''));

    // Function to calculate and display the total
    function calculateTotal() {
        const qty = parseInt(qtyElement.value);
        const total = price * qty;
        totalElement.textContent = total.toFixed(2); // Display total with 2 decimal places

        // Check if quantity is greater than $Stocks
        const stocksAvailable = <?php echo $Stocks; ?>; // Get $Stocks from PHP
        if (qty > stocksAvailable) {
            stockMessage.textContent = 'Quantity exceeds available stocks. Please enter a lower quantity.';
        } else {
            stockMessage.textContent = ''; // Clear the stock message
        }
    }

    // Calculate the initial total
    calculateTotal();

    // Add event listener to recalculate the total whenever the quantity changes
    qtyElement.addEventListener('input', calculateTotal);
</script>

            </fieldset>

            <fieldset>
                <legend>Order Details</legend>

                <?php
                // Check whether food id is set or not
                if (isset($_GET['food_id'])) {
                    // Get the Food id and details of the selected food
                    $food_id = $_GET['food_id'];

                    // Get the Details of the Selected Food
                    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
                    // Execute the Query
                    $res = mysqli_query($conn, $sql);
                    // Count the rows
                    $count = mysqli_num_rows($res);
                    // Check whether the data is available or not
                    if ($count == 1) {
                        // We have data
                        // Get the Data from Database
                        $row = mysqli_fetch_assoc($res);

                        $restaurant_id = $row['category_id'];
                    } else {
                        // Food not available
                        // Redirect to Home Page
                        header('location:' . SITEURL);
                        exit(); // Add this line to stop executing the rest of the code
                    }
                } else {
                    // Redirect to homepage
                    header('location:' . SITEURL);
                    exit(); // Add this line to stop executing the rest of the code
                }
                ?>

                <!-- which stall section... -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="order-label">Stall GCASH Number</div>
                        <select name="restaurant_id2" class="input-responsive" required disabled>
                            <option value="">Select a Stall</option>
                            <option value="1" <?php if ($restaurant_id == 1) echo "selected"; ?>>R2K [09477102348] </option>
                            <option value="3" <?php if ($restaurant_id == 3) echo "selected"; ?>>CIA[09455001603]</option>
                            <option value="2" <?php if ($restaurant_id == 2) echo "selected"; ?>>Graciously FoodHub[09175019624]</option>
                        </select>
                        <div class="col-md-6">

                        <div class="food-menu-img">
    <br>
    <div id="qrCodeImage">
        <?php
        // Check the value of $restaurant_id and display the corresponding image or text
        if ($restaurant_id == 1) {
            echo '<img src="r2kgcashqrcode.jpg" alt="R2K GCash QR Code" class="img-responsive img-curve">';
            echo '<a href="r2kgcashqrcode.jpg" download="r2kgcashqrcodee.jpg">Download QR Code</a>';
        } elseif ($restaurant_id == 2) {
            echo '<img src="graciouslygcashqrcode.jpg" alt="Graciously GCash QR Code" class="img-responsive img-curve">';
            echo '<a href="graciouslygcashqrcode.jpg" download="graciouslygcashqrcodee.jpg">Download QR Code</a>';
        } else {
            // Default text when $restaurant_id doesn't match any of the conditions
            echo 'No QR Code Available';
        }
        ?>
    </div>
</div>

</div>

                        <select name="restaurant_id" class="input-responsive" required hidden>
                            <option value="">Select a Stall</option>
                            <option value="1" <?php if ($restaurant_id == 1) echo "selected"; ?>>R2K [09477102348]</option>
                            <option value="3" <?php if ($restaurant_id == 3) echo "selected"; ?>>CIA[09455001603]</option>
                            <option value="2" <?php if ($restaurant_id == 2) echo "selected"; ?>>Graciously FoodHub[09175019624]</option>
                        </select>
                    </div>
                </div>

                <!-- end of which stall section... -->

                <br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div class="order-label">1.Name</div>
<input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>

<div class="order-label">2.Phone Number</div>
<input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required disabled>

<div class="order-label">3.Email</div>
<input type="email" name="email" placeholder="E.g. 202010924@feualabang.edu.ph" class="input-responsive" required disabled>

<div class="order-label">4.Reference Number (GCASH)</div>
<input type="text" name="address" placeholder="0010596664511" class="input-responsive" required disabled>
<div class="order-label">5. Accept Terms and Conditions</div>
<input type="checkbox" name="terms_acceptance" required>
<label for="terms_acceptance" id="terms-label">I accept the <a href="#" id="termsLink">Terms and Conditions</a></label>

<input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" disabled>

<!-- Modal HTML -->
<div id="terms-modal" class="modal-terms" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" id="close-modal-terms">&times;</span>
            <h2>Terms and Conditions</h2>
        </div>
        <div class="modal-body">
            <p>By using the Alabites service, you agree to the following terms and conditions:</p>
            <ol>
                <li>Your information will be stored confidentially in our database.</li>
                <li>Orders placed through the Alabites service are valid until 5 PM of the same day, concessionaires reserve the right to cancel all reserved and/or unclaimed food after this time. No refunds will be allowed.</li>
                <li>Alabites reserves the right to modify or terminate the service at any time without prior notice.</li>
                <li>You are responsible for ensuring the accuracy of your order details. Alabites is not responsible for errors in your order.</li>
                <li>Alabites does not guarantee the availability of any specific meal or concessionaire at any given time.</li>
                <li>Any disputes or concerns should be directed to Alabites customer support: <a href="mailto:alabitessupport@gmail.com">alabitessupport@gmail.com</a></li>
            </ol>
        </div>
    </div>
</div>


<style>
    /* Modal-terms (Your renamed modal class) */
.modal-terms {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Modal-terms Content */
.modal-terms .modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    top: 90px;
    padding: 20px;
    border: 2px solid #444;
    border-radius: 10px;
    width: 80%;
    max-width: 400px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    animation-name: animatetop;
    animation-duration: 0.4s;
    transition: top 0.4s;
    text-align: center;
}
/* Add Animation */
@keyframes animatetop {
    from {
        top: -300px;
        opacity: 0;
    }
    to {
        top: 150px; /* End position */
        opacity: 1;
    }
}

/* The Close Button for Modal-terms */
.modal-terms .close {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.modal-terms .close:hover,
.modal-terms .close:focus {
    color: green;
    text-decoration: none;
    cursor: pointer;
}

/* Modal-terms Header */
.modal-terms .modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

/* Modal-terms Body */
.modal-terms .modal-body {
    padding: 20px 0;
    color: #333;
    font-size: 18px; /* Increased font size for better readability */
    line-height: 1.5; /* Increased line height for better spacing */
    text-align: left;
}

/* Modal-terms Footer */
.modal-terms .modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
}

/* Modal-terms Title */
.modal-terms .modal-title {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

/* Modal-terms Reference Number */
.modal-terms .modal-reference {
    font-size: 18px;
    color: #444;
}

/* Media Query for Responsive Design */
@media (max-width: 768px) {
    .modal-terms .modal-content {
        max-width: 90%;
    }
    .modal-terms .modal-title {
        font-size: 20px;
    }
    .modal-terms .modal-reference {
        font-size: 16px;
    }
}
</style>

<script>
// Get the elements
const nameInput = document.querySelector('input[name="full-name"]');
const phoneInput = document.querySelector('input[name="contact"]');
const emailInput = document.querySelector('input[name="email"]');
const referenceInput = document.querySelector('input[name="address"]');
const termsCheckbox = document.querySelector('input[name="terms_acceptance"]');
const confirmButton = document.querySelector('input[name="submit"]');
const errorMessage = document.querySelector('.error-message'); // Error message element

// Initially disable all fields and the "Order Now" button
phoneInput.setAttribute('disabled', 'true');
emailInput.setAttribute('disabled', 'true');
referenceInput.setAttribute('disabled', 'true');
confirmButton.setAttribute('disabled', 'true');

// Add input event listeners to all fields and the terms checkbox
const inputFields = [nameInput, phoneInput, emailInput, referenceInput, termsCheckbox];

inputFields.forEach((field, index) => {
    field.addEventListener('input', () => {
        if (areAllFieldsFilled() && termsCheckbox.checked) {
            confirmButton.removeAttribute('disabled');
        } else {
            confirmButton.setAttribute('disabled', 'true');
        }

        if (field === referenceInput) {
            // Limit reference number to 13 characters
            if (field.value.length > 13) {
                field.value = field.value.slice(0, 13);
                document.getElementById('reference-error-message').textContent = 'Reference Number cannot exceed 13 digits';
            } else {
                document.getElementById('reference-error-message').textContent = ''; // Clear error message
            }
        }

        if (field.value) {
            if (index < inputFields.length - 1) {
                inputFields[index + 1].removeAttribute('disabled');
            }
        } else {
            inputFields.slice(index + 1).forEach((disabledField) => {
                disabledField.setAttribute('disabled', 'true');
            });
        }
    });
});

// JavaScript to handle the terms modal
const termsLabel = document.getElementById("terms-label");
const termsModal = document.getElementById("terms-modal");
const closeBtn = document.getElementById("close-modal-terms");

function openTermsModal() {
    termsModal.style.display = "block";
}

function closeTermsModal() {
    termsModal.style.display = "none";
}

termsLabel.addEventListener("click", () => {
    openTermsModal();
});

closeBtn.addEventListener("click", () => {
    closeTermsModal();
});

window.addEventListener("click", (e) => {
    if (e.target === termsModal) {
        closeTermsModal();
    }
});


// Check if all fields are filled and the terms checkbox is checked
function areAllFieldsFilled() {
    return inputFields.every((field) => field.value) && termsCheckbox.checked;
}
</script>






<?php
// Check whether submit button is clicked or not
if (isset($_POST['submit'])) {
    // Get all the details from the form
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $restaurant_id = $_POST['restaurant_id'];
    $total = $price * $qty; // total = price x qty 

    // Check if the quantity exceeds the available stocks
    if ($qty > ($Stocks)) {
        echo '<div class="error text-center">Quantity exceeds available stocks. Please enter a lower quantity.</div>';
    } else {
        // Set the desired time zone
        $timezone = new DateTimeZone('Asia/Manila');
        $currentDateTime2 = new DateTime(null, $timezone);
        $order_date = $currentDateTime2->format("Y-m-d H:i:s"); // Convert DateTime to string

        $status = "Pending Order";  // Ordered, On Delivery, Delivered, Cancelled

        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];

        // Check if the reference number has at least 10 digits
        if (strlen($customer_address) < 10 || strlen($customer_address) > 13) {
            echo '<div class="error text-center">Reference Number must have at least 10-13 digits.</div>';
        } else if (strlen($customer_contact) !== 11) {
            // Check if the mobile number has exactly 11 digits
            echo '<div class="error text-center">Mobile Number must have exactly 11 digits.</div>';
        } else {
            // Check if the reference number already exists in the database
            $existingReferenceQuery = "SELECT COUNT(*) AS count FROM tbl_order WHERE customer_address = '$customer_address'";
            $existingReferenceResult = mysqli_query($conn, $existingReferenceQuery);

            if ($existingReferenceResult) {
                $row = mysqli_fetch_assoc($existingReferenceResult);
                $existingReferenceCount = $row['count'];

                if ($existingReferenceCount > 0) {
                    // Display an error message to the user
                    echo '<div class="error text-center">The reference number is already in the database and is invalid.</div>';
                } else {
                    // Save the Order in Database
                    // Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address, restaurant_id) VALUES 
                        ('$food', $price, $qty, $total, '$order_date', 'Reserved', '$customer_name', '$customer_contact', '$customer_email', '$customer_address', '$restaurant_id')
                    ";

                    // Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2) {
                        // Get the reference number from the latest entry
                        $sql3 = "SELECT customer_address FROM tbl_order ORDER BY order_date DESC LIMIT 1";
                        $result = mysqli_query($conn, $sql3);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $referenceNumber = $row['customer_address'];

                            // Update the 'Stocks' in tbl_food
                            $escaped_food = mysqli_real_escape_string($conn, $food);
                            $update_stock_sql = "UPDATE tbl_food SET Stocks = Stocks - $qty WHERE title = '$escaped_food'";
                            $update_stock_result = mysqli_query($conn, $update_stock_sql);

                            if (!$update_stock_result) {
                                $error = mysqli_error($conn);
                                echo "Failed to update Stocks column: $error";
                            }

                            // Display the modal after a successful order
                            echo '<script>
                            window.addEventListener("load", function() {
                                var modal = document.getElementById("myModal");
                                var closeModal = document.getElementById("closeModal");
                                var referenceNumberElement = document.getElementById("referenceNumber");
                        
                                // Update this line to set the referenceNumber from PHP
                                referenceNumberElement.textContent = "' . $customer_address . '"; // Set the currently inputted reference number
                        
                                closeModal.addEventListener("click", function() {
                                    modal.style.display = "none";
                                    window.location.href = "' . SITEURL . '"; // Redirect when the modal is closed
                                });
                            });
                        </script>';
                            echo '<!-- The Modal -->
                            <div id="myModal" class="modal">
                                <div class="modal-content">
                                    <span class="close" id="closeModal">&times;</span>
                                    <h2 class="modal-title">Thank You for Your Order</h2>
                                    <p>Your order was successful. Please make sure to screenshot this page for verification.</p>
                                    <p class="modal-reference">Your reference number is: <span id="referenceNumber"></span></p>
                                </div>
                            </div>';
                        }
                    } else {
                        // Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:' . SITEURL);
                    }
                }
            } else {
                // Handle the database query error
                echo '<div class="error text-center">Error checking the reference number.</div>';
            }
        }
    }
}
?>



                    <!-- end of reference number section... -->
                </div>
            </fieldset>
        </form>
        <?php
        include('partials-front/footer.php');
        ?>






      