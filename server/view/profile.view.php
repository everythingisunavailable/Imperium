<?php 
function display_profile(){
    echo <<<HTML
    <div class="profile-page">
  <aside class="profile-sidebar">
    <img src="assets/pictures/profilepic.png" alt="Profile Picture" class="profile-picture" />
    <h2 class="profile-name">Imperium</h2>
    <p class="profile-email">nuk_e_di@gmail.com</p>
    <p class="profile-member-since">Member since: Jan 2023</p>
  </aside>

  <main class="profile-main">
    <section class="profile-section">
      <h3 class="section-title">Order History</h3>
      <ul class="item-list">
        <li class="item-card">
          <p><strong>Order #12345</strong> – Alienware x17 Gaming Laptop</p>
          <p class="item-subtext">Delivered: March 21, 2025</p>
        </li>
        <li class="item-card">
          <p><strong>Order #12312</strong> – Razer BlackWidow V4 Keyboard</p>
          <p class="item-subtext">Delivered: February 14, 2025</p>
        </li>
      </ul>
    </section>

    <section class="profile-section">
      <h3 class="section-title">Saved Items</h3>
      <div class="saved-items-grid">
        <div class="item-card">
          <h4 class="item-title">Razer Blade 16 (2024)</h4>
          <p class="item-subtext">Intel i9, RTX 4080, 32GB RAM</p>
          <button class="add-to-cart">Add to Cart</button>
        </div>
        <div class="item-card">
          <h4 class="item-title">Logitech G Pro X Wireless Headset</h4>
          <p class="item-subtext">DTS:X Surround, Detachable Mic</p>
          <button class="add-to-cart">Add to Cart</button>
        </div>
      </div>
    </section>
  </main>
</div>
HTML;
}