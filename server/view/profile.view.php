<?php 
function display_profile(){
    echo <<<HTML
<div class="profile-page">
  <aside class="profile-sidebar displace-hide animate-in">
    <img src="assets/pictures/profilepic.png" alt="Profile Picture" class="profile-picture" />
    <h2 class="profile-name">Imperium</h2>
    <p class="profile-email">nuk_e_di@gmail.com</p>
    <p class="profile-member-since">Member since: Jan 2023</p>
      <h3 class="section-title">Account Settings</h3>
      <form class="account-form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter new username">
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" id="email" name="email" placeholder="Enter new email">
        </div>
        <div class="form-group">
          <label for="change-password">Password</label>
          <a href="/forgot-password.php" class="password-redirect">Change Password</a>
        </div>
        <button type="submit" class="account-submit">Update Account</button>
      </form>
  </aside>

  <main class="profile-main displace-hide animate-in">
    <section class="profile-section">
      <h3 class="section-title">Order History</h3>
      <ul class="item-list">
        <li class="item-card">
          <div class="order-item">
            <div class="order-img">
              <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="Alienware x17">
            </div>
            <div class="order-details">
              <p><strong>Order #12345</strong></p>
              <p class="item-title">Alienware x17 Gaming Laptop</p>
              <p class="item-info">Intel i9 • RTX 3080 • 32GB RAM • 1TB SSD</p>
              <p class="item-price">$2,499.00</p>
              <p class="item-subtext">Delivered: March 21, 2025</p>
              <div class="product-carousel">
                <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="">
                <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="">
                <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="">
              </div>
            </div>
          </div>
        </li>
        <li class="item-card">
          <div class="order-item">
            <div class="order-img">
              <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="Razer BlackWidow V4">
            </div>
            <div class="order-details">
              <p><strong>Order #12312</strong></p>
              <p class="item-title">Razer BlackWidow V4 Keyboard</p>
              <p class="item-info">Green Switch • Full RGB • Detachable Wrist Rest</p>
              <p class="item-price">$169.99</p>
              <p class="item-subtext">Delivered: February 14, 2025</p>
              <div class="product-carousel">
                <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="">
                <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="">
              </div>
            </div>
          </div>
        </li>
      </ul>
    </section>

    <section class="profile-section">
      <h3 class="section-title">Saved Items</h3>
      <div class="saved-items-grid displace-hide animate-in">
        <div class="item-card">
          <div class="saved-img">
            <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="Razer Blade 16">
          </div>
          <h4 class="item-title">Razer Blade 16 (2024)</h4>
          <p class="item-info">Intel i9 • RTX 4080 • 32GB RAM • 1TB SSD</p>
          <p class="item-price">$2,299.00</p>
          <div class="product-carousel">
            <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="">
            <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="">
          </div>
          <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="item-card">
          <div class="saved-img">
            <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="Logitech G Pro X">
          </div>
          <h4 class="item-title">Logitech G Pro X Wireless Headset</h4>
          <p class="item-info">DTS:X • 2.4GHz Wireless • Blue VO!CE Mic</p>
          <p class="item-price">$199.99</p>
          <div class="product-carousel">
            <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="">
            <img src="assets/pictures/Alienware x17 Gaming Laptop" alt="">
          </div>
          <button class="add-to-cart">Add to Cart</button>
        </div>
      </div>
    </section>
  </main>
</div>
HTML;
}
