<?php
// Check if the website is closed based on time
$currentDateTime = new DateTime();
$startTime = new DateTime('10:00:00'); // Set your desired start time
$endTime = new DateTime('5:00:00'); // Set your desired end time
$websiteClosed = ($currentDateTime >= $startTime && $currentDateTime <= $endTime);

if ($websiteClosed) {
    // Display the closed banner
    echo '<div style="background-color: #ff0000; color: #ffffff; text-align: center; padding: 10px;">
            <h3>Website Closed</h3>
            <p>We apologize for the inconvenience. The website is currently closed for maintenance.</p>
          </div>';
} else {
    // Website is open, display regular content
    include('partials-front/menu.php');
    ?>
	
    <?php 
        // Check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            // Get the Food id and details of the selected food
            $food_id = $_GET['food_id'];

            // Get the Details of the Selected Food
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            // Execute the Query
            $res = mysqli_query($conn, $sql);
            // Count the rows
            $count = mysqli_num_rows($res);
            // Check whether the data is available or not
            if($count==1)
            {
                // We have data
                // Get the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                // Food not available
                // Redirect to Home Page
                header('location:'.SITEURL);
            }
        }
        else
        {
            // Redirect to homepage
            header('location:'.SITEURL);
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

                    <div class="food-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">₱<?php echo $price; ?></p>
<input type="hidden" name="price" value="<?php echo $price; ?>">

<div class="order-label">Quantity</div>
<input type="number" name="qty" class="input-responsive" value="1" required>
						
<div class="order-total">Total: ₱<span id="total"></span></div>

<script>
    // Get the elements
    const priceElement = document.querySelector('.food-price');
    const qtyElement = document.querySelector('input[name="qty"]');
    const totalElement = document.getElementById('total');

    // Retrieve the price from the HTML
    const price = parseFloat(priceElement.textContent.replace('₱', ''));

    // Function to calculate and display the total
    function calculateTotal() {
        const qty = parseInt(qtyElement.value);
        const total = price * qty;
        totalElement.textContent = total.toFixed(2); // Display total with 2 decimal places
    }

    // Calculate the initial total
    calculateTotal();

    // Add event listener to recalculate the total whenever the quantity changes
    qtyElement.addEventListener('input', calculateTotal);
</script>

                        
                    </div>

                </fieldset>
                
                <fieldset>
				
                    <legend>Order Details</legend>
					<div label for="colors"> <p>What Stall are you ordering from:</label>
        <select name="colors" id="colors">
            <option value="red">R2K [placeholder for Mobile Number]</option>
            <option value="blue">CIA[09455001603]</option>
            <option value="green">Graciously FoodHub[09175019624]</option>
          
        </select>
            </div>
			<div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. 202010924@feualabang.edu.ph" class="input-responsive" required>

                    <div class="order-label">Reference Number(Gcash)</div>
                    <textarea name="address" placeholder="0010 596 664511" class="input-responsive" required></textarea>
								
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
		
                </fieldset>

            </form>

            <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d h:i:sa"); //Order DAte

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>

        </div>
    </section>
	<?php 
        // Check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            // Get the Food id and details of the selected food
            $food_id = $_GET['food_id'];

            // Get the Details of the Selected Food
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            // Execute the Query
            $res = mysqli_query($conn, $sql);
            // Count the rows
            $count = mysqli_num_rows($res);
            // Check whether the data is available or not
            if($count==1)
            {
                // We have data
                // Get the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                // Food not available
                // Redirect to Home Page
                header('location:'.SITEURL);
            }
        }
        else
        {
            // Redirect to homepage
            header('location:'.SITEURL);
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

                    <div class="food-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">₱<?php echo $price; ?></p>
<input type="hidden" name="price" value="<?php echo $price; ?>">

<div class="order-label">Quantity</div>
<input type="number" name="qty" class="input-responsive" value="1" required>
						
<div class="order-total">Total: ₱<span id="total"></span></div>

<script>
    // Get the elements
    const priceElement = document.querySelector('.food-price');
    const qtyElement = document.querySelector('input[name="qty"]');
    const totalElement = document.getElementById('total');

    // Retrieve the price from the HTML
    const price = parseFloat(priceElement.textContent.replace('₱', ''));

    // Function to calculate and display the total
    function calculateTotal() {
        const qty = parseInt(qtyElement.value);
        const total = price * qty;
        totalElement.textContent = total.toFixed(2); // Display total with 2 decimal places
    }

    // Calculate the initial total
    calculateTotal();

    // Add event listener to recalculate the total whenever the quantity changes
    qtyElement.addEventListener('input', calculateTotal);
</script>

                        
                    </div>

                </fieldset>
                
                <fieldset>
				
                    <legend>Order Details</legend>
					<div label for="colors"> <p>What Stall are you ordering from:</label>
        <select name="colors" id="colors">
            <option value="red">R2K [placeholder for Mobile Number]</option>
            <option value="blue">CIA[09455001603]</option>
            <option value="green">Graciously FoodHub[09175019624]</option>
          
        </select>
            </div>
			<div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. 202010924@feualabang.edu.ph" class="input-responsive" required>

                    <div class="order-label">Reference Number(Gcash)</div>
                    <textarea name="address" placeholder="0010 596 664511" class="input-responsive" required></textarea>
								
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
		
                </fieldset>

            </form>

            <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d h:i:sa"); //Order DAte

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
    include('partials-front/footer.php');
}
?>
