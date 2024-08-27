<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['cart'])) {
    $user_email = $_SESSION['user_email'];  // Assuming you have the user's email in the session
    $transaction_number = uniqid('trans_');
    $total_price = 0;

    // Insert the main transaction
    $query = "INSERT INTO transactions (transaction_number, user_email, transaction_time) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $transaction_number, $user_email);
    $stmt->execute();
    $stmt->close();

    // Loop through cart items and insert transaction details
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $query = "SELECT name, price FROM products WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->bind_result($name, $price);
        $stmt->fetch();
        $stmt->close();

        $item_total = $price * $quantity;
        $total_price += $item_total;

        $query = "INSERT INTO transaction_details (transaction_number, product_name, product_price, quantity) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssdi", $transaction_number, $name, $price, $quantity);
        $stmt->execute();
        $stmt->close();
    }

    // Update transaction with the total price
    $query = "UPDATE transactions SET total_price = ? WHERE transaction_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ds", $total_price, $transaction_number);
    $stmt->execute();
    $stmt->close();

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to a success page
    header("Location: success.php?transaction_number=$transaction_number");
    exit();
} else {
    header('Location: cart.php');  // Redirect to cart if no items
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .loading-screen { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); display: flex; align-items: center; justify-content: center; z-index: 9999; }
        .loading-screen .spinner-border { width: 3rem; height: 3rem; }
    </style>
</head>
<body>
    <div class="loading-screen" id="loading-screen">
        <div>
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h3 class="mt-3">Your order is being processed. Thank you!</h3>
            <p id="transaction-number"></p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const response = <?php echo json_encode($response); ?>;
            const transactionNumber = response.match(/Your transaction number is (.*)/)[1] || '';
            document.getElementById('transaction-number').textContent = 'Your transaction number is: ' + transactionNumber;

            setTimeout(() => {
                document.getElementById('loading-screen').style.display = 'none';
                window.location.href = 'products.php';
            }, 3000);
        });
    </script>
</body>
</html>