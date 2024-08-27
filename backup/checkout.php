<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty!";
    exit;
}

$cart = $_SESSION['cart'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_number = uniqid('TXN');
    $user_email = $_SESSION['email']; // Assuming user is logged in
    $city = $_POST['city'];
    $municipality = $_POST['municipality'];
    $zipcode = $_POST['zipcode'];
    $house_number = $_POST['house_number'];

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO transactions (transaction_number, user_email, city, municipality, zipcode, house_number) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $transaction_number, $user_email, $city, $municipality, $zipcode, $house_number);
        $stmt->execute();

        $stmt = $conn->prepare("INSERT INTO transaction_details (transaction_number, product_name, product_price, quantity) VALUES (?, ?, ?, ?)");
        foreach ($cart as $item) {
            $stmt->bind_param("ssdi", $transaction_number, $item['name'], $item['price'], $item['quantity']);
            $stmt->execute();
        }

        $conn->commit();
        unset($_SESSION['cart']);
        header("Location: transaction_history.php");
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Beer-Tual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="vh-100 overflow-auto">
    <div class="container my-5">
        <h2>Checkout</h2>
        <form method="POST" action="checkout.php">
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="mb-3">
                <label for="municipality" class="form-label">Municipality</label>
                <input type="text" class="form-control" id="municipality" name="municipality" required>
            </div>
            <div class="mb-3">
                <label for="zipcode" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode" required>
            </div>
            <div class="mb-3">
                <label for="house_number" class="form-label">House Number</label>
                <input type="text" class="form-control" id="house_number" name="house_number" required>
            </div>
            <button type="submit" class="btn btn-primary">Confirm Purchase</button>
        </form>
    </div>
</body>
</html>
