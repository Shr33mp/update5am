<?php
session_start(); // Start the session

include 'db_connect.php'; // Database connection

$drinks = []; // Initialize the $drinks array

// Fetch product data from the database including stock
$query = "SELECT id, name, price, image, description, stock FROM products";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $drinks[] = $row; // Add each product to the $drinks array
    }
} else {
    echo "No products found.";
}

$conn->close();

// Check if the cart is set in the session
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beer-Tual - Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="vh-100 overflow-auto">
    <?php include 'navbar.php'; ?>
    
    <div class="container my-5">
        <div class="row">
            <div id="products-section" class="col-md-8">
                <div class="row row-cols-3">
                    <?php if (!empty($drinks)): ?>
                        <?php foreach ($drinks as $drink): ?>
                            <div class="col">
                                <div class="card product-card">
                                    <img src="<?php echo htmlspecialchars($drink['image']); ?>" class="card-img-top product-image" alt="<?php echo htmlspecialchars($drink['name']); ?>">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?php echo htmlspecialchars($drink['name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($drink['description']); ?></p>
                                        <p class="card-text">Stock: <?php echo htmlspecialchars($drink['stock']); ?></p>
                                        <p class="card-text">$<?php echo htmlspecialchars($drink['price']); ?></p>
                                        <button class="btn btn-primary add-to-cart" 
                                            data-id="<?php echo htmlspecialchars($drink['id']); ?>"
                                            data-name="<?php echo htmlspecialchars($drink['name']); ?>"
                                            data-price="<?php echo htmlspecialchars($drink['price']); ?>"
                                            data-stock="<?php echo htmlspecialchars($drink['stock']); ?>"
                                            <?php if ($drink['stock'] <= 0) echo 'disabled'; ?>>
                                            <?php echo ($drink['stock'] <= 0) ? 'Out of Stock' : 'Add to Cart'; ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No products available.</p>
                    <?php endif; ?>
                </div>
            </div>
            <div id="cart-section" class="col-md-4">
                <h4>Summary of your cart</h4> <!-- Updated Cart Heading -->
                <ul id="cart-items" class="list-group"></ul>
                <div id="total-price" class="mt-2">Total: $0.00</div>
                <a href="checkout.php" class="btn btn-success mt-3" id="checkout-btn">Checkout</a> <!-- Updated Checkout Button -->
                <button id="remove-all-btn" class="btn btn-danger mt-3">Remove All</button>
            </div>
        </div>
    </div>

    <div class="container my-5 text-center">
        <?php if (isset($_SESSION['username'])): ?>
            <h1 class="display-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <?php else: ?>
            <h1 class="display-4">Welcome to Beer-Tual Guest!</h1>
            <p class="lead">Please proceed to log in or create an account to get started.</p>
        <?php endif; ?>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="toast-body" class="toast-body">
                Product added to cart!
            </div>
        </div>
    </div>

    <script>
    let cart = {}; // Object to store cart items

    document.addEventListener('DOMContentLoaded', function() {
        // Load the cart from the session
        fetch('get_cart.php')
            .then(response => response.json())
            .then(data => {
                cart = data.cart || {}; // Load the cart data from the session if it exists
                updateCartDisplay();
                updateTotalPrice();
            })
            .catch(error => console.error('Error loading cart:', error));

        document.getElementById('products-section').addEventListener('click', function(event) {
            if (event.target && event.target.matches('.add-to-cart')) {
                const button = event.target;
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = parseFloat(button.getAttribute('data-price'));
                const stock = parseInt(button.getAttribute('data-stock'));

                if (stock <= 0) {
                    alert('This item is out of stock.');
                    return;
                }

                // Update cart object
                if (cart[name]) {
                    if (cart[name].quantity < stock) {
                        cart[name].quantity += 1;
                    } else {
                        alert('Cannot add more items than in stock.');
                        return;
                    }
                } else {
                    cart[name] = { id: id, price: price, quantity: 1 };
                }

                // Update cart display
                updateCartDisplay();
                updateTotalPrice();

                // Send the updated cart data to the server
                updateCartOnServer(cart);

                // Show toast notification
                let toast = document.getElementById('toast');
                let toastBody = document.getElementById('toast-body');
                toastBody.textContent = `${name} added to cart!`;
                let toastEl = new bootstrap.Toast(toast);
                toastEl.show();
            }
        });

        function updateCartOnServer(cartData) {
            fetch('update_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ cart: cartData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Cart successfully updated in session.');
                } else {
                    console.error('Failed to update cart in session.');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function updateCartDisplay() {
            let cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';

            for (let product in cart) {
                let item = cart[product];
                let listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                
                let itemContent = document.createElement('div');
                itemContent.className = 'd-flex align-items-center';
                let itemText = document.createElement('span');
                itemText.textContent = `${product} - $${item.price.toFixed(2)} x ${item.quantity}`;
                itemContent.appendChild(itemText);

                let buttonGroup = document.createElement('div');
                buttonGroup.className = 'btn-group ms-3';

                let minusButton = document.createElement('button');
                minusButton.className = 'btn btn-secondary btn-sm';
                minusButton.textContent = '-';
                minusButton.onclick = function() {
                    if (cart[product].quantity > 1) {
                        cart[product].quantity -= 1;
                        updateCartDisplay();
                        updateTotalPrice();
                        updateCartOnServer(cart);
                    }
                };

                let plusButton = document.createElement('button');
                plusButton.className = 'btn btn-secondary btn-sm';
                plusButton.textContent = '+';
                plusButton.onclick = function() {
                    if (cart[product].quantity < item.stock) {
                        cart[product].quantity += 1;
                        updateCartDisplay();
                        updateTotalPrice();
                        updateCartOnServer(cart);
                    } else {
                        alert('Cannot add more items than in stock.');
                    }
                };

                buttonGroup.appendChild(minusButton);
                buttonGroup.appendChild(plusButton);
                itemContent.appendChild(buttonGroup);

                let removeButton = document.createElement('button');
                removeButton.className = 'btn btn-danger btn-sm ms-2';
                removeButton.textContent = 'Remove';
                removeButton.onclick = function() {
                    delete cart[product];
                    updateCartDisplay();
                    updateTotalPrice();
                    updateCartOnServer(cart);
                };

                listItem.appendChild(itemContent);
                listItem.appendChild(removeButton);
                cartItems.appendChild(listItem);
            }
        }

        function updateTotalPrice() {
            let total = 0;
            for (let product in cart) {
                total += cart[product].price * cart[product].quantity;
            }
            document.getElementById('total-price').textContent = `Total: $${total.toFixed(2)}`;
        }

        document.getElementById('remove-all-btn').addEventListener('click', function() {
            cart = {};
            updateCartDisplay();
            updateTotalPrice();
            updateCartOnServer(cart);
        });
    });
    </script>
</body>
</html>
