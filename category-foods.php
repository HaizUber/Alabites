    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .food-search,
        .food-menu {
            margin-bottom: 30px;
        }

        .food-menu h2 {
            margin-bottom: 20px;
            font-size: 32px;
            text-align: center;
        }

        .food-menu-box {
            background-color: #f9f9f9;
            border-radius: 5px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .food-menu-box:hover {
            transform: translateY(-5px);
        }

        .food-menu-img img {
            width: 100%;
            height: auto;
            display: block;
        }

        .food-menu-desc {
            padding: 20px;
        }

        .food-menu-desc h4 {
            margin-top: 0;
            font-size: 24px;
        }

        .food-price {
            font-size: 18px;
            color: #ff5733;
            margin-bottom: 10px;
        }

        .food-detail {
            color: #666;
        }

        .unavailable-label {
            font-size: 18px;
            color: #f00;
            font-style: italic;
        }

        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
        }

        .floating-button a {
            background-color: #ff5733;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .floating-button a:hover {
            background-color: #e6451f;
        }

        .cart-counter {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 18px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 24px;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-body {
            padding: 0;
        }

        .cart-items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cart-items-table th,
        .cart-items-table td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .cart-total {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .modal-body form .form-group {
            margin-bottom: 20px;
        }

        .modal-body form label {
            display: block;
            font-weight: bold;
        }

        .modal-body form input[type="text"],
        .modal-body form input[type="email"],
        .modal-body form input[type="tel"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .modal-body form button[type="submit"] {
            background-color: #ff5733;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .modal-body form button[type="submit"]:hover {
            background-color: #e6451f;
        }

    </style>

    <?php include('config/constants.php'); // Include database connection
    include('partials-front/menu.php');
    // Check if the website is closed based on time
    $timezone = new DateTimeZone('Asia/Manila');
    $currentDateTime = new DateTime(null, $timezone);
    $startTime = '07:00:00'; // 7am (07:00:00)
    $endTime = '17:00:00'; // 5pm (17:00:00)

    $currentTime = $currentDateTime->format('H:i:s'); // Get the current time in 'H:i:s' format

        
    // Process category or search parameters
    if(isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    } elseif(isset($_POST['search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $category_title = "Your Search: \"$search\"";
    } else {
        
        exit(); // Ensure the script stops executing after the redirect
    }
    ?>
    <!-- Your HTML content for food search and menu display -->
    <section class="food-search text-center">
        <!-- Content for food search -->
        <div class="container">
            <?php
            // Check the value of $restaurant_id and display the corresponding image or text
            if ($category_id == 1) {
                echo '<img src="r2k.jpg" alt="R2K" class="img-responsive img-curve" style="max-width: 40%">';
            } elseif ($category_id == 2) {
                echo '<img src="Graciously.jpg" alt="Graciously" class="img-responsive img-curve" style="max-width: 40%">';
            } elseif ($category_id == 3) {
                echo '<img src="cia.jpg" alt="Graciously" class="img-responsive img-curve" style="max-width: 40%">';
            } else {
                // Default text when $restaurant_id doesn't match any of the conditions
                echo 'No Image Available';
            }
            ?>
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" id="food-search-input" placeholder="Search for Food.." required>
            </form>
            <div id="food-search-results"></div>
        </div>
    </section>
    <section class="food-menu">
        <!-- Content for food menu -->
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <div id="animation-container">
                <div id="food-menu-container"> <!-- Container for food menu -->
                    <?php
                    // Display all food items initially
                    $search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
                    $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id AND (stocks > 0 OR title LIKE '%$search%')";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);

                    if ($count2 > 0) {
                        while ($row2 = mysqli_fetch_assoc($res2)) {
                            $id = $row2['id'];
                            $title = $row2['title'];
                            $price = $row2['price'];
                            $description = $row2['description'];
                            $image_name = $row2['image_name'];
                            $stocks = $row2['Stocks'];

                            $isAvailable = $stocks > 0;
                            ?>

                            <div class="food-menu-box <?php echo $isAvailable ? '' : 'unavailable'; ?>">
                                <div class="food-menu-img">
                                    <?php
                                    if ($image_name == "") {
                                        echo "<div class='error'>Image not Available.</div>";
                                    } else {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/<?php echo $image_name; ?>"
                                            alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">₱<?php echo $price; ?></p>
                                    <p class="food-detail">
                                    <?php echo $description; ?>
                                    </p>
                                    <br>
                                    <?php if ($isAvailable) { ?>
                                        <button class="btn btn-primary add-to-cart" data-food-id="<?php echo $id; ?>" data-food-price="<?php echo $price; ?>" data-food-name="<?php echo $title; ?>">Add to Cart</button>
                                    <?php } else { ?>
                                        <span class="unavailable-label">Not Available</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<div class='error'>Food not found.</div>";
                    }
                    ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>

    <!-- Floating button -->
    <div id="floating-button" class="floating-button">
        <a href="#" id="cart-icon-link">
            <i class="fas fa-shopping-cart"></i>
            <span id="cart-counter" class="cart-counter">0</span>
        </a>
        <div id="cart-dropdown" class="cart-dropdown">
            <ul id="cart-items-list" class="cart-items-list"></ul>
        </div>
    </div>

    <div id="cart-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Cart Items</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <table id="cart-items-table" class="cart-items-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items-modal">
                        <!-- Cart items will be dynamically added here -->
                    </tbody>
                </table>
                <p id="cart-total-modal" class="cart-total"></p>

                <!-- Transaction Details Form -->
                <form id="transaction-details-form">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Number:</label>
                        <input type="tel" id="contact" name="contact" required>
                    </div>
                    <div class="form-group">
                        <label for="reference">Reference Number:</label>
                        <input type="text" id="reference" name="reference" required>
                    </div>
                    <button type="submit" id="checkout-button-modal">Checkout</button>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- JavaScript for shopping cart functionality -->
    <script>
    // JavaScript code for shopping cart functionality
    $(document).ready(function(){
        var cartItems = []; // Array to store cart items

    // Add to cart button click event
    $('.add-to-cart').click(function(){
        var foodId = $(this).data('food-id');
        var foodName = $(this).data('food-name');
        var foodPrice = parseFloat($(this).data('food-price'));

        // Check if the item is already in the cart
        var existingItemIndex = cartItems.findIndex(item => item.id === foodId);
        if(existingItemIndex !== -1) {
            // If the item is already in the cart, update the quantity
            cartItems[existingItemIndex].quantity++;
        } else {
            // If the item is not in the cart, add it to the cart
            cartItems.push({ id: foodId, name: foodName, price: foodPrice, quantity: 1 });
        }

        // Update cart counter
        $('#cart-counter').text(cartItems.length);

        // Show success message
        alert('Item added to cart');

        // Prevent default form submission
        return false;
    });

        // Cart icon click event
        $('#cart-icon-link').click(function(){
            // Display the cart modal
            $('#cart-modal').css('display', 'block');

            // Render cart items in the modal
            renderCartItems();
        });

        // Close button click event for cart modal
        $('.close').click(function(){
            // Hide the cart modal
            $('#cart-modal').css('display', 'none');
        });

        // Function to render cart items in the modal
        function renderCartItems() {
            var cartItemsHtml = '';
            var cartTotal = 0;
            cartItems.forEach(function(item){
                var total = item.price * item.quantity;
                cartTotal += total;
                cartItemsHtml += '<tr>';
                cartItemsHtml += '<td>' + item.name + '</td>';
                cartItemsHtml += '<td>' + item.price.toFixed(2) + '</td>';
                cartItemsHtml += '<td>' + item.quantity + '</td>';
                cartItemsHtml += '<td>' + total.toFixed(2) + '</td>';
                cartItemsHtml += '</tr>';
            });
            $('#cart-items-modal').html(cartItemsHtml);
            $('#cart-total-modal').text('Total: ₱' + cartTotal.toFixed(2));
        }

    // Checkout button click event for cart modal
$('#checkout-button-modal').click(function(){
    var name = $('#name').val();
    var email = $('#email').val();
    var contact = $('#contact').val();
    var reference = $('#reference').val();

    // Prepare data to send to server (cart items and transaction details)
    var data = {
        cartItems: cartItems,
        name: name,
        email: email,
        contact: contact,
        reference: reference
    };
    console.log(data);

  // Send data to server using AJAX
  $.ajax({
        url: 'http://localhost/files/process_order.php',
        type: 'POST',
        data: data,
        success: function(response) {
            if (response === 'success') {
                alert('Transaction successful! Thank you for your purchase.');
                cartItems = []; // Clear cart
                $('#cart-counter').text('0'); // Reset cart counter
                renderCartItems(); // Render empty cart in modal
                $('#cart-modal').css('display', 'none'); // Hide cart modal
            } else {
                alert('Transaction successful! Thank you for your purchase.');
            }
        },
        error: function(xhr, status, error) {
            alert('Transaction successful! Thank you for your purchase.');
            console.error(xhr, status, error);
        }
    });

        });
    });
    </script>
    <?php include('partials-front/footer.php'); ?>
