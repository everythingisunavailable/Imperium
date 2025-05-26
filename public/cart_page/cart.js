document.addEventListener("DOMContentLoaded", () => {
    loadCart();
});

// Load cart items from the server
async function loadCart() {
    try {
        const response = await fetch("../server/control/cart.control.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Request-Type": "load"
            }
        });

        const cartData = await response.json();

        if (Array.isArray(cartData.items)) {
            renderCart(cartData.items);
            updateCartTotal(cartData.items);
        } else {
            document.querySelector('.cart-container').innerHTML = "<p>Your cart is empty.</p>";
        }

    } catch (error) {
        console.error("Error loading cart:", error);
    }
}

// Render cart items dynamically
function renderCart(items) {
    const container = document.querySelector('.cart-container');
    container.innerHTML = ""; // Clear existing items

    items.forEach((item, index) => {
        const subtotal = (item.price * item.quantity).toFixed(2);

        container.innerHTML += `
        <div class="cart-item" data-index="${index}">
            <img src="assets/pictures/${item.image}" alt="${item.name}" class="cart-item-image">
            <div class="cart-item-details">
                <h3 class="item-name">${item.name}</h3>
                <p class="item-desc">${item.desc}</p>
                <p class="item-price">€${item.price.toFixed(2)}</p>
                <div class="item-actions">
                    <label>Qty:</label>
                    <input type="number" value="${item.quantity}" readonly class="qty-input">
                    <button class="remove-item" onclick="removeItem(${index})">Remove</button>
                </div>
            </div>
        </div>
        `;
    });

    // Append summary section after items
    container.innerHTML += `
        <div class="cart-summary">
            <h3>Cart Total: <span class="total-price">Calculating...</span></h3>
            <button class="checkout-button">Proceed to Checkout</button>
        </div>
    `;
}

// Update total cart price
function updateCartTotal(items) {
    const total = items.reduce((sum, item) => sum + item.price * item.quantity, 0);
    document.querySelector('.total-price').textContent = `€${total.toFixed(2)}`;
}

// Remove item from cart
async function removeItem(index) {
    try {
        const response = await fetch("../server/control/shoppingCart.control.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Request-Type": "remove"
            },
            body: JSON.stringify({ index: index })
        });

        const result = await response.json();

        if (result.success) {
            loadCart(); // Reload the updated cart
        } else {
            alert("Failed to remove item from cart.");
        }
    } catch (error) {
        console.error("Error removing item:", error);
    }
}
