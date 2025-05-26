<?php 
function display_cart() {

    echo '<div class="cart-page">
            <h2 class="cart-title">Your Shopping Cart</h2>
            <div class="cart-container">';

    $total = 0.0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $index => $item) {
            $name = htmlspecialchars($item['name']);
            $desc = htmlspecialchars($item['desc']);
            $image = htmlspecialchars($item['image']);
            $price = number_format($item['price'], 2);
            $quantity = (int)$item['quantity'];
            $subtotal = $item['price'] * $quantity;
            $total += $subtotal;

            echo <<<HTML
<div class="cart-item">
  <img src="assets/pictures/{$image}" alt="{$name}" class="cart-item-image">
  <div class="cart-item-details">
    <h3 class="item-name">{$name}</h3>
    <p class="item-desc">{$desc}</p>
    <p class="item-price">€{$price}</p>
    <div class="item-actions">
      <label for="qty{$index}">Qty:</label>
      <input type="number" id="qty{$index}" name="qty{$index}" value="{$quantity}" min="1" class="qty-input" readonly>
      <button class="remove-item" data-index="{$index}">Remove</button>
    </div>
  </div>
</div>
HTML;
        }
    } else {
        echo "<p>Your cart is empty.</p>";
    }

    $totalFormatted = number_format($total, 2);
    echo <<<HTML
    <!-- Cart Summary -->
    <div class="cart-summary">
      <h3>Cart Total: <span class="total-price">€{$totalFormatted}</span></h3>
      <button class="checkout-button">Proceed to Checkout</button>
    </div>
  </div>
</div>
HTML;
}
