<h1>Shopping Cart</h1>

<?php
// Check if there are items in the cart
if (empty($cartItems)) {
  echo "Your cart is empty.";
} else {
  // Display cart items in a table
  echo "<table>";
  echo "<tr><th>Food</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr>";
  $total = 0;
  foreach ($cartItems as $item) {
    $subtotal = $item['price'] * $item['quantity'];
    $total += $subtotal;
    echo "<tr>";
    echo "<td>" . $item['id'] . "</td>"; // Replace with food title retrieval
    echo "<td>₱" . $item['price'] . "</td>";
    echo "<td>" . $item['quantity'] . "</td>";
    echo "<td>₱" . $subtotal . "</td>";
    echo "</tr>";
  }
  echo "<tr><td></td><td></td>
