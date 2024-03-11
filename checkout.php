<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Page</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        #cartItems {
            margin-bottom: 20px;
        }

        .cart-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Transaction Page</h1>
        <div id="cartItems" class="fade-in">
            <!-- Cart items will be displayed here -->
        </div>
        <form id="transactionForm" class="fade-in">
            <!-- Transaction form will be here -->
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <!-- Add more fields for transaction details as needed -->
            <input type="submit" value="Place Order">
        </form>
    </div>
    <!-- Add your JavaScript code here -->
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const cartItems = [];

    // Retrieve cart items from URL parameters
    urlParams.forEach((value, key) => {
        if (key.startsWith('id') && urlParams.has('name' + key.substring(2)) && urlParams.has('price' + key.substring(2)) && urlParams.has('quantity' + key.substring(2))) {
            const id = value;
            const name = urlParams.get('name' + key.substring(2));
            const price = parseFloat(urlParams.get('price' + key.substring(2)));
            const quantity = parseInt(urlParams.get('quantity' + key.substring(2)));

            // Push cart item without details
            cartItems.push({ id, name, price, quantity });

            // Perform inline database query to get product details
            <?php
                // Include database connection
                include('constants.php');

                // Query database for product details
                $sql = "SELECT title, price FROM tbl.food WHERE id = $id";
                $result = mysqli_query($conn, $sql);

                // Check if query was successful
                if ($result) {
                    // Fetch product details
                    $row = mysqli_fetch_assoc($result);
                    $productName = $row['title'];
                    $productPrice = $row['price'];

                    // Output product details as JavaScript object
                    echo "
                    const itemIndex = cartItems.findIndex(item => item.id === '$id');
                    cartItems[itemIndex].name = '$productName';
                    cartItems[itemIndex].price = $productPrice;
                    ";
                }
            ?>
        }
    });

    // Function to display cart items
    function displayCartItems() {
        const cartItemsDiv = document.getElementById('cartItems');
        cartItemsDiv.innerHTML = ''; // Clear previous content
        if (cartItems.length > 0) {
            cartItems.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.classList.add('cart-item');
                itemDiv.innerHTML = `
                    <p>Product: ${item.name}</p>
                    <p>Price: ${item.price}</p>
                    <p>Quantity: ${item.quantity}</p>
                    <hr>
                `;
                cartItemsDiv.appendChild(itemDiv);
            });
        } else {
            cartItemsDiv.innerHTML = '<p>No items in cart</p>';
        }
    }

    // Display cart items
    displayCartItems();

    // Add event listener for form submission
    document.getElementById('transactionForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        // Retrieve transaction details from the form
        let fullName = document.getElementById('fullName').value;
        let email = document.getElementById('email').value;
        // Add more fields as needed

        // Perform transaction processing here
        // For example, you can send the transaction details to a server using AJAX

        // Optionally, you can clear the cart items from local storage after successful transaction
        // localStorage.removeItem('cartItems');
        
        // Redirect to a confirmation page or display a success message
        alert('Transaction successful! Thank you for your purchase.');
    });
});
</script>

</body>
</html>
