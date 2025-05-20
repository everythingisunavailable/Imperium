<?php 
function display_cart(){
  echo <<<HTML
<div class="cart-page">
  <h2 class="cart-title">Your Shopping Cart</h2>
  <div class="cart-container">
    
    <!-- Example Item 1 -->
    <div class="cart-item">
      <img src="assets/pictures/pc.png" alt="Razer Blade 16" class="cart-item-image">
      <div class="cart-item-details">
        <h3 class="item-name">Razer Blade 16 (2024)</h3>
        <p class="item-desc">Intel Core i9, RTX 4080, 32GB RAM, 1TB SSD</p>
        <p class="item-price">€3,299.00</p>
        <div class="item-actions">
          <label for="qty1">Qty:</label>
          <input type="number" id="qty1" name="qty1" value="1" min="1" class="qty-input">
          <button class="remove-item">Remove</button>
        </div>
      </div>
    </div>

    <!-- Example Item 2 -->
    <div class="cart-item">
      <img src="assets/pictures/pc.png" alt="Logitech G Pro X" class="cart-item-image">
      <div class="cart-item-details">
        <h3 class="item-name">Logitech G Pro X Wireless Headset</h3>
        <p class="item-desc">DTS:X Surround, Detachable Mic, Long Battery Life</p>
        <p class="item-price">€199.99</p>
        <div class="item-actions">
          <label for="qty2">Qty:</label>
          <input type="number" id="qty2" name="qty2" value="1" min="1" class="qty-input">
          <button class="remove-item">Remove</button>
        </div>
      </div>
    </div>

    <!-- Cart Summary -->
    <div class="cart-summary">
      <h3>Cart Total: <span class="total-price">€3,498.99</span></h3>
      <button class="checkout-button">Proceed to Checkout</button>
    </div>
  </div>
</div>
HTML;
}
